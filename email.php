<?php




//引用PHPMailer-5.2-stable資料夾裡面的寄信功能，注意：最外層的資料夾內要有PHPMailer-5.2-stable資料夾，和comfirm_mailer.php的檔案
require './db/db_connection.php';




$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "10901";

$counter = 0;

$conn = new mysqli($servername,$username,$password,$dbname);




$sql = "DELETE FROM `10901College`  WHERE name = '李峻霣'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '毛紹綱'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '曹恆偉'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '闕志達'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '李琳山'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '陳政維'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '林則彬'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '劉宗德'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '周必泰'";
$result = $conn->query($sql);

$sql = "DELETE FROM `10901College`  WHERE name = '黃俊郎'";
$result = $conn->query($sql);


$conn->close(); 



?>