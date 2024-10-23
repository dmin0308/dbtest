<?php
session_start(); // 세션 시작
include_once("./config/db.php"); // config 파일 포함

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 어드민인지 확인
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    // POST 요청이 있고, 삭제할 ID들이 있는지 확인
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['delete_ids'])) {
        // 선택된 항목의 ID 배열을 쉼표로 구분된 문자열로 변환
        $delete_ids = implode(',', array_map('intval', $_POST['delete_ids'])); // SQL 인젝션 방지를 위해 정수로 변환

        // 선택된 항목 삭제 쿼리 실행
        $sql = "DELETE FROM delivery_container_inquiries WHERE inquiry_id IN ($delete_ids)";
        
        if ($conn->query($sql) === TRUE) {
            $message = "선택된 글이 성공적으로 삭제되었습니다.";
        } else {
            $message = "삭제 중 오류 발생: " . $conn->error;
        }
    } else {
        $message = "삭제할 글을 선택해주세요."; // 삭제할 글 선택 안내 메시지
    }
} else {
    $message = "삭제 권한이 없습니다."; // 어드민이 아닐 경우 메시지 출력
}

// 연결 종료
$conn->close();

// 목록 페이지로 리다이렉션
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삭제 결과</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center; /* 가운데 정렬 */
            padding-top: 100px; /* 상단 여백 */
        }
        .message {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            width: 80%;
            max-width: 500px; /* 최대 폭 */
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* 링크에서 밑줄 제거 */
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="message">
        <p><?php echo $message; ?></p>
        <a href="./list.php" class="button">목록으로 돌아가기</a>
    </div>
</body>
</html>

