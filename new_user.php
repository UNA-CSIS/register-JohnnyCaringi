<?php
// session start here...
session_start();
include_once 'validate.php';

// get all 3 strings from the form (and scrub w/ validation function)
$enteredUser = test_input($_POST["user"]);
$enteredPass = test_input($_POST["pwd"]);
$enteredRepeat = test_input($_POST["repeat"]);
// make sure that the two password values match!
if($enteredPass != $enteredRepeat){
    header("location:index.php");
}


// create the password_hash using the PASSWORD_DEFAULT argument
$hashedPass = password_hash($enteredPass, PASSWORD_DEFAULT);
// login to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// make sure that the new user is not already in the database
$sql = "SELECT password FROM users WHERE username = '$enteredUser'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    // insert username and password hash into db (put the username in the session
    // or make them login)
    $sql = "INSERT INTO users (username, password) VALUES ('$enteredUser', '$hashedPass')";
    $conn->query($sql);
    header("location:index.php");
}

