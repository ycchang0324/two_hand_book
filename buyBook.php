<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$dataFromFrontEnd = json_decode(file_get_contents("php://input"));

require 'db_connection.php';
$conn = connection();

$data = array(
    "微積分甲上下"=>array(0,0,0,0),
    "交換電路與邏輯設計"=>array(0,0,0,0),
    "生物科學通論"=>array(0,0,0,0),
    "普通化學丙"=>array(0,0,0,0),
    "普通物理學甲"=>array(0,0,0,0),
    "計算機程式設計"=>array(0,0,0,0),
    "電子學(一)"=>array(0,0,0,0),
    "電磁學(一)"=>array(0,0,0,0),
    "工程數學-線性代數"=>array(0,0,0,0),
    "工程數學-微分方程"=>array(0,0,0,0),
    "工程數學-離散數學"=>array(0,0,0,0),
    "工程數學-複變"=>array(0,0,0,0),
    "演算法"=>array(0,0,0,0),
    "資料結構"=>array(0,0,0,0)
);
    
    foreach($data as $x => $x_value) {
        $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 200";
         $result = $conn->query($sql);
        echo $x . " ";
        $data[$x][0] = $result->num_rows;
        echo $data[$x][0] . " ";
        
        
         $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 300";
         $result = $conn->query($sql);
        $data[$x][1] = $result->num_rows;
        echo $data[$x][1] . " ";
        
         $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 500";
         $result = $conn->query($sql);
       $data[$x][2] = $result->num_rows;
        echo $data[$x][2] . " ";
        
         $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 700";
         $result = $conn->query($sql);
       $data[$x][3] = $result->num_rows;
        echo $data[$x][3] . "\n";
    }
    
    
    
    


    json_encode(["data"=>$data]);

?>

      