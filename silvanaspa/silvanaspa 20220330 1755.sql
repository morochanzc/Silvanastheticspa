-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.36


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema silvanaspa
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ silvanaspa;
USE silvanaspa;

--
-- Table structure for table `silvanaspa`.`agenda`
--

DROP TABLE IF EXISTS `agenda`;
CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`agenda`
--

/*!40000 ALTER TABLE `agenda` DISABLE KEYS */;
INSERT INTO `agenda` (`id`,`nombre`,`descripcion`,`activo`) VALUES 
 (1,'Dra. Silvana','Gerente y Doctora del centro de estetica y SPA',1);
/*!40000 ALTER TABLE `agenda` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE `anuncio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensaje` text COLLATE utf8mb4_unicode_ci,
  `fecharegistro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`anuncio`
--

/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`anuncio_usuario`
--

DROP TABLE IF EXISTS `anuncio_usuario`;
CREATE TABLE `anuncio_usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `anuncio_id` bigint(20) DEFAULT NULL,
  `visto` tinyint(1) DEFAULT NULL,
  `fecha_lectura` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Anunciousuario_FKIndex2` (`anuncio_id`),
  KEY `Anunciousuario_FKIndex1` (`usuario_id`),
  CONSTRAINT `FK_59F9287B963066FD` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncio` (`id`),
  CONSTRAINT `FK_59F9287BDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`anuncio_usuario`
--

/*!40000 ALTER TABLE `anuncio_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio_usuario` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`cita`
--

DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracion_id` int(11) NOT NULL,
  `agenda_id` int(11) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3E379A6295C02598` (`duracion_id`),
  KEY `IDX_3E379A62EA67784A` (`agenda_id`),
  KEY `IDX_3E379A62DB38439E` (`usuario_id`),
  CONSTRAINT `FK_3E379A6295C02598` FOREIGN KEY (`duracion_id`) REFERENCES `duracion` (`id`),
  CONSTRAINT `FK_3E379A62DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_3E379A62EA67784A` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`cita`
--

/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`descanso`
--

DROP TABLE IF EXISTS `descanso`;
CREATE TABLE `descanso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` time NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`descanso`
--

/*!40000 ALTER TABLE `descanso` DISABLE KEYS */;
INSERT INTO `descanso` (`id`,`nombre`,`duracion`,`activo`) VALUES 
 (1,'Almuerzo','01:00:00',1);
/*!40000 ALTER TABLE `descanso` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`descanso_agenda`
--

DROP TABLE IF EXISTS `descanso_agenda`;
CREATE TABLE `descanso_agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agenda_id` int(11) NOT NULL,
  `descanso_id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_993EAC27EA67784A` (`agenda_id`),
  KEY `IDX_993EAC2770068B39` (`descanso_id`),
  CONSTRAINT `FK_993EAC2770068B39` FOREIGN KEY (`descanso_id`) REFERENCES `descanso` (`id`),
  CONSTRAINT `FK_993EAC27EA67784A` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`descanso_agenda`
--

/*!40000 ALTER TABLE `descanso_agenda` DISABLE KEYS */;
INSERT INTO `descanso_agenda` (`id`,`agenda_id`,`descanso_id`,`hora_inicio`,`hora_fin`) VALUES 
 (1,1,1,'12:30:00','13:30:00');
/*!40000 ALTER TABLE `descanso_agenda` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`duracion`
--

DROP TABLE IF EXISTS `duracion`;
CREATE TABLE `duracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` time NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`duracion`
--

/*!40000 ALTER TABLE `duracion` DISABLE KEYS */;
/*!40000 ALTER TABLE `duracion` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`estado`
--

/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`estado_usuario`
--

DROP TABLE IF EXISTS `estado_usuario`;
CREATE TABLE `estado_usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`estado_usuario`
--

/*!40000 ALTER TABLE `estado_usuario` DISABLE KEYS */;
INSERT INTO `estado_usuario` (`id`,`nombre`) VALUES 
 (1,'Activo');
