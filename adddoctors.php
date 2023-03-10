<!--
ASSIGNMENT 3
Add Doctors Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Doctors - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>Add a New Doctor</h1>
    <form action="" method="post">
        <label for="firstname">First Name: </label>
        <input type="text" id="firstname" name="firstname">
        <label for="lastname">Last Name: </label>
        <input type="text" id="lastname" name="lastname">
        <br>
        <label for="licensenum">License Number: </label>
        <input type="text" id="licensenum" name="licensenum">
        <label for="specialty">Specialty: </label>
        <input type="text" id="specialty" name="specialty">
        <br>
        <label for="licensedate">License Date: </label>
        <input type="date" id="licensedate" name="licensedate">
        <label for="birthdate">Birth Date: </label>
        <input type="date" id="birthdate" name="birthdate">
        <br>
        <label for="hospital-list">Hospital List: </label>
        <select id="hospital-list" name="hospital-list">
            <?php
            $query = "SELECT hoscode, hosname FROM hospital"; // select query
            $result = mysqli_query($connection, $query);
            if (!$result) { // error alert
                echo "<script>alert('Error: Failed to query database.')</script>";
            }
            while ($row = mysqli_fetch_assoc($result)) { // populate dropdown list with hospitals
                $string = $row["hosname"] . " (" . $row["hoscode"] . ")";
                echo "<option value='" . $row["hoscode"] . "'>" . $string . "</option>";
            }
            mysqli_free_result($result);
            ?>
        </select>
        <label for="hospital-code">or Hospital Code: </label>
        <input type="text" id="hospital-code" name="hospital-code">
        <br>
        <input type="submit" value="Add">
    </form>
</div>
<?php
if (!empty($_POST)) { // perform only after form post
    $hospital = $_POST["hospital-list"];
    if (!empty($_POST["hospital-code"])) { // if hospital code is set -> override
        $hospital = $_POST["hospital-code"];
    }
    $query = "INSERT INTO doctor VALUES ('" . $_POST["licensenum"] . "','" . $_POST["firstname"] . "','" .
        $_POST["lastname"] . "','" . $_POST["licensedate"] . "','" . $_POST["birthdate"] . "','"
        . $hospital . "','". $_POST["specialty"] . "')"; // insert query

    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: The inputted values are not acceptable. Check for a duplicate license number or non-existent hospital code.')</script>";
    } else { // success alert
        $string = $_POST["firstname"] . " " . $_POST["lastname"] . " - " . $_POST["licensenum"];
        echo "<script>alert('You have added the doctor " . $string . "')</script>";
    }
}
mysqli_close($connection); // close connection
?>
</body>
</html>