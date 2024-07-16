<?php
session_start();

$servername = "localhost:3325";
$username_db = "root";
$password_db = ""; 
$database = "glow"; 


$conn = new mysqli($servername, $username_db, $password_db, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST["user"];
    $password = $_POST["pass"];

    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    
    $sql = "SELECT * FROM glow_admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
       
        
        $_SESSION['password_verified'] = true;
        
        header("Location: display_data.php");
        
    } else {
        
        echo "Invalid username or password.";
    }
}


$conn->close();
?>
