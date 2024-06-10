<!-- Group 30 - Ben Kahl -->
<?php
// Include config file
require_once "config.php";

// Check if book_id parameter is set
if (isset($_GET['book_id'])) {
    // Retrieve book_id from the GET parameters
    $book_id = $_GET['book_id'];

    // Update the book's availability to true (1)
    $sql = "UPDATE BOOK SET available = 1 WHERE book_id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $book_id);

        // Attempt to execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit();
        } else {
            echo "Error updating book availability: " . mysqli_error($link);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($link);
    }
    
    // Close connection
    mysqli_close($link);
} else {
    // Redirect to an error page or handle the case where parameters are not set
    header("location: error_page.php");
    exit();
}
?>