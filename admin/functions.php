<?php

//Functions for Quiz
function addNewQuiz(){
	global $connection;
	if(isset($_POST['submit'])){
		$quiz_name = $_POST['quiz_name'];
		$quiz_question_count = $_POST['quiz_question_count'];
		$quiz_remaining_questions = $_POST['quiz_question_count'];
		
		$quiz_name = mysqli_real_escape_string($connection, $quiz_name);
		$quiz_question_count = mysqli_real_escape_string($connection, $quiz_question_count);
		$quiz_remaining_questions = mysqli_real_escape_string($connection, $quiz_remaining_questions);

		$query = "INSERT INTO quiz(quiz_name, quiz_question_count,quiz_remaining_questions,quiz_date) VALUES('{$quiz_name}', '{$quiz_question_count}', '{$quiz_remaining_questions}', now())";
		$result = mysqli_query($connection, $query);
		if(!$result){
			echo "This quiz is exist try editing it or you are trying enter same name repeatedly!";
		}else{
			header("Location: add_new_quiz.php");
			exit();
		}
	}
}

function showAllQuizes(){
	global $connection;
	$query = "SELECT * FROM quiz";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($result)){
		$quiz_id = $row['quiz_id'];
		$quiz_name = $row['quiz_name'];
		echo "<tr>";
		echo	"<td>{$quiz_id}</td>";
		echo	"<td>{$quiz_name}</td>";
		echo "</tr>";
	}
}

function deleteQuiz(){
	global $connection;
	if (isset($_GET['delete'])) {
		$quiz_id = $_GET['delete'];
		$delete_query = "DELETE FROM quiz WHERE quiz_id = '{$quiz_id}'";
		$result = mysqli_query($connection, $delete_query);

		$delete_ques_query = "DELETE FROM question WHERE question_quiz_id = '{$quiz_id}'";
		$result_ques_query = mysqli_query($connection, $delete_ques_query);

		$delete_answer_query = "DELETE FROM answers WHERE answer_quiz_id = '{$quiz_id}'";
		$result_answer_query = mysqli_query($connection, $delete_answer_query);

		if(!$result && !$result_ques_query && !$result_answer_query){
			die("QUERY FAILED". mysqli_error($connection));
		}else{
			header("Location: quiz.php?source");
		} 
	}
}

function updateQuiz($curr_quiz_question_count, $curr_quiz_remaining_questions){
	global $connection;
	if (isset($_POST['edit_quiz'])) {
		$quiz_id = $_GET['update'];
		$quiz_name = $_POST['quiz_name'];
		$quiz_question_count = $_POST['quiz_question_count'];

		$quiz_name = mysqli_real_escape_string($connection, $quiz_name);
		$quiz_question_count = mysqli_real_escape_string($connection, $quiz_question_count);

		if ($curr_quiz_question_count <= $quiz_question_count) {
			$quiz_remaining_questions = $quiz_question_count - $curr_quiz_question_count;
			$update_query = "UPDATE quiz SET quiz_name = '{$quiz_name}', quiz_question_count = '{$quiz_question_count}', quiz_remaining_questions = quiz_remaining_questions + '{$quiz_remaining_questions}' WHERE quiz_id = '{$quiz_id}'";
			$result = mysqli_query($connection, $update_query);
			if(!$result){
				die("QUERY FAILED" . mysqli_error($connection));
			}else{
				header("Location: quiz.php?source");
			}
		}else{
			$quiz_remaining_questions = $quiz_question_count - ($curr_quiz_question_count - $curr_quiz_remaining_questions);
			if ($quiz_remaining_questions > 0) {
				$update_query = "UPDATE quiz SET quiz_name = '{$quiz_name}', quiz_question_count = '{$quiz_question_count}', quiz_remaining_questions = '{$quiz_remaining_questions}' WHERE quiz_id = '{$quiz_id}'";
				$result = mysqli_query($connection, $update_query);
				if(!$result){
					die("QUERY FAILED" . mysqli_error($connection));
				}else{
					header("Location: quiz.php?source");
				}
			}else {
				echo '<div class="alert alert-danger">';
				echo	'<strong>Danger!</strong> You can not discrease question count any more. You have added some questions to this Quiz';
				echo '</div>';
			}
		}
	}
}



