<?php

$servername = "localhost:3325";
$username = "root";
$password = "";
$database = "glow"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$submissionDate = date("Y-m-d");


$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$options = isset($_POST['options']) ? implode(", ", $_POST['options']) : '';
$feedback = $_POST['feedback'];


$sql = "INSERT INTO detail (name, email, phone, dob, options, feedback, submission_date) 
        VALUES ('$name', '$email', '$phone', '$dob', '$options', '$feedback', '$submissionDate')";

if ($conn->query($sql) === TRUE) {
    echo "THANK YOU FOR YOUR RESPONSE! OUR TEAM WILL CONTACT YOU SOON";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>

