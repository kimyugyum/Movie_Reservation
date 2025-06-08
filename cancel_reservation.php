<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$reserve_id = $_POST['reserve_id'] ?? '';

// reserve_id 유효성 검사
if (!$reserve_id) {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

// 본인의 예매인지 확인
$stmt = $conn->prepare("SELECT movie_id FROM reservations WHERE reserve_id = ? AND user_id = ?");
$stmt->bind_param("is", $reserve_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('예매 정보를 찾을 수 없습니다.'); history.back();</script>";
    exit;
}

$movie_id = $result->fetch_assoc()['movie_id'];

// 리뷰 삭제
$stmt = $conn->prepare("DELETE FROM reviews WHERE user_id = ? AND movie_id = ?");
$stmt->bind_param("si", $user_id, $movie_id);
$stmt->execute();

// 예매 삭제
$stmt = $conn->prepare("DELETE FROM reservations WHERE reserve_id = ? AND user_id = ?");
$stmt->bind_param("is", $reserve_id, $user_id);
$stmt->execute();

echo "<script>alert('예매가 취소되었습니다.'); location.href='mypage.php';</script>";
?>
