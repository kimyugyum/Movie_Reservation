<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}

include 'db.php';       
include 'header.php';   

$user_id = $_SESSION['user_id'];
$user_result = $conn->query("SELECT name FROM users WHERE id='$user_id'");
$user = $user_result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="UTF-8">
    <title>물결 속으로, MovieWave</title>
    <link rel="icon" href="assets/favicon.png">
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Style -->
    <link rel="stylesheet" href="style.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
  </head>
<body>

<!-- 무비차트 섹션 시작 -->
<div class="container mt-5">
  <h3 class="text-white mb-3">🎬 무비차트</h3>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
      
    <!-- 카드 1 -->
    <div class="col">
      <div class="card movie-card bg-dark text-white h-100 border-0 overflow-hidden">
        <div class="ratio ratio-2x3">
          <img src="assets/movie1.jpg" class="card-img-top object-fit-cover" alt="쇼생크 탈출">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-bold mb-1">쇼생크 탈출</h5>
            <p class="card-text mb-2 text-info">🎯 99% &nbsp;&nbsp; 🎟️ 예매율 29.5%</p>
          </div>
          <a href="reserve.php?movie_id=1" class="btn btn-outline-info btn-sm mt-auto">예매하기</a>
        </div>
      </div>
    </div>

    <!-- 카드 2 -->
    <div class="col">
      <div class="card movie-card bg-dark text-white h-100 border-0 overflow-hidden">
        <div class="ratio ratio-2x3">
          <img src="assets/movie2.jpg" class="card-img-top object-fit-cover" alt="다크나이트">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-bold mb-1">다크 나이트</h5>
            <p class="card-text mb-2 text-info">🎯 98% &nbsp;&nbsp; 🎟️ 예매율 15.7%</p>
          </div>
          <a href="reserve.php?movie_id=1" class="btn btn-outline-info btn-sm mt-auto">예매하기</a>
        </div>
      </div>
    </div>

    <!-- 카드 3 -->
    <div class="col">
      <div class="card movie-card bg-dark text-white h-100 border-0 overflow-hidden">
        <div class="ratio ratio-2x3">
          <img src="assets/movie3.jpg" class="card-img-top object-fit-cover" alt="포레스트 검프">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-bold mb-1">포레스트 검프</h5>
            <p class="card-text mb-2 text-info">🎯 98% &nbsp;&nbsp; 🎟️ 예매율 14.4%</p>
          </div>
          <a href="reserve.php?movie_id=1" class="btn btn-outline-info btn-sm mt-auto">예매하기</a>
        </div>
      </div>
    </div>

    <!-- 카드 4 -->
    <div class="col">
      <div class="card movie-card bg-dark text-white h-100 border-0 overflow-hidden">
        <div class="ratio ratio-2x3">
          <img src="assets/movie4.jpg" class="card-img-top object-fit-cover" alt="인터스텔라">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-bold mb-1">인터스텔라</h5>
            <p class="card-text mb-2 text-info">🎯 96% &nbsp;&nbsp; 🎟️ 예매율 9.3%</p>
          </div>
          <a href="reserve.php?movie_id=1" class="btn btn-outline-info btn-sm mt-auto">예매하기</a>
        </div>
      </div>
    </div>

    <!-- 카드 5 -->
    <div class="col">
      <div class="card movie-card bg-dark text-white h-100 border-0 overflow-hidden">
        <div class="ratio ratio-2x3">
          <img src="assets/movie5.jpg" class="card-img-top object-fit-cover" alt="센과 치히로의 행방불명">
        </div>
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <h5 class="card-title fw-bold mb-1">센과 치히로의 행방불명</h5>
            <p class="card-text mb-2 text-info">🎯 95% &nbsp;&nbsp; 🎟️ 예매율 5.6%</p>
          </div>
          <a href="reserve.php?movie_id=1" class="btn btn-outline-info btn-sm mt-auto">예매하기</a>
        </div>
      </div>
    </div> 
  </div>
</div>
<!-- 무비차트 섹션 끝 -->

