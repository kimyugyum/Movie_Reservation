<?php
include 'db.php';
include 'header.php';

// 포스터 경로 (movie_id 기준)
$movie_posters = [
  1 => 'assets/movie1.jpg',
  2 => 'assets/movie2.jpg',
  3 => 'assets/movie3.jpg',
  4 => 'assets/movie4.jpg',
  5 => 'assets/movie5.jpg',
  6 => 'assets/movie6.jpg',
  7 => 'assets/movie7.jpg',
  8 => 'assets/movie8.jpg',
  9 => 'assets/movie9.jpg',
 10 => 'assets/movie10.jpg',
 11 => 'assets/movie11.jpg',
 12 => 'assets/movie12.jpg',
 13 => 'assets/movie13.jpg',
 14 => 'assets/movie14.jpg',
 15 => 'assets/movie15.jpg',
 16 => 'assets/movie16.jpg',
 17 => 'assets/movie17.jpg',
 18 => 'assets/movie18.jpg',
 19 => 'assets/movie19.jpg',
 20 => 'assets/movie20.jpg',
];

// 보조 정보 배열 (movie_id 기준)
$movie_additional = [
  1 => ['release' => '1995-01-28', 'reserve_rate' => 29.5, 'like_rate' => 99],
  2 => ['release' => '2008-08-06', 'reserve_rate' => 15.7, 'like_rate' => 98],
  3 => ['release' => '1994-10-15', 'reserve_rate' => 14.4, 'like_rate' => 98],
  4 => ['release' => '2014-11-06', 'reserve_rate' => 9.3, 'like_rate' => 96],
  5 => ['release' => '2002-06-28', 'reserve_rate' => 5.6, 'like_rate' => 95],
  6 => ['release' => '2025-06-11', 'reserve_rate' => 0.0, 'like_rate' => 0],
  7 => ['release' => '2025-06-18', 'reserve_rate' => 0.0, 'like_rate' => 0],
  8 => ['release' => '2025-06-25', 'reserve_rate' => 0.0, 'like_rate' => 0],
  9 => ['release' => '2025-07-01', 'reserve_rate' => 0.0, 'like_rate' => 0],
 10 => ['release' => '2025-07-05', 'reserve_rate' => 0.0, 'like_rate' => 0],
 11 => ['release' => '2025-07-07', 'reserve_rate' => 0.0, 'like_rate' => 0],
 12 => ['release' => '2025-07-09', 'reserve_rate' => 0.0, 'like_rate' => 0],
 13 => ['release' => '2025-07-10', 'reserve_rate' => 0.0, 'like_rate' => 0],
 14 => ['release' => '2025-07-12', 'reserve_rate' => 0.0, 'like_rate' => 0],
 15 => ['release' => '2025-07-15', 'reserve_rate' => 0.0, 'like_rate' => 0],
 16 => ['release' => '2025-07-17', 'reserve_rate' => 0.0, 'like_rate' => 0],
 17 => ['release' => '2025-07-20', 'reserve_rate' => 0.0, 'like_rate' => 0],
 18 => ['release' => '2025-07-23', 'reserve_rate' => 0.0, 'like_rate' => 0],
 19 => ['release' => '2025-07-25', 'reserve_rate' => 0.0, 'like_rate' => 0],
 20 => ['release' => '2025-07-28', 'reserve_rate' => 0.0, 'like_rate' => 0],
];

// DB에서 영화 목록 불러오기
$movies = [];
$result = $conn->query("SELECT * FROM movies ORDER BY movie_id ASC");

while ($row = $result->fetch_assoc()) {
  $id = $row['movie_id'];
  $add = $movie_additional[$id] ?? ['release' => '2099-12-31', 'reserve_rate' => 0, 'like_rate' => 0];
  $release_date = $add['release'];
  $today = date('Y-m-d');
  $d_day = (strtotime($release_date) <= strtotime($today)) ? '개봉중' : 'D-' . floor((strtotime($release_date) - strtotime($today)) / 86400);

  $movies[] = [
    'title' => $row['title'],
    'poster' => $movie_posters[$id] ?? 'assets/default.jpg',
    'rating' => $row['rating'],
    'reserve_rate' => $add['reserve_rate'],
    'like_rate' => $add['like_rate'],
    'release' => date('Y.m.d', strtotime($release_date)),
    'd_day' => $d_day
  ];
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>영화 | 물결 속으로, MovieWave</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel&family=Orbitron&display=swap" rel="stylesheet">
  <style>
    .movie-card .card-img-top {
      transition: transform 0.3s ease;
      object-fit: cover;
      height: 360px;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }

    .movie-card:hover .card-img-top {
      transform: scale(1.05);
    }

    .movie-card {
      border: none;
      border-radius: 12px;
      background-color: #111;
      box-shadow: 0 4px 15px rgba(0, 170, 255, 0.2);
      transition: box-shadow 0.3s ease;
    }

    .movie-card:hover {
      box-shadow: 0 6px 20px rgba(0, 170, 255, 0.4);
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.4em 0.6em;
      border-radius: 8px;
    }

    .card-title {
      color: #00aaff;
      font-weight: 600;
      margin-bottom: 0.4rem;
    }

    .card-body p {
      margin-bottom: 0.3rem;
      line-height: 1.4;
    }

    .btn-info {
      background-color: #00aaff;
      border: none;
    }

    .btn-info:hover {
      background-color: #007acc;
      cursor: pointer;
    }

    .btn-secondary[disabled] {
      opacity: 0.6;
      cursor: not-allowed;
    }
  </style>
</head>
<body style="background-color: #000; color: #fff;">

<!-- 기존의 head 스타일, body, container 등은 그대로 유지 -->

<div class="container mt-5">
  <h3 class="section-title mb-4">영화</h3>
  <hr class="border-info" style="opacity: 1;">
  <div class="row row-cols-1 row-cols-md-4 g-4">

    <?php $rank = 1; foreach ($movies as $m): ?>
    <?php $is_opened = !str_starts_with($m['d_day'], 'D-'); ?>
    <div class="col">
      <div class="card movie-card h-100 text-white">
        <div class="position-relative">
          <img src="<?= $m['poster'] . '?v=' . (file_exists($m['poster']) ? filemtime($m['poster']) : time()) ?>" class="card-img-top" alt="포스터">
          <div class="position-absolute top-0 start-0 px-2 py-1 bg-danger text-white fw-bold">No.<?= $rank++ ?></div>
          <div class="position-absolute top-0 end-0 px-2 py-1 bg-danger text-white small"><?= $m['rating'] ?></div>
        </div>
        <div class="card-body p-3">
          <h6 class="card-title text-truncate"><?= htmlspecialchars($m['title']) ?></h6>
          <p class="mb-1 small">예매율 <?= $m['reserve_rate'] ?>% &nbsp; <i class="bi bi-hand-thumbs-up"></i> <?= $m['like_rate'] ?>%</p>
          <p class="mb-1 small text-secondary"><?= $m['release'] ?> 개봉 <span class="badge bg-secondary"><?= $m['d_day'] ?></span></p>

          <?php if ($is_opened): ?>
            <a href="reserve.php" class="btn btn-sm btn-info text-white w-100 mt-2">예매하기</a>
          <?php else: ?>
            <button class="btn btn-sm btn-secondary w-100 mt-2" disabled>예매 불가</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
