
<?php




//引用PHPMailer-5.2-stable資料夾裡面的寄信功能，注意：最外層的資料夾內要有PHPMailer-5.2-stable資料夾，和comfirm_mailer.php的檔案
require './db/db_connection.php';
require_once './class/mail.php';

$confirm_mailer = new ConfirmMailer;
$userName = 'ntueesaad@gmail.com';
$passWord = 'weareelites';
$confirm_mailer->setUsernameAndPassword( $userName, $passWord);
$subject = '道歉信-寄太多重覆信';
$confirm_mailer->addSubject( $subject );


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "10901";

$counter = 0;

$conn = new mysqli($servername,$username,$password,$dbname);




$sql = "SELECT * FROM `10901college`";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    
    $recipientMail = $row["email"];
    $recipientName = $row["name"];

    $body = $row["name"] . " 老師您好:<br><br>";
    $body .= "我們是電機系系學會學術部。<br>";
    $body .= "由於寄信是用php mailer寄送，我忘了刪除上一位老師的信箱資料，就直接寄送下一位老師的信件，<br>因此導致許多老師收到多封郵件，造成您的困擾，";
    $body .= "在此向各位老師致上最深的歉意。";
    
    
    $body .= "<br><br>電機系系學會 敬上";
    echo '<br>';  
    echo '<br>';  
    echo $body;
    echo '<br>';  
    echo '-------------------------------';
    $confirm_mailer->removeAllRecipient();
    $confirm_mailer->addBody( $body );
    $confirm_mailer->addRecipient( $recipientMail, $recipientName );
    $confirm_mailer->sendMail();
    
    $counter++;
}



$conn->close(); 



?>