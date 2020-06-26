
<?php

    VALUES('$username','$useremail')");
    function bookStat($bookName){  //回傳現有已註冊的書籍統計資料(金額與對應數量)
    $lookUp = $conn->prepare("SELECT * FROM books WHERE bookName LIKE %'$bookName'% ");
    $lookUp->bind_param("s", $bookName);
    $result = $lookUp->execute();
    if($result->num_rows > 0){
        $re = array(0,0,0,0);
        while($row = $result->fetch_assoc()) {
            if ($row['price'] == 200){
                $re[0]++;
            }
            else if ($row['price'] == 300){
                $re[1]++;
            }
            else if ($row['price'] == 500){
                $re[2]++;
            }
            else if ($row['price'] == 700){
                $re[3]++;
            }
        }
    }
    return $re
}
$conn->close()
?>