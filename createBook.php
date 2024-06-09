<!-- Group 30 - Ben Kahl -->
<?php
require_once "config.php";

$book_id = $available = $isbn = $title = $author = $length = $ibrary_id = "";
$book_id_err = $available_err = $isbn_err = $title_err = $author_err = $length_err = $ibrary_id_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First title
    $title = trim($_POST["title"]);
    if(empty($title)){
        $title_err = "Please enter a title.";
    } elseif(!filter_var($title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid title.";
    } 

    $isbn = trim($_POST["isbn"]);
    if(empty($isbn)){
        $isbn_err = "Please enter a isbn.";
    } elseif(!filter_var($isbn, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]{13,13}+$/")))){
        $isbn_err = "Please enter a valid isbn.";
    } 

    $author = trim($_POST["author"]);
    if(empty($author)){
        $author_err = "Please enter a author.";
    } elseif(!filter_var($author, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $author_err = "Please enter a valid author.";
    } 
 
    $length = trim($_POST["length"]);
    if(empty($length)){
        $length_err = "Please enter a length.";
    } elseif(!filter_var($length, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $length_err = "Please enter a valid length.";
    }
  
    // Check input errors before inserting in database
    if(empty($title_err) && empty($isbn_err) && empty($book_id_err) && empty($zip_err) && empty($state_err) && empty($author_err)){
        // Prepare an insert statement
        $bookInsert = "INSERT INTO BOOK (book_id, available, isbn, title, author, length, library_id) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $bookInsert)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iiissii", $param_book_id, $param_available, $param_isbn, $param_title, $param_author, $param_length, $param_library_id);
            
            // Set parameters
            $param_book_id = $book_id;
            $param_available = 1;
            $param_isbn = $isbn;
            $param_title = $title;
            $param_author = $author;
            $param_length = $length;
            $param_library_id = $library_id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: index.php");
					exit();
            } else{
                echo "<center><h4>Error while creating new employee</h4></center>";
				$book_id_err = "Enter a unique book_id.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($lStmt);

    // Close connection
    mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                        <h2>Create Book</h2>
                    </div>
                    <p>Please fill this form and submit to add a book to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($length_err)) ? 'has-error' : ''; ?>">
                            <label>Length</label>
                            <input type="number" name="length" class="form-control" value="<?php echo $length; ?>">
                            <span class="help-block"><?php echo $length_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($isbn_err)) ? 'has-error' : ''; ?>">
                            <label>ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="<?php echo $isbn; ?>">
                            <span class="help-block"><?php echo $isbn_err;?></span>
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