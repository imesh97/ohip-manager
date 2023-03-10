<!--
ASSIGNMENT 3
View Hospitals Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Hospitals - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <style>
        .hospital-info ul {
            list-style: none;
            text-align: center;
        }

        .hospital-info li {
            display: inline-block;
        }
    </style>
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<div class="header">
    <h1>View Hospitals</h1>
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
                echo "<option value='" . $row["hoscode"] . "'>" . $row["hosname"] . " (" . $row["hoscode"] . ")</option>";
            }
            mysqli_free_result($result);
            ?>
        </select>
        <input type="submit" value="View">
    </form>
</div>

<?php
if (!empty($_POST)) { // perform only after form post
    echo "<div class='hospital-info'>";
    echo "<ul>";
    $query = "SELECT * FROM hospital h, doctor d WHERE h.headdoc=d.licensenum AND hoscode='" . $_POST["hospital"] . "'"; // select query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: Failed to query database.')</script>";
    }
    while ($row = mysqli_fetch_assoc($result)) { // display hospital info
        echo "<li><p><b>Hospital Name:</b> " . $row["hosname"] . " |&nbsp;</p></li>";
        echo "<li><p><b>City:</b> " . $row["city"] . " |&nbsp;</p></li>";
        echo "<li><p><b>Province:</b> " . $row["prov"] . " |&nbsp;</p></li>";
        echo "<li><p><b>Number of Beds:</b> " . $row["numofbed"] . " |&nbsp;</p></li>";
        echo "<li><p><b>Head Doctor:</b> " . $row["firstname"] . " " . $row["lastname"] . "</p></li>";
    }
    echo "</ul>";
    echo "</div>";
    mysqli_free_result($result);

    echo "<table class='table-list'>";
    echo "<tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>License Number</th>";
    echo "</tr>";

    $query = "SELECT * FROM doctor WHERE hosworksat='" . $_POST["hospital"] . "'"; // select query
    $result = mysqli_query($connection, $query);
    if (!$result) { // error alert
        echo "<script>alert('Error: Failed to query database.')</script>";
    }
    while ($row = mysqli_fetch_assoc($result)) { // populate table with doctors
        echo "<tr>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["licensenum"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}
else { // if hospital not selected -> show default text
    echo "<p class='initial-text'>To view hospital information, select a hospital from the menu.</p>";
}
mysqli_close($connection); // close connection
?>
</body>
</html>