
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small>Author</small>
                </h1>
                
                <div class="col-xs-12" style="overflow: auto;">
                	<table class="table table-bordered table-hover" >
                		<thead>
                			<tr>
                				<th>Quiz Id</th>
                				<th>Quiz Title</th>
                                <th>Question count</th>
                                <th>Remaining Questions</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Add Questions</th>
                			</tr>
                		</thead>
                		<tbody>
                			<?php
                                $query = "SELECT * FROM quiz";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($result)){
                                    $quiz_id = $row['quiz_id'];
                                    $quiz_name = $row['quiz_name'];
                                    $quiz_question_count = $row['quiz_question_count'];
                                    $quiz_remaining_questions = $row['quiz_remaining_questions'];
                                    echo "<tr>";
                                    echo    "<td>{$quiz_id}</td>";
                                    echo    "<td>{$quiz_name}</td>";
                                    echo    "<td>{$quiz_question_count}</td>";
                                    echo    "<td>{$quiz_remaining_questions}</td>";
                                    echo    "<td><a href='quiz.php?source=delt&delete={$quiz_id}'>Delete</a></td>";
                                    echo    "<td><a href='quiz.php?source=edit&update={$quiz_id}'>Edit</a></td>";
                                    echo    "<td><a href='add_question.php?add_ques={$quiz_id}'>See/Add Questions</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                		</tbody>
                	</table>
                </div>
            </div>
        </div>
        <!-- /.row -->

<?php 
    if (isset($_SESSION['admin_username'])) {
        deleteQuiz();
    }
?>
