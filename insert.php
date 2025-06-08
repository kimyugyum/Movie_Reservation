<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $pwd = trim($_POST['pwd'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $birth = $_POST['birth'] ?? '';
    $nickname = trim($_POST['nickname'] ?? '');
    $genre = $_POST['genre'] ?? [];
    $genre_str = implode(',', $genre);

    // 아이디, 비번에 한글 포함 시 거부
    if (preg_match('/[가-힣]/u', $id) || preg_match('/[가-힣]/u', $pwd)) {
        echo "<script>alert('아이디 또는 비밀번호에는 한글을 사용할 수 없습니다.'); history.back();</script>";
        exit;
    }

    if ($id && $pwd && $name && $gender && $birth && $nickname) {
        // 아이디 중복 검사
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt_check->bind_param("s", $id);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            echo "<script>alert('이미 사용 중인 아이디입니다.'); history.back();</script>";
            exit;
        }

        // 비밀번호 해시
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

        // 회원가입 INSERT
        $stmt = $conn->prepare("INSERT INTO users (id, pwd, name, gender, birth, nickname, genre)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $id, $hashed_pwd, $name, $gender, $birth, $nickname, $genre_str);

        if ($stmt->execute()) {
            echo "<script>alert('회원가입이 완료되었습니다.'); location.href='login_form.php';</script>";
            exit;
        } else {
            echo "<script>alert('DB 저장 오류: " . $stmt->error . "'); history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('모든 항목을 입력해야 합니다.'); history.back();</script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>회원가입</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets/logo.png" alt="로고"> MOVIEBOOK
    </a>
  </div>
</nav>

<div class="container mt-5" style="max-width: 500px;">
  <h3 class="text-center text-info mb-4">회원가입</h3>

  <form action="insert.php" method="post">
    <!-- 아이디 -->
    <div class="mb-3">
      <label class="form-label">아이디</label>
      <input type="text" name="id" class="form-control bg-dark text-white border-secondary" required
             oninput="validateNoKorean(this, '아이디')">
    </div>

    <!-- 비밀번호 -->
    <div class="mb-3">
      <label class="form-label">비밀번호</label>
      <input type="password" name="pwd" class="form-control bg-dark text-white border-secondary" required
             oninput="validateNoKorean(this, '비밀번호')">
    </div>

    <!-- 이름 -->
    <div class="mb-3">
      <label class="form-label">이름</label>
      <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required>
    </div>

    <!-- 닉네임 (textarea 사용) -->
    <div class="mb-3">
      <label class="form-label">닉네임</label>
      <textarea name="nickname" rows="1" class="form-control bg-dark text-white border-secondary" required></textarea>
    </div>

    <!-- 성별 (radio) -->
    <div class="mb-3">
      <label class="form-label">성별</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="M" required>
        <label class="form-check-label">남성</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="F">
        <label class="form-check-label">여성</label>
      </div>
    </div>

    <!-- 생년월일 (calendar) -->
    <div class="mb-3">
      <label class="form-label">생년월일</label>
      <input type="date" name="birth" class="form-control bg-dark text-white border-secondary" required>
    </div>

    <!-- 관심 장르 (checkbox) -->
    <div class="mb-3">
      <label class="form-label">관심 장르 (복수선택 가능)</label><br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="액션" id="chk1">
        <label class="form-check-label" for="chk1">액션</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="로맨스" id="chk2">
        <label class="form-check-label" for="chk2">로맨스</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="코미디" id="chk3">
        <label class="form-check-label" for="chk3">코미디</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="스릴러" id="chk4">
        <label class="form-check-label" for="chk4">스릴러</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="SF" id="chk5">
        <label class="form-check-label" for="chk5">SF</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="공포" id="chk6">
        <label class="form-check-label" for="chk6">공포</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="드라마" id="chk7">
        <label class="form-check-label" for="chk7">드라마</label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="판타지" id="chk8">
        <label class="form-check-label" for="chk8">판타지</label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="뮤지컬" id="chk9">
        <label class="form-check-label" for="chk9">뮤지컬</label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="genre[]" value="애니메이션" id="chk10">
        <label class="form-check-label" for="chk10">애니</label>
      </div>
    </div>

    <button type="submit" class="btn btn-cgv w-100">가입하기</button>
  </form>
</div>

<script>
function validateNoKorean(input, fieldName) {
  const koreanPattern = /[ㄱ-ㅎㅏ-ㅣ가-힣]/g;
  if (koreanPattern.test(input.value)) {
    alert(fieldName + "에는 한글을 입력할 수 없습니다.");
    input.value = input.value.replace(koreanPattern, '');
    input.focus();
  }
}
</script>

</body>
</html>
