<!--
ASSIGNMENT 3
Patients Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patients - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>View Doctor's Patients</h1>
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
                echo "<option value='" . $row["licensenum"] . "'>" . $row["firstname"] . " " . $row["lastname"] . "</option>";
            }
            mysqli_free_result($result);
            ?>
        </select>
        <input type="submit" value="View">
    </form>
</div>

<?php
if (!empty($_POST)) { // perform only after form post
    echo "<table class='table-list'>";
    echo "<tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>OHIP Number</th>";
    echo "<th>Birth Date</th>";
    echo "<th>Assigned Doctor";
    echo "</tr>";

    $query = "SELECT p.firstname, p.lastname, p.ohipnum, p.birthdate, d.firstname AS df, d.lastname AS dl FROM patient p, looksafter l, doctor d WHERE d.licensenum=l.licensenum AND l.ohipnum=p.ohipnum AND d.licensenum='" . $_POST["doctor"] . "'";
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: Failed to query database.')</script>";
    }
    while ($row = mysqli_fetch_assoc($result)) { // populate table with patients
        echo "<tr>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["ohipnum"] . "</td>";
        echo "<td>" . $row["birthdate"] . "</td>";
        echo "<td>" . $row["df"] . " " . $row["dl"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}
else { // if doctor not selected -> show default text
    echo "<p class='initial-text'>To view a list of patients, select a doctor from the menu.</p>";
}
mysqli_close($connection); // close connection
?>
</body>
</html>