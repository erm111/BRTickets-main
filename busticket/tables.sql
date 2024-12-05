-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for busticket
CREATE DATABASE IF NOT EXISTS `busticket` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `busticket`;

-- Dumping structure for table busticket.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `departure_state` varchar(100) DEFAULT NULL,
  `arrival_state` varchar(100) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `bus_type` varchar(50) DEFAULT NULL,
  `seat_numbers` varchar(100) DEFAULT NULL,
  `total_seats` int DEFAULT NULL,
  `luggage` tinyint(1) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `next_of_kin_name` varchar(100) DEFAULT NULL,
  `next_of_kin_relationship` varchar(50) DEFAULT NULL,
  `next_of_kin_email` varchar(100) DEFAULT NULL,
  `next_of_kin_phone` varchar(20) DEFAULT NULL,
  `next_of_kin_address` text,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table busticket.tickets: ~0 rows (approximately)
INSERT INTO `tickets` (`id`, `user_id`, `departure_state`, `arrival_state`, `travel_date`, `bus_type`, `seat_numbers`, `total_seats`, `luggage`, `total_amount`, `next_of_kin_name`, `next_of_kin_relationship`, `next_of_kin_email`, `next_of_kin_phone`, `next_of_kin_address`, `booking_date`, `status`) VALUES
	(1, 1, 'Ebonyi', 'Lagos', '2024-12-03', 'jet mover', '["1"]', 1, 1, 30000.00, 'Clinton Nnanyere', 'father', 'uzomannanyere@gmail.com', '07019805051', 'No 62 Ukachukwu street', '2024-12-01 09:46:27', 'pending'),
	(2, 1, 'Abia', 'Adamawa', '2024-12-02', NULL, '["3","6","7"]', 3, 1, 80000.00, 'kjvnlaks kdngal;km', 'father', 'fjafil@gmail.com', '090444132567', 'rome ', '2024-12-01 20:52:58', 'pending'),
	(3, 1, 'Ojota', 'Ketu', '2024-12-02', NULL, '["9","10"]', 2, 1, 55000.00, 'Nnanyere Uzoma', 'father', 'uzomannanyere@gmail.com', '07019805051', '64 Emeka Ugorji Crescent', '2024-12-01 22:50:27', 'pending');

-- Dumping structure for table busticket.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table busticket.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
	(1, 'Delight Opara', 'oparatickets@gmail.com', '$2y$10$HzitYnHj9ufUZKrr9R/dEeFOK4oJW9wvizVpFXfZkAggl7KXySIKa', '2024-11-29 14:56:47'),
	(2, 'Twai sam', 'twaisam@gmail.com', '$2y$10$kITnGC/4/YspbU2NE2ORI.vv9ccsa8/5anXlQeMySvEtmi7jCqW5O', '2024-12-01 20:39:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
