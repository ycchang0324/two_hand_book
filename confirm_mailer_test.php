
<!--用來測試comfirm_mailer.php的功能，只是用來測試，到時候不會在專案裡
-->

<?php

require( dirname( __FILE__ ) . './confirm_mailer.php' );

$name = $studentId = $constellation = "";

$name = $_POST["name"];
$studentId = $_POST["studentId"];
$constellation = $_POST["constellation"];



$text = "你是". $constellation . "座";


//記得要填寄信信箱和密碼
$confirm_mailer->setUsernameAndPassword("b08901XXX@ntu.edu.tw", "XXXXXXXX");
$confirm_mailer->addRecipient("b08901049@ntu.edu.tw", "我是收件人");
$confirm_mailer->addRecipient("ycchang0324@gmail.com", "我是收件人");
$confirm_mailer->addBody("你好ㄚㄚ");
$confirm_mailer->sendMail();

//試著直接引用3_mail.php的寄信程式，利用輸入的學號+"@ntu.edu.tw"當作email收件信箱寄信，內容須包括"你是XX座(星座)"

?>

