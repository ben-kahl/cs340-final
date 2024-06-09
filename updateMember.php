<?php
    session_start();
    // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $fname = $lname = $dob = "";
    $fname_err = $lname_err = $dob_err = "";

    // Check existence of id parameter before processing further
    if(isset($_GET["member_id"]) && !empty(trim($_GET["member_id"]))){
        $_SESSION["member_id"] = trim($_GET["member_id"]);
        $member_id = $_SESSION["member_id"];
        
        // Prepare a select statement
        $sql = "SELECT member_id, fname, lname, dob 
                FROM MEMBER 
                WHERE member_id=?";
  
        if($stmt1 = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt1, "i", $member_id);      
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt1)){
                $result1 = mysqli_stmt_get_result($stmt1);
                if(mysqli_num_rows($result1) == 1){
                    $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $dob = $row['dob'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }                
            } else{
                echo "Error in executing query.";
            }       
            // Close statement
            mysqli_stmt_close($stmt1);
        }
    } else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // the id is hidden and can not be changed
        $member_id = $_SESSION["member_id"];
        
        // Validate form data
        $fname = trim($_POST["fname"]);
        if(empty($fname)){
            $fname_err = "Please enter a first name.";
        } elseif(!filter_var($fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $fname_err = "Please enter a valid first name.";
        } 
        
        $lname = trim($_POST["lname"]);
        if(empty($lname)){
            $lname_err = "Please enter a last name.";
        } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $lname_err = "Please enter a valid last name.";
        }  
        
        $dob = trim($_POST["dob"]);
        if(empty($dob)){
            $dob_err = "Please enter date of birth.";     
        } elseif(!DateTime::createFromFormat('Y-m-d', $dob)){
            $dob_err = "Please enter a valid date in YYYY-MM-DD format.";
        }

        // Check input errors before inserting into database
        if(empty($fname_err) && empty($lname_err) && empty($dob_err)){
            // Prepare update statement
            $updateM = "UPDATE MEMBER SET fname=?, lname=?, dob=? WHERE member_id=?";
        
            if($mStmt = mysqli_prepare($link, $updateM)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($mStmt, "sssi", $fname, $lname, $dob, $member_id);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($mStmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: index.php");
                    exit();
                } else{
                    echo "<center><h2>Error when updating member</h2></center>";
                }
                // Close statement
                mysqli_stmt_close($mStmt);
            }
        }
        
        // Close connection
        mysqli_close($link);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Member</title>
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
                        <h3>Update Record for Member ID = <?php echo $_GET["member_id"]; ?> </h3>
                    </div>
                    <p>Please edit the input values and submit to update the member record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                            <span class="help-block"><?php echo $fname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                            <span class="help-block"><?php echo $lname_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
                            <span class="help-block"><?php echo $dob_err;?></span>
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
