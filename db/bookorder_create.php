<?php

require 'db_connection.php';
$conn = connection();

$sql = "CREATE TABLE bookorder (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
stdId VARCHAR(30) NOT NULL,
category VARCHAR(10) NOT NULL,
subject VARCHAR(15) NOT NULL,
price INT(5) NOT NULL,
fee INT(5) NOT NULL,
state VARCHAR(20) NOT NULL,
others VARCHAR(200),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo json_encode([
        "success"=>1,
        "msg"=>"Table bookorder created successfully"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
        );
} else {
    $errorMessage = "Error creating table bookorder: " . $conn->error;
    echo json_encode([
        "success"=>0,
        "msg"=>"$errorMessage"
        ],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT
    );
}

$conn->close();

?>