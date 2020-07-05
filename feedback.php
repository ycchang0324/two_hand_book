<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require './db/db_connection.php';
require_once './class/mail.php';

// POST DATA
$conn = connection();

$data = json_decode(file_get_contents("php://input"));
if( $data -> comment != "" ){

    $comment = $data -> comment;
    $reply = $data -> reply;

    //$comment = "1";
    //$reply = "";

    $sql = "INSERT INTO feedback (comment,reply)
    VALUES ('$comment','$reply')";
     
    
    if ($conn -> query($sql) === TRUE) {
        
      echo json_encode(["success"=>1,"msg"=>"comment successfully"]);
        

    } else {

      echo json_encode(["success"=>0,"msg"=>"False"]);
        
    }
    
}


$conn->close();
?>