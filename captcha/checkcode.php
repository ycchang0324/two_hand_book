<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$input_captcha = json_encode(file_get_contents("php://input"));
//echo $input_captcha;
$captcha = $input_captcha -> captcha;
//echo $captcha;
if(!isset($_SESSION)){
    session_start();
    }  //判斷session是否已啟動

if((!empty($_SESSION['check_word'])) && (!empty($captcha))){  //判斷此兩個變數是否為空
    // echo $_SESSION['check_word'];
    $answer = $_SESSION['check_word'];
    //echo "captcha: " . $captcha . <br>;
    //echo "answer: " . $answer;
     if($answer == $captcha){
         
          $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
         
          header('content-Type: text/html; charset=utf-8');

          echo json_encode(['success'=>1],JSON_FORCE_OBJECT);
        //   echo '<p> </p><p> </p><a href="./chptcha_index.php">OK輸入正確，將於一秒後跳轉(按此也可返回)</a>';
        //  echo '<meta http-equiv="refresh" content="1; url=./captcha_index.php">';
         
          //exit();
     }else{
        //  echo '<p> </p><p> </p><a href="./chptcha_index.php">Error輸入錯誤，將於一秒後跳轉(按此也可返回)</a>';
        //  echo '<meta http-equiv="refresh" content="1; url=./captcha_index.php">';
        echo json_encode(['success'=>0],JSON_FORCE_OBJECT);
     };

}
?>