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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `device` */

insert  into `device`(`id`,`uid`,`name`,`cost`,`range`,`status`) values (8,'sdkgs','kkasdfk',22455,12,1),(9,'452','ps3',22222,12,0),(23,'jii','jkk',65,12,0),(25,'adf','adfadf',7533,11,0),(26,'46345','356',3456,11,0),(27,'356','3563',7533,11,0),(28,'456','4564',8000,11,0),(32,'sdfgsd','sadgsdf',8000,12,0);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`unit`,`cost`) values (16,'cafe Ä‘en Ä‘Ã¡ ','ly',10000),(17,'cafe sua','ly',15000);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device` int(11) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `stop` int(11) DEFAULT NULL,
  `surcharge` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

/*Data for the table `payment` */

insert  into `payment`(`id`,`device`,`start`,`stop`,`surcharge`,`discount`,`comment`,`status`,`date`) values (55,8,1343813646,1343813647,0,0,'',0,1343813646),(56,8,1343813696,1343813698,0,0,'',0,1343813696),(57,8,1343813701,1343813702,0,0,'',0,1343813701),(58,8,1343813732,0,0,0,'',1,1343813732);

/*Table structure for table `payment_menu` */

DROP TABLE IF EXISTS `payment_menu`;

CREATE TABLE `payment_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment` int(11) DEFAULT NULL,
  `menu` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

/*Data for the table `payment_menu` */

insert  into `payment_menu`(`id`,`payment`,`menu`,`number`,`date`) values (51,45,16,1,1343812390),(52,45,17,1,1343812390),(53,45,16,1,1343812410),(54,45,17,1,1343812410),(55,49,16,1,1343812596),(56,49,17,1,1343812596),(57,51,16,1,1343812637),(58,51,17,1,1343812637),(59,52,16,1,1343812666),(60,52,17,1,1343812666),(61,54,16,1,1343813625),(62,54,17,1,1343813625),(63,57,16,1,1343813706),(64,57,17,1,1343813706);

/*Table structure for table `range` */

DROP TABLE IF EXISTS `range`;

CREATE TABLE `range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `range` */

insert  into `range`(`id`,`name`) values (11,'Day 1'),(12,'Day 2'),(13,'Day 3'),(14,'DÃ£y 4');

/*Table structure for table `system` */

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `var` varchar(255) NOT NULL,
  `val` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`var`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `system` */

insert  into `system`(`var`,`val`) values ('default_cost','8000'),('default_unit','0.5');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
