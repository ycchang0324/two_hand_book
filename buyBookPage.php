<?php

// POST 前要先有這些header檔
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



//需要連線資料庫
require './db/db_connection.php';

//呼叫連線資料庫，$conn現在是操作資料庫的變數
$conn = connection();

//$dataFromFrontEnd接收前端來的資料
$dataFromFrontEnd = json_decode(file_get_contents("php://input"));

//$data為一個二維陣列，第一維為課程，第二維為200、300、500、700元的書籍數量，預設為0本
$data = [
    "Default"=>array(0,0,0,0),
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
];

//下面做的迴圈將所有課程的不同價格訂單數量計算出來，並且assign到$data陣列裡面
foreach($data as $x => $x_value) {
    
    $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 200";
     $result = $conn->query($sql);
    $data[$x][0] = $result->num_rows;



     $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 300";
     $result = $conn->query($sql);
    $data[$x][1] = $result->num_rows;


     $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 500";
     $result = $conn->query($sql);
   $data[$x][2] = $result->num_rows;


     $sql = "SELECT id FROM bookorder WHERE subject = '$x' AND price = 700";
     $result = $conn->query($sql);
   $data[$x][3] = $result->num_rows;

}
    
//回傳$data陣列    
echo json_encode($data, JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);

?>

      