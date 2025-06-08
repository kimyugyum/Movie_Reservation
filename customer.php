<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>고객센터 | 물결 속으로, MovieWave</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .accordion-item {
            background-color: #1a1a1a;
            border: 1px solid #00aaff;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .accordion-button {
            background-color: #1a1a1a;
            color: #00aaff;
            font-weight: bold;
            padding: 1rem;
        }

        .accordion-button:not(.collapsed) {
            background-color: #000;
            color: #fff;
            box-shadow: inset 0 -2px 10px rgba(0, 170, 255, 0.3);
        }

        .accordion-button:hover {
            color: #fff;
            background-color: #0d0d0d;
        }

        .accordion-body {
            background-color: #111;
            color: #ccc;
            border-top: 1px solid #00aaff;
            padding: 1rem;
        }

        .section-title {
            color: #00aaff;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            border-left: 5px solid #00aaff;
            padding-left: 15px;
            margin-bottom: 30px;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body style="background-color: #000; color: #fff;">

<div class="container mt-5 mb-5" style="animation: fadeIn 0.8s;">
  <h3 class="section-title mb-4">자주 묻는 질문 (FAQ)</h3>
  <hr class="border-info" style="opacity: 1;">

  <div class="accordion" id="faqAccordion">

  <div class="accordion" id="faqAccordion">

  <!-- 1. 예매 내역 확인 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading1">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
        🎟️ 예매 내역은 어디서 확인하나요?
      </button>
    </h2>
    <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        마이페이지 > 예매 내역에서 본인의 모든 예매 정보를 확인할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 2. 예매 취소 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading2">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
        ❌ 예매를 취소하려면 어떻게 하나요?
      </button>
    </h2>
    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        마이페이지 > 예매 내역에서 해당 예매의 '취소' 버튼을 눌러 취소할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 3. 좌석 변경 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading3">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
        🔄 예매한 좌석을 변경할 수 있나요?
      </button>
    </h2>
    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        예매 내역에서 '수정' 버튼을 눌러 좌석을 다시 선택할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 4. 예매는 어디서 하나요? -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading4">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
        🎫 예매는 어디서 하나요?
      </button>
    </h2>
    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        영화 상세 페이지 또는 메인 페이지에서 '예매하기' 버튼을 눌러 예매를 시작할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 5. 로그인은 어떻게 하나요? -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading5">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
        🔐 로그인은 어떻게 하나요?
      </button>
    </h2>
    <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        오른쪽 상단의 로그인 메뉴를 통해 아이디와 비밀번호로 로그인할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 6. 회원가입 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading6">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6">
        📝 회원가입은 어디서 하나요?
      </button>
    </h2>
    <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        로그인 페이지 하단의 '회원가입' 버튼을 통해 간단히 가입할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 7. 마이페이지 기능 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading7">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7">
        📂 마이페이지에서는 어떤 기능을 사용할 수 있나요?
      </button>
    </h2>
    <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        예매 내역 확인, 좌석 변경, 예매 취소, 개인정보 수정 기능을 사용할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 8. 영화 목록 확인 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading8">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8">
        🎥 예매 가능한 영화는 어디서 확인하나요?
      </button>
    </h2>
    <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        메인 페이지 또는 영화 페이지에서 현재 상영 중인 모든 영화의 정보를 확인할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 9. 예매한 영화의 시간/극장 확인 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading9">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9">
        ⏰ 예매한 영화의 시간과 극장은 어디서 볼 수 있나요?
      </button>
    </h2>
    <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        마이페이지 > 예매 내역에서 영화 제목과 함께 시간, 극장, 좌석 정보를 확인할 수 있습니다.
      </div>
    </div>
  </div>

  <!-- 10. 회원 정보 수정 -->
  <div class="accordion-item bg-dark text-white border-info">
    <h2 class="accordion-header" id="heading10">
      <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10">
        ⚙️ 회원 정보를 수정하고 싶어요.
      </button>
    </h2>
    <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
      <div class="accordion-body">
        마이페이지 > 내 정보 수정 버튼을 눌러 이름, 비밀번호, 닉네임 등을 변경할 수 있습니다.
      </div>
    </div>
  </div>

</div>



</div>

</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
