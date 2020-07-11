<?php

//這些header檔用來POST
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//連線資料庫
require_once '../db/db_connection.php';

//使用Manage類別
require '../class/mailer.php';

//$data接收POST過來的函式
$data = json_decode(file_get_contents("php://input"));



//創建$mailer物件
$mailer = new Mailer();

//呼叫函式，以獲取學號下的全部訂單
$mailer -> sendSellingResult();

?>