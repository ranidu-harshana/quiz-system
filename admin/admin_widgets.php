       
                <!-- /.row -->
                
<div class="col-lg-12">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) FROM quiz";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $quiz_count = $row['COUNT(*)'];
                            echo "<div class='huge'>{$quiz_count}</div>";
                        }
                    ?>
                        <div>Quizes</div>
                    </div>
                </div>
            </div>
            <a href="quiz.php?source">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) FROM question";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $question_count = $row['COUNT(*)'];
                            echo "<div class='huge'>{$question_count}</div>";
                        }
                    ?>
                      <div>Questions</div>
                    </div>
                </div>
            </div>
            <a href="quiz.php?source">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) FROM answers";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $answer_count = $row['COUNT(*)'];
                            echo "<div class='huge'>{$answer_count}</div>";
                        }
                    ?>
                         <div>Answers</div>
                    </div>
                </div>
            </div>
            <a href="quiz.php?source">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT COUNT(*) FROM users";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $users_count = $row['COUNT(*)'];
                            echo "<div class='huge'>{$users_count}</div>";
                        }
                    ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->