<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small>Author</small>
                </h1>
                <div id="match" style="display:none;" class="col-xs-12 alert alert-success">
                      <strong>Success! </strong><span style="color: green"><i class="fas fa-check-circle"></i></span>  Questions are All Set. Good to go.
                </div>
                <div id="mismatch" style="display:none" class="col-xs-12 alert alert-warning">
                    <strong>Warning!</strong> <span id="warning" class="warning"></span>
                </div>
                <div class="col-xs-6">  
                    <script type="text/javascript">
                        function inputTextBehaviour(){
                            var question_answer_type = document.getElementById("question_answer_type").value;
                            console.log(question_answer_type);
                            if (question_answer_type != 3 && question_answer_type != 4 && question_answer_type != 5 && question_answer_type != 'default') {
                                document.getElementById("num_of_answers").removeAttribute("disabled");
                            }else{
                                document.getElementById("num_of_answers").setAttribute("disabled", "on");
                            }
                        }
                    </script> 
                    
                    <h3 id="add_ques_heading">Add Question</h3>       
	                <form action="" method="post" id="add_ques_form">
	                	<div class="form-group">
	                		<label for="question_desc">Question</label>
	                		<input type="text" class="form-control" name="question_desc" required>
	                	</div>
                        <div class="form-group">
                            <label for="question_answer_type">Question Type&nbsp;&nbsp;</label>
                            <select name="question_answer_type" id="question_answer_type" onclick="inputTextBehaviour()">
                                <option value="default">Select Answer Type</option>
                            <?php
                                $get_question_type = "SELECT * FROM question_types";
                                $get_question_type_query = mysqli_query($connection, $get_question_type);
                                while ($get_question_type_row = mysqli_fetch_assoc($get_question_type_query)) {
                                    $question_types_id = $get_question_type_row['question_types_id'];
                                    $question_types_names = $get_question_type_row['question_types_names'];
                                    echo "<option value={$question_types_id}>{$question_types_names}</option>";
                                }
                            ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="question_answer_count">Number of Answers</label>
                            <input type="text" id="num_of_answers" disabled="on" class="form-control" name="question_answer_count" required>
                        </div>
                        
	                	<div class="form-group">
	                		<input type="submit" class="btn btn-primary" name="submit_ques" value="Add Question">
	                	</div>
                        
	                </form>

                    <?php
                    if (isset($_GET['update'])) {
                        include "includes/update_question.php";
                    }
                    ?>

                    <script type="text/javascript">
                        function remain(count){
                            if (count > 0) {
                                document.getElementById('mismatch').setAttribute("style", "display:inline");
                                document.getElementById('warning').innerHTML = '<i class="fas fa-times-circle" style="color:red"></i> There are  '+ count + ' remaining questions to add';
                            }else{
                                document.getElementById('match').setAttribute("style", "display:inline");
                            }
                        }

                       
                    </script>
	                <?php
                        if (isset($_GET['add_ques'])) {
                            $quiz_id = $_GET['add_ques'];
                            $remaning_count = "SELECT quiz_remaining_questions FROM quiz WHERE quiz_id = {$quiz_id}";
                            $remaning_count_result = mysqli_query($connection, $remaning_count);
                            while($result_row = mysqli_fetch_assoc($remaning_count_result)){
                                $quiz_remaining_questions = $result_row['quiz_remaining_questions'];
                                if($quiz_remaining_questions > 0){
                                    echo "<script type='text/javascript'>remain({$quiz_remaining_questions});</script>";
                                }else{
                                    echo "<script type='text/javascript'>remain({$quiz_remaining_questions});</script>";
                                }
                            }
                            
                            if (isset($_POST['submit_ques'])) {
                                if ($quiz_remaining_questions > 0) {
                                    $r = addQuestion();
                                    if ($r) {
                                        $quiz_remaining_questions -= 1;
                                        $remaning_count_update = "UPDATE quiz SET quiz_remaining_questions = '{$quiz_remaining_questions}' WHERE quiz_id = {$quiz_id}";
                                        mysqli_query($connection, $remaning_count_update);
                                        header("Location: add_question.php?add_ques=$quiz_id");
                                    }
                                }
                            }
                        }
                    ?>
                </div>

                <div class="col-xs-6">
                	<table class="table table-bordered table-hover">
                		<thead>
                			<tr>
                				<th>Id</th>
                				<th>Question</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Add Answers</th>
                                <th>Remaining Answers</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php showAllQuestions(); ?>
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
<?php deleteQuestion(); ?>