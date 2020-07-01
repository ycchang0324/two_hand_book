<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require './db/db_connection.php';
require './class/seller.php';
require_once './class/mail.php';

// POST DATA

$data = json_decode(file_get_contents("php://input"));



$name = $data -> name;
$stdId = $data -> stdId;
$category = $data -> category;
$subject = $data -> subject;
$price = $data -> price;
$others = $data -> others;



$seller = new Seller($name, $stdId, $category, $subject,$price, $others);

$seller->store();

?>