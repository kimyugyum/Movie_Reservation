<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>로그인</title>
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- 외부 스타일시트 -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- 헤더 -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets\logo.png" alt="로고"> MOVIEBOOK
    </a>
  </div>
</nav>

<!-- 로그인 폼 -->
<div class="container mt-5" style="max-width: 400px;">
  <h3 class="text-center text-info mb-4">로그인</h3>

  <form action="login.php" method="post">
    <div class="mb-3">
      <label for="user_id" class="form-label">아이디</label>
      <input type="text" class="form-control bg-dark text-white border-secondary" id="user_id" name="user_id" required>
    </div>

    <div class="mb-3">
      <label for="user_pw" class="form-label">비밀번호</label>
      <input type="password" class="form-control bg-dark text-white border-secondary" id="user_pw" name="user_pw" required>
    </div>

    <button type="submit" class="btn btn-cgv w-100">로그인</button>
  </form>

  <div class="text-center mt-3">
    <a href="insert.php" class="text-info">회원가입</a>
  </div>
</div>

</body>
</html>
