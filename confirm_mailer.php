
<?php

//回到根目錄
$parentDirName = dirname(__FILE__);

//引用PHPMailer-5.2-stable資料夾裡面的寄信功能，注意：最外層的資料夾內要有PHPMailer-5.2-stable資料夾，和comfirm_mailer.php的檔案
require_once("$parentDirName/PHPMailer-5.2-stable/PHPMailerAutoload.php"); //記得引入檔案 


class ConfirmMailer
{
	private $m_mail;

    //建構子，其中包含寄信的一些基本設定。
	function __construct()
	{
		$this -> m_mail = new PHPMailer;
		//$mail->SMTPDebug = 3; // 開啟偵錯模式

		$this -> m_mail->isSMTP(); // Set mailer to use SMTP
        
        //若要用gmail寄信，將下面這一行改成smtp.gmail.com
        $this -> m_mail->Host = 'mail.ntu.edu.tw'; // Specify main and backup SMTP servers(台大的smtp)

		$this -> m_mail->SMTPAuth = true; // Enable SMTP authentication
		$this -> m_mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$this -> m_mail->Port = 587; // TCP port to connect to

		$this -> m_mail->setFrom('b08901049@ntu.edu.tw', '二手書網站'); //寄件的Gmail$

		$this -> m_mail->Subject = '二手書網站';
		$this -> m_mail->Body = '報告班長，完全沒有畫面';
		$this -> m_mail->AltBody = '報告班長，完全沒有畫面';
		
	}

    //設定用戶帳密
	public function setUsernameAndPassword( $userName, $passWord)
	{
		$this -> m_mail->Username = $userName;
		$this -> m_mail->Password = $passWord;
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
	
    //新增寄件人
	public function addRecipient( $recipientMail, $recipientName )
	{
		$this -> m_mail -> addAddress($recipientMail, $recipientName);
	}
    
    
    //把所有寄件人列出來
	public function listRecipients()
	{
		//待填
	}
    
    //把所有寄件人移除
	public function removeAllRecipient()
	{
		//待填
	}
    
    
    

    //確認寄信
	public function sendMail()
	{
		if(!$this -> m_mail->send()) {
			//echo 'Message could not be sent.';
			//echo 'Mailer Error: ' . $this->mail->ErrorInfo;
		}
		else{
			//echo 'Message has been sent';
		}
	}
 
	


}

//$confirm_mailer = new ConfirmMailer;

?>