<!-- EVENT 섹션 시작 -->
<section class="event-section py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="section-title mb-0">EVENT</h2>
    </div>

    <!-- 슬라이드 전체 감싸는 컨테이너 -->
    <div class="event-wrapper position-relative">

      <!-- 왼쪽 화살표 -->
      <button class="btn-slide-left" onclick="scrollEvent('left')">
        <span class="arrow">&lt;</span>
      </button>

      <!-- 카드 슬라이드 영역 -->
      <div class="event-scroll d-flex overflow-auto gap-3 pb-2" id="eventScroll">

        <!-- 카드 1 -->
        <div class="card bg-dark text-white flex-shrink-0 event-card" style="width: 260px;">
          <img src="assets/event1.png" class="card-img-top event-img" alt="쇼생크 포스터">
          <div class="card-body text-start">
            <p class="mb-1 text-muted">&lt;쇼생크 탈출&gt;</p>
            <h6 class="event-title">[쇼생크 탈출] SX 포스터</h6>
            <p class="event-date">2025.05.30 ~ 2025.06.30</p>
          </div>
        </div>

        <!-- 카드 2 -->
        <div class="card bg-dark text-white flex-shrink-0 event-card" style="width: 260px;">
          <img src="assets/event2.png" class="card-img-top event-img" alt="IMAX 포스터">
          <div class="card-body text-start">
            <p class="mb-1 text-muted">&lt;다크 나이트&gt;</p>
            <h6 class="event-title">[다크 나이트] 3D 포스터</h6>
            <p class="event-date">2025.05.20 ~ 2025.06.20</p>
          </div>
        </div>

        <!-- 카드 3 -->
        <div class="card bg-dark text-white flex-shrink-0 event-card" style="width: 260px;">
          <img src="assets/event3.png" class="card-img-top event-img" alt="센과 치히로 포스터">
          <div class="card-body text-start">
            <p class="mb-1 text-muted">&lt;센과 치히로&gt;</p>
            <h6 class="event-title">[센과 치히로의 행방불명] SCREENX 와이드</h6>
            <p class="event-date">2025.05.20 ~ 2025.06.20</p>
          </div>
        </div>

        <!-- 카드 4 -->
        <div class="card bg-dark text-white flex-shrink-0 event-card" style="width: 260px;">
          <img src="assets/event4.png" class="card-img-top event-img" alt="인터스텔라 포스터">
          <div class="card-body text-start">
            <p class="mb-1 text-muted">&lt;인터스텔라&gt;</p>
            <h6 class="event-title">[인터스텔라 : LIMITED] MOMENT LABEL</h6>
            <p class="event-date">2025.05.30 ~ 2025.06.30</p>
          </div>
        </div>

      </div>

      <!-- 오른쪽 화살표 -->
      <button class="btn-slide-right" onclick="scrollEvent('right')">
        <span class="arrow">&gt;</span>
      </button>

    </div>
  </div>
</section>
<!-- EVENT 섹션 끝 -->

<!-- 특별관 섹션 시작 -->
<section class="special-zone py-5" style="background-color: #1a1a1a;">
  <div class="container">
    <h2 class="section-title mb-4">특별관</h2>
    
    <div class="row g-4 align-items-start">

      <!-- 왼쪽 이미지 -->
      <div class="col-md-6">
        <div id="specialCard" class="card text-white border-0 shadow w-100 position-relative overflow-hidden">
          <img id="specialImage" src="assets/hall1.png"
               style="width: 100%; object-fit: cover;" alt="특별관 이미지">
          <div class="position-absolute bottom-0 start-0 p-4 w-100"
               style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
            <h4 id="specialTitle" class="fw-bold mb-1">COMFORTABLE CINEMA</h4>
            <p id="specialTag" class="text-info mb-0">#편안함의 극치, 프리미엄관</p>
          </div>
        </div>
      </div>

      <!-- 오른쪽 버튼 리스트 -->
      <div class="col-md-6" id="buttonCol">
        <div class="d-grid gap-3">
          <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center py-3" onclick="changeSpecial('COMFORTABLE')">
            <span class="fw-bold">COMFORTABLE CINEMA</span>
            <span class="badge bg-light text-dark">#편안함의 극치, 프리미엄관</span>
          </button>
          <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center py-3" onclick="changeSpecial('PRIMIUM')">
            <span class="fw-bold">PRIMIUM & SOUND</span>
            <span class="badge bg-light text-dark">#실감나는_소리의</span>
          </button>
          <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center py-3" onclick="changeSpecial('3D')">
            <span class="fw-bold">3D관</span>
            <span class="badge bg-light text-dark">#입체감 #색다른_체험</span>
          </button>
          <button class="btn btn-outline-light text-start d-flex justify-content-between align-items-center py-3" onclick="changeSpecial('LUXURY')">
            <span class="fw-bold">LUXURY CINEMA</span>
            <span class="badge bg-light text-dark">#고급진 #프라이빗한</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- 특별관 섹션 끝 -->

