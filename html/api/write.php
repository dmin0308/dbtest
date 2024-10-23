<?php
include_once("./config/db.php"); // 상대경로로 가져와야 한다.
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
} else { 
    $wno = isset($_GET['wno']) ? $_GET['wno'] : null;

    if($wno){ // 글수정 
        $sql = "SELECT * FROM delivery_container_inquiries WHERE wno = ".$wno;    
        $result = $conn->query($sql); 
        $row = $result->fetch_assoc(); 
    }
?>

<form action="/api/insertdb.php" method="POST">
  <ul>     
    <li>        
      <input type="hidden" id="wno" name="wno" value="<?php echo isset($wno) ? $wno : ''; ?>">
    </li>

    <!-- 상점 이름: 반드시 자모음이 결합된 한글로 시작 -->
    <li>
      <label for="store_name">상점 이름:</label>
      <input type="text" id="store_name" name="store_name" maxlength="255" 
        placeholder="상점 이름을 입력하세요" 
        value="<?php echo isset($row['store_name']) ? $row['store_name'] : ''; ?>" 
        pattern="^[가-힣]{1}[가-힣0-9\s]*" 
        title="한글로 시작하고, 자모음이 결합된 한글로 이루어진 상점 이름이어야 합니다." 
        required>
      
    </li>

    <!-- 상점 주소 -->
    <li>
      <label for="store_address">상점 주소:</label>
      <input type="text" id="store_address" name="store_address" maxlength="255" 
        placeholder="상점 주소를 입력하세요" 
        value="<?php echo isset($store_address) ? $store_address : ''; ?>" required>
    </li>

    <!-- 소유자 이름: 반드시 한글 이름, 최대 6자 -->
    <li>
      <label for="owner_name">소유자 이름:</label>
      <input type="text" id="owner_name" name="owner_name" maxlength="6" 
        placeholder="소유자 이름을 입력하세요" 
        value="<?php echo isset($owner_name) ? $owner_name : ''; ?>" 
        pattern="^[가-힣]{1,6}$" 
        title="소유자 이름은 반드시 한글이어야 하며, 최대 6자까지 입력 가능합니다." 
        required>
    </li>

    <!-- 연락처 -->
    <li>
      <label for="contact_number">연락처:</label>
      <input type="tel" id="contact_number" name="contact_number" maxlength="20" 
        placeholder="연락처를 입력하세요" 
        value="<?php echo isset($contact_number) ? $contact_number : ''; ?>" required>
    </li>

    <!-- 배달 앱 -->
    <li>
      <label for="delivery_apps">배달 앱:</label>
      <input type="text" id="delivery_apps" name="delivery_apps" maxlength="255" 
        placeholder="사용하는 배달 앱을 입력하세요" 
        value="<?php echo isset($delivery_apps) ? $delivery_apps : ''; ?>">
    </li>

    <!-- 제출 버튼 -->
    <li>
      <button type="submit"><?php echo isset($wno) ? '글 수정하기' : '글쓰기'; ?></button>
    </li>
  </ul>
</form>


<?php
}
// 연결 종료
$conn->close();
?>

<a href="./list.php">목록</a>
