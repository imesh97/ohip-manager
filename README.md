# OHIP Manager

Assignment 3 for CS3319 (Intro to Databases) at Western University.  
A full stack web application for viewing and modifying hospital information regarding the OHIP database.

## Tech Stack

- PHP
- Apache
- MySQL
- HTML/CSS

## Run Locally

First, clone the repository. Then, ensure that you have Apache and MySQL installed as they are dependencies for the tech stack.

Create a MySQL user and a database for administrative usage. Then, create the appropriate `doctor`, `patient`, `hospital` and `looksafter` tables.

Next, update the database login details in the `connectdb.php` file:

```
$host = "localhost";
$user = "USERNAME";
$pass = "PASSWORD";
$db = "DBNAME";
```

Finally, run the Apache server and view the site locally at `localhost`

## ER Diagram

![ER Diagram](https://github.com/imesh97/ohip-manager/blob/main/er-diagram.png?raw=true)
