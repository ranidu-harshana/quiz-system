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
                <div class="col-xs-6">
	                <form action="" method="post">
	                	<div class="form-group">
	                		<label for="quiz_name">Quiz Name</label>
	                		<input type="text" class="form-control" name="quiz_name" required>
	                	</div>
                        <div class="form-group">
                            <label for="quiz_question_count">Question Count</label>
                            <input type="text" class="form-control" name="quiz_question_count" required>
                        </div>
	                	<div class="form-group">
	                		<input type="submit" class="btn btn-primary" name="submit" value="Add Quiz">
	                	</div>
	                </form>

	                <?php addNewQuiz() ?>

                </div>
                <div class="col-xs-6">
                	<table class="table table-bordered table-hover"  style="overflow: auto;">
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

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php 
	include "includes/footer.php";
?>