/*!40000 ALTER TABLE `estado_usuario` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agenda_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `festivo` tinyint(1) DEFAULT NULL,
  `dia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E25853A3EA67784A` (`agenda_id`),
  CONSTRAINT `FK_E25853A3EA67784A` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`id`,`agenda_id`,`fecha`,`festivo`,`dia`,`hora_inicio`,`hora_fin`,`duracion`) VALUES 
 (1,1,'2020-11-02',1,'',NULL,NULL,NULL),
 (2,1,'2020-11-16',1,'',NULL,NULL,NULL),
 (3,1,NULL,0,'Lunes','08:00:00','18:00:00',NULL),
 (4,1,NULL,0,'Martes','08:00:00','18:00:00',NULL),
 (5,1,NULL,0,'Miercoles','08:00:00','18:00:00',NULL),
 (6,1,NULL,0,'Jueves','08:00:00','18:00:00',NULL),
 (7,1,NULL,0,'Viernes','08:00:00','18:00:00',NULL);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`login_log`
--

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LoginLog_FKIndex1` (`usuario_id`),
  CONSTRAINT `FK_F16D9FFFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`login_log`
--

/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`medidas`
--

DROP TABLE IF EXISTS `medidas`;
CREATE TABLE `medidas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `staff_id` bigint(20) DEFAULT NULL,
  `cuello` double DEFAULT NULL,
  `hombro` double DEFAULT NULL,
  `pecho` double DEFAULT NULL,
  `brazo` double DEFAULT NULL,
  `antebrazo` double NOT NULL,
  `cintura` double DEFAULT NULL,
  `gluteos` double DEFAULT NULL,
  `pierna` double DEFAULT NULL,
  `pantorrilla` double DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `pesokg` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`),
  KEY `Medidas_FKIndex1` (`usuario_id`),
  CONSTRAINT `FK_FF9C1C2AD4D57CD` FOREIGN KEY (`staff_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_FF9C1C2ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`medidas`
--

/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `padre_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Menu_FKIndex1` (`padre_id`),
  CONSTRAINT `FK_7D053A93613CEC58` FOREIGN KEY (`padre_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`,`padre_id`,`nombre`,`ruta`,`icono`) VALUES 
 (1,NULL,'Administración',NULL,'fas fa-fw fa-cog'),
 (2,1,'Usuarios','usuario_list','fas fa-fw fa-user'),
 (3,1,'Agendas','agenda_list','fas fa-fw fa-calendar-alt'),
 (4,1,'Descansos','descanso_list','fas fa-fw fa-business-time'),
 (5,1,'Horarios','horario_list','fas fa-fw fa-clock'),
 (6,NULL,'Parametrizar',NULL,'fas fa-fw fa-chalkboard-teacher'),
 (7,6,'Agendas','agenda_panel','fas fa-fw fa-calendar-alt');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`menu_rol`
--

DROP TABLE IF EXISTS `menu_rol`;
CREATE TABLE `menu_rol` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rol_id` bigint(20) DEFAULT NULL,
  `menu_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MenuRol_FKIndex2` (`menu_id`),
  KEY `MenuRol_FKIndex1` (`rol_id`),
  CONSTRAINT `FK_96F4F1054BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  CONSTRAINT `FK_96F4F105CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`menu_rol`
--

/*!40000 ALTER TABLE `menu_rol` DISABLE KEYS */;
INSERT INTO `menu_rol` (`id`,`rol_id`,`menu_id`) VALUES 
 (1,1,1),
 (2,1,2),
 (3,1,3),
 (4,1,4),
 (5,1,6),
 (6,1,5),
 (7,1,7);
/*!40000 ALTER TABLE `menu_rol` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) DEFAULT NULL,
  `fecha_genera_recibo` datetime DEFAULT NULL,
  `precio` int(10) unsigned DEFAULT NULL,
  `impuestos` int(10) unsigned DEFAULT NULL,
  `descuentos` int(10) unsigned DEFAULT NULL,
  `dias_operacion` bigint(20) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `soporte_pago` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_validacion_pago` datetime DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_final` datetime DEFAULT NULL,
  `anulado` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pagos_FKIndex1` (`usuario_id`),
  CONSTRAINT `FK_DA9B0DFFDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`pagos`
--

/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_producto_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` int(10) unsigned DEFAULT NULL,
  `creditos` int(10) unsigned DEFAULT NULL COMMENT 'creditos que aporta el producto.',
  `fecha_registro` datetime DEFAULT NULL,
  `imagen_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Producto_FKIndex1` (`tipo_producto_id`),
  CONSTRAINT `FK_A7BB061543614776` FOREIGN KEY (`tipo_producto_id`) REFERENCES `tipo_producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`producto`
--

/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`rol`
--

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id`,`nombre`,`descripcion`) VALUES 
 (1,'ROLE_ADMIN','Administrador'),
 (2,'ROLE_DIRECTOR','Director'),
 (3,'ROLE_USUARIO','Usuario'),
 (4,'ROLE_CLIENTE','Cliente');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`tipo_identificacion`
--

DROP TABLE IF EXISTS `tipo_identificacion`;
CREATE TABLE `tipo_identificacion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`tipo_identificacion`
--

/*!40000 ALTER TABLE `tipo_identificacion` DISABLE KEYS */;
INSERT INTO `tipo_identificacion` (`id`,`nombre`) VALUES 
 (1,'Cédula de Ciudadanía'),
 (2,'Cédula de Extranjería'),
 (3,'Pasaporte'),
 (4,'Tarjeta de Identidad'),
 (5,'NIT');