//Functions for Questions
function addQuestion(){
	global $connection;
	if(isset($_POST['submit_ques'])){
		if (isset($_GET['add_ques'])) {
			$question_desc = $_POST['question_desc'];
			$question_answer_type = $_POST['question_answer_type'];

			$question_desc = mysqli_real_escape_string($connection, $question_desc);
			$question_answer_type = mysqli_real_escape_string($connection, $question_answer_type);

			if(empty($_POST['question_answer_count'])){
			    $question_answer_count = 0;
			}else{
			    $question_answer_count = $_POST['question_answer_count'];
			    $question_answer_count = mysqli_real_escape_string($connection, $question_answer_count);
			}
			$question_time = 2;
			$question_quiz_id = $_GET['add_ques'];
			
			
			$query = "INSERT INTO question(question_quiz_id, question_desc, question_answer_count, question_answer_type, question_time, question_date) VALUES('{$question_quiz_id}', '{$question_desc}', '{$question_answer_count}', '{$question_answer_type}', '{$question_time}', now())";
			$result = mysqli_query($connection, $query);
			if(!$result){
				echo("This Question is exist for this quiz try editing it or you are trying enter same name repeatedly!");
				header("Location: add_question.php?add_ques={$question_quiz_id}");
				exit();
			}else{
				return true;
			}
		}
	}
}

function showAllQuestions(){
	global $connection;
	if (isset($_GET['add_ques'])) {
		$quiz_id = $_GET['add_ques'];
		$query = "SELECT * FROM question WHERE question_quiz_id = {$quiz_id}";
		$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($result)){
			$question_id  = $row['question_id'];
			$question_desc = $row['question_desc'];
			$question_answer_type = $row['question_answer_type'];
			$question_answer_count = $row['question_answer_count'];
			$question_added_answers = $row['question_added_answers'];
			$remaining_answers = $question_answer_count - $question_added_answers;
			echo "<tr>";
			echo	"<td>{$question_id}</td>";
			echo	"<td>{$question_desc}</td>";
			echo	"<td><a href='add_question.php?add_ques={$quiz_id}&update={$question_id}' onclick='ll()'>Edit</a></td>";
			echo	"<td><a href='add_question.php?delete_question_id={$question_id}'>Delete</a></td>";
			if($question_answer_type == 'default'){
				echo "<td>You have not select any answer type. Please edit the question and select answer type</td>";
			}else if ($question_answer_type != 3 && $question_answer_type != 4 && $question_answer_type != 5) {
				echo "<td><a href='answer.php?source&question_id=$question_id&question_answer_count=$question_answer_count'>Add or See Answers</a></td>";
			}else{
				echo "<td>No Multiple Answers</td>";
			}
			echo "<td>$remaining_answers</td>";
			echo "</tr>";
		}
	}
		
}

function updateQuestion(){
	global $connection;
	if (isset($_POST['update'])) {
		$question_id = $_GET['update'];
		$quiz_id = $_GET['add_ques'];
		$question_desc = $_POST['question_desc'];
		$question_desc = mysqli_real_escape_string($connection, $question_desc);
        if(empty($_POST['question_answer_count'])){
			    $question_answer_count = 0;
		}else{
		    $question_answer_count = $_POST['question_answer_count'];
		    $question_answer_count = mysqli_real_escape_string($connection,$question_answer_count);
		}
        $question_answer_type = $_POST['question_answer_type'];
        $question_answer_type = mysqli_real_escape_string($connection, $question_answer_type);
        $update = "UPDATE question SET question_desc = '{$question_desc}', question_answer_count = '{$question_answer_count}', question_answer_type = '{$question_answer_type}' WHERE question_id = {$question_id}";
        $update_query = mysqli_query($connection, $update);
        if($update_query){
        	header("Location: add_question.php?add_ques={$quiz_id}");
        }
	}
}


function deleteQuestion(){
	global $connection;
	if (isset($_GET['delete_question_id'])) {
        $delete_question_id = $_GET['delete_question_id'];
        $get_quiz_id = "SELECT question_quiz_id FROM question WHERE question_id = {$delete_question_id}";
        $get_quiz_id_result = mysqli_query($connection, $get_quiz_id);
        while ($get_quiz_id_row = mysqli_fetch_assoc($get_quiz_id_result)) {
            $quiz_id = $get_quiz_id_row['question_quiz_id'];
        }
        $delete_question = "DELETE FROM question WHERE question_id = {$delete_question_id}";
        $delete_question_query = mysqli_query($connection, $delete_question);
        if ($delete_question_query) {
        	mysqli_query($connection, "DELETE FROM answers WHERE answer_question_id = {$delete_question_id}");
            $update_quiz_remaining_questions = "UPDATE quiz SET quiz_remaining_questions = quiz_remaining_questions + 1 WHERE quiz_id  = {$quiz_id}";
            $update_quiz_remaining_questions_result = mysqli_query($connection, $update_quiz_remaining_questions);
            if ($update_quiz_remaining_questions_result) {
                header("Location: add_question.php?add_ques={$quiz_id}");
            }
        }
    }
}




