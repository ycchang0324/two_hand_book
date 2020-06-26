<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$conn = connection();

$data = array(
array("微積分",0,0,0,0),
array("交換電路與邏輯設計",0,0,0,0),
array("生物科學通論",0,0,0,0),
array("普通化學丙",0,0,0,0),
array("普通物理甲",0,0,0,0),
array('電子學(一)',0,0,0,0),
array("電磁學(一)",0,0,0,0),
array("線性代數",0,0,0,0),
array("微分方程",0,0,0,0),
array("離散",0,0,0,0),
array("複變",0,0,0,0),
array("演算法",0,0,0,0),
array("資料結構",0,0,0,0)
);
    
for($x = 0; $x < 12; $x++){
    $subject = $data[$x][0];
    
    $sql = "SELECT id FROM seller WHERE subject = '$subject' AND price = 200";
     $result = $conn->query($sql);
    
    $data[$x][1] = $result->num_rows;

    $sql = "SELECT id FROM seller WHERE subject = '$subject' AND price = 300";
    $result = $conn->query($sql);
    
    
    $data[$x][2] = $result->num_rows;
    
    $sql = "SELECT id FROM seller WHERE subject = '$subject' AND price = 500";
    $result = $conn->query($sql);
    
    
    $data[$x][3] = $result->num_rows;
    
    $sql = "SELECT id FROM seller WHERE subject = '$subject' AND price = 700";
    $result = $conn->query($sql);
    
    
    $data[$x][4] = $result->num_rows;   

}

    echo json_encode(["users"=>$data]);
?>

      