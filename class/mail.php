
<?php

//dirname是這個檔案的根目錄，套兩次dirname就是這個檔案的根根目錄。
$parentDirName = dirname(dirname(__FILE__));

//引用PHPMailer-5.2-stable資料夾裡面的寄信功能，注意：最外層的資料夾內要有PHPMailer-5.2-stable資料夾，和comfirm_mailer.php的檔案
//用require'../../PHPMailer-5.2-stable/PHPMailerAutoload.php'會有錯誤，網路上說是因為PHPMailer只能用絕對路徑require，用相對路徑require會有問題
require_once("$parentDirName/PHPMailer-5.2-stable/PHPMailerAutoload.php"); //記得引入檔案 

//能連線資料庫
require_once("$parentDirName/db/db_connection.php"); 

//創立一個寄信類別Mailer
class Mailer
{
    //裡面有private的成員變數
	private $m_mail;
    private $stdId;
    private $name;
    private $subject;
    private $price;

    
    //建構子，其中包含寄信的一些基本設定。
	function __construct()
	{
		$this -> m_mail = new PHPMailer;
        
        //若開啟Debug模式，當寄信時會噴出很多寄信的細節，出錯時很好找，但是平常可以comment掉
		//$this -> m_mail->SMTPDebug = 3; // 開啟偵錯模式

        //我們用的是SMTP寄信，且寄信內文符合HTML格式
		$this -> m_mail->isSMTP(); // Set mailer to use SMTP
        $this -> m_mail ->isHTML(true);   
        
        
        //若要用gmail寄信，將下面這一行改成smtp.gmail.com
        //如果要用自己的gmail寄信，記得要改gmail容許低安全性程式執行的按鍵，可參考以下網址
        //https://sites.google.com/a/mail.ncnu.edu.tw/ems/home/faqs/cloudmail-wen-ti/faq-c-0026
        
        //寄信的伺服器是smtp.gmail.com
        $this -> m_mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers(台大的smtp)
        
        
		
        $this -> m_mail->SMTPAuth = true; // Enable SMTP authentication
		
        //我們用ssl方式寄信
        $this -> m_mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
		
        //ssl的Port號是465
        $this -> m_mail->Port = 465; // ssl port to connect to
        
        //設定寄信信箱和寄信人名稱
		$this -> m_mail->setFrom('ntueeshb@gmail.com', '二手書網站'); //寄件的Gmail$
        
        //預設信件主旨，內文、替換內文
		$this -> m_mail->Subject = '二手書網站';
		$this -> m_mail->Body = '報告班長，完全沒有畫面';
		$this -> m_mail->AltBody = '報告班長，完全沒有畫面';
		
	}
    
    //設定寄信的帳密
    private function setUsernameAndPassword( $userName, $passWord)
	{
		$this -> m_mail->Username = $userName;
		$this -> m_mail->Password = $passWord;
	}
    
    //在資料庫中email資料表找尋寄信的帳密
    private function setUser(){
        $conn = connection();
        $account = 'ntueeshb@gmail.com';
        
        $sql = "SELECT password FROM email WHERE account = '$account'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
             $orderList = $result -> fetch_all(MYSQLI_ASSOC);
        
            
            
        $password = $orderList[0][password];
        
        $this->setUsernameAndPassword($account, $password);
        
    }
    
    //更改主旨
	private function addSubject( $subject )
	{
		$this -> m_mail->Subject = $subject;
	}
    
    //更改內文
	private function addBody( $body )
	{
		
		$this -> m_mail->Body = $body;
		$this -> m_mail->AltBody = $body;
	}
    
    
    
    //確認寄信
	private function sendMail()
	{
		if(!$this -> m_mail->send()) {
            $msgError = "Message could not be sent. Mailer Error: " . $this->m_mail->ErrorInfo;
			echo json_encode(["success"=>"0","msg"=>"$msgError"]);
			
		}
		else{
            echo json_encode(["success"=>"1","msg"=>"Message has been sent"]);	
		}
	}
    
    //賣家要寄信前，先呼叫這個函式，將基本資料assign進成員變數中
    public function sellerSetMail( $_stdId, $_name, $_subject, $_price ){
        
        $this -> stdId = $_stdId;
        $this -> name = $_name;
        $this -> subject = $_subject;
        $this -> price = $_price;
    }
    
    //非常重要!!當在迴圈中要寄給很多不同收信人各自的信件時，每次都要先呼叫這個函式去除上一位收件人的信箱，否則第一個人會收到所有人的信件
	public function removeAllRecipient(){
        $this->m_mail->ClearAllRecipients( );
    }
    
