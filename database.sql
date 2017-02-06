/*
SQLyog Enterprise - MySQL GUI v7.15 
MySQL - 5.6.31 : Database - blog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`blog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `blog`;

/*Table structure for table `User` */

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `User` */

insert  into `User`(`id`,`Email`,`FirstName`,`Password`) values (25,'salsero199_1@mail.ru','gena','eeee'),(28,'andrewtachilin@gmail.com','Андрей','g'),(29,'salsero199_1@mail.ru','eqwewq','eqweqw');

/*Table structure for table `activity` */

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `User_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `activity` */

insert  into `activity`(`User_id`,`title`,`post`,`tag`,`post_id`) values (28,'false','qweqwe','false',2),(29,'okey','okeyqweq,12,12,32','okey',3),(30,'post','post','post',4),(30,'andrew','AAAAA','rrrr',16),(34,'andrew','AAAAA','rrrr',17),(36,'andrew','AAAAA','rrrr',18),(37,'andrew','AAAAA','rrrr',19),(3,'andrew','AAAAA','rrrr',20),(38,'andrew','AAAAA','rrrr',21);

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

insert  into `comments`(`id`,`text`,`post_id`,`parent_id`) values (148,'eqweqwewq','3',143),(149,'r','3',144),(150,'ttt','3',148),(152,'rew','3',151),(153,'werw','3',148),(159,'qwe','3',148),(164,'rere','3',150),(165,'wqre','3',152),(166,'rwrwq','3',148),(167,'rere','3',150),(169,'eqweq','3',165),(175,'eqweq','3',167),(178,'2131','3',148),(186,'qqqqqqq','3',148),(193,'eqw333','3',0),(194,'eqw333','3',0),(195,'opa-na','3',0),(196,'qqqqqqq','3',186),(197,'111111eqweq','3',0),(198,'rewe','3',196),(199,'eqw ew','3',148),(200,'eqweqw','3',0),(201,'222222222','3',0),(202,'3',NULL,NULL);

/*Table structure for table `post_to_tag` */

DROP TABLE IF EXISTS `post_to_tag`;

CREATE TABLE `post_to_tag` (
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `post_to_tag` */

insert  into `post_to_tag`(`post_id`,`tag_id`) values (3,1),(3,2),(3,3),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0),(3,0);

/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id_tag` (`id_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

insert  into `tag`(`id_tag`,`text`) values (1,'rewerw'),(2,'qwe'),(3,'222'),(4,'3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
