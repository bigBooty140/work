-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: mfc
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('Mr','Ms','Mrs','Dr') DEFAULT 'Mr',
  `first_name` varchar(100) NOT NULL,
  `initials` varchar(10) DEFAULT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nationality` enum('SA citizen','Foreign national residing in SA') DEFAULT NULL,
  `sa_id_number` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'South Africa',
  `proof_of_identification` enum('Driver''s license','Passport') DEFAULT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `traffic_register_number` varchar(50) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT 'ABSA',
  `account_holder_name` varchar(150) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `branch_code` varchar(20) DEFAULT NULL,
  `id_document_path` varchar(255) DEFAULT NULL,
  `traffic_register_letter_path` varchar(255) DEFAULT NULL,
  `proof_of_address_path` varchar(255) DEFAULT NULL,
  `banking_document_path` varchar(255) DEFAULT NULL,
  `race` enum('African','White','Coloured','Indian','Other') DEFAULT 'African',
  `gender` enum('Male','Female','Other') DEFAULT 'Male',
  `date_of_birth` date DEFAULT NULL,
  `heard_about_us` varchar(255) DEFAULT NULL,
  `complex_unit` varchar(150) DEFAULT NULL,
  `street_number` varchar(20) DEFAULT NULL,
  `street_name` varchar(150) DEFAULT NULL,
  `suburb` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `province` enum('Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo','Mpumalanga','North West','Northern Cape','Western Cape') DEFAULT 'Eastern Cape',
  `cellphone_number` varchar(20) DEFAULT NULL,
  `work_telephone_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-09-16 11:20:07