    //加入收件人
    public function addRecipient( $recipientMail, $recipientName )
	{
		$this -> m_mail -> addAddress($recipientMail, $recipientName);
	}
    
    
    
    
    
    
    
    public function sendMailForm(){
        $this->setUser();
        $this->removeAllRecipient();
        
        $this->addRecipient($this->stdId . '@ntu.edu.tw', $this->name);
        
        
        $body = $this->name .'先生/小姐您好，感謝您賣出' . $this->subject . '的書，為' . $this->price . '元';
        $this -> addBody( $body );
        
        
        $this -> sendMail();
    }
    
    public function sendMailReceive(){
        
        $this->setUser();
        
        $this->addRecipient($this->stdId . '@ntu.edu.tw', $this->name);
    
        $body = $this->name .'先生/小姐您好，已收到' . $this->subject . '的書，為' . $this->price . '元';
        $this -> addBody( $body );
        
        
        $this -> sendMail();
    }
    
    public function sendMailNotReceive(){
        $this->setUser();
        
        $conn = connection();
        $sql = "SELECT stdId, name FROM seller";
        $result = $conn->query($sql);
        //echo $result->num_rows . "\n";
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $stdId = $row["stdId"];
                $name = $row["name"];
                
                
                $this->addRecipient($stdId . '@ntu.edu.tw', $name);
                
                $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND state = '沒收到書'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                    $body = $name . "先生/小姐您好，很抱歉沒有收到以下書籍：" . "<br>";
                    
                    while($row = $result->fetch_assoc()) 
                        $body = $body . $row["subject"] . '的書，為' . $row["price"] . "元" . "<br>" ;
                    $body = $body . "若有錯誤，請立刻聯繫二手書專員"; 
                   
                    $this -> addBody( $body );
                    $this -> sendMail();
                }                
            }   
        }
    }
    
    public function sendSellingResult(){
        $this->setUser();
        
        $conn = connection();
        $sql = "SELECT stdId, name FROM seller";
        $result = $conn->query($sql);
        //echo $result->num_rows . "\n";
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $stdId = $row["stdId"];
                $name = $row["name"];
                
                $this->addRecipient($stdId . '@ntu.edu.tw', $name);
                
                $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND (state = '已賣出' or state = '沒賣出')";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                    $body = $name . "先生/小姐您好，以下是您的賣書結果：" . "<br>";
                    
                    $body .= "已賣出的書：" . "<br>";
                    $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND state = '已賣出' ";
                    $result = $conn->query($sql);
                    
                    while(($row = $result->fetch_assoc()) && $row["state"] == '已賣出') 
                        $body = $body . $row["subject"] . '的書，為' . $row["price"] . "元" . "<br>" ;
                    
                    
                    $body .= "沒賣出的書：" . "<br>";
                    $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND state = '沒賣出' ";
                    $result = $conn->query($sql);
                    while(($row = $result->fetch_assoc()) && $row["state"] == '沒賣出') 
                        $body = $body . $row["subject"] . '的書，為' . $row["price"] . "元" . "<br>" ;
                    
                    
                    
                    $body = $body . "請在XX月XX日至指定地點領錢及退書"; 
                    
                    echo $body . "\n";
                    $this -> addBody( $body );
                    $this -> sendMail();
                }                
            }   
        }
    }
    
    public function sendMailGivenBack(){
        $this->setUser();
        
        $this->addRecipient($this->stdId . '@ntu.edu.tw', $this->name);
        
        
        $body = $this->name .'先生/小姐您好，您已領取' . $this->subject . '的賣出費用或是退書，感謝您的參與!' ;
        $this -> addBody( $body );
        
        
        $this -> sendMail();
    }
    
    public function sendMailNotGivenBack(){
        //echo "in function senMailNot Given Back\n\n\n";
        $this->setUser();
        
        $conn = connection();
        $sql = "SELECT stdId, name FROM seller";
        $result = $conn->query($sql);
        //echo $result->num_rows . "\n";
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $stdId = $row["stdId"];
                $name = $row["name"];
                
                
                $this->addRecipient($stdId . '@ntu.edu.tw', $name);
                
                $sql = "SELECT * FROM bookorder WHERE stdId = '$stdId' AND state = '未領錢或退書'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                    $body = $name . "先生/小姐您好，您尚未領取以下書籍的賣出費用或是退書：" . "<br>";
                    
                    while($row = $result->fetch_assoc()) 
                        $body = $body . $row["subject"] . "<br>" ;
                    $body = $body . "補領時間請關注電機二手書臉書粉絲專頁"; 
                   
                    $this -> addBody( $body );
                    $this -> sendMail();
                }                
            }   
        }
    }
 
	


}

                

?>