/*!40000 ALTER TABLE `tipo_identificacion` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE `tipo_producto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`tipo_producto`
--

/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo_identificacion_id` bigint(20) DEFAULT NULL,
  `rol_id` bigint(20) DEFAULT NULL,
  `estado_usuario_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_cambio_pass` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `creditos` int(10) unsigned DEFAULT NULL,
  `terminos_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_aceptacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2265B05D65478DC6` (`tipo_identificacion_id`),
  KEY `IDX_2265B05D4BAB96C` (`rol_id`),
  KEY `IDX_2265B05D6280DDFF` (`estado_usuario_id`),
  CONSTRAINT `FK_2265B05D4BAB96C` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  CONSTRAINT `FK_2265B05D6280DDFF` FOREIGN KEY (`estado_usuario_id`) REFERENCES `estado_usuario` (`id`),
  CONSTRAINT `FK_2265B05D65478DC6` FOREIGN KEY (`tipo_identificacion_id`) REFERENCES `tipo_identificacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`tipo_identificacion_id`,`rol_id`,`estado_usuario_id`,`nombre`,`apellido`,`identificacion`,`direccion`,`telefono`,`celular`,`correo`,`foto`,`login`,`clave`,`fecha_registro`,`fecha_cambio_pass`,`activo`,`creditos`,`terminos_path`,`fecha_aceptacion`) VALUES 
 (1,1,1,1,'Javier','Zamora C.','6390105','Cra. 4 # 11A-25','4865081','3176396377','jzamora@mcc.com.co',NULL,'jzamora','$argon2id$v=19$m=65536,t=4,p=1$MEZZMGkwOGpwUlZ5RXBMeg$+R/wvxjqRj2AHffFnSRzhY90su4fkl3z5uZGesI2SF4',NULL,NULL,1,NULL,NULL,NULL),
 (2,1,2,1,'Lauren Silvana','Valencia Artunduaga','25531264','Carrera 4 #11A-25, Miranda, Cauca','8475030','3207822706','silvana.valencia@gmail.com',NULL,'lsvalencia','$argon2id$v=19$m=65536,t=4,p=1$RHRJQ0g5REM3VjBaMEc3bQ$8xCOpB/qxqisaUK2LQB10DlE7Ebg6CbfJfbhndKLgJA','2020-05-22 20:17:00','2020-05-22 20:21:46',1,NULL,NULL,NULL),
 (3,4,4,1,'Juan David','Zamora','1109184680','Carrera 4 #11A-25','3127974488','3127974488','juanda555@gmail.com',NULL,'jdzamora','$argon2id$v=19$m=65536,t=4,p=1$L2ljRTVVY2hpSlQ4dHNJaQ$7J6GSVAB4K6lHSiEsVS/g+bwiINZ+NYHglo7fuIt2mI','2021-05-03 18:01:50','2021-05-03 18:01:50',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Table structure for table `silvanaspa`.`venta_productos`
--

DROP TABLE IF EXISTS `venta_productos`;
CREATE TABLE `venta_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `producto_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) DEFAULT NULL,
  `precio` bigint(20) DEFAULT NULL,
  `creditos` int(10) unsigned DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venta_productos_FKIndex2` (`usuario_id`),
  KEY `VentaProductos_FKIndex1` (`producto_id`),
  CONSTRAINT `FK_616A90ED7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  CONSTRAINT `FK_616A90EDDB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `silvanaspa`.`venta_productos`
--

/*!40000 ALTER TABLE `venta_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_productos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
