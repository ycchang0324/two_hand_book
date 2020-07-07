<?php

//POST資料時必須要先有這些header檔

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//需要連線mysql的database
require_once './db/db_connection.php';

//接收POST過來的data
$data = json_decode(file_get_contents("php://input"));   


//把POST過來的data做基本的刪減，避免壞蛋亂輸入資料駭入系統
function trimmedData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//將刪減好的資料令為php中的變數
$account = trimmedData($data -> account);
$password = trimmedData($data -> password);

//令一個php的變數，如果和database的帳密符合，isMember為1，否則為0
$isMember = 0;

//connection()為./db/db_connection.php中的一個函式，此時$conn已經連線至資料庫second_hand_book中
$conn = connection();

//檢查管理者輸入的帳密是否與login資料表中儲存的帳密相符，若相符，$isMember變數為1，否則為0
$sql = "SELECT account,password FROM Login ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    if(($row["account"] == $account) && ($row["password"] == $password))
        $isMember = 1;
}

//連線結束    
$conn->close();

//回傳$isMember的值。
echo json_encode(["success"=> $isMember ]);



?>