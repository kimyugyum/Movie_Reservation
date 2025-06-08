<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
  exit;
}
include 'db.php';
include 'header.php';

$movie_id = $_POST['movie_id'] ?? '';
$theater = $_POST['theater'] ?? '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';

if (!$movie_id || !$theater || !$date || !$time) {
  echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
  exit;
}

$movie_posters = [
  1 => 'assets/movie1.jpg',
  2 => 'assets/movie2.jpg',
  3 => 'assets/movie3.jpg',
  4 => 'assets/movie4.jpg',
  5 => 'assets/movie5.jpg',
];
$poster_path = $movie_posters[$movie_id] ?? 'assets/default.jpg';


$movie = $conn->query("SELECT * FROM movies WHERE movie_id = $movie_id")->fetch_assoc();

// 예약된 좌석 불러오기
$occupied_query = "
  SELECT seat FROM reservations 
  WHERE movie_id = $movie_id 
    AND theater = '$theater' 
    AND date = '$date' 
    AND time = '$time'
";
$occupied_result = $conn->query($occupied_query);

$occupied_seats = [];
while ($row = $occupied_result->fetch_assoc()) {
    $occupied_seats[] = $row['seat'];
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>좌석 선택 | MovieWave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .seat {
      width: 36px;
      height: 36px;
      margin: 4px;
      background-color: #444;
      color: white;
      text-align: center;
      line-height: 36px;
      border-radius: 4px;
      cursor: pointer;
    }
    .seat.selected {
      background-color: #00aaff;
    }
    .seat.occupied {
      background-color: #999;
      cursor: not-allowed;
    }
    .seat-row {
      display: flex;
      justify-content: center;
      margin-bottom: 5px;
    }
    .summary-box {
      background-color: #111;
      padding: 20px;
      border-radius: 10px;
      min-height: 550px; /* ✅ 좌석 선택 박스와 높이 비슷하게 */
    }
    .seat-label {
      font-size: 0.8rem;
      color: #ccc;
      margin-right: 8px;
      width: 20px;
      text-align: right;
    }

    .counter-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    background-color: ##f8f9fa;
    padding: 1px;
    border-radius: 10px;
    gap: 10px;
  }

  .counter-block {
    flex: 1; /* 모든 박스 동일 너비 */
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    padding: 6px 10px;
    border-radius: 8px;
  }

  .counter-label {
    font-weight: bold;
    font-size: 0.9rem;
    color: #000;
    margin-right: 6px;
  }

  .counter-controls {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .counter-controls button {
    width: 26px;
    height: 26px;
    border: none;
    background-color: #00aaff;
    color: #fff;
    font-weight: bold;
    font-size: 16px;
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0;
    line-height: 1;
  }

  .counter-controls input {
    width: 28px;
    height: 26px;
    text-align: center;
    font-weight: bold;
    font-size: 1rem;
    border: none;
    background: transparent;
    pointer-events: none;
    color: #000;
  }
</style>

</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <div class="row">
    <!-- 좌석 선택 -->
    <div class="col-md-8">
      <h2 class="section-title mb-4">인원 선택</h2>
      <div class="counter-container">

        <!-- 성인 -->
        <div class="counter-block">
          <span class="counter-label">성인</span>
          <div class="counter-controls">
            <button type="button" class="minus-btn" data-target="adult">-</button>
            <input type="text" id="adult" value="1" readonly>
            <button type="button" class="plus-btn" data-target="adult">+</button>
          </div>
        </div>

        <!-- 청소년 -->
        <div class="counter-block">
          <span class="counter-label">청소년</span>
          <div class="counter-controls">
            <button type="button" class="minus-btn" data-target="teen">-</button>
            <input type="text" id="teen" value="0" readonly>
            <button type="button" class="plus-btn" data-target="teen">+</button>
          </div>
        </div>

        <!-- 우대 -->
        <div class="counter-block">
          <span class="counter-label">우대</span>
          <div class="counter-controls">
            <button type="button" class="minus-btn" data-target="special">-</button>
            <input type="text" id="special" value="0" readonly>
            <button type="button" class="plus-btn" data-target="special">+</button>
          </div>
        </div>

      </div>
      <hr class="section-divider">
      <h2 class="section-title mt-2 mb-4">좌석 선택</h2>
      <div class="bg-black p-4 rounded" style="margin-bottom: 120px;">
        <div class="text-center text-secondary mb-2">SCREEN</div>

        <div id="seats">
        <?php
        $rows = ['A', 'B', 'C', 'D', 'E'];

        foreach ($rows as $r) {
          echo "<div class='d-flex justify-content-center align-items-center mb-2'>";

          // 왼쪽 분단 (2좌석)
          echo "<div class='d-flex me-4'>";
          for ($i = 1; $i <= 2; $i++) {
            $seat = $r . $i;
            echo "<div class='seat' data-seat='$seat'>$i</div>";
          }
          echo "</div>";

          // 가운데 분단 (4좌석)
          echo "<div class='d-flex me-4'>";
          for ($i = 3; $i <= 6; $i++) {
            $seat = $r . $i;
            echo "<div class='seat' data-seat='$seat'>$i</div>";
          }
          echo "</div>";

          // 오른쪽 분단 (2좌석)
          echo "<div class='d-flex'>";
          for ($i = 7; $i <= 8; $i++) {
            $seat = $r . $i;
            echo "<div class='seat' data-seat='$seat'>$i</div>";
          }
          echo "</div>";

          echo "</div>";
        }
        ?>
      </div>

      </div>
    </div>

    <!-- 요약 -->
    <div class="col-md-4">
      <div class="summary-box">
        <!-- 영화 정보 + 포스터 -->
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div class="pe-2">
            <h5 class="text-info mb-2">예매 정보</h5>
            <div class="fw-bold fs-5"><?= htmlspecialchars($movie['title']) ?></div>
            <div style="font-size: 0.95rem; color: #fff;">
              <?= htmlspecialchars($theater) ?>
            </div>
            <div style="font-size: 0.95rem; color: #fff;">
              <?= htmlspecialchars($date) ?> <?= htmlspecialchars($time) ?>
            </div>
          </div>
          <img src="<?= $poster_path ?>" alt="포스터" style="width: 100px; height: auto; border-radius: 4px;">
        </div>


        <hr class="text-secondary">
        <p>선택 좌석: <span id="selectedSeats" class="text-warning">없음</span></p>
        <p>총 인원: <span id="totalCount">1</span>명</p>
        <p>예상 금액: <span id="totalPrice">12000</span>원</p>

        <form action="reserve_insert.php" method="POST">
          <input type="hidden" name="movie_id" value="<?= $movie_id ?>">
          <input type="hidden" name="theater" value="<?= $theater ?>">
          <input type="hidden" name="date" value="<?= $date ?>">
          <input type="hidden" name="time" value="<?= $time ?>">
          <input type="hidden" name="seats" id="seatInput">
          <input type="hidden" name="count" id="countInput">
          <button type="submit" class="btn btn-primary w-100 mt-3" disabled id="submitBtn">예매하기</button>
        </form>

        <!-- 예매 혜택 -->
        <div class="mt-4 p-3 bg-secondary text-white rounded small">
          🎁 <strong>예매 혜택</strong><br>
          - 온라인 예매 시 <strong>포인트 5%</strong> 적립<br>
          - 현장 예매 고객 대상 <strong>한정 굿즈 증정!</strong><br>
          - 관람 후 <strong>리뷰 작성 시</strong> 추첨 혜택 제공!
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const occupiedSeats = <?= json_encode($occupied_seats); ?>;
  const seats = document.querySelectorAll(".seat");
  const selectedSeatsSpan = document.getElementById("selectedSeats");
  const seatInput = document.getElementById("seatInput");
  const submitBtn = document.getElementById("submitBtn");
  const totalCountSpan = document.getElementById("totalCount");
  const totalPriceSpan = document.getElementById("totalPrice");
  const countInput = document.getElementById("countInput");

  let selected = [];
  
  document.querySelectorAll(".minus-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      const targetId = this.dataset.target;
      const input = document.getElementById(targetId);
      let val = parseInt(input.value);
      if (val > 0) input.value = val - 1;
      updateSummary();
    });
  });

  document.querySelectorAll(".plus-btn").forEach(btn => {
    btn.addEventListener("click", function () {
      const targetId = this.dataset.target;
      const input = document.getElementById(targetId);
      let val = parseInt(input.value);
      if (val < 6) input.value = val + 1;
      updateSummary();
    });
  });

  function updateSummary() {
    const adult = parseInt(document.getElementById("adult").value);
    const teen = parseInt(document.getElementById("teen").value);
    const special = parseInt(document.getElementById("special").value);

    const total = adult + teen + special;

    // 단가 설정
    const adultPrice = 12000;
    const teenPrice = 7000;
    const specialPrice = 6000;

    const totalPrice = (adult * adultPrice) + (teen * teenPrice) + (special * specialPrice);

    // UI 반영
    document.getElementById("totalCount").textContent = total;
    document.getElementById("totalPrice").textContent = totalPrice.toLocaleString(); // 쉼표 포함
    document.getElementById("countInput").value = total;

    enforceSeatLimit(total);
  }


