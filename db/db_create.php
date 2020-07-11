<?php
$servername = "localhost";
$username = "root";
$password = "root";


// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE second_hand_book";
if($conn->query($sql) === TRUE){
    echo json_encode([
        "success"=>1,
        "msg"=>"Database created successfully"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
    
}else{
    $errorMessage = "Error creating database: " . $conn->error;
    echo json_encode([
        "success"=>0,
        "msg"=>"$errorMessage"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
    
}

$conn->close();

?>