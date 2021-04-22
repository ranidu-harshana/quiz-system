<h3>Update Answer</h3>
<div class="col-xs-6">
    <?php
        if (isset($_GET['edit_answer_id'])) {
            $answer_id = $_GET['edit_answer_id'];
            $get_answer_desc = "SELECT answer_desc FROM answers WHERE answer_id = $answer_id";
            $get_answer_desc_result = mysqli_query($connection, $get_answer_desc);
            while ($get_answer_desc_row = mysqli_fetch_assoc($get_answer_desc_result)) {
                $answer_desc = $get_answer_desc_row['answer_desc'];
            }
        }
    ?>
    <div class="alert alert-info">
        <?php
            if (isset($_GET['question_id'])) {
                $question_id = $_GET['question_id'];
                $get_question = "SELECT * FROM question WHERE question_id = $question_id";
                $get_question_result = mysqli_query($connection, $get_question);
                while ($get_question_row = mysqli_fetch_assoc($get_question_result)) {
                    $question_desc = $get_question_row['question_desc'];
                    $question_answer_count = $get_question_row['question_answer_count'];
                }
            }
        ?>
        <strong>Question >> </strong> <?php echo $question_desc ?>
    </div>
    <form action="" method="post" id="add_answer_form">
        <div class="form-group">
            <label for="answer_desc">Edit Your Answers</label>
            <input type='text' class='form-control' name='answer_desc' required value="<?php echo $answer_desc; ?>">
        </div>
         <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_answer" value="Edit Answer">
        </div>
    </form>
    
</div>
<?php
    if (isset($_SESSION['admin_username'])) {
         updateAnswers($question_answer_count, $question_id);
    } 
?>