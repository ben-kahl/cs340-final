<!-- Group 30 - Ben Kahl -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Borrow Record</title>
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
    if (isset($_GET["book_id"]) && !empty(trim($_GET["book_id"]))) {
        $book_id = trim($_GET["book_id"]);
    }
    require_once "config.php";
    echo "<div class='page-header clearfix'>";
    echo"<h2 class='pull-left'>Book Borrow Record</h2>";
    echo "</div>";
    $sql = "SELECT * FROM BORROWS WHERE book_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $book_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                echo "<div class = 'col-md-4'>";
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th width=10%>Book ID</th>";
                echo "<th width=10%>Member ID</th>";
                echo "<th width=10%>Date Checked Out</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['member_id'] . "</td>";
                    echo "<td>" . $row['book_id'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
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
    mysqli_close($link);
    ?>
</body>