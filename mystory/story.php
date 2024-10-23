<?php
// MySQL 데이터베이스 접속 설정
$servername = "localhost"; // 또는 서버 IP 주소
$username = "sonja4485"; // MySQL 사용자 이름
$password = "rudckftj!12zhf"; // MySQL 비밀번호
$dbname = "sonja4485"; // 사용할 데이터베이스 이름

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
} else {
    echo "맞았다!!";
}

// 여기에서 SQL 쿼리를 실행하거나 작업을 수행할 수 있습니다.

// 연결 종료
$conn->close();
?>
