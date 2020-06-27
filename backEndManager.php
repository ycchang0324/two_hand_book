<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'db_connection.php';
require 'manage.php';

$data = json_decode(file_get_contents("php://input"));
$account = $data -> account;
$password = $data -> password;

$manager = new Manage($account,$password);
$success = $manager->login();

json_encode(["success"=>$success]);



?>