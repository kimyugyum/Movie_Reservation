<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$user_result = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
$user = $user_result->fetch_assoc();

// 수정된 예약 조회 쿼리 (movie_id 포함)
$reserve_query = "
SELECT r.reserve_id, r.movie_id, m.title, r.seat, r.date, r.time, r.theater 
FROM reservations r 
JOIN movies m ON r.movie_id = m.movie_id 
WHERE r.user_id = '$user_id'
ORDER BY r.date DESC
";

$reservations = $conn->query($reserve_query);

// 가장 많이 본 장르 추출 (Subquery 사용)
$favorite_sql = "
SELECT genre
FROM movies
WHERE genre = (
  SELECT m.genre
  FROM reservations r
  JOIN movies m ON r.movie_id = m.movie_id
  WHERE r.user_id = '$user_id' AND m.genre IS NOT NULL
  GROUP BY m.genre
  ORDER BY COUNT(*) DESC
  LIMIT 1
)
LIMIT 1;
";

$favorite_result = $conn->query($favorite_sql);
$favorite_genre = $favorite_result->num_rows > 0 ? $favorite_result->fetch_assoc()['genre'] : null;

// 총 예매 횟수
$total_sql = "SELECT COUNT(*) AS total FROM reservations WHERE user_id = '$user_id'";
$total_result = $conn->query($total_sql);
$total_count = $total_result->fetch_assoc()['total'] ?? 0;

// 가장 자주 간 극장
$theater_sql = "
SELECT theater
FROM reservations
WHERE user_id = '$user_id'
GROUP BY theater
ORDER BY COUNT(*) DESC
LIMIT 1;
";

// 사용자 리뷰 전체 조회
$my_reviews = [];
$review_result = $conn->query("SELECT movie_id, rating, comment FROM reviews WHERE user_id = '$user_id'");
while ($r = $review_result->fetch_assoc()) {
    $my_reviews[$r['movie_id']] = $r;
}

$theater_result = $conn->query($theater_sql);
$favorite_theater = $theater_result->num_rows > 0 ? $theater_result->fetch_assoc()['theater'] : null;
?>


<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>마이페이지 | 물결 속으로, MovieWave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .mypage-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 40px;
    }
    .profile-card {
      background-color: #1a1a1a;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 170, 255, 0.2);
      flex: 1 1 280px;
      min-width: 250px;
    }
    .reserve-list {
      flex: 3 1 600px;
    }
    .reserve-card {
      background-color: #111;
      border: 1px solid #333;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .reserve-card h5 {
      color: #00aaff;
    }
    .reserve-card small {
      color: #ccc;
    }
    .btn-outline-danger, .btn-outline-info {
      padding: 4px 10px;
      font-size: 0.85rem;
    }
    .form-check-input[type="radio"]:hover + .form-check-label {
      color: #ffc107 !important;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-black text-light">

<div class="container mypage-wrapper">
  <!-- 사용자 정보 카드 -->
  <div class="profile-card">
    <h3 class="text-info mb-3"><i class="bi bi-person-circle me-2"></i><?php echo htmlspecialchars($user['name']); ?> 님</h3>
    <p><strong>성별:</strong> <?php echo $user['gender'] === 'male' ? '남성' : '여성'; ?></p>
    <p><strong>생년월일:</strong> <?php echo $user['birth']; ?></p>

    <!-- 📊 총 예매 횟수 -->
    <div class="mt-4 p-3 rounded" style="background-color: #0d0d0d; border-left: 5px solid #00aaff;">
      <p class="mb-1 text-secondary fw-bold">📊 총 예매 횟수</p>
      <h5 class="text-info m-0"><?= $total_count ?>회</h5>
    </div>

    <!-- 🎬 가장 자주 간 극장 -->
    <?php if ($favorite_theater): ?>
    <div class="mt-3 p-3 rounded" style="background-color: #0d0d0d; border-left: 5px solid #00aaff;">
      <p class="mb-1 text-secondary fw-bold">🎬 가장 자주 간 극장</p>
      <h5 class="text-info m-0"><?= htmlspecialchars($favorite_theater) ?></h5>
    </div>
    <?php endif; ?>

    <!-- 🍿 가장 많이 본 장르 -->
    <?php if ($favorite_genre): ?>
    <div class="mt-3 p-3 rounded" style="background-color: #0d0d0d; border-left: 5px solid #00aaff;">
      <p class="mb-1 text-secondary fw-bold">🍿 가장 많이 본 장르</p>
      <h5 class="text-info m-0"><?= htmlspecialchars($favorite_genre) ?></h5>
    </div>
    <?php endif; ?>
  </div>



  <!-- 예매 내역 카드 -->
<div class="reserve-list">
  <h4 class="mb-4 text-info"><i class="bi bi-ticket-perforated me-2"></i>예매 내역</h4>

  <?php if ($reservations->num_rows > 0): ?>
    <?php while ($row = $reservations->fetch_assoc()): ?>
      <?php $review = $my_reviews[$row['movie_id']] ?? null; ?>
      <div class="reserve-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5><?php echo $row['title']; ?></h5>
          <div>
            <a href="update_reservation.php?id=<?php echo $row['reserve_id']; ?>" class="btn btn-outline-info me-2">수정</a>
            <form action="cancel_reservation.php" method="post" class="d-inline" onsubmit="return confirm('정말 취소하시겠습니까?');">
              <input type="hidden" name="reserve_id" value="<?php echo $row['reserve_id']; ?>">
              <button type="submit" class="btn btn-outline-danger" style="margin-top: 2px;">취소</button>
            </form>
          </div>
        </div>
        <p class="mb-1"><strong>좌석:</strong> <?php echo $row['seat']; ?></p>
        <p class="mb-1"><strong>날짜:</strong> <?php echo $row['date']; ?> <strong>시간:</strong> <?php echo $row['time']; ?></p>
        <p class="mb-0"><strong>극장:</strong> <?php echo $row['theater']; ?></p>

        <?php if ($review): ?>
          <!-- 이미 작성된 리뷰 출력 -->
          <div class="mt-3 p-3 border rounded bg-dark text-light">
            <p class="mb-1"><strong>내 리뷰:</strong> <?= str_repeat("⭐", $review['rating']) ?></p>
            <?php if (!empty($review['comment'])): ?>
              <p class="mb-0"><em><?= htmlspecialchars($review['comment']) ?></em></p>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <!-- 리뷰 작성 폼 -->
          <form action="insert_review.php" method="post" class="mt-3">
            <input type="hidden" name="movie_id" value="<?= $row['movie_id'] ?>">

            <div class="mb-2">
              <label class="form-label text-light d-block">별점:</label>
              <div class="d-flex gap-2">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" id="rating<?= $i ?>_<?= $row['reserve_id'] ?>" value="<?= $i ?>" required>
                    <label class="form-check-label text-warning" for="rating<?= $i ?>_<?= $row['reserve_id'] ?>">
                      <?= str_repeat("⭐", $i) ?>
                    </label>
                  </div>
                <?php endfor; ?>
              </div>
            </div>

            <div class="mb-2">
              <label class="form-label text-light">한줄평 (선택):</label>
              <textarea name="comment" rows="2" class="form-control bg-dark text-white border-secondary" placeholder="코멘트 작성..."></textarea>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-sm btn-info text-white">리뷰 등록</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-light">예매 내역이 없습니다.</p>
  <?php endif; ?>
</div>


<?php include 'footer.php'; ?>
</body>
</html>
