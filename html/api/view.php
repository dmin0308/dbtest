<?php

include_once("./config/db.php"); 
$conn = new mysqli($servername, $username, $password, $dbname);
$wno = $_GET['wno'];

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
} else {
   $sql = "SELECT * FROM delivery_container_inquiries where inquiry_id = ".$wno; 
   $result = $conn->query($sql);
   $row = $result->fetch_assoc(); 

   // Check if the result exists
   if ($row) {
?>
   <section style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
       <h2 style="text-align: center; font-size: 24px; color: #333;">가게 정보</h2>
       <p><strong>가게 이름:</strong> <?php echo $row['store_name']; ?></p>
       <p><strong>주소:</strong> <?php echo $row['store_address']; ?></p>
       <p><strong>소유자 이름:</strong> <?php echo $row['owner_name']; ?></p>
       <p><strong>연락처:</strong> <?php echo $row['contact_number']; ?></p>
       <p><strong>배달 앱:</strong> <?php echo $row['delivery_apps']; ?></p>

       <div style="display: flex; justify-content: space-between; margin-top: 20px;">
           <a href="./write.php?wno=<?php echo $wno; ?>" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">글수정</a>
           <a href="./delete.php?wno=<?php echo $wno; ?>" style="padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">글삭제</a>
       </div>
   </section>
<?php
   } else {
       echo "<p>해당 글을 찾을 수 없습니다.</p>";
   }
}

// 연결 종료
$conn->close();
?>
