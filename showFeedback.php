<?php

//藥用POST方法前要用這些header檔
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//需要連線資料庫的檔案
require './db/db_connection.php';


// $conn為處理資料庫的變數
$conn = connection();

//$data變數接收前端傳過來的資料
$data = json_decode(file_get_contents("php://input"));

    

//要求所有feedback裡的資料
$sql = "SELECT * FROM feedback ";

//$result為所有feedback的資料
$result = $conn->query($sql);

//當有回饋，會回傳success為1，allComment是儲存所有feedback資料的二維陣列，第一為為第幾列，第二為為第幾欄
if($result->num_rows > 0){
    $allComment = $result -> fetch_all(MYSQLI_ASSOC);
    echo json_encode(["success"=>1,"allComment"=>$allComment],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
}
//若沒有回饋，success回傳0，allComment回傳空值
else{
    echo json_encode(["success"=>0,"allComment"=>""]);
}

//結束資料庫連線
$conn->close();
?>