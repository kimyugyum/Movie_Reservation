<?php
session_start();
include 'db.php';

$id = trim($_POST['user_id'] ?? '');
$pwd = trim($_POST['user_pw'] ?? '');

// 사용자 정보 조회
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    // 1. 비밀번호가 해시된 경우 (정상 로그인)
    if (password_verify($pwd, $user['pwd'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        echo "<script>alert('로그인 성공!'); location.href='index.php';</script>";
        exit;
    }

    // 2. 비밀번호가 평문인 경우 (기존 사용자) → 로그인 허용 & 자동 업그레이드
    if ($pwd === $user['pwd']) {
        // 평문 비번을 해시로 변환 후 DB에 저장
        $new_hash = password_hash($pwd, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET pwd = ? WHERE id = ?");
        $update_stmt->bind_param("ss", $new_hash, $user['id']);
        $update_stmt->execute();

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        echo "<script>alert('로그인 성공!'); location.href='index.php';</script>";
        exit;
    }
}

echo "<script>alert('아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
$conn->close();
?>
