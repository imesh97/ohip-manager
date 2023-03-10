<!--
ASSIGNMENT 3
Update Hospitals Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Hospitals - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>Update Hospitals</h1>
    <form action="" method="post">
        <label for="hospital">Hospital: </label>
        <select id="hospital" name="hospital">
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
        <br>
        <label for="numofbeds">Number of Beds:</label>
        <input type="number" id="numofbeds" name="numofbeds">
        <br>
        <input type="submit" value="Update">
    </form>
</div>
<?php
if (!empty($_POST)) { // perform only after form post
    $query = "UPDATE hospital SET numofbed='" . $_POST["numofbeds"] . "' WHERE hoscode='" . $_POST["hospital"] . "'"; // update query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: Failed to update database.')</script>";
    } else { // success alert
        echo "<script>alert('You have updated the number of beds in hospital " . $_POST["hospital"] . " to: " . $_POST["numofbeds"] . "')</script>";
    }
}
mysqli_close($connection); // close connection
?>
</body>
</html>