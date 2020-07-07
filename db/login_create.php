<?php
require 'db_connection.php';
$conn = connection();

$sql = "CREATE TABLE login (
id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
account VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo json_encode([
        "success"=>1,
        "msg"=>"Table login created successfully"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
        );
} else {
    $errorMessage = "Error creating table login: " . $conn->error;
    echo json_encode([
        "success"=>0,
        "msg"=>"$errorMessage"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
}

$conn->close();

?>