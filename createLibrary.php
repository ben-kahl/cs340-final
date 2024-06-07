<!-- Group 30 - Ben Kahl -->
<?php
require_once "config.php";

$library_id = $name = "";
$library_id_err = $name_err =  "";
$addr_id = $street = $city = $state = $zip = "";
$addr_id_err = $street_err = $city_err = $state_err = $zip_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First name
    $name = trim($_POST["name"]);
    if(empty($fname)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($fname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid fname.";
    } 
    // Validate Last name
    $street = trim($_POST["street"]);
    if(empty($street)){
        $street_err = "Please enter a lname.";
    } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $street_err = "Please enter a valid lname.";
    } 
        // Validate Last name
    $city = trim($_POST["city"]);
    if(empty($city)){
        $city_err = "Please enter a lname.";
    } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $city_err = "Please enter a valid lname.";
    } 
 
        // Validate Last name
    $state = trim($_POST["state"]);
    if(empty($state)){
        $state_err = "Please enter a lname.";
    } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $state_err = "Please enter a valid lname.";
    }
        // Validate Last name
    $zip = trim($_POST["zip"]);
    if(empty($zip)){
        $zip_err = "Please enter a lname.";
    } elseif(!filter_var($lname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $zip_err = "Please enter a valid lname.";
    } 
  
 

    // Check input errors before inserting in database
    if(empty($member_id_err) && empty($lname_err) && empty($library_id_err) && empty($fname) && empty($date_joined) && empty($dob)){
        // Prepare an insert statement
        $sql = "INSERT INTO MEMBER (member_id, fname, lname, dob, date_joined,library_id) 
		        VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssdssi", $param_member_id, $param_fname, $param_lname, 
				$param_dob, $param_date_joined, $param_library_id);
            
            // Set parameters
			$param_member_id = $member_id;
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
                        <h2>Create Library</h2>
                    </div>
                    <p>Please fill this form and submit to add a Library to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                            <label>Street</label>
                            <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
                            <span class="help-block"><?php echo $street_err;?></span>
                        </div>            
						<div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
                            <label>Birth date</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            <span class="help-block"><?php echo $dob_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_joined_err)) ? 'has-error' : ''; ?>">
                            <label>Date Joined</label>
                            <input type="date" name="date_joined" class="form-control" value="<?php echo $date_joined; ?>">
                            <span class="help-block"><?php echo $date_joined_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($library_id_err)) ? 'has-error' : ''; ?>">
                            <label>Library ID</label>
                            <input type="number" min ="1" name="library_id" class="form-control" value="<?php echo $library_id; ?>">
                            <span class="help-block"><?php echo $library_id_err;?></span>
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