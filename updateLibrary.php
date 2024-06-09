<?php
session_start();
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $street = $city = $state = $zip = "";
$name_err = $street_err = $city_err = $state_err = $zip_err = "";

// Check existence of id parameter before processing further
if (isset($_GET["library_id"]) && !empty(trim($_GET["library_id"]))) {
    $_SESSION["library_id"] = trim($_GET["library_id"]);
    $library_id = $_SESSION["library_id"];

    // Prepare a select statement
    $sql = "SELECT L.library_id, L.name AS library_name, LA.street, LA.city, LA.state, LA.zip 
                FROM LIBRARY L 
                JOIN LIBRARY_ADDR LA ON L.library_id = LA.library_id 
                WHERE L.library_id=?";

    if ($stmt1 = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt1, "s", $library_id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt1)) {
            $result1 = mysqli_stmt_get_result($stmt1);
            if (mysqli_num_rows($result1) == 1) {
                $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                $name = $row['library_name'];
                $street = $row['street'];
                $city = $row['city'];
                $state = $row['state'];
                $zip = $row['zip'];
            } else {
                // URL doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Error in executing query.";
        }
        // Close statement
        mysqli_stmt_close($stmt1);
    }
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // the id is hidden and can not be changed
    $library_id = $_SESSION["library_id"];

    // Validate form data
    $name = trim($_POST["name"]);
    if (empty($name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    }

    $street = trim($_POST["street"]);
    if (empty($street)) {
        $street_err = "Please enter a street.";
    } elseif (!filter_var($street, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s0-9]+$/")))) {
        $street_err = "Please enter a valid street name.";
    }

    $city = trim($_POST["city"]);
    if (empty($city)) {
        $city_err = "Please enter city.";
    }

    $state = trim($_POST["state"]);
    if (empty($state)) {
        $state_err = "Please enter state.";
    }

    $zip = trim($_POST["zip"]);
    if (empty($zip)) {
        $zip_err = "Please enter zip code.";
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($street_err) && empty($city_err) && empty($state_err) && empty($zip_err)) {
        // Prepare update statements
        $updateL = "UPDATE LIBRARY SET name=? WHERE library_id=?";
        $updateLA = "UPDATE LIBRARY_ADDR SET street=?, city=?, state=?, zip=? WHERE library_id=?";

        if ($lStmt = mysqli_prepare($link, $updateL)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($lStmt, "si", $name, $library_id);

            // Attempt to execute the prepared statement
            if (!mysqli_stmt_execute($lStmt)) {
                echo "<center><h2>Error when updating library</h2></center>";
            }
            // Close statement
            mysqli_stmt_close($lStmt);
        }

        if ($laStmt = mysqli_prepare($link, $updateLA)) {
            mysqli_stmt_bind_param($laStmt, "sssii", $street, $city, $state, $zip, $library_id);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($laStmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "<center><h2>Error when updating library address</h2></center>";
            }
            // Close statement
            mysqli_stmt_close($laStmt);
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
    <title>Company DB</title>
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
                        <h3>Update Record for Library ID = <?php echo $_GET["library_id"]; ?> </h3>
                    </div>
                    <p>Please edit the input values and submit to update.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                            <label>Street</label>
                            <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
                            <span class="help-block"><?php echo $street_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                            <span class="help-block"><?php echo $city_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                            <label>State</label>
                            <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                            <span class="help-block"><?php echo $state_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($zip_err)) ? 'has-error' : ''; ?>">
                            <label>Zip</label>
                            <input type="number" name="zip" class="form-control" value="<?php echo $zip; ?>">
                            <span class="help-block"><?php echo $zip_err; ?></span>
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