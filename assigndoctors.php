<!--
ASSIGNMENT 3
Assign Doctors Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Assign Doctors - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>Assign Doctors</h1>
    <form action="" method="post">
        <label for="doctor">Doctor: </label>
        <select id="doctor" name="doctor">
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
        <label for="patient">Patient: </label>
        <select id="patient" name="patient">
            <?php
            $query = "SELECT ohipnum, firstname, lastname FROM patient"; // select query
            $result = mysqli_query($connection, $query);
            if (!$result) { // error alert
                echo "<script>alert('Error: Failed to query database.')</script>";
            }
            while ($row = mysqli_fetch_assoc($result)) { // populate dropdown list with patients
                $string = $row["firstname"] . " " . $row["lastname"] . " (" . $row["ohipnum"] . ")";
                echo "<option value='" . $row["ohipnum"] . "'>" . $string . "</option>";
            }
            mysqli_free_result($result);
            ?>
        </select>
        <br>
        <input type="submit" value="Assign">
    </form>
</div>
<?php
if (!empty($_POST)) { // perform only after form post
    $query = "INSERT INTO looksafter (licensenum, ohipnum) VALUES ('" . $_POST["doctor"] . "','" . $_POST["patient"] . "')"; // insert query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: The doctor is already assigned to the patient')</script>";
    } else { // success alert
        echo "<script>alert('You have assigned doctor " . $_POST["doctor"] . " to patient " . $_POST["patient"] . "')</script>";
    }
}
mysqli_close($connection); // close connection
?>
</body>
</html>