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



                <?php
                	if (isset($_GET['source'])) {
                		$source = $_GET['source'];
                		switch ($source) {
                			case 'update':
                				include "includes/update_answer.php";
                				break;
                			
                			default:
                				include "includes/add_answer.php";
                				break;
                		}
                	}
                ?>


                <div class="col-xs-6">
                    <table class="table table-bordered table-hover"  style="overflow: auto;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Answer</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (isset($_SESSION['admin_username'])) {
                                showAllAnswers();
                            }
                            ?>
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
