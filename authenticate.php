<?php
// start session
session_start();
include_once 'validate.php';
$enteredUser = test_input($_POST["user"]);
$enteredPass = test_input($_POST["pwd"]);

// login to the softball database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// select password from users where username = <what the user typed in>
$sql = "SELECT password FROM users WHERE username = '$enteredUser'";
$result = $conn->query($sql);
// if no rows, then username is not valid (but don't tell Mallory) just send
// her back to the login
if ($result->num_rows == 0) {
    header("location:index.php");
}
// otherwise, password_verify(password from form, password from db)
else{
    $row = $result->fetch_assoc();
    $valid = password_verify($enteredPass, $row['password']);
}

// if good, put username in session, otherwise send back to login
if($valid){
    $_SESSION['username'] = $enteredUser;
    header("location:games.php");
}
else{
    header("location:index.php");
}
