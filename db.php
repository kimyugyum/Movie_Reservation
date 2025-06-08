<?php
$host = 'localhost';
$user = 'root';          // 본인의 DB 사용자명
$password = '8951';  // 본인의 DB 비밀번호
$dbname = 'movie_ticket';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}
?>
