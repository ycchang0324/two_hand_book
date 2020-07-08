<?php


class Manage {
      
    function getBookOrderStdId($stdId){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND state = '未收到書'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $orderList = $result -> fetch_all(MYSQLI_ASSOC);
            echo json_encode(["success"=>1,"orderList"=>$orderList],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
        }
        else{
            echo json_encode(["success"=>0]);
        }
        $conn->close();
        
    }
    
    function getBookOrderBookId($id){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE id = '$id' AND state = '未收到書'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $orderList = $result -> fetch_all(MYSQLI_ASSOC);
            echo json_encode(["success"=>1,"orderList"=>$orderList],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
        }
        else{
            echo json_encode(["success"=>0]);
        }
        $conn->close();
        
    }
    
    function notReceive(){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE state = '未收到書'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $sql = "UPDATE bookorder SET state='沒收到書' WHERE id=$row[id]";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["success"=>1,"msg"=>"成功更改至沒到收書狀態"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                
            }else {
                $msg = "更改狀態失敗 " . $conn->error;
                echo json_encode(["success"=>0,"msg"=>"$msg"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
            }
            
            
        }
        
        

        $conn->close();
    }
    
    function notSold(){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE state = '已收到書'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $sql = "UPDATE bookorder SET state='沒賣出' WHERE id=$row[id]";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["success"=>1,"msg"=>"成功更改至沒賣出狀態"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
            }else {
                $msg = "更改狀態失敗 " . $conn->error;
                echo json_encode(["success"=>0,"msg"=>"$msg"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
            }
            
        }

        $conn->close(); 
    }
    
    function notGivenBack(){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE state = '已賣出' OR state = '沒賣出'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $sql = "UPDATE bookorder SET state='未領錢或退書' WHERE id=$row[id]";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["success"=>1,"msg"=>"成功更改至未領錢或退書狀態"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
                
            }else {
                $msg = "更改狀態失敗 " . $conn->error;
                echo json_encode(["success"=>0,"msg"=>"$msg"],JSON_UNESCAPED_UNICODE,JSON_FORCE_OBJECT);
            }
        }
    
        $conn->close(); 
        
    }
    

    
   

    


    
    
    
}
?>