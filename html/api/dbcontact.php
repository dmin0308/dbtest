<?php

include_once ('./config/db.php'); //상대경로로 가져와야함


// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM delivery_container_inquiries";
    $result = $conn->query($sql); //sql실행 array
}
    if ($result->num_rows > 0) {
        // 각 행의 데이터를 출력
        echo "전체 글 : ".$result->num_rows."개";
    } else {
    echo "데이터가 없습니다.";
}

// 연결 종료
$conn->close();
?>
