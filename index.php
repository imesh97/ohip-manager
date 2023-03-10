<!--
ASSIGNMENT 3
Index Page
Student Number: _14
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home - OHIP Manager</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <style>
        #db-icon {
            margin: auto;
            display: block;
            padding-top: 50px;
            padding-bottom: 25px;
            width: 30%;
        }
    </style>
</head>

<body>
<?php // connect to db and include nav component
include 'connectdb.php';
include 'nav.php';
?>
<img src="https://uxwing.com/wp-content/themes/uxwing/download/computers-mobile-hardware/setting-computer-desktop-icon.png" alt="Database Icon" id="db-icon">
<p class="initial-text">Welcome to the OHIP Manager!
    <br>This administration panel is designed to view and modify information regarding the OHIP database.
    <br>Use the navigation menu above to start performing tasks...</p>
</body>

</html>