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
    //echo "Database created successfully";
}else{
    //echo "Error creating database: " . $conn->error;
}

$conn->close();

$dbname = "second_hand_book";
$conn = new mysqli($servername,$username,$password,$dbname);
// sql to create table


$sql = "CREATE TABLE bookorder (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
stdId VARCHAR(30) NOT NULL,
category VARCHAR(10) NOT NULL,
subject VARCHAR(15) NOT NULL,
price INT(5) NOT NULL,
state VARCHAR(20) NOT NULL,
others VARCHAR(200),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table BookOrder created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}




$sql = "CREATE TABLE seller (
stdId INT(6) NOT NULL,
name VARCHAR(30) NOT NULL,
bookNum INT(2) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table Seller created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE login (
id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
account VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table Seller created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE oldbook (
id INT(5) NOT NULL,
name VARCHAR(100) NOT NULL,
category VARCHAR(30) NOT NULL,
price INT(5) NOT NULL,
picture INT(5) NOT NULL,
isSold INT(2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table Seller created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE email (

account VARCHAR(30) NOT NULL,
password VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table Seller created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE feedback (
id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
comment VARCHAR(500) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  //echo "Table Seller created successfully";
} else {
  //echo "Error creating table: " . $conn->error;
}

$conn->close();


?>