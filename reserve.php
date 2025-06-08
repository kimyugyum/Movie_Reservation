
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}
include 'db.php';
include 'header.php'; 



// 개봉한 전체 영화 목록
$movie_result = $conn->query("SELECT * FROM movies WHERE movie_id BETWEEN 1 AND 5");

// 포스터 경로 배열 (movie_id 기준)
$movie_posters = [
    1 => 'assets/movie1.jpg',
    2 => 'assets/movie2.jpg',
    3 => 'assets/movie3.jpg',
    4 => 'assets/movie4.jpg',
    5 => 'assets/movie5.jpg',
];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>예매 | 물결 속으로, MovieWave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
  <style>
    .reserve-step {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 20px;
      height: 500px;
      overflow-y: auto;
    }
    .reserve-step h5 {
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 15px;
      font-weight: bold;
      color: #0d1a2b;
    }
    .footer-nav {
      background-color: transparent; /* 외부 div에서 배경 처리 */
      color: white;
      padding: 20px 0;
      display: flex;
      justify-content: space-around;
      align-items: center;
      font-size: 18px;
    }
    .footer-nav span {
      color: #aaa;
    }
    .footer-nav .active {
      color: #00aaff;
      font-weight: bold;
    }
    .footer-nav button {
      background-color: #00aaff;
      border: none;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 5px;
      color: #fff;
    }
    .footer-nav button:hover {
      background-color: #007acc;
    }
  </style>
</head>
<body>
  
<section style="background-color:rgb(0, 0, 0);">
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="section-title mb-0">예매</h2>
    </div>
    <hr class="border-info" style="opacity: 1;">


      <div class="row g-4">

        <!-- 영화 선택 (form 바깥에 두기) -->
        <div class="col-md-4">
          <div class="reserve-step">
            <h5>영화</h5>
            <div class="d-grid gap-2">
              <?php while ($row = $movie_result->fetch_assoc()): ?>
                <button type="button"
                        class="btn btn-outline-dark movie-btn w-100 py-2 text-start"
                        data-id="<?= $row['movie_id'] ?>"
                        data-title="<?= htmlspecialchars($row['title']) ?>"
                        data-poster="<?= $movie_posters[$row['movie_id']] ?>">
                  <strong><?= htmlspecialchars($row['title']) ?></strong>
                  <span class="badge bg-secondary float-end"><?= $row['rating'] ?></span>
                </button>
              <?php endwhile; ?>
            </div>
          </div>
        </div>


        <!-- 극장 선택 -->
        <div class="col-md-3">
          <div class="reserve-step">
            <h5>극장</h5>
            <div class="d-grid gap-2">
              <?php
                $theaters = ['상도', '흑석', '대학로', '인천터미널', '인천논현', '경기 안성'];
                foreach ($theaters as $t):
              ?>
                <button type="button"
                        class="btn btn-outline-dark theater-btn w-100 py-2"
                        data-theater="<?= $t ?>">
                  <?= $t ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- 날짜 선택 -->
        <div class="col-md-2">
          <div class="reserve-step">
            <h5>날짜</h5>
            <div class="d-grid gap-2">
              <?php
                $dates = ['2025-06-11', '2025-06-12', '2025-06-13', '2025-06-14'];
                foreach ($dates as $d):
                  $label = date('m/d (D)', strtotime($d));  // 06/10 (Tue) 형식
              ?>
                <button type="button"
                        class="btn btn-outline-dark date-btn w-100 py-2"
                        data-date="<?= $d ?>">
                  <?= $label ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- 시간 선택 -->
        <div class="col-md-3">
          <div class="reserve-step">
            <h5>시간</h5>
            <span class="text-muted" style="font-size: 0.7rem;">☀️ 조조 &nbsp; | 🌙 심야</span>
            <div id="time-buttons" class="d-grid gap-2" style="display: none !important;">
              <button type="button" class="btn btn-outline-dark time-btn" data-time="09:00">☀️ 09:00</button>
              <button type="button" class="btn btn-outline-dark time-btn" data-time="12:20">12:20</button>
              <button type="button" class="btn btn-outline-dark time-btn" data-time="15:40">15:40</button>
              <button type="button" class="btn btn-outline-dark time-btn" data-time="19:00">19:00</button>
              <button type="button" class="btn btn-outline-dark time-btn" data-time="22:20">🌙 22:20</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 통합된 하단 네비게이션 + 요약창 -->
    <div style="background-color: #111; width: 100%;">
      <div class="container-fluid footer-nav mt-5 d-flex flex-wrap align-items-center justify-content-between px-4">
        <div class="d-flex align-items-center">
          <img id="summary-poster" src="" alt="포스터" style="height: 80px; margin-right: 20px; display: none;">
          <h5 id="summary-title" class="mb-0 text-white"></h5>
        </div>
        <div class="d-flex gap-4 align-items-center">
          <span>영화선택</span>
          <span>|</span>
          <span>극장선택</span>
          <span>|</span>
          <span>▶</span>
          <span>좌석선택</span>
          <span>▶</span>
          <span>결제</span>
          <form action="seat.php" method="POST" id="reserveForm">
            <input type="hidden" name="movie_id" id="hidden-movie-id">
            <input type="hidden" name="theater" id="hidden-theater">
            <input type="hidden" name="date" id="hidden-date">
            <input type="hidden" name="time" id="hidden-time">
            <button type="submit" class="btn btn-primary" id="seatSubmitBtn" disabled>좌석선택 →</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</div>

