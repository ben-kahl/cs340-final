<!-- Group 30 - Ben Kahl -->
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
                <h2 class="pull-left">Library Details</h2>
                    <a href="createLibrary.php" class="btn btn-success pull-right">Add New Library</a>
                </div>
                <?php
                require_once "config.php";
                $library = "SELECT  L.library_id, L.name AS library_name, LA.street, LA.city, LA.state, LA.zip FROM LIBRARY L JOIN LIBRARY_ADDR LA ON L.library_id = LA.library_id";
                if($libraryResults = mysqli_query($link, $library)){
                    if(mysqli_num_rows($libraryResults) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th width = 33%>Name</th>";
                                    echo "<th width = 33%>Address</th>";
                                    echo "<th width = 33%>Action</th>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($libraryResults)){
                                echo "<tr>";
                                    echo "<td>" . $row['library_name'] . "</td>";
                                    echo "<td>" . $row['street'] . " " . $row['city'] . " " . $row['state'] . " " . $row['zip'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='viewLibrary.php?library_id=". $row['library_id']."' title='View Library Books and Members' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                                        echo "<a href='editLibrary.php?library_id=". $row['library_id']."' title='Edit Library' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "<a href='deleteLibrary.php?library_id=". $row['library_id']."' title='Delete Library' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($libraryResults);
                    } else{
                        echo "<p class='lead'><em>No records were found for Library.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $library. <br>" . mysqli_error($link);
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