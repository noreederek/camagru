-- MySQL dump 10.13  Distrib 8.0.19, for osx10.14 (x86_64)
--
-- Host: localhost    Database: camagru
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Current Database: `camagru`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `camagru` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `camagru`;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `id_photo` int DEFAULT NULL,
  `comments` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_user` (`id_user`),
  KEY `id_photo` (`id_photo`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `persons` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id_photo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,1,'Good photo!'),(2,3,2,'interesting'),(3,3,3,'strange'),(4,5,3,'beautiful))'),(5,5,4,'Cool picture!'),(6,2,4,'Just try to leave comment)'),(7,5,4,'beautiful picture)'),(8,3,4,'good)'),(10,5,5,'vululu'),(11,3,5,'wabaladalaptap)'),(12,2,5,'qwe!'),(13,4,5,'Im here'),(14,3,5,'camagru working comment'),(15,6,7,'top style photo'),(16,5,11,'RRRRRRR!!!'),(17,3,11,'AAA!!'),(20,1,3,'Perfecto!');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filters`
--

DROP TABLE IF EXISTS `filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filters` (
  `id_filter` int NOT NULL AUTO_INCREMENT,
  `path_filter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_filter`),
  UNIQUE KEY `path_filter` (`path_filter`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filters`
--

LOCK TABLES `filters` WRITE;
/*!40000 ALTER TABLE `filters` DISABLE KEYS */;
INSERT INTO `filters` VALUES (1,'img/filtres/1.png'),(10,'img/filtres/10.png'),(11,'img/filtres/11.png'),(12,'img/filtres/12.png'),(13,'img/filtres/13.png'),(14,'img/filtres/14.png'),(15,'img/filtres/15.png'),(16,'img/filtres/16.png'),(17,'img/filtres/17.png'),(18,'img/filtres/18.png'),(19,'img/filtres/19.png'),(2,'img/filtres/2.png'),(20,'img/filtres/20.png'),(21,'img/filtres/21.png'),(22,'img/filtres/22.png'),(23,'img/filtres/23.png'),(24,'img/filtres/24.png'),(25,'img/filtres/25.png'),(26,'img/filtres/26.png'),(27,'img/filtres/27.png'),(28,'img/filtres/28.png'),(3,'img/filtres/3.png'),(4,'img/filtres/4.png'),(5,'img/filtres/5.png'),(6,'img/filtres/6.png'),(7,'img/filtres/7.png'),(8,'img/filtres/8.png'),(9,'img/filtres/9.png');
/*!40000 ALTER TABLE `filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id_user` int DEFAULT NULL,
  `id_photo` int DEFAULT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_photo` (`id_photo`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `persons` (`id`),
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_photo`) REFERENCES `photos` (`id_photo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (5,1),(2,1),(3,2),(1,4),(3,4),(4,4),(5,4),(6,4),(1,5),(2,5),(5,5),(3,5),(4,6),(4,7),(4,8),(4,9),(4,10),(4,11),(4,12),(5,15),(1,3),(1,2),(10,7),(10,27),(10,3);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `roles` varchar(20) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `activationtok` varchar(300) NOT NULL,
  `activationstatus` varchar(255) DEFAULT NULL,
  `comgetflag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `activationtok` (`activationtok`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'admin','admin@admin.ru','admin','c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec','NULL','aaaaa','activated','send'),(2,'nderek','nderek@nderek.ru','user','6c995df83843f2c5cdc17b404d44fa8dc27fc34f97fa625ee8c6de7f171578037c0e79dc929b19dc612c91b1002d2a9da77fcb962f464fcff80c78490b6beb0e','NULL','aaaaaa','notactivated','send'),(3,'wlipia','wlipia@wlipia.ru','user','d38bab25c2ef0a9714c649dc274015f55f115aa43db1dababa7ce1754dfcbc92276445c509a23104800e1c5af562812305c4b36fb3588eda0fa0e075d8527280','NULL','aaaaaaa','activated','send'),(4,'unicolle','unicolle@unicolle.ru','user','b42b50eb04d6b13ed148a47c93ca88b524bd194df7a5646e6d500c55809a6a3a043722c75e616a4d7d65feaf5ec7d7f7483d4df8e64aa444a3f2a525ba3873d3','NULL','aaaaaaaa','activated','send'),(5,'qwerty','qwerty@qwerty.ru','user','95ff55f6833d336bebdc170c258960786e6079a789fa29364e28ff0263b0ce685d97a369332c2effa7b875c91a9ea376a2f55f5c41ca2bdb35f30956e744b168','NULL','aaaaaaaaa','activated','send'),(6,'sscottie','sscottie@sscottie.ru','user','32e7b2c7b085b95d74e522b8273fe4635609e3f1e876e5ab96ed5cd0c1cf5bb8b46ba36d50ec8833a4de34b9e60624998d57a41825bc42f7bd1082a6b1209db8','NULL','aaaaaaaaaa','activated','send'),(8,'testyyy','testyyy@ageokfc.com','user','d2ddfefbd1c7611813dadfbd3a3718ac41c1ab6217290b1df42d721aa9e8f89fa740dd2c7d9dc6fe986e325aba77f599f05caa851568e5834fe7983d75aefd3c',NULL,'6f4884260efadc16c1239761fd516ac1','activated','stopsend'),(9,'Altusar','altusar.v.p@gmail.com','user','1389f9dd9d1550fe538616397756765d3ea4c79f5ec8004424239ba3f80c6573d6036d6088e8af0e421eb2c7cfbe63a7f15e644b586dd191b789149e53223146',NULL,'7cdea90740d2eb67d4f080b94e6bff6d','activated','send'),(10,'vovasag742','vovasag742@mailer2.net','user','0431fdf517e60dddb3448c7dbf297be7cf6cecd37cc980617da51f40ccda058410e25fdf13ac6a4fcbe1b16be7a8666a502681eab5e163d5ed9bb8d80fe0618a',NULL,'f0ef8d7f06422e15cbda7857c018979b','activated','send'),(11,'zxcvbn123','zxcvbn123@mailer2.net','user','4fd5ce8af9c3568dd58d05c79c1e74a29c383fdcaf6c670936d6f36ce5e67819aff0a5bcf0602e66f7a871133110a3ca3cebb3440213b28e958c3a6785ea573a',NULL,'db1423bd90071996632f8343167495af','activated','send'),(12,'asdfgh123','asdfgh123@mailer2.net','user','dfbd86405317a881e52051a9ecdeecb10fd968ed30869ffddbbd1916bb62b9af552246e34a4f4d22a88acf5badfb694525a111e66d3ab9506ff4a963796d097b',NULL,'2ae7289bacfff5f2f814bdbcbcfe63cc','activated','send'),(13,'poiuyt123','poiuyt123@mailer2.net','user','b6c23d90521bd060c32767585c63805304b1847a549117fd8a493287213f7a6d15e4668b6219f892857652f6090771b0ee0cbf6db1ecd4b3164edf3ebc65b181',NULL,'29aeaa21a4a1c9ec9d1c8f1f3cf1f44f','activated','send');
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photos` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `date_upload` int DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `geopos` varchar(255) DEFAULT NULL,
  `datetextformat` varchar(255) DEFAULT NULL,
  `postauthor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_photo`),
  UNIQUE KEY `link` (`link`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `persons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (1,1504523502,'img/galerie/1.jpg',2,'Russia - Moscow','15TH OF JULY 2020 10:15','nderek'),(2,1504513602,'img/galerie/2.jpg',2,'Russia - Nizhniy Novgorod','15TH OF JULY 2020 10:16','nderek'),(3,1504594102,'img/galerie/3.jpg',2,'Russia - Perm','15TH OF JULY 2020 10:17','nderek'),(4,1504507802,'img/galerie/4.jpg',2,'Russia - Perm','15TH OF JULY 2020 10:17','nderek'),(5,1504503892,'img/galerie/5.jpg',3,'Russia - Moscow','15TH OF JULY 2020 10:18','wlipia'),(6,1504403602,'img/galerie/6.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(7,1504413602,'img/galerie/7.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(8,1504403632,'img/galerie/8.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(9,1504403602,'img/galerie/9.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(10,1504343602,'img/galerie/10.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(11,1504359602,'img/galerie/11.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(12,1504139602,'img/galerie/12.jpg',4,'Russia - Moscow','15TH OF JULY 2020 10:15','unicolle'),(13,1504314602,'img/galerie/13.jpg',5,'Russia - Moscow','15TH OF JULY 2020 10:15','qwerty'),(14,1504103182,'img/galerie/14.jpg',5,'Russia - Moscow','15TH OF JULY 2020 10:15','qwerty'),(15,1504407302,'img/galerie/15.jpg',6,'Russia - Moscow','15TH OF JULY 2020 10:15','sscottie'),(27,1595026533,'img/galerie/15950265331.png',1,' Russia - Moscow ','18th of July 2020 01:55','admin');
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-18  6:08:50
