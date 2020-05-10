<!DOCTYPE html>
<html>
<title> <p>表單</p>
</title>
<body>
<?php echo 表單內容 ?>
<!--
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  學號：<input type="text" name="studentId" minlength="9" maxlength="9" require="required"><br>
  姓名: <input type="text" name="stdName" maxlength="5" require="required"><br>
  類別: <select name="category" require="required">
        <option value="comp1">大一必修</option>
        <option value="comp2">大二必修</option>
        <option value="comp3">大三必修</option>
        <option value="multi">複選必修</option>
        <option value="elective">選修</option>
        <option value="other">其他選修(含通識)</option>
        </select>
　科目：<select name="subject" require="required">
        <option value=></option>
        <option value=></option>
        <option value=></option>
        <option value=></option>
        </select>
  數量: <input type="number" name="amount" value="1" min="1" require="required">
  書價:<br>
  <blockquote>
    200元<input type="radio" name="price" value="200"><br>
    300元<input type="radio" name="price" value="300"><br>
    500元<input type="radio" name="price" value="500"><br>
    700元<input type="radio" name="price" value="700"><br>
  </blockquote>
  備註:<input type="text" name="comment" maxlength="100">
  <input type="text" name="check" maxlength="4" require="required">                      <!--驗證碼--
  <input type="checkbox" name="condition"  value="我已同意二手書網站條款" require="required"><br>
  <input type="submit" value="送出"><br>

</form>
-->
<?php

# require( dirname( __FILE__ ) . './database.php' )

$servername = ""
$username = ""
$password = ""
$dbname = ""


$stdId = $stdName = $email = $comment = ""
$price = $bookStatus = $sellerStatus = $sellerId = 0
$category = $subject = $bookName = ""
$bookId1 = $bookId2 = $bookId3 = $bookId4 = $bookId5 = 0

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function regSeller($stdName, $stdId, $email, $sellerStatus, $comment){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $stdId = test_input($_POST["stdId"]);
    $stdName = test_input($_POST["stdName"]);
    $
    $sellerStatus = test_input($_POST["sellerStatus"]);
    $comment = test_input($_POST["comment"]);
    $email = test_input($_POST["email"]);
  }
  $addSeller = $conn->prepare("INSERT INTO Sellers(sellerId, stdName, stdId, email, 
    bookId1, bookId2, bookId3, bookId4, bookId5, sellerStatus, comment) VALUES (?, ?, 
    ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $addSeller->bind_param("sssssssssss", $sellerId, $stdName, $stdId, $email, 
    $bookId1, $bookId2, $bookId3, $bookId4, $bookId5, $sellerStatus, $comment);
  $addSeller->execute();
}

function regBook($stdName, $stdId, $price, $subject, $bookStatus,
  $bookName, $category){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $stdId = test_input($_POST["stdId"]);
    $stdName = test_input($_POST["stdName"]);
    $price = test_input($_POST["price"]);
    $subject = test_input($_POST["subject"]);
    $bookStatus = test_input($_POST["bookStatus"]);
    $category = test_input($_POST["category"]);
    $bookName = test_input($_POST["bookName"]);
    $email = test_input($_POST["email"]);
  }

  if ($email === ""){
    $email = $stdId . "@ntu,edu.tw"
  }
  $addBook = $conn->prepare("INSERT INTO Books(stdName, stdId, price, subject, bookStatus,
    bookName, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $addBook->bind_param("sssssss", $stdName, $stdId, $price, $subject, $bookStatus,
    $bookName, $category);
  $addBook -> execute();
}
$conn->close();
?>
</body>
</html>