<!--
ASSIGNMENT 3
View Doctors Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Doctors - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>View Doctors</h1>
    <form action="" method="post">
        <label for="order-by">Order by: </label>
        <select id="order-by" name="order-by">
            <option value="lastname" selected>Last Name</option>
            <option value="birthdate">Birth Date</option>
        </select>
        <select id="order-type" name="order-type">
            <option value="ASC" selected>Ascending</option>
            <option value="DESC">Descending</option>
        </select>
        <input type="submit" value="View">
    </form>
</div>

<table class="table-list">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>License Number</th>
        <th>License Date</th>
        <th>Birth Date</th>
        <th>Hospital</th>
        <th>Specialty</th>
    </tr>
    <?php
    $query = "SELECT * FROM doctor ORDER BY lastname ASC"; // select query: base
    if (!empty($_POST)) {
        $query = "SELECT * FROM doctor ORDER BY " . $_POST['order-by'] . " " . $_POST['order-type']; // select query: filtered
    }
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
    mysqli_free_result($result);
    mysqli_close($connection); // close connection
    ?>
</table>
</body>
</html>