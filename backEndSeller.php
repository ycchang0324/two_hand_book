<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'db_connection.php';
require 'seller.php';
require_once 'confirm_mailer.php';

// POST DATA

$data = json_decode(file_get_contents("php://input"));
$name = $data -> name;
$stdId = $data -> stdId;
$category = $data -> category;
$subject = $data -> subject;
$price = $data -> price;
$others = $data -> others;

  /*
$name = '張原嘉';
$stdId = 'b08901049';
$catagory = '大一必修';
$subject = '微積分';
$price = 200;
$others = '';
*/

$seller = new Seller($name, $stdId, $category, $subject,$price, $others);
$seller->store();
$seller->sendMail();

?>