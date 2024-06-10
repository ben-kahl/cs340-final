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
    if(empty($name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } 

    $street = trim($_POST["street"]);
    if(empty($street)){
        $street_err = "Please enter a street.";
    } elseif(!filter_var($street, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $street_err = "Please enter a valid street.";
    } 

    $city = trim($_POST["city"]);
    if(empty($city)){
        $city_err = "Please enter a city.";
    } elseif(!filter_var($city, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $city_err = "Please enter a valid city.";
    } 
 
    $state = trim($_POST["state"]);
    if(empty($state)){
        $state_err = "Please enter a state.";
    } elseif(!filter_var($state, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $state_err = "Please enter a valid state.";
    }
        // Validate Last name
    $zip = trim($_POST["zip"]);
    if(empty($zip)){
        $zip_err = "Please enter a zip code.";
    } elseif(!filter_var($zip, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $zip_err = "Please enter a valid zip.";
    } 
  
 

    // Check input errors before inserting in database
    if(empty($name_err) && empty($street_err) && empty($library_id_err) && empty($zip_err) && empty($state_err) && empty($city_err)){
        // Prepare an insert statement
        $libraryInsert = "INSERT INTO LIBRARY (name) 
		        VALUES (?)";
         
        $libraryAddrInsert = "INSERT INTO LIBRARY_ADDR (library_id, street, city, state, zip)
                VALUES (?, ?, ?, ?, ?, ?)";
        if($lStmt = mysqli_prepare($link, $libraryInsert)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($lStmt, "s", $param_name);
            
            // Set parameters
            $param_name = $name;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($lStmt)){
                //Do nothing
            } else{
                echo "<center><h4>Error while creating new library</h4></center>";
            }
        }
         
        // Close statement
        mysqli_stmt_close($lStmt);

        if($laStmt = mysqli_prepare($link, $libraryAddrInsert)){
            mysqli_stmt_bind_param($laStmt, "iisssi", $param_library_id, $param_street, $param_city,
                $param_state, $param_zip);
            $param_library_id = $library_id;
            $param_street = $street;
            $param_city = $city;
            $param_state = $state;
            $param_zip = $zip;

            if(mysqli_stmt_execute($laStmt)){
                header("location: " . $_SESSION['previous_page']);
                exit();
            } else{
                echo "<center><h4>Error while creating new Library Address</h4></center>";
                $addr_id_err = "Enter a unique addr_id";
            }
        }
        mysqli_stmt_close($laStmt);
    // Close connection
    mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Library</title>
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
						<div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                            <span class="help-block"><?php echo $city_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                            <label>State</label>
                            <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                            <span class="help-block"><?php echo $state_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($zip_err)) ? 'has-error' : ''; ?>">
                            <label>Zip Code</label>
                            <input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>">
                            <span class="help-block"><?php echo $zip_err;?></span>
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