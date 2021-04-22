<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<div id="page-wrapper">

    <div class="container-fluid">
    	<?php
        if (isset($_SESSION['admin_username'])) {
    		if (isset($_GET['source'])) {
    			$source = $_GET['source'];
    			switch ($source) {
    				case 'edit':
    					include "includes/update_quiz.php";
    					break;
    				case 'delt':
    					include "includes/see_all_quizes.php";
    					break;
    				default:
    					include "includes/see_all_quizes.php";
    					break;
    			}
    		}
        }
    	?>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php 
	include "includes/footer.php";
?>