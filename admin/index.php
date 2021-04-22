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
                    <?php
                        if (isset($_SESSION['admin_username'])) {
                            $admin_firstname = $_SESSION['admin_firstname'];
                            echo "<small>$admin_firstname</small>";
                        }
                    ?>
                    
                </h1>
            </div>
            <?php include "admin_widgets.php"; ?>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>