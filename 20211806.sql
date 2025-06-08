-- MySQL dump 10.13  Distrib 9.2.0, for Win64 (x86_64)
--
-- Host: localhost    Database: movie_ticket
-- ------------------------------------------------------
-- Server version	9.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `runtime` int DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'쇼생크 탈출','드라마',142,'15세'),(2,'다크 나이트','액션, 스릴러',152,'15세'),(3,'포레스트 검프','드라마, 코미디',142,'전체관람가'),(4,'인터스텔라','SF, 드라마',169,'12세'),(5,'센과 치히로의 행방불명','애니메이션, 판타지',125,'전체관람가'),(6,'매트릭스','액션, SF',136,'15세'),(7,'라이온킹','애니메이션, 가족',88,'전체관람가'),(8,'트루먼쇼','드라마',103,'12세'),(9,'어벤져스: 엔드게임','액션, SF',181,'12세'),(10,'인셉션','SF, 스릴러',148,'12세'),(11,'해리 포터와 마법사의 돌','판타지, 가족',152,'전체관람가'),(12,'월-E','애니메이션, SF',98,'전체관람가'),(13,'토이 스토리','애니메이션, 가족',81,'전체관람가'),(14,'업','애니메이션, 드라마',96,'전체관람가'),(15,'위대한 쇼맨','뮤지컬, 드라마',105,'12세'),(16,'너의 이름은','애니메이션, 로맨스',106,'12세'),(17,'기생충','드라마, 스릴러',132,'15세'),(18,'코코','애니메이션, 가족',105,'전체관람가'),(19,'이터널 선샤인','로맨스, 드라마',108,'15세'),(20,'블랙 팬서','액션, SF',134,'12세');
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `reserve_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `seat` varchar(5) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `theater` varchar(50) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`reserve_id`),
  KEY `user_id` (`user_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,'user01',1,'A1','2025-06-11','상도','09:00'),(2,'bbbb',1,'C5','2025-06-11','상도','09:00'),(3,'aaaa',1,'D5','2025-06-11','상도','09:00'),(4,'user01',2,'A1','2025-06-11','상도','12:20'),(5,'user02',3,'A2','2025-06-11','상도','15:40'),(6,'user03',4,'A3','2025-06-11','상도','19:00'),(7,'user04',5,'A4','2025-06-11','상도','22:20'),(8,'user05',1,'B1','2025-06-12','흑석','09:00'),(9,'user06',2,'B2','2025-06-12','흑석','12:20'),(10,'user07',3,'B3','2025-06-12','흑석','15:40'),(11,'user08',4,'B4','2025-06-12','흑석','19:00'),(12,'user09',5,'B5','2025-06-12','흑석','22:20'),(13,'user10',1,'C1','2025-06-13','대학로','09:00'),(14,'user11',2,'C2','2025-06-13','대학로','12:20'),(15,'user12',3,'C3','2025-06-13','대학로','15:40'),(16,'user13',4,'C4','2025-06-13','대학로','19:00'),(17,'user14',5,'C5','2025-06-13','대학로','22:20'),(18,'user15',1,'D1','2025-06-14','인천논현','09:00'),(19,'user16',2,'D2','2025-06-14','인천논현','12:20'),(20,'user17',3,'D3','2025-06-14','인천논현','15:40');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `movie_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  CONSTRAINT `reviews_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'user01',1,5,'인생 영화입니다','2025-06-04 00:15:29'),(2,'bbbb',1,4,'재밌게 봤어요','2025-06-04 00:15:29'),(3,'aaaa',1,5,'감동적이에요','2025-06-04 00:15:29'),(4,'user01',2,4,'몰입감 최고','2025-06-04 00:15:29'),(5,'user02',3,5,'웃기고 슬퍼요','2025-06-04 00:15:29'),(6,'user03',4,4,'스케일이 크네요','2025-06-04 00:15:29'),(7,'user04',5,5,'감성 가득 애니','2025-06-04 00:15:29'),(8,'user05',1,3,'괜찮았어요','2025-06-04 00:15:29'),(9,'user06',2,5,'액션 좋았음','2025-06-04 00:15:29'),(10,'user07',3,4,'감동적','2025-06-04 00:15:29'),(11,'user08',4,5,'눈물 났어요','2025-06-04 00:15:29'),(12,'user09',5,4,'몽환적인 분위기','2025-06-04 00:15:29'),(13,'user10',1,4,'다시 보고 싶어요','2025-06-04 00:15:29'),(14,'user11',2,3,'조금 지루했어요','2025-06-04 00:15:29'),(15,'user12',3,5,'명작입니다','2025-06-04 00:15:29'),(16,'user13',4,4,'웅장한 영화','2025-06-04 00:15:29'),(17,'user14',5,5,'상상력이 풍부해요','2025-06-04 00:15:29'),(18,'user15',1,4,'연기 좋았어요','2025-06-04 00:15:29'),(19,'user16',2,3,'내용은 무난','2025-06-04 00:15:29'),(20,'user17',3,5,'강추합니다','2025-06-04 00:15:29');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `nickname` varchar(50) NOT NULL,
  `genre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('aaaa','$2y$12$1tJ4K9h3NBeWVckUhIVnneJZjubA4OE9T1Gna3bXx6hXDkNQlk/.C','a','M','2002-01-01','a씨','액션,코미디,판타지'),('bbbb','bbbb','b','F','2014-04-04','b씨','로맨스,공포'),('user01','$2y$12$rWy0zZbnv/ety565P6Ju3uV0LB9o9tCT40sB0jjoNtV0vj3BI6SzO','홍길동','M','1995-05-10','길동이','액션,스릴러'),('user02','pass02','김영희','F','1997-03-15','영희짱','로맨스,드라마'),('user03','pass03','이철수','M','1994-12-25','철수킹','코미디,판타지'),('user04','pass04','박지민','F','2000-07-18','지민스타','뮤지컬,로맨스'),('user05','pass05','최민수','M','1988-11-03','민수남','액션,SF'),('user06','pass06','정하나','F','1999-02-02','하나짱','드라마,코미디'),('user07','pass07','오성훈','M','2001-08-09','성훈배우','공포,스릴러'),('user08','pass08','윤미래','F','1996-06-30','미래녀','SF,로맨스'),('user09','pass09','한지성','M','1992-09-14','지성화이팅','애니메이션,판타지'),('user10','pass10','장도연','F','1990-10-20','도연언니','코미디,뮤지컬'),('user11','pass11','류지훈','M','1993-03-03','지훈지킴이','스릴러,액션'),('user12','pass12','조예린','F','1998-01-28','예린요정','로맨스,판타지'),('user13','pass13','문동은','F','1995-04-19','복수는나의것','스릴러,드라마'),('user14','pass14','강민혁','M','1991-12-07','민혁스윗','뮤지컬,애니메이션'),('user15','pass15','배수지','F','1994-05-10','국민첫사랑','드라마,로맨스'),('user16','pass16','김태형','M','1993-12-30','뷔정국이','공포,스릴러'),('user17','pass17','이서연','F','2002-06-06','서연스마일','애니메이션,코미디'),('user18','pass18','정재현','M','1990-09-21','재현파워','액션,SF');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-08 23:12:46
