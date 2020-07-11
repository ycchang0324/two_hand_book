<?php

// POST 前要先有這些header檔
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//需要連線資料庫
require './db/db_connection.php';

//需要include seller類別
require './class/seller.php';

//需要include寄信函式
require_once './class/mail.php';

// $data接收前端傳過來的資料
$data = json_decode(file_get_contents("php://input"));


//把POST過來的data做基本的刪減，避免壞蛋亂輸入資料駭入系統
function trimmedData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//將刪減後的資料傳述php的變數中
$name     = trimmedData( $data -> name );
$stdId    = trimmedData( $data -> stdId );
$category = trimmedData( $data -> category );
$subject  = trimmedData( $data -> subject );
$price    = trimmedData( $data -> price );
$fee      = trimmedData( $data -> fee );
$others   = trimmedData( $data -> others );


//創造一個$seller的物件
$seller = new Seller($name, $stdId, $category, $subject,$price, 200,$others);

//呼叫$seller的成員函式store()，將資料傳入資料庫中
$seller->store();

?>