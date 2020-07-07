<?php
require 'db_connection.php';
$conn = connection();

$sql = "CREATE TABLE oldbook (
id INT(5) NOT NULL,
name VARCHAR(100) NOT NULL,
category VARCHAR(30) NOT NULL,
price INT(5) NOT NULL,
picture INT(5) NOT NULL,
isSold INT(2) NOT NULL
)";


if ($conn->query($sql) === TRUE) {
  echo json_encode([
        "success"=>1,
        "msg"=>"Table oldbook created successfully"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
        );
} else {
    $errorMessage = "Error creating table oldbook: " . $conn->error;
    echo json_encode([
        "success"=>0,
        "msg"=>"$errorMessage"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
}

$conn->close();

?>