<!-- 판매 섹션 시작 -->
<section class="py-5" style="background-color: #1a1a1a;">
  <div class="container">
    <div class="row g-4">

      <!-- 🎟️ 영화관람권 -->
      <div class="col-md-4">
        <div class="bg-dark text-white p-4 rounded shadow-sm h-100">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold">🎟️ 영화관람권</h4>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/ticket1.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="CGV">
            <div>
              <div>CGV 영화관람권</div>
              <div class="fw-bold text-info">13,000원</div>
            </div>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/ticket2.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="IMAX">
            <div>
              <div>IMAX 영화관람권</div>
              <div class="fw-bold text-info">18,000원</div>
            </div>
          </div>

          <div class="d-flex align-items-center">
            <img src="assets/ticket3.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="4DX">
            <div>
              <div>4DX 영화관람권</div>
              <div class="fw-bold text-info">19,000원</div>
            </div>
          </div>
        </div>
      </div>

      <!-- 🎁 기프트카드 -->
      <div class="col-md-4">
        <div class="bg-dark text-white p-4 rounded shadow-sm h-100">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold">🎁 기프트카드</h4>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/gift1.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="A형">
            <div>
              <div>PAYWAVE A형</div>
              <div class="fw-bold text-info">금액충전형</div>
            </div>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/gift2.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="B형">
            <div>
              <div>PAYWAVEE B형</div>
              <div class="fw-bold text-info">금액충전형</div>
            </div>
          </div>

          <div class="d-flex align-items-center">
            <img src="assets/gift3.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="C형">
            <div>
              <div>PAYWAVE C형</div>
              <div class="fw-bold text-info">금액충전형</div>
            </div>
          </div>
        </div>
      </div>

      <!-- 🍿 팝콘 -->
      <div class="col-md-4">
        <div class="bg-dark text-white p-4 rounded shadow-sm h-100">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold">🍿 팝콘</h4>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/popcorn1.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="팝콘 M">
            <div>
              <div>오리지널 팝콘 M</div>
              <div class="fw-bold text-info">4,000원</div>
            </div>
          </div>

          <div class="d-flex align-items-center mb-3">
            <img src="assets/popcorn2.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="팝콘 L">
            <div>
              <div>오리지널 팝콘 L</div>
              <div class="fw-bold text-info">5,000원</div>
            </div>
          </div>

          <div class="d-flex align-items-center">
            <img src="assets/popcorn3.png" class="me-3" style="width: 70px; border-radius: 6px;" alt="카라멜">
            <div>
              <div>카라멜 팝콘 M</div>
              <div class="fw-bold text-info">4,500원</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- 판매 섹션 끝 -->

<!-- 내부 자바 스크립트 -->
<script>
  const scrollContainer = document.getElementById('eventScroll');
  const cardWidth = 260 + 24; // 카드 너비 + gap
  let autoScrollInterval;

  function scrollEvent(direction) {
    const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

    if (direction === 'left') {
      scrollContainer.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    } else {
      const remaining = maxScrollLeft - scrollContainer.scrollLeft;
      const scrollAmount = Math.min(cardWidth, remaining);
      scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
  }

  function startAutoScroll() {
    autoScrollInterval = setInterval(() => {
      const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

      // 맨 끝이면 맨 앞으로 이동
      if (Math.ceil(scrollContainer.scrollLeft) >= maxScrollLeft) {
        scrollContainer.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        scrollContainer.scrollBy({ left: cardWidth, behavior: 'smooth' });
      }
    }, 4000); // 4초 간격
  }

  function stopAutoScroll() {
    clearInterval(autoScrollInterval);
  }

  // 시작
  startAutoScroll();

  // 마우스 올렸을 때 자동 스크롤 멈추기 (선택사항)
  scrollContainer.addEventListener('mouseenter', stopAutoScroll);
  scrollContainer.addEventListener('mouseleave', startAutoScroll);

    const specialData = {
    COMFORTABLE: {
      title: 'COMFORTABLE CINEMA',
      image: 'assets/hall1.png',
      tag: '#편안함의 극치, 프리미엄관'
    },
    PRIMIUM: {
      title: 'PRIMIUM & SOUND',
      image: 'assets/hall2.png',
      tag: '#실감나는_소리의'
    },
    '3D': {
      title: '3D관',
      image: 'assets/hall3.png',
      tag: '#입체감 #색다른_체험'
    },
    LUXURY: {
      title: 'LUXURY CINEMA',
      image: 'assets/hall4.png',
      tag: '#고급진 #프라이빗한'
    }
  };

  function changeSpecial(key) {
    const data = specialData[key];
    document.getElementById('specialImage').src = data.image;
    document.getElementById('specialImage').alt = data.title;
    document.getElementById('specialTitle').textContent = data.title;
    document.getElementById('specialTag').textContent = data.tag;
  }

  function matchHeights() {
    const right = document.getElementById("buttonCol");
    const card = document.getElementById("specialCard");
    const img = document.getElementById("specialImage");

    if (right && card && img) {
      const rightHeight = right.offsetHeight;
      card.style.height = rightHeight + "px";
      img.style.height = rightHeight + "px";
    }
  }

  // 실행 시점 중요!
  window.addEventListener("load", matchHeights);
  window.addEventListener("resize", matchHeights);
  
</script>







<?php include 'footer.php'; ?>
</body>
</html>
