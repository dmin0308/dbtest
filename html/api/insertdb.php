<?php

include_once("./config/db.php"); //상대경로로 가져와야한다.
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// POST로 전송된 데이터 확인
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 필수 입력값들 확인
    
        // POST로 전송된 데이터 저장
        $store_name = $_POST['store_name'];
        $store_address = $_POST['store_address'];
        $owner_name = $_POST['owner_name'];
        $contact_number = $_POST['contact_number'];
        $delivery_apps = isset($_POST['delivery_apps']) ? $_POST['delivery_apps'] : '';
     
          // SQL 쿼리 작성 (query 방식)
          $sql = "INSERT INTO delivery_container_inquiries 
          (store_name, store_address, owner_name, contact_number, delivery_apps) 
          VALUES ('$store_name', '$store_address', '$owner_name', '$contact_number', '$delivery_apps')"; // 값에 홀따움표!!! 주의 꼭 해줘야 한다.

    // 쿼리 실행 및 결과 확인
    if ($conn->query($sql) === TRUE) {       
      echo "<script>
                  alert('데이터가 성공적으로 삽입되었습니다.');
                  window.location.href='list.php';
               </script>";
    } else {
        echo "데이터 삽입 실패: " . $conn->error;
    }

    $conn->close();

    } else {
        echo "필수 입력값이 누락되었습니다.";
    }

?>
