<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'] ?? null;
$rating = $_POST['rating'] ?? null;
$comment = trim($_POST['comment'] ?? '');

// 필수 항목 확인
if (!$movie_id || !$rating) {
    echo "<script>alert('별점은 필수 입력 항목입니다.'); history.back();</script>";
    exit;
}

// 🔐 예매한 영화인지 확인
$res_stmt = $conn->prepare("SELECT * FROM reservations WHERE user_id = ? AND movie_id = ?");
$res_stmt->bind_param("si", $user_id, $movie_id);
$res_stmt->execute();
$res_result = $res_stmt->get_result();

if ($res_result->num_rows === 0) {
    echo "<script>alert('예매하지 않은 영화에는 리뷰를 작성할 수 없습니다.'); history.back();</script>";
    exit;
}

// 중복 리뷰 방지
$check_stmt = $conn->prepare("SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?");
$check_stmt->bind_param("si", $user_id, $movie_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo "<script>alert('이미 이 영화에 대한 리뷰를 작성하셨습니다.'); history.back();</script>";
    exit;
}

// 리뷰 등록
$insert_stmt = $conn->prepare("INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (?, ?, ?, ?)");
$insert_stmt->bind_param("siis", $user_id, $movie_id, $rating, $comment);

if ($insert_stmt->execute()) {
    echo "<script>alert('리뷰가 등록되었습니다.'); history.back();</script>";
} else {
    echo "<script>alert('리뷰 등록에 실패했습니다.'); history.back();</script>";
}
?>
