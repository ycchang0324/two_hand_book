
<?php


$parentDirName = dirname(dirname(__FILE__));

//引用PHPMailer-5.2-stable資料夾裡面的寄信功能，注意：最外層的資料夾內要有PHPMailer-5.2-stable資料夾，和comfirm_mailer.php的檔案
require_once("$parentDirName/PHPMailer-5.2-stable/PHPMailerAutoload.php"); //記得引入檔案 

//require_once("$parentDirName/db/db_connection.php"); 

class ConfirmMailer
{
	private $m_mail;
    private $stdId;
    private $name;
    private $subject;
    private $price;

    //建構子，其中包含寄信的一些基本設定。
	function __construct()
	{
		$this -> m_mail = new PHPMailer;
		//$this -> m_mail->SMTPDebug = 3; // 開啟偵錯模式

		$this -> m_mail->isSMTP(); // Set mailer to use SMTP
        
        //若要用gmail寄信，將下面這一行改成smtp.gmail.com
        $this -> m_mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers(台大的smtp)

		$this -> m_mail->SMTPAuth = true; // Enable SMTP authentication
		$this -> m_mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
		$this -> m_mail->Port = 465; // TCP port to connect to
        //$this -> m_mail->CharSet = "utf-8"; //郵件編碼
		$this -> m_mail->setFrom('ntueeshb@gmail.com', '二手書網站'); //寄件的Gmail$
            
		$this -> m_mail->Subject = '二手書網站';
		$this -> m_mail->Body = '報告班長，完全沒有畫面';
		$this -> m_mail->AltBody = '報告班長，完全沒有畫面';
		
	}
    
    public function setUsernameAndPassword( $userName, $passWord)
	{
		$this -> m_mail->Username = $userName;
		$this -> m_mail->Password = $passWord;
	}
    
    public function sellerSetMail( $_stdId, $_name, $_subject, $_price ){
        
        $this -> stdId = $_stdId;
        
        $this -> name = $_name;
        $this -> subject = $_subject;
        $this -> price = $_price;
    }
	

    //更改主旨
	public function addSubject( $subject )
	{
		$this -> m_mail->Subject = $subject;
	}
    
    //更改內文
	public function addBody( $body )
	{
		
		$this -> m_mail->Body = $body;
		$this -> m_mail->AltBody = $body;
	}
    
    //確認寄信
	public function sendMail()
	{
		if(!$this -> m_mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $this->m_mail->ErrorInfo;
		}
		else{
			echo 'Message has been sent';
		}
	}
    
    public function addRecipient( $recipientMail, $recipientName )
	{
		$this -> m_mail -> addAddress($recipientMail, $recipientName);
	}
    
    public function sendMailForm(){
        
        $conn = connection();
        $account = 'ntueeshb@gmail.com';
        
        $sql = "SELECT password FROM email WHERE account = '$account'";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
             $orderList = $result -> fetch_all(MYSQLI_ASSOC);
        
            
            
        $password = $orderList[0][password];
        
        $this->setUsernameAndPassword($account, $password);
        $this->addRecipient($this->stdId . '@ntu.edu.tw', "我是收件人");
        //$this->addRecipient($this->m_mail->Username, "我是收件人");
        
        $body = $this->name .'先生/小姐您好，感謝您賣出' . $this->subject . '的書，為' . $this->price . '元';
        $this -> addBody( $body );
        
        
        $this -> sendMail();
    }
 
	


}

                

?>

