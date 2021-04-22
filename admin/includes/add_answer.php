<h3>Add Answer</h3>
<div class="col-xs-6">
    <div class="alert alert-info">
        <?php
            if (isset($_GET['question_id'])) {
                $question_id = $_GET['question_id'];
                $get_question = "SELECT question_desc,question_quiz_id FROM question WHERE question_id = $question_id";
                $get_question_result = mysqli_query($connection, $get_question);
                while ($get_question_row = mysqli_fetch_assoc($get_question_result)) {
                    $question_desc = $get_question_row['question_desc'];
                    $question_quiz_id = $get_question_row['question_quiz_id'];
                }
            }
        ?>
        <strong>Question >> </strong> <a href="add_question.php?add_ques=<?php echo $question_quiz_id ?>"><?php echo $question_desc ?></a>
    </div>
    <form action="" method="post" id="add_answer_form">
        <div class="form-group">
            <label for="answer_desc">Add Your Answers</label>
            <?php
                if (isset($_GET['question_id']) && isset($_GET['question_answer_count'])) {
                    $question_id = $_GET['question_id'];
                    $question_answer_count = $_GET['question_answer_count'];
                    $added_answers = mysqli_query($connection, "SELECT question_added_answers FROM question WHERE question_id = {$question_id}");
                    while ($added_answers_row = mysqli_fetch_assoc($added_answers)) {
                        $remain_answers = $question_answer_count - $added_answers_row['question_added_answers'];
                    }
                    if ($remain_answers > 0) {
                        for ($i=1; $i < $remain_answers + 1; $i++) { 
                            echo "<input type='text' class='form-control' placeholder='Answer {$i}' name='answer_desc[]' required>" . "<br>";
                        }
                        ?>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit_answers" value="Add Answers">
                        </div>
                    <?php
                    }else{
                        ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> You have Entered All answers for this Question.
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </form>
    
</div>
<?php 
if (isset($_SESSION['admin_username'])) {
    addAnswers();
}
?>
<?php
if (isset($_SESSION['admin_username'])) {
    deleteAnswer();
}
?>