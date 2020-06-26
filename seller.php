<?php

//require 'db_connection.php';

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
    function store(){
        $conn = connection();
        $sql = "INSERT INTO seller(name, stdId, category, subject, price, state, others)
        VALUES ('$this->name', '$this->stdId', '$this->category', '$this->subject', '$this->price', '$this->state','$this->others')";

        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    
    function sendMail(){
        $confirm_mailer = new ConfirmMailer;
        $confirm_mailer->setUsernameAndPassword("b08901049@ntu.edu.tw", "Ycchang0324");
        $confirm_mailer->addRecipient($this->stdId . '@ntu.edu.tw', "我是收件人");
        
        $confirm_mailer->addBody($this->name .'先生/小姐您好，感謝您賣出' . $this->subject . '的書，為' . $this->price . '元');
        $confirm_mailer->sendMail();
    }
  
    
        
}


?>