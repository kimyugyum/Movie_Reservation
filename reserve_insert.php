<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}

include 'db.php';

// POST 데이터 가져오기
$user_id  = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'] ?? '';
$theater  = $_POST['theater'] ?? '';
$date     = $_POST['date'] ?? '';
$time     = $_POST['time'] ?? '';
$seatStr  = $_POST['seats'] ?? '';
$seats    = explode(',', $seatStr);

// 예외 처리: 데이터가 모두 있는지 확인
if (!$movie_id || !$theater || !$date || !$time || empty($seats)) {
    echo "<script>alert('예매 정보가 누락되었습니다.'); history.back();</script>";
    exit;
}

// 좌석마다 insert 실행
$success = true;
foreach ($seats as $seat) {
    $seat = trim($seat); // 공백 제거
    if ($seat === '') continue;

    $stmt = $conn->prepare("INSERT INTO reservations (user_id, movie_id, theater, date, time, seat) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $user_id, $movie_id, $theater, $date, $time, $seat);

    if (!$stmt->execute()) {
        $success = false;
        break;
    }
}

if ($success) {
    echo "<script>alert('예매가 완료되었습니다.'); location.href='mypage.php';</script>";
} else {
    echo "<script>alert('예매에 실패했습니다.'); history.back();</script>";
}
?>
