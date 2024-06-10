<!-- Group 30 - Ben Kahl -->
<?php
session_start();
$library_id = $_SESSION["library_id"];
require_once "config.php";

$fname = $lname = $dob = $date_joined = "";
$member_id_err = $fname_err = $lname_err = $dob_err = $date_joined_err = $library_id_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First name
    $fname = trim($_POST["fname"]);
    if(empty($fname)){
        $fname_err = "Please enter a fname.";
    } elseif(!filter_var($fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid fname.";
    } 
    // Validate Last name
    $lname = trim($_POST["lname"]);
    if(empty($lname)){
        $lname_err = "Please enter a lname.";
    } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $lname_err = "Please enter a valid lname.";
    } 
 
	// Validate Birthdate
    $dob = trim($_POST["dob"]);
    if(empty($dob)){
        $dob_err = "Please enter birthdate.";     
    }	

    // Validate Birthdate
    $date_joined = trim($_POST["date_joined"]);
    if(empty($date_joined)){
        $date_joined = "Please enter date joined.";     
    }
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($lname_err) && empty($dob_err) && empty($date_joined_err) && empty($library_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO MEMBER (fname, lname, dob, date_joined,library_id) 
		        VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_fname, $param_lname, 
				$param_dob, $param_date_joined, $param_library_id);
            
            // Set parameters
            $param_lname = $lname;
			$param_fname = $fname;
			$param_dob = $dob;
            $param_date_joined = $date_joined;
            $param_library_id = $library_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
				    header("location: index.php");
					exit();
            } else{
                echo "<center><h4>Error while creating new employee</h4></center>";
				$member_id_err = "Enter a unique member_id.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Issue with input";
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
                        <h2>Create Member</h2>
                    </div>
                    <p>Please fill this form and submit to add an Member to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <label>Birth date</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $dob_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_joined_err)) ? 'has-error' : ''; ?>">
                            <label>Date Joined</label>
                            <input type="date" name="date_joined" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $date_joined_err;?></span>
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