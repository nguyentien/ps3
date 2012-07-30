/*
SQLyog Ultimate v9.50 
MySQL - 5.5.16 : Database - ps3
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ps3` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `ps3`;

/*Table structure for table `device` */

DROP TABLE IF EXISTS `device`;

CREATE TABLE `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `range` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `device` */

insert  into `device`(`id`,`uid`,`name`,`cost`,`range`,`status`) values (8,'sdkgs','kkasdfk',224,12,NULL),(9,'452','ps3',22222,12,NULL),(23,'jii','jkk',65,12,NULL),(24,'wert','wert',0,12,NULL),(25,'adf','adfadf',7533,11,NULL),(26,'46345','356',3456,11,NULL),(27,'356','3563',7533,11,NULL),(28,'456','4564',8000,11,NULL),(31,'sdg','may 1',8000,11,NULL);

/*Table structure for table `extra` */

DROP TABLE IF EXISTS `extra`;

CREATE TABLE `extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `extra` */

insert  into `extra`(`id`,`name`,`unit`,`cost`) values (12,'cafe den da','ly',19000),(13,'cafe sua da ddfg','ly',16000),(14,'hfgh','gsdfsdf',18000),(15,'com ga','44',4447);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `stop` int(11) DEFAULT NULL,
  `surcharge` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment` */

/*Table structure for table `payment_extra` */

DROP TABLE IF EXISTS `payment_extra`;

CREATE TABLE `payment_extra` (
  `payment` int(11) NOT NULL,
  `extra` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment`,`extra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `payment_extra` */

/*Table structure for table `range` */

DROP TABLE IF EXISTS `range`;

CREATE TABLE `range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `range` */

insert  into `range`(`id`,`name`) values (11,'Day 1'),(12,'Day 2'),(13,'Day 3'),(14,'Day 4'),(16,'adf');

/*Table structure for table `system` */

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `var` varchar(255) NOT NULL,
  `val` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system` */

insert  into `system`(`var`,`val`) values ('default_cost','345'),('default_unit','1');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
