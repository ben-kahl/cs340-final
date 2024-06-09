<!-- Group 30 - Ben Kahl -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Library</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        .wrapper {
            width: 70%;
            margin: 0 auto;
        }

        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('.selectpicker').selectpicker();
    </script>
</head>

<body>
    <?php
    session_start();
    if (isset($_GET["library_id"]) && !empty(trim($_GET["library_id"]))) {
        $library_id = trim($_GET["library_id"]);
    }
    require_once "config.php";
    echo "<div class='page-header clearfix'>";
    echo "<h2> Members </h2>";
    echo"<h2 class='pull-left'>Member Details</h2>";
    echo "<a href='createMember.php?library_id=" . $library_id . "' class='btn btn-success pull-right'>Add New Member</a>";
    echo "</div>";
    $sql = "SELECT * FROM MEMBER WHERE library_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $library_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                echo "<div class = 'col-md-4'>";
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
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['fname'] . "</td>";
                    echo "<td>" . $row['lname'] . "</td>";
                    echo "<td>" . $row['date_joined'] . "</td>";
                    echo "<td>" . $row['library_id'] . "</td>";
                    echo "<td>";
                    echo "<a href='viewBorrowRecord.php?member_id=" . $row['member_id'] . "' title='View Borrow Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                    echo "<a href='viewRatings.php?member_id=" . $row['member_id'] . "' title='View Ratings' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                    echo "<a href='editMember.php?member_id=" . $row['member_id'] . "' title='Edit Member' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                    echo "<a href='deleteMember.php?member_id=" . $row['member_id'] . "' title='Delete Member' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. <br>" . mysqli_error($link);
        }
    }
    echo "<div class='page-header clearfix'>";
    echo "<h2> Books </h2>";
    echo"<h2 class='pull-left'>Member Details</h2>";
    echo "<a href='createBook.php?library_id=" . $library_id . "' class='btn btn-success pull-right'>Add New Book</a>";
    echo "</div>";
    $sql2 = "SELECT * FROM BOOK WHERE library_id = ?";
    if ($stmt2 = mysqli_prepare($link, $sql2)) {
        mysqli_stmt_bind_param($stmt2, "i", $library_id);
        if (mysqli_stmt_execute($stmt2)) {
            $result2 = mysqli_stmt_get_result($stmt2);
            if (mysqli_num_rows($result2) > 0) {
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
                while ($row = mysqli_fetch_array($result2)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['length'] . "</td>";
                    echo "<td>" . $row['isbn'] . "</td>";
                    if ($row['available'] == 1) {
                        echo "<td>Yes</td>";
                    } else {
                        echo "<td>No</td>";
                    }
                    echo "<td>" . $row['library_id'] . "</td>";
                    echo "<td>";
                    echo "<a href='viewBorrowRecord.php?book_id=" . $row['book_id'] . "' title='View Borrow Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                    echo "<a href='viewRatings.php?book_id=" . $row['book_id'] . "' title='View Ratings' data-toggle='tooltip'><span class='glyphicon glyphicon-user'></span></a>";
                    echo "<a href='deleteBook.php?book_id=" . $row['book_id'] . "' title='Delete Book' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                // Free result set
                mysqli_free_result($result2);
            }
            } else {
                echo "<p class='lead'><em>No books were found.</em></p>";
            }
    } else {
        echo "ERROR: Could not able to execute $sql2. <br>" . mysqli_error($link);
    }
    mysqli_close($link);
    ?>
</body>