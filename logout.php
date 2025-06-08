<?php
session_start();
session_unset();     // 모든 세션 변수 제거
session_destroy();   // 세션 파기
echo "<script>alert('로그아웃 되었습니다.'); location.href='login_form.php';</script>";
?>
