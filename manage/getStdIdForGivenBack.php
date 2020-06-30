<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../db_connection.php';
require '../manage.php';
require_once '../confirm_mailer.php';

$data = json_decode(file_get_contents("php://input"));
$stdId = $data -> stdId;

$manager = new Manage();
$manager->givenBackStdId($stdId);




?>