function enforceSeatLimit(limit) {
  // 선택된 좌석 수가 초과되었는지 검사
  if (selected.length > limit) {
    const lastSelected = selected.pop(); // 가장 마지막 클릭된 것 제거
    const lastSeatEl = document.querySelector(`.seat[data-seat='${lastSelected}']`);
    if (lastSeatEl) lastSeatEl.classList.remove("selected");

    alert("선택한 인원 수보다 많은 좌석을 선택할 수 없습니다.");
  }

  // UI 업데이트
  selectedSeatsSpan.textContent = selected.length ? selected.join(", ") : "없음";
  seatInput.value = selected.join(",");
  totalCountSpan.textContent = selected.length;
  countInput.value = selected.length;
  submitBtn.disabled = selected.length === 0;
}

seats.forEach(seat => {
  seat.addEventListener("click", () => {
    if (seat.classList.contains("occupied")) return;

    const seatId = seat.dataset.seat;
    if (selected.includes(seatId)) {
      seat.classList.remove("selected");
      selected = selected.filter(s => s !== seatId);
    } else {
      seat.classList.add("selected");
      selected.push(seatId);
    }

    // 인원 수 제한 검사
    const totalPeople =
      parseInt(document.getElementById("adult").value) +
      parseInt(document.getElementById("teen").value) +
      parseInt(document.getElementById("special").value);

    enforceSeatLimit(totalPeople);
  });
});

// 예약된 좌석을 occupied로 표시
seats.forEach(seat => {
  const seatId = seat.dataset.seat;
  if (occupiedSeats.includes(seatId)) {
    seat.classList.add("occupied");
  }
});
  
</script>
</body>
<?php include 'footer.php'; ?>
</html>
