<?php
session_start(); // 세션 시작

// 로그인 상태 확인 및 인덱스 페이지로 리다이렉션
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header("Location: list.php"); // 이미 로그인한 경우 인덱스 페이지로 리다이렉션
    exit;
}

// 로그인 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 예시: 실제 환경에서는 DB에서 사용자 정보를 확인해야 합니다.
    if ($username === 'admin' && $password === '0000') { // 간단한 예시
        $_SESSION['is_admin'] = true; // 어드민 권한 설정
        header("Location: list.php"); // 목록 페이지로 리다이렉션
        exit;
    } else {
        $error = "잘못된 사용자 이름이나 비밀번호입니다."; // 로그인 실패 메시지
    }
}
?>

<!-- 로그인 폼 -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <style>
        /* CSS 스타일 */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px; /* 페이지 상단에서 떨어지도록 */
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>로그인</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p> <!-- 오류 메시지 출력 -->
        <?php endif; ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">사용자 이름:</label>
            <input type="text" name="username" required>
            
            <label for="password">비밀번호:</label>
            <input type="password" name="password" required>
            
            <button type="submit">로그인</button>
        </form>
    </div>
</body>
</html>
