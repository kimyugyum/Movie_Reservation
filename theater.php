<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>극장 | 물결 속으로, MovieWave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
  <style>
    .object-fit-cover {
      object-fit: cover;
    }
  </style>
</head>
<body style="background-color: #000; color: #fff;">

<div class="container mt-5">
  <h3 class="section-title mb-4">극장</h3>
  <hr class="border-info" style="opacity: 1;">
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <?php
    $theaters = [
      '상도' => [
        'image' => 'assets/theater1.png',
        'address' => '서울특별시 동작구 상도로 123',
        'phone' => '02-0000-0001',
        'desc' => '조용하고 쾌적한 상영 환경이 특징인 상도점입니다.',
        'map_query' => '서울특별시 동작구 상도로 123'
      ],
      '흑석' => [
        'image' => 'assets/theater2.png',
        'address' => '서울특별시 동작구 흑석로 84',
        'phone' => '02-0000-0002',
        'desc' => '한강과 가까운 위치로 여유로운 관람이 가능한 흑석점입니다.',
        'map_query' => '서울특별시 동작구 흑석로 84'
      ],
      '대학로' => [
        'image' => 'assets/theater3.png',
        'address' => '서울특별시 종로구 대학로 57',
        'phone' => '02-0000-0003',
        'desc' => '연극과 영화가 함께 어우러지는 문화 중심 대학로점입니다.',
        'map_query' => '서울특별시 종로구 대학로 57'
      ],
      '인천터미널' => [
        'image' => 'assets/theater4.png',
        'address' => '인천광역시 미추홀구 연남로 35',
        'phone' => '032-000-0004',
        'desc' => '대형 쇼핑몰과 함께 위치한 인천터미널점입니다.',
        'map_query' => '인천광역시 미추홀구 연남로 35'
      ],
      '인천논현' => [
        'image' => 'assets/theater5.png',
        'address' => '인천광역시 남동구 논고개로 87',
        'phone' => '032-000-0005',
        'desc' => '쾌적하고 편리한 교통을 자랑하는 인천논현점입니다.',
        'map_query' => '인천광역시 남동구 논고개로 87'
      ],
      '경기 안성' => [
        'image' => 'assets/theater6.png',
        'address' => '경기도 안성시 중앙로 101',
        'phone' => '031-000-0006',
        'desc' => '경기 남부 대표 복합 문화 공간, 경기 안성점입니다.',
        'map_query' => '경기도 안성시 중앙로 101'
      ]
    ];

    foreach ($theaters as $name => $info):
      $modal_id = 'modal-' . md5($name); // 모달 ID는 해시로 고유하게 설정
    ?>
    <div class="col">
      <div class="card h-100 shadow-sm bg-dark text-white border-secondary">
        <div class="row g-0">
          <div class="col-md-5">
            <img src="<?= $info['image'] ?>" class="img-fluid h-100 w-100 object-fit-cover" alt="<?= $name ?> 극장 이미지">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <h5 class="card-title fw-bold text-info"><?= $name ?>점</h5>
              <p class="card-text"><i class="bi bi-geo-alt"></i> <?= $info['address'] ?></p>
              <p class="card-text"><i class="bi bi-telephone"></i> <?= $info['phone'] ?></p>
              <p class="card-text small"><?= $info['desc'] ?></p>
              <a href="reserve.php" class="btn btn-sm btn-outline-info mt-2">예매하기</a>
              <button class="btn btn-sm btn-outline-light mt-2" data-bs-toggle="modal" data-bs-target="#<?= $modal_id ?>">위치안내</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 위치안내 모달 -->
    <div class="modal fade" id="<?= $modal_id ?>" tabindex="-1" aria-labelledby="<?= $modal_id ?>Label" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title" id="<?= $modal_id ?>Label"><?= $name ?>점 위치 안내
            <span style="font-size: 0.65rem; opacity: 0.6;">※ 실제 위치가 아닙니다.</span>
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <iframe 
              src="https://maps.google.com/maps?q=<?= urlencode($info['map_query']) ?>&output=embed"
              width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="">
            </iframe>
          </div>
        </div>
      </div>
    </div>

    <?php endforeach; ?>
  </div>
</div>

<!-- Bootstrap JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>
</body>
</html>
