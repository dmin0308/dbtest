<?php
session_start(); // 세션 시작

// 어드민 인증 확인
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php"); // 어드민이 아닐 경우 로그인 페이지로 리다이렉션
    exit;
}

include_once("./config/db.php"); // config 파일 포함

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
} 

// 데이터 조회 쿼리 실행
$sql = "SELECT * FROM delivery_container_inquiries";
$result = $conn->query($sql); // 쿼리 실행

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트 페이지</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        a{
            text-decoration:none;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .delete-button {
            background-color: #f44336;
        }
        .delete-button:hover {
            background-color: #e53935;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="delete.php" method="POST"> <!-- 선택된 항목을 삭제하는 폼 -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>전체 글 : <?php echo $result->num_rows; ?>개</h2>
                <div>
                    <a href="./write.php" class="button">글쓰기</a>
                    <button type="submit" class="button delete-button">글삭제</button>
                </div>
            </div>
            <ul>
    <?php
    // 쿼리 결과를 반복하며 각 행을 <li> 요소로 출력
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            ?>
            <li>
                <input type="checkbox" name="delete_ids[]" value="<?php echo $row["inquiry_id"]; ?>" style="margin-right: 10px;"> <!-- 삭제할 항목 선택용 체크박스 -->
                <a href='./view.php?wno=<?php echo $row["inquiry_id"]; ?>' style="font-size: 18px; font-weight: bold; text-decoration: none; color: #333;">
                    가게 이름: <?php echo $row["store_name"]; ?>
                </a>
                <p>주소: <?php echo $row["store_address"]; ?></p>
                <p>소유자 이름: <?php echo $row["owner_name"]; ?></p>
                <p>연락처: <?php echo $row["contact_number"]; ?></p>
                <p>배달 앱: <?php echo $row["delivery_apps"]; ?></p>
            </li>
            <?php
        }
    } else {
        echo "<li>데이터가 없습니다.</li>"; // 데이터가 없는 경우 메시지 출력
    }
    ?>
            </ul>
        </form>
    </div>
</body>
</html>
