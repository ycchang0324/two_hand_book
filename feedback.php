<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require './db/db_connection.php';
require_once './class/mail.php';

// POST DATA

$data = json_decode(file_get_contents("php://input"));


$comment = $data -> comment;

$conn = connection();

$sql = "INSERT INTO feedback (comment)
VALUES ('$feedback')";

if ($conn->query($sql) === TRUE) {
    $commentSql = "SELECT * FROM feedback ";
        $result = $conn->query($commentSql);
        if($result->num_rows > 0){
            $allComment = $result -> fetch_all(MYSQLI_ASSOC);
            echo json_encode(["success"=>1,"allComment"=>$allComment],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
        }
        else{
            echo json_encode(["success"=>0,"msg"=>"no comments"]);
        }
  
} else {
  echo json_encode(["success"=>0,"msg"=>"False"]);
}

$conn->close();
?>