<script>
  const movieButtons = document.querySelectorAll(".movie-btn");
  const theaterButtons = document.querySelectorAll(".theater-btn");
  const dateButtons = document.querySelectorAll(".date-btn");
  const timeButtons = document.querySelectorAll(".time-btn");

  const hiddenMovieInput = document.getElementById("hidden-movie-id");
  const hiddenTheaterInput = document.getElementById("hidden-theater");
  const hiddenDateInput = document.getElementById("hidden-date");
  const hiddenTimeInput = document.getElementById("hidden-time");

  const summaryTitle = document.getElementById("summary-title");
  const summaryPoster = document.getElementById("summary-poster");

  const timeContainer = document.getElementById("time-buttons");

  // 영화 선택
  movieButtons.forEach(button => {
    button.addEventListener("click", function () {
      movieButtons.forEach(btn => btn.classList.remove("btn-primary"));
      movieButtons.forEach(btn => btn.classList.add("btn-outline-dark"));
      this.classList.remove("btn-outline-dark");
      this.classList.add("btn-primary");

      hiddenMovieInput.value = this.dataset.id;

      // 요약창 업데이트
      summaryTitle.textContent = this.dataset.title;
      summaryPoster.src = this.dataset.poster;
      summaryPoster.style.display = "block";
    });
  });

  // 극장 선택
  theaterButtons.forEach(button => {
    button.addEventListener("click", function () {
      theaterButtons.forEach(btn => btn.classList.remove("btn-primary"));
      theaterButtons.forEach(btn => btn.classList.add("btn-outline-dark"));
      this.classList.remove("btn-outline-dark");
      this.classList.add("btn-primary");

      hiddenTheaterInput.value = this.dataset.theater;
    });
  });

  // 날짜 선택
  dateButtons.forEach(button => {
    button.addEventListener("click", function () {
      dateButtons.forEach(btn => btn.classList.remove("btn-primary"));
      dateButtons.forEach(btn => btn.classList.add("btn-outline-dark"));
      this.classList.remove("btn-outline-dark");
      this.classList.add("btn-primary");

      hiddenDateInput.value = this.dataset.date;

      timeContainer.style.display = "block";
    });
  });

  // 시간 선택
  timeButtons.forEach(button => {
    button.addEventListener("click", function () {
      timeButtons.forEach(btn => btn.classList.remove("btn-primary"));
      timeButtons.forEach(btn => btn.classList.add("btn-outline-dark"));
      this.classList.remove("btn-outline-dark");
      this.classList.add("btn-primary");

      hiddenTimeInput.value = this.dataset.time;
    });
  });

  // 좌석 선택 버튼 활성화 조건 검사 함수
function updateSubmitButtonState() {
  const isComplete =
    hiddenMovieInput.value &&
    hiddenTheaterInput.value &&
    hiddenDateInput.value &&
    hiddenTimeInput.value;

  document.getElementById("seatSubmitBtn").disabled = !isComplete;
}

// 선택 이벤트에 검사 함수 연결
[movieButtons, theaterButtons, dateButtons, timeButtons].forEach(buttons => {
  buttons.forEach(button => {
    button.addEventListener("click", updateSubmitButtonState);
  });
});
</script>



</body>
<?php include 'footer.php'; ?>
</html>
