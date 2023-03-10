<!--
ASSIGNMENT 3
Delete Doctors Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete Doctors - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>Delete a Doctor</h1>
    <form action="" method="post">
        <label for="licensenum">License Number: </label>
        <input type="text" id="licensenum" name="licensenum">
        <br>
        <label for="doctor-list">or Doctor List: </label>
        <select id="doctor-list" name="doctor-list">
            <?php
            $query = "SELECT licensenum, firstname, lastname FROM doctor"; // select query
            $result = mysqli_query($connection, $query);
            if (!$result) { // error alert
                echo "<script>alert('Error: Failed to query database.')</script>";
            }
            while ($row = mysqli_fetch_assoc($result)) { // populate dropdown list with doctors
                $string = $row["firstname"] . " " . $row["lastname"] . " (" . $row["licensenum"] . ")";
                echo "<option value='" . $row["licensenum"] . "'>" . $string . "</option>";
            }
            mysqli_free_result($result);
            ?>
        </select>
        <br>
        <input type="submit" value="Delete">
    </form>
</div>
<?php
if (!empty($_POST)) { // perform only after form post
    $licensenum = $_POST["doctor-list"];
    if (!empty($_POST["licensenum"])) { // if license number is set -> override
        $licensenum = $_POST["licensenum"];
    }

    $query = "DELETE FROM doctor WHERE licensenum='" . $licensenum . "'"; // delete query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: The doctor could not be deleted. Check if the doctor is a head doctor and/or currently treating patients.')</script>";
    } else { // success alert
        echo "<script>alert('You have deleted the doctor " . $licensenum . "')</script>";
        header("Refresh:0"); // refresh page again to update doctor list values
    }
}
mysqli_close($connection); // close connection
?>
</body>
</html>