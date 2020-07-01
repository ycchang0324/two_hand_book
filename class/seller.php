<?php



class Seller {
  private $name;
  private $stdId;
  private $category;
  private $subject;
  private $price;
  private $others;
  private $state;


  function __construct($_name, $_stdId, $_category, $_subject, $_price, $_others) {
    $this->name = $_name;
    $this->stdId = $_stdId;
    $this->category = $_category;
    $this->subject = $_subject;
    $this->price = $_price;
    $this->state = '未收到書';
    $this->others = $_others;
    
      
    
  }
    
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
        $conn = connection();
       
        
        if( $this->isNew() == 1 ){
            $sql = "INSERT INTO bookorder(name, stdId, category, subject, price, state, others)
            VALUES ('$this->name', '$this->stdId', '$this->category', '$this->subject', '$this->price', '$this->state','$this->others')";
                
            if ($conn->query($sql) === TRUE) {
              echo json_encode(["success" => 1,"msg"=>"success insert order"]);
            } else {
              
                $msg = "Error: " . $sql . "<br>" . $conn->error;
                echo json_encode(["success" => 0,"msg"=>$msg]);
            } 
            
            
            $sql = "INSERT INTO seller(stdId, name, bookNum)
            VALUES ('$this->stdId','$this->name',1)";
            if ($conn->query($sql) === TRUE) {
                
                echo json_encode(["success" => 1,"msg"=>"success insert order"]);
                
                $confirm_mailer = new ConfirmMailer;
                $confirm_mailer -> sellerSetMail( $this->stdId, $this->name, $this->subject, $this->price );
                $confirm_mailer -> sendMailForm();
                
                
            } else {
              $msg = "Error: " . $sql . "<br>" . $conn->error;
              echo json_encode(["success" => 0,"msg"=>$msg]);
            } 
        }
        else{
            $sql = "SELECT * FROM Seller WHERE stdId = '$this->stdId' ";
            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()){
                    $bookNum = $row["bookNum"];
                
            }
            
            if($bookNum < 5 ){
                $bookNum = $bookNum + 1;
               $sql = "UPDATE Seller SET bookNum = '$bookNum' WHERE stdId = '$this->stdId'" ;
                $conn->query($sql); 
                
                
                 $sql = "INSERT INTO bookorder(name, stdId, category, subject, price, state, others)
            VALUES ('$this->name', '$this->stdId', '$this->category', '$this->subject', '$this->price', '$this->state','$this->others')";
                
                $confirm_mailer = new ConfirmMailer;
                $confirm_mailer -> sellerSetMail( $this->stdId, $this->name, $this->subject, $this->price );
                $confirm_mailer -> sendMailForm();

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