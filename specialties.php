<!--
ASSIGNMENT 3
Specialties Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Specialties - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>Specialized Doctors</h1>
    <form action="" method="post">
        <label for="specialty">Specialty: </label>
        <select id="specialty" name="specialty">
            <?php
            $query = "SELECT DISTINCT speciality FROM doctor"; // select query
            $result = mysqli_query($connection, $query);
            if (!$result) { // error alert
                echo "<script>alert('Error: Failed to query database.')</script>";
            }
            while ($row = mysqli_fetch_assoc($result)) { // populate dropdown list with specialties
                echo "<option value='" . $row["speciality"] . "'>" . $row["speciality"] . "</option>";
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
    echo "<th>License Number</th>";
    echo "<th>License Date</th>";
    echo "<th>Birth Date</th>";
    echo "<th>Hospital</th>";
    echo "<th>Specialty</th>";
    echo "</tr>";

    $query = "SELECT * FROM doctor WHERE speciality='" . $_POST['specialty'] . "'"; // select query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: Failed to query database.')</script>";
    }
    while ($row = mysqli_fetch_assoc($result)) { // populate table with doctors
        echo "<tr>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["licensenum"] . "</td>";
        echo "<td>" . $row["licensedate"] . "</td>";
        echo "<td>" . $row["birthdate"] . "</td>";
        echo "<td>" . $row["hosworksat"] . "</td>";
        echo "<td>" . $row["speciality"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}
else { // if specialty not selected -> show default text
    echo "<p class='initial-text'>To view a list of specialized doctors, select a specialty from the menu.</p>";
}
mysqli_close($connection); // close connection
?>
</body>
</html>