==========================
🎬 MovieWave - 영화 예매 웹사이트
==========================

## 📌 프로젝트 개요
- PHP와 MySQL을 기반으로 한 영화 예매 웹사이트입니다.
- 회원은 로그인 후 영화 예매, 리뷰 작성, 예매 수정 및 취소가 가능합니다.
- 마이페이지에서 예매 통계(총 예매 횟수, 가장 자주 간 극장, 가장 많이 본 장르)를 확인할 수 있습니다.
- 비회원은 예매 기능에 접근할 수 없습니다.

## 💡 주요 기능 요약
1. 회원가입 / 로그인 / 로그아웃 기능
2. 영화 목록 출력 및 상세정보 확인
3. 영화 예매 (날짜/시간/좌석/극장 선택)
4. 예매 내역 확인 및 수정/취소 기능
5. 영화 리뷰 작성 기능 (별점, 한줄평)
6. 마이페이지 통계 기능 (JOIN, SUBQUERY 사용)

## 💻 주요 페이지 구성
- `main.php`               : 로그인 후 진입하는 메인 페이지  
- `login_form.php`         : 로그인 폼 페이지  
- `login.php`              : 로그인 처리  
- `post.php`               : 예매 등록  
- `update.php`             : 예매 수정  
- `delete.php`             : 예매 취소  
- `content.php`            : 예매 목록 테이블 출력  
- `mypage.php`             : 마이페이지 (통계, 리뷰 기능 포함)  
- `insert_review.php`      : 리뷰 등록 처리  
- `update_reservation.php` : 예매 수정 처리  
- `cancel_reservation.php` : 예매 취소 처리  
- `db.php`                 : MySQL DB 연결  
- `style.css`              : 전체 디자인 (다크 테마)

## 💾 DB 연결 정보
- DB 서버: `localhost`  
- 사용자명: `root`  
- 비밀번호: `abcd1234` ← 본인의 실제 MySQL 비밀번호  
- 데이터베이스명: `movie_ticket`

**연결 방식 (db.php 예시):**
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

## 🛡 보안 대책 및 강화 기능

본 프로젝트에서는 웹 보안의 기본 원칙을 충실히 따르고 있으며, 다음과 같은 보안 기능을 추가 구현했습니다.

### ✅ 1. SQL Injection 방지
- 모든 DB 쿼리에 대해 `prepare()` + `bind_param()`을 사용하여 SQL 조작을 원천 차단했습니다.
```php
$stmt = $conn->prepare("SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?");
$stmt->bind_param("si", $user_id, $movie_id);
```

### ✅ 2. XSS(Cross-Site Scripting) 방지
- HTML 출력 시 `htmlspecialchars()`로 사용자 입력을 필터링했습니다.
```php
<p><?= htmlspecialchars($review['comment']) ?></p>
```

### ✅ 3. 세션 기반 인증 및 접근 제어
- 모든 주요 페이지에서 `$_SESSION['user_id']` 체크를 통해 비로그인 사용자 접근을 차단했습니다.
```php
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login_form.php';</script>";
    exit;
}
```

### ✅ 4. 리뷰 중복 등록 방지
- 한 유저가 동일 영화에 대해 여러 번 리뷰를 작성하지 못하도록 서버에서 확인합니다.
```php
$check_sql = "SELECT * FROM reviews WHERE user_id = ? AND movie_id = ?";
```

### ✅ 5. 비밀번호 보안 강화
- 회원 비밀번호는 `password_hash()`로 암호화되어 저장되며, 로그인 시 `password_verify()`로 검증됩니다.
```php
$hashed = password_hash($pwd, PASSWORD_DEFAULT);
password_verify($input_pwd, $hashed_pwd_from_db);
```

### ✅ 6. 예매 수정 및 취소 권한 제어
- 본인의 예매만 수정/취소할 수 있도록 `user_id` 조건으로 서버 단에서 제어합니다.
```sql
SELECT * FROM reservations WHERE reserve_id = ? AND user_id = ?
```

## 🗃 데이터베이스 구조
- 총 4개 테이블 (`users`, `movies`, `reservations`, `reviews`)
- 각 테이블당 20개 이상 레코드 보유

### 사용된 JOIN 예시
```sql
SELECT r.reserve_id, m.title, r.seat
FROM reservations r
JOIN movies m ON r.movie_id = m.movie_id
WHERE r.user_id = 'user01';
```

### 사용된 SUBQUERY 예시
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

## 🧾 DB 백업 파일
- 파일명: `2025XXXX.sql`
- 백업 명령어:
```bash
mysqldump -u root -p movie_ticket > 2025XXXX.sql
```
- `.sql` 파일에는 `CREATE TABLE`, `INSERT INTO` 쿼리가 포함되어 있으며, 메모장으로 정상 백업 여부를 확인했습니다.

## 🎨 심미성
- Bootstrap 5 기반의 다크 테마 디자인
- 카드 UI, 아이콘, 텍스트 강조 등을 활용해 사용자 편의성 향상
- 반응형 UI로 다양한 디바이스에서도 사용 가능

## 👤 개발자 정보
- 이름: 홍길동
- 학번: 2025XXXX
- 팀 구성: 1인 프로젝트 (단독 수행)
- 과목: 웹 프로그래밍 기말 프로젝트
