
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PtId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'farhan 2','Change Department From CBAP/BIPAP Department to Billing Department','2','2024-02-16 08:37:26','2024-02-16 08:37:26'),(2,'farhan 2','Change Status From Completed to Pending','2','2024-02-16 08:37:26','2024-02-16 08:37:26'),(3,NULL,'Change Status From Pending to Waiting For Auth','2','2024-02-16 12:24:48','2024-02-16 12:24:48'),(4,NULL,'Note Added ','2','2024-02-16 12:53:35','2024-02-16 12:53:35'),(5,NULL,'Change Status From Waiting For Auth to Pending','1','2024-02-16 14:29:27','2024-02-16 14:29:27'),(6,'farhan 2','Change Department From CBAP/BIPAP Department to Billing Department','3','2024-02-17 14:41:25','2024-02-17 14:41:25'),(7,'farhan 2','Change Status From Resupply to Pending','3','2024-02-17 14:41:25','2024-02-17 14:41:25'),(8,'test','Change Status From Pending to Auth Denied','1','2024-02-17 14:53:55','2024-02-17 14:53:55'),(9,'farhan 2','Change Status From Pending to Resupply','3','2024-02-17 16:47:14','2024-02-17 16:47:14'),(10,'test','Change Status From Auth Denied to Resupply','1','2024-02-17 16:48:01','2024-02-17 16:48:01'),(11,'test','Note Added ','1','2024-02-17 17:08:30','2024-02-17 17:08:30'),(12,'test','Change Department From Rental Orders to CBAP/BIPAP Department','1','2024-02-17 17:15:12','2024-02-17 17:15:12'),(13,'farhan 2','Change Department From Billing Department to CBAP/BIPAP Department','3','2024-02-17 17:20:33','2024-02-17 17:20:33'),(14,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 17:21:27','2024-02-17 17:21:27'),(15,'farhan 2','Change Status From Resupply to Auth Denied','3','2024-02-17 17:21:28','2024-02-17 17:21:28'),(16,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 17:22:14','2024-02-17 17:22:14'),(17,'farhan 2','Change Status From Auth Denied to Resupply','3','2024-02-17 17:22:15','2024-02-17 17:22:15'),(18,'farhan 2','Change Department From CBAP/BIPAP Department to Billing Department','3','2024-02-17 17:28:41','2024-02-17 17:28:41'),(19,'farhan 2','Change Department From Billing Department to CBAP/BIPAP Department','3','2024-02-17 17:29:21','2024-02-17 17:29:21'),(20,'farhan 2','Change Department From CBAP/BIPAP Department to Intake Department','3','2024-02-17 17:34:27','2024-02-17 17:34:27'),(21,'farhan 2','Change Status From Resupply to Waiting For Auth','3','2024-02-17 17:34:27','2024-02-17 17:34:27'),(22,'farhan 2','Change Status From Waiting For Auth to Resupply','3','2024-02-17 17:39:50','2024-02-17 17:39:50'),(23,'test','Change Department From Rental Orders to Rental Orders','2','2024-02-17 17:45:10','2024-02-17 17:45:10'),(24,'farhan 2','Change Department From Billing Department to Billing Department','3','2024-02-17 17:46:05','2024-02-17 17:46:05'),(25,'test','Change Department From Rental Orders to Rental Orders','2','2024-02-17 17:46:56','2024-02-17 17:46:56'),(26,'farhan 2','Change Department From Rental Orders to Rental Orders','3','2024-02-17 17:58:48','2024-02-17 17:58:48'),(27,'test','Change Department From Intake Department to Intake Department','2','2024-02-17 18:01:23','2024-02-17 18:01:23'),(28,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 18:21:28','2024-02-17 18:21:28'),(29,'farhan 2','Change Department From CBAP/BIPAP Department to Billing Department','3','2024-02-17 18:24:46','2024-02-17 18:24:46'),(30,'farhan 2','Change Department From Billing Department to CBAP/BIPAP Department','3','2024-02-17 18:25:28','2024-02-17 18:25:28'),(31,'farhan 2','Change Department From CBAP/BIPAP Department to Intake Department','3','2024-02-17 18:27:52','2024-02-17 18:27:52'),(32,'test','Change Department From Intake Department to CBAP/BIPAP Department','2','2024-02-17 18:31:55','2024-02-17 18:31:55'),(33,'farhan 2','Change Department From Intake Department to CBAP/BIPAP Department','3','2024-02-17 18:34:58','2024-02-17 18:34:58'),(34,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 18:45:02','2024-02-17 18:45:02'),(35,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 18:46:16','2024-02-17 18:46:16'),(36,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 18:49:43','2024-02-17 18:49:43'),(37,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 18:52:48','2024-02-17 18:52:48'),(38,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 18:55:42','2024-02-17 18:55:42'),(39,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 19:15:08','2024-02-17 19:15:08'),(40,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 19:17:59','2024-02-17 19:17:59'),(41,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 19:26:48','2024-02-17 19:26:48'),(42,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-17 19:30:31','2024-02-17 19:30:31'),(43,'farhan 2','Change Department From Rental Orders to CBAP/BIPAP Department','3','2024-02-17 19:31:37','2024-02-17 19:31:37'),(44,'farhan 2','Change Department From CBAP/BIPAP Department to Intake Department','3','2024-02-17 20:07:44','2024-02-17 20:07:44'),(45,'test','Change Department From Intake Department to CBAP/BIPAP Department','3','2024-02-17 20:09:58','2024-02-17 20:09:58'),(46,'farhan 2','Change Department From CBAP/BIPAP Department to Intake Department','3','2024-02-17 20:13:08','2024-02-17 20:13:08'),(47,'test','Change Department From Intake Department to CBAP/BIPAP Department','3','2024-02-17 20:14:51','2024-02-17 20:14:51'),(48,NULL,'Change Department From CBAP/BIPAP Department to Intake Department','3','2024-02-18 04:40:12','2024-02-18 04:40:12'),(49,'farhan 2','Change Department From Intake Department to Rental Orders','3','2024-02-18 05:47:46','2024-02-18 05:47:46'),(50,'farhan 2','Change Department From Rental Orders to Intake Department','3','2024-02-18 05:52:24','2024-02-18 05:52:24'),(51,'farhan 2','Change Department From Intake Department to CBAP/BIPAP Department','3','2024-02-18 05:53:02','2024-02-18 05:53:02'),(52,'farhan 2','Change Department From CBAP/BIPAP Department to Rental Orders','3','2024-02-18 05:58:01','2024-02-18 05:58:01'),(53,'test','Change Department From Intake Department to Rental Orders','3','2024-02-18 06:06:40','2024-02-18 06:06:40'),(54,'farhan 2','Change Status From Waiting For Auth to Pending','7','2024-02-18 06:12:56','2024-02-18 06:12:56'),(55,'farhan 2','Change Department From Rental Orders to Intake Department','7','2024-02-18 06:14:09','2024-02-18 06:14:09'),(56,'farhan 2','Change Department From Intake Department to CBAP/BIPAP Department','7','2024-02-18 06:16:51','2024-02-18 06:16:51'),(57,'farhan 2','Change Status From Pending to Resupply','5','2024-02-18 12:59:45','2024-02-18 12:59:45'),(58,'farhan 2','Change Status From Waiting For Auth to Resupply','2','2024-02-18 13:08:36','2024-02-18 13:08:36'),(59,'kamran','Note Added ','5','2024-02-18 14:10:10','2024-02-18 14:10:10'),(60,'kamran','Change Department From Rental Orders to CBAP/BIPAP Department','8','2024-02-18 14:17:39','2024-02-18 14:17:39'),(61,'kamran','Change Status From Waiting For Auth to Pending','8','2024-02-18 14:17:39','2024-02-18 14:17:39'),(62,'test','Change Status From Resupply to Cancelled','5','2024-02-19 06:38:09','2024-02-19 06:38:09'),(63,'test','Change Department From Rental Orders to Intake Department','5','2024-02-19 06:44:57','2024-02-19 06:44:57'),(64,'test','Change Status From Cancelled to Resupply','5','2024-02-19 06:45:50','2024-02-19 06:45:50'),(65,'test','Change Department From Intake Department to Resupply Department','5','2024-02-19 06:58:19','2024-02-19 06:58:19'),(66,'test','Change Department From Intake Department to Rental Orders','9','2024-02-19 07:33:44','2024-02-19 07:33:44');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (3,'Intake Department','2024-02-15 05:53:41','2024-02-15 05:53:41'),(4,'Rental Orders','2024-02-15 05:54:24','2024-02-15 05:54:24'),(5,'Billing Department','2024-02-15 05:54:38','2024-02-15 05:54:38'),(6,'Resupply Department','2024-02-15 05:54:55','2024-02-15 05:54:55'),(7,'CBAP/BIPAP Department','2024-02-15 05:55:18','2024-02-15 05:55:18'),(10,'kamran','2024-02-18 14:36:58','2024-02-18 14:36:58');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Office_Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone_Num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,'Dr. Doctor 1','98289823','829082918389088','2024-02-15 06:27:04','2024-02-15 06:27:04'),(2,'Dr. Doctor 2','98289823','97907','2024-02-15 06:27:21','2024-02-15 06:27:21'),(4,'usama3','1234355443','(45)566554','2024-02-16 14:26:40','2024-02-16 14:35:11');
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UserId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2024_02_13_100811_create_users_table',1),(17,'2024_02_14_115119_create_doctors_table',1),(18,'2024_02_14_165012_create_statuses_table',1),(19,'2024_02_14_171332_create_departments_table',1),(20,'2024_02_14_174241_create_logs_table',1),(22,'2024_02_15_172407_create_patients_table',2),(24,'2024_02_16_125506_create_activities_table',3),(25,'2024_02_16_172540_create_notes_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PtId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (1,NULL,'Test Note','2','2024-02-16 12:53:35','2024-02-16 12:53:35'),(2,'test','hi','1','2024-02-17 17:08:29','2024-02-17 17:08:29'),(3,'kamran','test','5','2024-02-18 14:10:09','2024-02-18 14:10:09');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Off_Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Insurance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Order_No` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Order_Status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `User` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resupplyCat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resupplyDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'test','test','2','2024-12-31','malir','medical','000001','1','7','2','','2024-04-23','2024-02-16 06:32:36','2024-02-18 12:58:43'),(2,'Farhan','Know','2','2004-12-04','malir','medical','000002','5','7','4','','2024-02-19','2024-02-16 06:33:39','2024-02-18 13:08:36'),(3,'usama','Nhi Chahiye','2','2024-02-17','malir','medical','000003','5','4','4',NULL,'2024-02-21','2024-02-17 07:39:22','2024-02-18 06:06:41'),(5,'Farhan','Nhi Chahiye','4','2021-10-29','malir','medical','000004','5','6','8','Wound Care','2024-02-24','2024-02-18 05:55:15','2024-02-19 07:03:24'),(7,'haris','Nhi Chahiye','4','2015-08-26','malir','medical','000005','1','7','2','Incontinence',NULL,'2024-02-18 05:56:57','2024-02-18 06:16:51'),(8,'ali','Know','1','2016-08-27','malir','medical','000006','1','7','7','Diabetic','2024-02-25','2024-02-18 12:35:25','2024-02-18 14:17:39'),(9,'test','test','4','2024-02-18','malir','medical','000007','1','4','2',NULL,NULL,'2024-02-18 12:36:29','2024-02-19 07:33:44'),(10,'Atif','test','1','2017-07-26','malir','medical','000008','5','5','8',NULL,NULL,'2024-02-19 10:03:34','2024-02-19 10:03:34'),(11,'aman','Medic','2','2016-12-25','malir','medical','000009','5','6','8',NULL,NULL,'2024-02-21 03:21:56','2024-02-21 03:21:56'),(12,'aman','Medic','2','2016-12-25','malir','medical','000010','5','6','8','Diabetic','2024-02-21','2024-02-21 03:48:10','2024-02-21 03:48:10'),(13,'usama','Know','2','2024-02-21','malir','medical','89','2','4','2','Incontinence',NULL,'2024-02-21 03:51:52','2024-02-21 05:46:55');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Pending','2024-02-15 06:06:11','2024-02-15 06:06:11'),(2,'Waiting For Auth','2024-02-15 06:06:33','2024-02-16 14:45:09'),(3,'Auth Denied','2024-02-15 06:06:45','2024-02-15 06:06:45'),(4,'Sent For Billing','2024-02-15 06:06:59','2024-02-15 06:06:59'),(5,'Resupply','2024-02-15 06:07:15','2024-02-15 06:07:15'),(6,'Cancelled','2024-02-15 06:07:24','2024-02-15 06:07:24'),(7,'Completed','2024-02-15 06:07:33','2024-02-15 06:07:33');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `Dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `max_pending_order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'farhan1','farhan1@gmail.com','$2y$10$A9ssyPYVRvhBmTzV8b6g9upeti6YGc.uttuAWW7w4ucyAGOb5FlD.','0','0','[\"3\",\"4\",\"7\"]','12','2024-02-15 05:56:23','2024-02-16 15:37:57'),(3,'farhan 2','farhanatif204@gmail.com','$2y$12$UfVBLrLh381C1S8o1UQJEe2yGD4/CJMPFscR7WIr91tkAan9Vva2W','2','0','null',NULL,'2024-02-15 05:58:57','2024-02-17 05:25:06'),(4,'test','farhanatif9990@gmail.com','$2y$12$tXdfgUWVCPMmfoSUBFLPZukrEyAJOPpxVfLNG2ZGpbWk5PrXDApvm','0','0','[\"3\",\"4\"]','12','2024-02-16 13:56:36','2024-02-16 14:04:18'),(6,'usama','farhanatif020@gmail.com','$2y$12$uYkAenr3xsT0wB17spyh5OFFBFCTSzO67gcOkeae0krLmFWdbRqaS','1','0',NULL,NULL,'2024-02-16 14:22:19','2024-02-16 15:37:17'),(7,'kamran','kamranbinahsan@gmail.com','$2y$12$4g7yxv9TZx1W9uccyUVKBOVW19eKCIRGas1duFmYySCDy5p5GXpra','2','0',NULL,NULL,'2024-02-18 14:01:17','2024-02-18 14:22:56'),(8,'Laraib','laraib@gmail.com','$2y$12$u5Tlm90bk9TWZVU.kzGB.eUZ.fNsUmIrDTpVc8tnm6sFyksWoUpzO','0','0','[\"5\",\"6\"]','12','2024-02-19 06:57:39','2024-02-19 06:57:39');
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

