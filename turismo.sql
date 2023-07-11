-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: turismo
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `capacitacion`
--

DROP TABLE IF EXISTS `capacitacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `capacitacion` (
  `IdCapacitacion` int NOT NULL AUTO_INCREMENT,
  `IdEstablecimiento` int DEFAULT NULL,
  `NombreCapacitacion` varchar(100) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  PRIMARY KEY (`IdCapacitacion`),
  KEY `fk_Capacitacion_Establecimiento` (`IdEstablecimiento`),
  CONSTRAINT `fk_Capacitacion_Establecimiento` FOREIGN KEY (`IdEstablecimiento`) REFERENCES `establecimiento` (`IdEstablecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capacitacion`
--

LOCK TABLES `capacitacion` WRITE;
/*!40000 ALTER TABLE `capacitacion` DISABLE KEYS */;
INSERT INTO `capacitacion` VALUES (1,1,'ORATORIA','2023-09-12');
/*!40000 ALTER TABLE `capacitacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correo`
--

DROP TABLE IF EXISTS `correo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `correo` (
  `IdCorreo` int NOT NULL AUTO_INCREMENT,
  `IdResponsableRemitente` int DEFAULT NULL,
  `IdResponsableDestinatario` int DEFAULT NULL,
  `Asunto` varchar(255) DEFAULT NULL,
  `Cuerpo` text,
  `Fecha` date DEFAULT NULL,
  PRIMARY KEY (`IdCorreo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correo`
--

LOCK TABLES `correo` WRITE;
/*!40000 ALTER TABLE `correo` DISABLE KEYS */;
/*!40000 ALTER TABLE `correo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destino_turistico`
--

DROP TABLE IF EXISTS `destino_turistico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destino_turistico` (
  `IdDestinoTuristico` int NOT NULL AUTO_INCREMENT,
  `NombreDestino` varchar(100) DEFAULT NULL,
  `Distrito` varchar(100) DEFAULT NULL,
  `Provincia` varchar(100) DEFAULT NULL,
  `Departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdDestinoTuristico`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destino_turistico`
--

LOCK TABLES `destino_turistico` WRITE;
/*!40000 ALTER TABLE `destino_turistico` DISABLE KEYS */;
INSERT INTO `destino_turistico` VALUES (1,'HUANUCO','PILLCOMARCA','PASASA','CUSCO'),(2,'LIMA','COMAS','LINCE','CALLAO');
/*!40000 ALTER TABLE `destino_turistico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `establecimiento` (
  `IdEstablecimiento` int NOT NULL AUTO_INCREMENT,
  `NombreEstablecimiento` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `IdDestinoTuristico` int DEFAULT NULL,
  `IdResponsable` int DEFAULT NULL,
  `IdUsuario` int DEFAULT NULL,
  `FechaAsignacion` date DEFAULT NULL,
  PRIMARY KEY (`IdEstablecimiento`),
  KEY `fk_Establecimiento_Destino_Turistico` (`IdDestinoTuristico`),
  KEY `fk_Establecimiento_Responsable` (`IdResponsable`),
  KEY `fk_Establecimiento_Usuario` (`IdUsuario`),
  CONSTRAINT `fk_Establecimiento_Destino_Turistico` FOREIGN KEY (`IdDestinoTuristico`) REFERENCES `destino_turistico` (`IdDestinoTuristico`),
  CONSTRAINT `fk_Establecimiento_Responsable` FOREIGN KEY (`IdResponsable`) REFERENCES `responsable` (`IdResponsable`),
  CONSTRAINT `fk_Establecimiento_Usuario` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
INSERT INTO `establecimiento` VALUES (1,'WAPRI','JR 2 DE MAYO',1,2,1,'2023-07-11');
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responsable` (
  `IdResponsable` int NOT NULL AUTO_INCREMENT,
  `Dni` varchar(9) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdResponsable`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsable`
--

LOCK TABLES `responsable` WRITE;
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
INSERT INTO `responsable` VALUES (2,'74556677','perez','raul','123456');
/*!40000 ALTER TABLE `responsable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `Dni` varchar(9) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'72334455','jimenez','alejandro','123456789');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-11 18:31:17
