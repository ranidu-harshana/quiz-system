<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Welcome to Admin
            <small>Author</small>
        </h1>
        <div class="col-xs-6">
        	<?php
        		if (isset($_GET['update'])) {
        			$quiz_id = $_GET['update'];
        			$get_quiz_details = "SELECT * FROM quiz WHERE quiz_id= {$quiz_id}";
        			$get_quiz_details_result = mysqli_query($connection, $get_quiz_details);
        			while ($get_quiz_details_row = mysqli_fetch_assoc($get_quiz_details_result)) {
        				$quiz_name = $get_quiz_details_row['quiz_name'];
        				$quiz_question_count = $get_quiz_details_row['quiz_question_count'];
        				$quiz_remaining_questions = $get_quiz_details_row['quiz_remaining_questions'];
        			}
        		}
        	?>
            <form action="" method="post">
            	<div class="form-group">
            		<label for="quiz_name">Quiz Name</label>
            		<input type="text" class="form-control" name="quiz_name" required value="<?php echo $quiz_name ?>">
            	</div>
                <div class="form-group">
                    <label for="quiz_question_count">Question Count</label>
                    <input type="text" class="form-control" name="quiz_question_count" required value="<?php echo $quiz_question_count ?>">
                </div>
            	<div class="form-group">
            		<input type="submit" class="btn btn-primary" name="edit_quiz" value="Edit Quiz">
            	</div>
            </form>
        </div>
        <div class="col-xs-6"  style="overflow: auto;">
        	<table class="table table-bordered table-hover">
        		<thead>
        			<tr>
        				<th>Id</th>
        				<th>Quiz Title</th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php showAllQuizes(); ?>
        		</tbody>
        	</table>
        </div>
    </div>
</div>
<!-- /.row -->

<?php 
if (isset($_SESSION['admin_username'])) {    
    updateQuiz($quiz_question_count, $quiz_remaining_questions);
}
?>