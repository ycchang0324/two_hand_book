<?php
require 'db_connection.php';
$conn = connection();

$sql = "CREATE TABLE email (

account VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL
)";


if ($conn->query($sql) === TRUE) {
  echo json_encode([
        "success"=>1,
        "msg"=>"Table email created successfully"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
        );
} else {
    $errorMessage = "Error creating table email: " . $conn->error;
    echo json_encode([
        "success"=>0,
        "msg"=>"$errorMessage"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
}

$conn->close();

?>