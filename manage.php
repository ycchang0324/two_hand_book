<?php

require 'db_connection.php';

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
        
        echo $this->isMember;
        $conn->close();
    }
        

        
}
    
    
  
    
        



?>