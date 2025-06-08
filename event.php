<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>이벤트 | 물결 속으로, MovieWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
    <style>
        .event-imgs {
            height: 250px; /* 원하는 만큼 늘리세요: 180~220px 추천 */
            object-fit: cover;
            object-position: top;
            display: block;
            width: 100%;
            }
    </style>
</head>
<body>
<!-- EVENT 섹션-->
<section class="event-section py-5">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="section-title mb-0">웨이브 PICK</h2>
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

<section class="event-section" style="background-color: #000;">
  <div class="container">

    <!-- 섹션 1: 극장 -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="section-title mb-0">극장</h3>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-5">
      <!-- 카드 1 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event5.jpg" class="event-imgs" alt="아트시네마">
          <div class="p-3">
            <div class="event-title" style="color: black;">[인천터미널] 아트시네마</div>
            <p class="event-date">2025.06.17 ~ 2025.06.17</p>
          </div>
        </div>
      </div>
      <!-- 카드 2 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event6.jpg" class="event-imgs" alt="콘서트">
          <div class="p-3">
            <div class="event-title" style="color: black;">[인천논현] MOVIE 콘서트</div>
            <p class="event-date">2025.06.14 ~ 2025.06.14</p>
          </div>
        </div>
      </div>
      <!-- 카드 3 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event7.jpg" class="event-imgs" alt="환경 캠페인">
          <div class="p-3">
            <div class="event-title" style="color: black;">[흑석] 환경 생각하기!</div>
            <p class="event-date">2025.06.06 ~ 2025.06.08</p>
          </div>
        </div>
      </div>
      <!-- 카드 4 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event8.jpg" class="event-imgs" alt="국가유공자">
          <div class="p-3">
            <div class="event-title" style="color: black;">[상도] 호국보훈의 달 할인</div>
            <p class="event-date">2025.06.04 ~ 2025.06.30</p>
          </div>
        </div>
      </div>
    </div>

    <!-- 섹션 2: 제휴/할인 -->
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
      <h3 class="section-title mb-0">제휴/할인</h3>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
      <!-- 카드 1 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event9.jpg" class="event-imgs" alt="진에어">
          <div class="p-3">
            <div class="event-title" style="color: black;">[진에어] 가정의 달 할인</div>
            <p class="event-date">2025.05.19 ~ 2025.06.30</p>
          </div>
        </div>
      </div>
      <!-- 카드 2 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event10.jpg" class="event-imgs" alt="헬로티처스">
          <div class="p-3">
            <div class="event-title" style="color: black;">[토스페이] 결제 프로모션</div>
            <p class="event-date">2025.06.01 ~ 2025.06.30</p>
          </div>
        </div>
      </div>
      <!-- 카드 3 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event11.jpg" class="event-imgs" alt="토스페이">
          <div class="p-3">
            <div class="event-title" style="color: black;">[네이버페이] 제휴 프로모션</div>
            <p class="event-date">2025.05.01 ~ 2025.05.31</p>
          </div>
        </div>
      </div>
      <!-- 카드 4 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event12.jpg" class="event-imgs" alt="네이버페이">
          <div class="p-3">
            <div class="event-title" style="color: black;">군인 경찰 특별 혜택</div>
            <p class="event-date">2025.01.01 ~ 2025.12.31</p>
          </div>
        </div>
      </div>
    </div>

    <!-- 섹션 3: 시사회 -->
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
      <h3 class="section-title mb-0">시사회/무대인사</h3>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
      <!-- 카드 1 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event13.jpg" class="event-imgs" alt="진에어">
          <div class="p-3">
            <div class="event-title" style="color: black;"><인터스텔라> 무대인사</div>
            <p class="event-date">2025.05.19 ~ 2025.06.30</p>
          </div>
        </div>
      </div>
      <!-- 카드 2 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event14.jpg" class="event-imgs" alt="헬로티처스">
          <div class="p-3">
            <div class="event-title" style="color: black;"><트루먼쇼> 무대인사</div>
            <p class="event-date">2025.06.20 ~ 2025.06.30</p>
          </div>
        </div>
      </div>
      <!-- 카드 3 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event15.jpg" class="event-imgs" alt="토스페이">
          <div class="p-3">
            <div class="event-title" style="color: black;"><마블> 내한 감사인사</div>
            <p class="event-date">2025.05.01 ~ 2025.05.31</p>
          </div>
        </div>
      </div>
      <!-- 카드 4 -->
      <div class="col">
        <div class="event-card h-100" style="background-color: white;">
          <img src="assets/event16.jpg" class="event-imgs" alt="네이버페이">
          <div class="p-3">
            <div class="event-title" style="color: black;"><라이온킹> 성우 내한인사</div>
            <p class="event-date">2025.05.01 ~ 2025.05.31</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>








<?php include 'footer.php'; ?>

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

</script>




</body>
</html>
