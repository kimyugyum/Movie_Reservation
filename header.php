<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!-- 헤더 -->
<!-- 로고 + 유저 메뉴 -->
<div style="background-color: #000; border-bottom: 1px solid rgb(63, 64, 65);">
  <div class="container d-flex justify-content-between align-items-center py-4">
    <a href="index.php" class="d-flex align-items-center text-decoration-none">
      <img src="assets/logo.png" alt="로고" style="height: 65px;">
      <span class="logo-title ms-2">MovieWave</span>
    </a>

    <div class="d-flex align-items-center gap-4">
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php" class="text-white text-decoration-none"><i class="bi bi-box-arrow-right"></i> 로그아웃</a>
        <a href="mypage.php" class="text-white text-decoration-none"><i class="bi bi-person-circle"></i> MY</a>
      <?php else: ?>
        <a href="login_form.php" class="text-white text-decoration-none"><i class="bi bi-lock"></i> 로그인</a>
        <a href="insert.php" class="text-white text-decoration-none"><i class="bi bi-person-plus"></i> 회원가입</a>
      <?php endif; ?>
      <a href="customer.php" class="text-white text-decoration-none"><i class="bi bi-headset"></i> 고객센터</a>
    </div>
  </div>
</div>


<!-- 메뉴 + 검색창 -->
<nav class="navbar navbar-expand-lg navbar-custom mb-4" style="border-bottom: 2px solid #00aaff;">
  <div class="container d-flex justify-content-between align-items-center py-0">
    <ul class="navbar-nav me-auto mb-0">
      <li class="nav-item"><a class="nav-link fs-6 me-2" href="content.php">영화</a></li>
      <li class="nav-item"><a class="nav-link fs-6 me-2" href="theater.php">극장</a></li>
      <li class="nav-item"><a class="nav-link fs-6 me-2" href="reserve.php">예매</a></li>
      <li class="nav-item"><a class="nav-link fs-6 me-2" href="event.php">이벤트</a></li>
    </ul>
    <form class="d-flex align-items-center">
      <input class="form-control form-control-sm bg-dark text-white border-secondary me-2" type="search" placeholder="영화 검색" aria-label="Search">
      <i class="bi bi-search text-white"></i>
    </form>
  </div>
</nav>
