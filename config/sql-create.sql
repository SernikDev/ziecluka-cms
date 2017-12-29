DROP DATABASE IF EXISTS `mvcproject`;

CREATE DATABASE `mvcproject` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mvcproject`;

CREATE TABLE `alias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `blog` (
  `blog_id` int(10) NOT NULL AUTO_INCREMENT,
  `blog_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `blog_content` text CHARACTER SET utf8,
  `blog_author_id` smallint(1) DEFAULT NULL,
  `blog_create_date` datetime DEFAULT NULL,
  `blog_seo_title` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `blog_url` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `blog_seo_description` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `blog_image_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

CREATE TABLE `seo` (
  `pid` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `upload` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(300) DEFAULT NULL,
  `size` int(10) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `born_date` date DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `account_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
