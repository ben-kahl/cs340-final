<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library DB</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
	<style type="text/css">
        .wrapper{
            width: 70%;
            margin:0 auto;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
		 $('.selectpicker').selectpicker();
    </script>
</head>
<body>
    <?php
        require_once "config.php";
    ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
            <div class="page-header clearfix">
                <h2>Library DB CS340</h2>
                <h2 class="pull-left">Member Details</h2>
                    <a href="createMember.php" class="btn btn-success pull-right">Add New Member</a>
                </div>
                <?php
                require_once "config.php";
                $sql = "SELECT member_id,fname,lname,date_joined,library_id FROM MEMBER";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th width=10%>First Name</th>";
                                    echo "<th width=10%>Last Name</th>";
                                    echo "<th width=10%>Date Joined</th>";
                                    echo "<th width=1%>Library ID</th>";
                                    echo "<th width=10%>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['fname'] . "</td>";
                                    echo "<td>" . $row['lname'] . "</td>";
                                    echo "<td>" . $row['date_joined'] . "</td>";
                                    echo "<td>" . $row['library_id'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='viewBorrowRecord.php?member_id=". $row['member_id']."' title='View Borrow Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                        echo "<a href='viewRatings.php?member_id=". $row['member_id']."' title='View Ratings' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                                        echo "<a href='editMember.php?member_id=". $row['member_id']."' title='Edit Member' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "<a href='deleteMember.php?member_id=". $row['member_id']."' title='Delete Member' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        echo "</table>";
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. <br>" . mysqli_error($link);
                }
                echo "<h2> Books </h2>";
                $sql2 = "SELECT * FROM BOOK";
                if($result2 = mysqli_query($link, $sql2)){
                    if(mysqli_num_rows($result2) > 0){
                        echo "<div class='col-md-4'>";
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th width=10%>Title</th>";
                                    echo "<th width = 10%>Author</th>";
                                    echo "<th width = 10%>Length</th>";
                                    echo "<th width = 10%>ISBN</th>";
                                    echo "<th width = 1%>Availabile</th>";
                                    echo "<th width = 1%>Library ID</th>";
                                    echo "<th width = 10%>Action</th>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result2)){
                                echo "<tr>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['author'] . "</td>";
                                    echo "<td>" . $row['length'] . "</td>";
                                    echo "<td>" . $row['isbn'] . "</td>";
                                    if($row['available'] == 1){
                                        echo "<td>Yes</td>";
                                    } else{
                                        echo "<td>No</td>";
                                    }
                                    echo "<td>" . $row['library_id'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='viewBorrowRecord.php?book_id=". $row['book_id']."' title='View Borrow Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                        echo "<a href='viewRatings.php?book_id=". $row['book_id']."' title='View Ratings' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                                        echo "<a href='deleteBook.php?book_id=". $row['book_id']."' title='Delete Book' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result2);
                    } else{
                        echo "<p class='lead'><em>No records were found for Dept Stats.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql2. <br>" . mysqli_error($link);
                }
                
                // Close connection
                mysqli_close($link);
                ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>