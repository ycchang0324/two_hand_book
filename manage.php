<?php

class Manage {
  private $account;
  private $password;
  private $isMember;


  function __construct($_account,$_password) {
    $this->account = $_account;
    $this->password = $_password;
    $this->isMember = 0;
  }
    function login(){
        $conn = connection();
        $sql = "SELECT account,password FROM Login ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if(($row["account"] == $this->account) && ($row["password"] == $this->password))
                $this->isMember = 1;
        }
        
        return $this->isMember;
        $conn->close();
    }
    function receiveBookStdId($stdId){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId'";
        $result = $conn->query($sql);
        /*while($row = $result->fetch_assoc()){
            echo $row["id"] . "\n";
        }
        */
        $conn->close();
        
    }
    
    function isReceive($id){
        $conn = connection();
        $sql = "UPDATE bookorder SET state='已收到書' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
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
            echo "Record updated successfully";
            }else {
            echo "Error updating record: " . $conn->error;
        }
            
        }

        $conn->close();
    }
    
    
    function buyBookToFront($id){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE id='$id'";
        
        $conn->close();
    }
    
    function isSold($id){
        $conn = connection();
        $sql = "UPDATE bookorder SET state='已賣出' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
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
            echo "Record updated successfully";
            }else {
            echo "Error updating record: " . $conn->error;
        }
            
        }

        $conn->close(); 
    }
    
    function givenBackStdId($stdId){
        $conn = connection();
        $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId'";
        $result = $conn->query($sql);
        /*while($row = $result->fetch_assoc()){
            echo $row["id"] . "\n";
        }
        */
        $conn->close();
        
    }
    
    function isGivenBack($id){
        $conn = connection();
        $sql = "UPDATE bookorder SET state='已領錢或退書' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
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
            echo "Record updated successfully";
            }else {
            echo "Error updating record: " . $conn->error;
        }
            
        }

        $conn->close(); 
    }
    
    
}
?>