<!DOCTYPE html>
<!--
<html>
<title> 買書表單
</title>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
</form>
類別：<select id="category" onchange="changeCategory(this.selectedIndex)"  require="required"></select><br><br>
科目：<select id="subject"></select><br><br>
    <script type="text/javascript">
        var category=["大一必修","大二必修","大三必修","複選必修","選修","其他選修"];
        var select = document.getElementById("category");
        var inner = "<option value=0> 請選擇 </option>";
        for(var i = 0; i < category.length; i++){
            inner = inner + '<option value=i>' + category[i] + '</option>';
        }
        select.innerHTML = inner;

        var subjects = new Array();
        subjects[0] = ["交換電路與邏輯設計", "計算機程式設計", "生物科學通論", "普通化學丙", "普通物理學甲", "微積分甲上"];
        subjects[1] = ["電子學(一)", "電磁學(一)", "工程數學-線性代數", "工程數學-微分方程"];
        subjects[2] = ["資料結構", "演算法"];
        subjects[3] = ["工程數學-離散數學", "工程數學-複變"];

        function changeCategory(index){
            var subSelect = document.getElementById("subject");
            if (index <= 3){
              var subInner = "<option value=0> 請選擇 </option>";
              for(var i = 0; i < subjects[index].length; i++){
                subInner = subInner + '<option value=i+1>' + subjects[index][i] + '</option>';
              }
            }
            else{
              var subInner = '請輸入課程全名:<input type="text" name="courseName" require="required"><br>';
            }
            subSelect.innerHTML = subInner;
        }
        changeCategory(document.getElementById("category").selectedIndex-1);
    </script>
    <noscript>Error</noscript>
</form>
-->
<?php
// require( dirname( __FILE__ ) . './有齊的database.php' );

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