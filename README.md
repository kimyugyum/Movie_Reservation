# 🎬 MovieWave - 영화 예매 웹사이트

---

## 📌 프로젝트 개요

- PHP와 MySQL을 기반으로 한 영화 예매 웹사이트입니다.
- 회원은 로그인 후 영화 예매, 리뷰 작성, 예매 수정 및 취소가 가능합니다.
- 마이페이지에서 예매 통계(총 예매 횟수, 가장 자주 간 극장, 가장 많이 본 장르)를 확인할 수 있습니다.
- 비회원은 예매 기능에 접근할 수 없습니다.

---

## 💡 주요 기능 요약

1. 회원가입 / 로그인 / 로그아웃 기능  
2. 영화 목록 출력 및 상세정보 확인  
3. 영화 예매 (날짜/시간/좌석/극장 선택)  
4. 예매 내역 확인 및 수정/취소 기능  
5. 영화 리뷰 작성 기능 (별점, 한줄평)  
6. 마이페이지 통계 기능 (JOIN, SUBQUERY 사용)

---

## 💻 주요 페이지 구성

- `main.php` : 로그인 후 진입하는 메인 페이지  
- `login_form.php` : 로그인 폼 페이지  
- `login.php` : 로그인 처리  
- `post.php` : 예매 등록  
- `update.php` : 예매 수정  
- `delete.php` : 예매 취소  
- `content.php` : 예매 목록 테이블 출력  
- `mypage.php` : 마이페이지 (통계, 리뷰 기능 포함)  
- `insert_review.php` : 리뷰 등록 처리  
- `update_reservation.php` : 예매 수정 처리  
- `cancel_reservation.php` : 예매 취소 처리  
- `db.php` : MySQL DB 연결  
- `style.css` : 전체 디자인 (다크 테마)

---

## 💾 DB 연결 정보

- DB 서버: `localhost`  
- 사용자명: `root`  
- 비밀번호: `abcd1234`  
- 데이터베이스명: `movie_ticket`

**연결 방식 (`db.php` 예시):**
```php
$host = 'localhost';
$user = 'root';
$password = 'abcd1234';
$dbname = 'movie_ticket';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}
```

---

## 🛡 보안 대책 및 강화 기능

### ✅ 1. SQL Injection 방지
```php
$stmt = $conn->prepare("SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?");
$stmt->bind_param("si", $user_id, $movie_id);
```

### ✅ 2. XSS(Cross-Site Scripting) 방지
```php
<p><?= htmlspecialchars($review['comment']) ?></p>
```

### ✅ 3. 세션 기반 인증 및 접근 제어
```php
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}
```

### ✅ 4. 리뷰 중복 등록 방지
```php
$check_sql = "SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?";
```

### ✅ 5. 비밀번호 보안 강화
```php
$hashed = password_hash($pwd, PASSWORD_DEFAULT);
password_verify($input_pwd, $hashed_pwd_from_db);
```

### ✅ 6. 예매 수정 및 취소 권한 제어
```sql
SELECT * FROM reservations WHERE reserve_id = ? AND user_id = ?
```

---

## 🗃 데이터베이스 구조

- 테이블 수: 4개 (`users`, `movies`, `reservations`, `reviews`)
- 각 테이블 20개 이상의 레코드 포함

### 🔁 JOIN 사용 예시
```sql
SELECT r.reserve_id, m.title, r.seat
FROM reservations r
JOIN movies m ON r.movie_id = m.movie_id
WHERE r.user_id = 'user01';
```

### 🔎 SUBQUERY 사용 예시
```sql
SELECT genre
FROM movies
WHERE genre = (
  SELECT m.genre
  FROM reservations r
  JOIN movies m ON r.movie_id = m.movie_id
  WHERE r.user_id = 'user01'
  GROUP BY m.genre
  ORDER BY COUNT(*) DESC
  LIMIT 1
);
```

---

## 🧾 DB 백업 파일

- 파일명: `20211806.sql`
- 생성 명령어:
```bash
mysqldump -u root -p movie_ticket > 20211806.sql
```
- `.sql` 파일에는 `CREATE TABLE`, `INSERT INTO` 쿼리가 포함되어 있으며, 백업 정상 여부를 확인했습니다.

---

## 🎨 심미성

- Bootstrap 5 기반 다크 테마 디자인 적용
- 카드 레이아웃, 아이콘, 폰트 강조 등 시각적 완성도 고려
- 반응형 디자인 적용 (데스크탑 / 모바일 호환)

---

## 👤 개발자 정보

- 이름: 김유겸  
- 학번: 20211806  
- 팀 구성: 1인 프로젝트  
- 과목: 사이버보안
