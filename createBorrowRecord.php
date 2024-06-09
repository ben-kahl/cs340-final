<!-- Group 30 - Ben Kahl -->
<?php
session_start();
require_once "config.php";

$member_ids = $book_ids = $availablities = array();

$member_id = $book_id  = $date = "";
$member_id_err = $book_id_err = $member_ids_err = $book_ids_err = $date_err = "";

if(isset($_GET["library_id"]) && !empty(trim($_GET["library_id"]))){
    $_SESSION["library_id"] = trim($_GET["library_id"]);
    $library_id = $_SESSION["library_id"];

    $sql1 = "SELECT M.member_id, M.library_id, B.book_id, B.library_id, B.available FROM MEMBER M JOIN BOOK B ON M.library_id = B.library_id WHERE M.library_id = ?";
    if ($stmt1 = mysqli_prepare($link, $sql1)){
        mysqli_stmt_bind_param($stmt1,"i", $library_id);
        if (mysqli_stmt_execute($stmt1)) {
            $result1 = mysqli_stmt_get_result($stmt1);
            if (mysqli_num_rows($result1) > 0){
                while ($row1 = mysqli_fetch_assoc($result1)){
                    $book_ids[] = $row1["book_id"];
                    $member_ids[] = $row1["member_id"];
                    $availablities[$row1["book_id"]] = $row1["available"];
                }
            }
            else {
                echo "No results found.";
            }
        } else {
            echo "Error executing query";
        }
    mysqli_stmt_close( $stmt1 );
    } else {
        echo "Error preparing statement.";
    }
} else {
    echo "Invalid Library ID.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First name
    $book_id = trim($_POST["book_id"]);
    if (empty($book_id)) {
        $book_id_err = "Please enter a fname.";
    } elseif (!ctype_digit($book_id)) {
        $book_id_err = "Please enter a valid fname.";
    } elseif (!(in_array($book_id, $book_ids) && $availablities[$book_id])) {
        $book_id_err = "Please select an available book.";
    }

    // Validate SSN
    $member_id = trim($_POST["member_id"]);
    if (empty($member_id)) {
        $member_id_err = "Please enter member_id.";
    } elseif (!ctype_digit($member_id)) {
        $member_id_err = "Please enter a positive integer value of member_id.";
    } elseif (!in_array($member_id, $member_ids)) {
        $member_id_err = "Please select an existing member.";
    }
    // Validate Birthdate
    $date = trim($_POST["date"]);
    if (empty($date)) {
        $date_err = "Please enter date checked out.";
    }

    // Check input errors before inserting in database
    if (empty($member_id_err) && empty($book_id_err) && empty($date_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO BORROWS (member_id, book_id, date) 
		        VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param(
                $stmt,
                "iis",
                $param_member_id,
                $param_book_id,
                $param_date
            );

            // Set parameters
            $param_member_id = $member_id;
            $param_book_id = $book_id;
            $param_date = $date;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "<center><h4>Error while creating new borrow record</h4></center>";
            }
        } else {
            echo "Error preparing statement.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Member</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Check out book</h2>
                    </div>
                    <p>Please fill this form and submit to add a record of a book being checked out to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($member_id_err)) ? 'has-error' : ''; ?>">
                            <label>Member ID</label>
                            <input type="text" name="member_id" class="form-control" value="<?php echo $member_id; ?>">
                            <span class="help-block"><?php echo $member_id_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($book_id_err)) ? 'has-error' : ''; ?>">
                            <label>Book ID</label>
                            <input type="text" name="book_id" class="form-control" value="<?php echo $book_id ?>">
                            <span class="help-block"><?php echo $book_id_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                            <label>Date Checked Out</label>
                            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $date_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>