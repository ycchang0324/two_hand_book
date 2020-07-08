<?php

//創建類別Seller，用途是將賣書表單的資料儲存到資料庫中bookorder資料表中
class Seller {
    
    //private成員變數
    private $name;
    private $stdId;
    private $category;
    private $subject;
    private $price;
    private $others;
    private $fee;
    private $state;
      
    
    //建構子，將賣家基本資料assign進物件中
    function __construct($_name, $_stdId, $_category, $_subject, $_price, $_fee, $_others) {
    
        $this->name = $_name;
        $this->stdId = $_stdId;
        $this->category = $_category;
        $this->subject = $_subject;
        $this->price = $_price;
        $this->state = '未收到書';
        $this->fee = $_fee;
        $this->others = $_others;

      
    
    }
    
    //判斷賣家是不是第一次填賣書表單。若是，回傳1，若之前有填過，回傳0
    function isNew(){
        $conn = connection();
        $sql = "SELECT stdId FROM Seller ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            if($row["stdId"] == $this->stdId)
                return 0;
        }
        return 1;
    }
    
    
    function store(){
        //與資料庫連線，$conn為資料庫執行的變數
        $conn = connection();
       
        //判斷賣家是否已出現在Seller資料表中，若從來沒出現在資料表中，先插入一筆定單至bookorder資料表中，再插入一筆賣家資料至seller資料表中
        if( $this->isNew() == 1 ){
            $sql = "INSERT INTO bookorder(name, stdId, category, subject, price, fee, state, others)
            VALUES ('$this->name',
                    '$this->stdId', 
                    '$this->category', 
                    '$this->subject', 
                    '$this->price', 
                    '$this->fee', 
                    '$this->state',
                    '$this->others'
                    )";
                
            if ($conn->query($sql) === TRUE) {
              echo json_encode(["success" => 1,"msg"=>"success insert order"]);
            } else {
              
                $msg = "Error: " . $sql . "<br>" . $conn->error;
                echo json_encode(["success" => 0,"msg"=>$msg]);
            } 
            
            
            $sql = "INSERT INTO seller(stdId, name, bookNum)
            VALUES ('$this->stdId',
                    '$this->name',
                    1
                    )";
            
            if ($conn->query($sql) === TRUE) {
                /*
                $sql = "DELETE FROM seller WHERE stdId = ''";
                conn->query($sql);
                echo json_encode(["success" => 1,"msg"=>"success insert order"]);
                */
                
                $mailer = new Mailer;
                $mailer -> sellerSetMail( $this->stdId, $this->name, $this->subject, $this->price );
                $mailer -> sendMailForm();
                
                
            } else {
              $msg = "Error: " . $sql . "<br>" . $conn->error;
              echo json_encode(["success" => 0,"msg"=>$msg]);
            } 
        }
        else{
            $sql = "SELECT * FROM seller WHERE stdId = '$this->stdId' ";
            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()){
                    $bookNum = $row["bookNum"];
                
            }
            
            if($bookNum < 5 ){
                
                $bookNum = $bookNum + 1;
                $sql = "UPDATE seller SET bookNum = '$bookNum' WHERE stdId = '$this->stdId'" ;
                $conn->query($sql); 
                
                
                
                 $sql = "INSERT INTO bookorder(name, stdId, category, subject, price, fee, state, others)
            VALUES ('$this->name',
                    '$this->stdId', 
                    '$this->category', 
                    '$this->subject', 
                    '$this->price', 
                    '$this->fee', 
                    '$this->state',
                    '$this->others'
                    )";
                
                $mailer = new Mailer;
                $mailer -> sellerSetMail( $this->stdId, $this->name, $this->subject, $this->price );
                $mailer -> sendMailForm();

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["success" => 1,"msg"=>"success insert order"]);
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
                echo json_encode(["success" => 0,"msg"=>$msg]);
            }    
            
            }
            
             else
                //echo "too much"
                 ;
            
            
            
           
            
            
            
        }
        

        $conn->close();
    }
    
        
}


?>