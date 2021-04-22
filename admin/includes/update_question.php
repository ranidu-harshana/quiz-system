<script type="text/javascript">
    function hideAddQuesForm() {
        document.getElementById('add_ques_form').setAttribute("style", "display:none");
        document.getElementById('add_ques_heading').setAttribute("style", "display:none");
    }

    function updateInputTextBehaviour(){
        var question_answer_type = document.getElementById("edit_ques_select").value;
        console.log(question_answer_type);
        if (question_answer_type != 3 && question_answer_type != 4 && question_answer_type != 5 && question_answer_type != 'default') {
            document.getElementById("question_answer_count").removeAttribute("disabled");
        }else{
            document.getElementById("question_answer_count").setAttribute("disabled", "on");
        }
    }
</script>
<?php
	if (isset($_GET['update'])) {
        echo '<script type="text/javascript">hideAddQuesForm()</script>';
    	$question_id = $_GET['update'];
    
        $get_question = "SELECT * FROM question WHERE question_id = {$question_id}";
        $get_question_query = mysqli_query($connection, $get_question);
        while ($get_question_row = mysqli_fetch_assoc($get_question_query)) {
            $question_desc = $get_question_row['question_desc'];
            $question_answer_count = $get_question_row['question_answer_count'];
            $question_answer_type = $get_question_row['question_answer_type'];
            $type_re = mysqli_query($connection, "SELECT * FROM question_types WHERE question_types_id = {$question_answer_type}");
            if($type_re){
                while ($type_name_row = mysqli_fetch_assoc($type_re)) {
                   $question_types_names = $type_name_row['question_types_names'];
                }
            }else{
                $question_types_names = 'Select Answer Type';
            }
        }
    }
?>
<h3>Update Question</h3>
<form action="" method="post">
    <div class="form-group">
        <label for="question_desc">Question</label>
        <input type="text" class="form-control" name="question_desc" required value="<?php echo $question_desc; ?>">
    </div>
    <div class="form-group">
        <label for="question_answer_type">Question Type&nbsp;&nbsp;</label>
        <select name="question_answer_type" onclick="updateInputTextBehaviour()" id="edit_ques_select">
            <option value="<?php echo $question_answer_type ?>"><?php echo $question_types_names ?></option>
        <?php
            $get_question_type = "SELECT * FROM question_types";
            $get_question_type_query = mysqli_query($connection, $get_question_type);
            while ($get_question_type_row = mysqli_fetch_assoc($get_question_type_query)) {
                $question_types_id = $get_question_type_row['question_types_id'];
                if($question_types_id != $question_answer_type){
                    $question_types_names = $get_question_type_row['question_types_names'];
                    echo "<option value={$question_types_id}>{$question_types_names}</option>";
                }
            }
        ?>
        </select>
    </div>
    <div class="form-group">
        <label for="question_answer_count">Number of Answers</label>
        <input type="text" class="form-control" name="question_answer_count" id="question_answer_count" required value="<?php echo $question_answer_count?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update" value="Update Question" id="update">
    </div>
</form>

<?php
if (isset($_SESSION['admin_username'])) { 
    updateQuestion();
}
?>