//Functions for Answers
function showAllAnswers(){
	global $connection;
	if (isset($_GET['question_id'])) {
		$question_id = $_GET['question_id'];
		$query = "SELECT * FROM answers WHERE answer_question_id = {$question_id} ORDER BY `answer_id` ASC";
		$result = mysqli_query($connection, $query);
		while($row = mysqli_fetch_assoc($result)){
			$answer_id = $row['answer_id'];
			$answer_desc = $row['answer_desc'];
			echo "<tr>";
			echo	"<td>{$answer_id}</td>";
			echo	"<td>{$answer_desc}</td>";
			echo	"<td><a href='answer.php?edit_answer_id={$answer_id}&source=update&question_id=$question_id'>Edit</a></td>";
			echo	"<td><a href='answer.php?source&delete_answer_id={$answer_id}&question_id={$question_id}'>Delete</a></td>";
			echo "</tr>";
		}
	}
		
}

function addAnswers(){
	global $connection;
	if (isset($_POST['submit_answers'])) {
        $answer_desc = $_POST['answer_desc'];
        $question_id = $_GET['question_id'];
        $question_answer_count = $_GET['question_answer_count'];
        foreach ($answer_desc as $key => $answer) {
            $insert_answer = "INSERT INTO answers(answer_question_id, answer_quiz_id,answer_desc) VALUES({$question_id}, (SELECT question_quiz_id FROM question WHERE question_id = {$question_id}), '{$answer}')";
            $insert_answer_query = mysqli_query($connection, $insert_answer);
            if ($insert_answer_query) {
                mysqli_query($connection, "UPDATE question SET question_added_answers = question_added_answers + 1 WHERE question_id = {$question_id}");
                header("Location: answer.php?source&question_id=$question_id&question_answer_count=$question_answer_count");
            }
        }
    }
}


function updateAnswers($question_answer_count, $question_id){
	global $connection;
	if (isset($_POST['edit_answer'])) {
		$answer_desc = $_POST['answer_desc'];
		$answer_desc = mysqli_real_escape_string($connection, $answer_desc);
		$answer_id = $_GET['edit_answer_id'];
		$edit_answer_result = mysqli_query($connection, "UPDATE answers SET answer_desc = '{$answer_desc}' WHERE answer_id = '{$answer_id}'");
		if ($edit_answer_result) {
			header("Location: answer.php?source&question_id=$question_id&question_answer_count=$question_answer_count");
		}else{
			echo '<div class="alert alert-danger"><strong>Danger!</strong> This answer is already exists.</div>';
		}
	}
}

function deleteAnswer(){
	global $connection;
	if (isset($_GET['delete_answer_id'])) {
        $delete_answer_id = $_GET['delete_answer_id'];
        $question_id = $_GET['question_id'];

        //for sending get request to answer page with default source after deleting
        $get_question_answer_count_result = mysqli_query($connection, "SELECT question_answer_count FROM question WHERE question_id = {$question_id}");
        while ($get_question_answer_count_row = mysqli_fetch_assoc($get_question_answer_count_result)) {
        	$question_answer_count = $get_question_answer_count_row['question_answer_count'];
        }
        $delete_answer = "DELETE FROM answers WHERE answer_id = {$delete_answer_id}";
        $delete_answer_query = mysqli_query($connection, $delete_answer);
        if ($delete_answer_query) {
            $update_question_added_answers = "UPDATE question SET question_added_answers = question_added_answers - 1 WHERE question_id  = {$question_id}";

            $update_question_added_answers_result = mysqli_query($connection, $update_question_added_answers);
            if ($update_question_added_answers_result) {
                header("Location: answer.php?source&question_id=$question_id&question_answer_count=$question_answer_count");
            }
        }
    }
}

?>