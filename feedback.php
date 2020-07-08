<?php

// POST 前要先有這些header檔
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//需要連線資料庫
require './db/db_connection.php';

//呼叫連線資料庫，$conn現在是操作資料庫的變數
$conn = connection();

//data接收前端post過來的變數
$data = json_decode(file_get_contents("php://input"));

//把POST過來的data做基本的刪減，避免壞蛋亂輸入資料駭入系統
function trimmedData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//$comment為刪減過的回饋
$comment = trimmedData( $data -> comment );

//如果$comment非空且有被設定，才能INSERT進資料庫
if( !empty($comment) && isset($comment ) ){

    $sql = "INSERT INTO feedback (comment,reply)
    VALUES ('$comment','')";
     
    //$conn執行$sql的指令，如果正確的話會回傳success為1，msg回傳comment successfully
    if ($conn -> query($sql) === TRUE) {
        
      echo json_encode(["success"=>1,"msg"=>"comment successfully"]);
        

    } else {
        
      echo json_encode(["success"=>0,"msg"=>"False"]);
        
    }
    
}
//若傳入的$comment為空，回傳success為0，msg回傳empty comment!
else if( empty( $comment ) ){
    echo json_encode(["success"=>0,"msg"=>"Empty comment!"]);
}

//結束資料庫連線
$conn->close();
?>