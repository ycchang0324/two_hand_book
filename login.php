<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'db_connection.php';

require_once 'confirm_mailer.php';

$data = json_decode(file_get_contents("php://input"));
$account = $data -> account;
$password = $data -> password;
$isMember = 0;

$conn = connection();
$sql = "SELECT account,password FROM Login ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    if(($row["account"] == $account) && ($row["password"] == $password))
        $isMember = 1;
}

    
$conn->close();

echo json_encode(["success"=> $isMember ]);



?>