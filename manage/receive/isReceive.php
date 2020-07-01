<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../db/db_connection.php';
require '../../class/manage.php';
require_once '../../class/mail.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data -> id;

$manager = new Manage();
$manager->isReceive(46);




?>