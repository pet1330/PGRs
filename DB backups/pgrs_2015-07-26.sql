# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.44-0ubuntu0.14.04.1)
# Database: pgrs
# Generation Time: 2015-07-26 16:07:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table absence
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absence`;

CREATE TABLE `absence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `absence_type_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `absence_absence_type_id_foreign` (`absence_type_id`),
  KEY `absence_student_id_foreign` (`student_id`),
  CONSTRAINT `absence_absence_type_id_foreign` FOREIGN KEY (`absence_type_id`) REFERENCES `absence_types` (`id`),
  CONSTRAINT `absence_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table absence_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absence_types`;

CREATE TABLE `absence_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `absence_types` WRITE;
/*!40000 ALTER TABLE `absence_types` DISABLE KEYS */;

INSERT INTO `absence_types` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Sick','The student is ill','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Holiday','The student is on holiday','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `absence_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table awards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `awards`;

CREATE TABLE `awards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `awards_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;

INSERT INTO `awards` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'MSc','Master of Science degree','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'MPhil','Master of Philosophy Degree','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'PhD','Doctor of Philosophy Degree','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Computer Science','Computer science is the scientific and practical approach to computation and its applications.','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table enrolment_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `enrolment_status`;

CREATE TABLE `enrolment_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `enrolment_status_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `enrolment_status` WRITE;
/*!40000 ALTER TABLE `enrolment_status` DISABLE KEYS */;

INSERT INTO `enrolment_status` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Applied','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Enrolled','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'Withdrawn','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Graduated','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `enrolment_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `gs_form_id` int(10) unsigned NOT NULL,
  `exp_start` date DEFAULT NULL,
  `exp_end` date DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `director_of_study_id` int(10) unsigned NOT NULL,
  `second_supervisor_id` int(10) unsigned DEFAULT NULL,
  `third_supervisor_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_student_id_foreign` (`student_id`),
  KEY `events_gs_form_id_foreign` (`gs_form_id`),
  KEY `events_director_of_study_id_foreign` (`director_of_study_id`),
  KEY `events_second_supervisor_id_foreign` (`second_supervisor_id`),
  KEY `events_third_supervisor_id_foreign` (`third_supervisor_id`),
  CONSTRAINT `events_director_of_study_id_foreign` FOREIGN KEY (`director_of_study_id`) REFERENCES `staff` (`id`),
  CONSTRAINT `events_gs_form_id_foreign` FOREIGN KEY (`gs_form_id`) REFERENCES `gs_forms` (`id`),
  CONSTRAINT `events_second_supervisor_id_foreign` FOREIGN KEY (`second_supervisor_id`) REFERENCES `staff` (`id`),
  CONSTRAINT `events_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `events_third_supervisor_id_foreign` FOREIGN KEY (`third_supervisor_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`id`, `student_id`, `gs_form_id`, `exp_start`, `exp_end`, `submitted_at`, `comments`, `director_of_study_id`, `second_supervisor_id`, `third_supervisor_id`, `created_at`, `updated_at`, `approved_at`)
VALUES
	(7,27,6,'2014-02-23','2014-08-23','2015-07-12 17:11:00','',2,NULL,NULL,'2015-07-12 17:12:14','2015-07-19 10:30:41',NULL),
	(8,81,3,'2014-11-30','2015-03-02','2015-07-12 17:55:00','',1,9,NULL,'2015-07-12 17:56:48','2015-07-12 17:56:48',NULL),
	(12,46,15,'2017-07-15',NULL,'2015-07-12 18:30:00','This is a comment about this specific event.',2,NULL,NULL,'2015-07-12 18:30:40','2015-07-16 11:19:01',NULL),
	(13,46,16,'2017-10-15',NULL,'2015-07-12 18:30:00','',2,NULL,NULL,'2015-07-12 18:30:57','2015-07-16 11:20:16',NULL),
	(17,46,4,NULL,NULL,'2015-07-13 09:26:00','',1,NULL,NULL,'2015-07-13 09:26:55','2015-07-13 09:26:55','2015-01-30 09:55:00'),
	(18,46,4,NULL,NULL,'2015-07-13 09:27:00','',1,NULL,NULL,'2015-07-13 09:27:28','2015-07-13 09:27:28','2015-02-20 09:27:00'),
	(19,46,4,NULL,NULL,'2015-07-13 09:27:00','',1,NULL,NULL,'2015-07-13 09:27:49','2015-07-13 09:27:49','2015-03-13 09:27:00'),
	(20,46,4,NULL,NULL,'2015-07-13 09:27:00','',1,NULL,NULL,'2015-07-13 09:28:19','2015-07-13 09:28:19','2015-04-24 09:28:00'),
	(21,46,4,NULL,NULL,'2015-07-13 09:28:00','',1,14,18,'2015-07-13 09:28:37','2015-07-13 17:11:27','2015-05-28 09:28:00'),
	(29,46,6,'2013-07-15','2014-04-15','2015-07-01 17:09:00','',2,NULL,NULL,'2015-07-13 17:09:37','2015-07-16 15:23:54','2015-07-16 15:23:00'),
	(31,46,4,NULL,NULL,'2015-07-13 17:24:00','This was a great meeting.',1,NULL,NULL,'2015-07-13 17:25:13','2015-07-14 09:30:45','2015-07-13 17:26:00'),
	(38,101,1,NULL,NULL,'2014-07-09 11:31:00','',2,NULL,NULL,'2015-07-14 11:31:54','2015-07-14 11:31:54','2014-08-13 11:31:00'),
	(39,101,3,'2014-11-01','2015-02-01','2015-07-14 11:32:00','',2,NULL,NULL,'2015-07-14 11:33:14','2015-07-14 11:34:33','2014-09-19 11:33:00'),
	(41,66,4,NULL,NULL,'2015-07-16 11:33:00','',2,NULL,NULL,'2015-07-16 11:33:41','2015-07-16 11:33:41','2015-07-16 11:33:00'),
	(44,46,15,'2015-10-03',NULL,NULL,'',2,NULL,NULL,'2015-07-16 15:53:09','2015-07-16 16:10:45',NULL),
	(45,69,4,NULL,NULL,'2015-07-17 09:39:00','',2,NULL,NULL,'2015-07-17 09:39:21','2015-07-17 09:39:21','2015-07-17 09:39:00'),
	(48,27,15,'2015-11-23',NULL,'2015-07-19 10:26:00','',2,NULL,NULL,'2015-07-19 10:26:28','2015-07-19 10:26:28','2015-07-17 10:26:00'),
	(49,27,1,NULL,NULL,NULL,'',18,NULL,NULL,'2015-07-19 10:29:34','2015-07-19 10:31:12',NULL),
	(51,46,4,'2015-08-19',NULL,NULL,'',2,NULL,NULL,'2015-08-19 15:30:35','2015-07-19 15:30:35',NULL),
	(52,72,15,'2010-01-27',NULL,'2015-07-19 18:35:00','',2,NULL,NULL,'2015-07-19 18:36:03','2015-07-19 18:36:35',NULL),
	(57,46,3,'2012-05-15',NULL,'2015-07-20 17:42:00','',2,NULL,NULL,'2015-07-20 17:42:24','2015-07-20 17:42:24','2015-07-20 17:42:00'),
	(64,6,15,'2015-12-26',NULL,NULL,'',2,NULL,NULL,'2015-07-21 12:19:39','2015-07-21 12:19:59',NULL),
	(65,45,2,NULL,NULL,NULL,'',2,NULL,NULL,'2015-07-21 12:20:33','2015-07-21 12:20:33',NULL),
	(112,1,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-08-05 00:00:00','2015-07-25 11:23:05',NULL),
	(113,1,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-08-05 00:00:00','2015-07-25 11:23:05',NULL),
	(114,1,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-08-05 00:00:00','2015-07-25 11:23:05',NULL),
	(115,2,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-04-24 00:00:00','2015-07-25 11:23:05',NULL),
	(116,2,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-04-24 00:00:00','2015-07-25 11:23:05',NULL),
	(117,2,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2018-04-24 00:00:00','2015-07-25 11:23:05',NULL),
	(118,3,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-07-06 00:00:00','2015-07-25 11:23:05',NULL),
	(119,3,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-07-06 00:00:00','2015-07-25 11:23:05',NULL),
	(120,3,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-07-06 00:00:00','2015-07-25 11:23:05',NULL),
	(121,4,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-10-12 00:00:00','2015-07-25 11:23:05',NULL),
	(122,4,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-10-12 00:00:00','2015-07-25 11:23:05',NULL),
	(123,4,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-10-12 00:00:00','2015-07-25 11:23:05',NULL),
	(124,5,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-01-14 00:00:00','2015-07-25 11:23:05',NULL),
	(125,5,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-01-14 00:00:00','2015-07-25 11:23:05',NULL),
	(126,5,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-01-14 00:00:00','2015-07-25 11:23:05',NULL),
	(127,6,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-12-26 00:00:00','2015-07-25 11:23:05',NULL),
	(128,6,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-12-26 00:00:00','2015-07-25 11:23:05',NULL),
	(129,6,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-12-26 00:00:00','2015-07-25 11:23:05',NULL),
	(130,6,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-12-26 00:00:00','2015-07-25 11:23:05',NULL),
	(131,6,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-12-26 00:00:00','2015-07-25 11:23:05',NULL),
	(132,7,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2009-07-17 00:00:00','2015-07-25 11:23:05',NULL),
	(133,7,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2010-07-17 00:00:00','2015-07-25 11:23:05',NULL),
	(134,7,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-07-17 00:00:00','2015-07-25 11:23:05',NULL),
	(135,8,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-12-30 00:00:00','2015-07-25 11:23:05',NULL),
	(136,8,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-12-30 00:00:00','2015-07-25 11:23:05',NULL),
	(137,8,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-12-30 00:00:00','2015-07-25 11:23:05',NULL),
	(138,9,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-04-25 00:00:00','2015-07-25 11:23:05',NULL),
	(139,9,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-04-25 00:00:00','2015-07-25 11:23:05',NULL),
	(140,9,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-04-25 00:00:00','2015-07-25 11:23:05',NULL),
	(141,10,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-08-14 00:00:00','2015-07-25 11:23:05',NULL),
	(142,10,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-08-14 00:00:00','2015-07-25 11:23:05',NULL),
	(143,10,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-08-14 00:00:00','2015-07-25 11:23:05',NULL),
	(144,10,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-08-14 00:00:00','2015-07-25 11:23:05',NULL),
	(145,10,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-08-14 00:00:00','2015-07-25 11:23:05',NULL),
	(146,11,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-12-27 00:00:00','2015-07-25 11:23:05',NULL),
	(147,11,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-12-27 00:00:00','2015-07-25 11:23:05',NULL),
	(148,11,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-12-27 00:00:00','2015-07-25 11:23:05',NULL),
	(149,11,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-12-27 00:00:00','2015-07-25 11:23:05',NULL),
	(150,11,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2018-12-27 00:00:00','2015-07-25 11:23:05',NULL),
	(151,12,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2009-10-13 00:00:00','2015-07-25 11:23:05',NULL),
	(152,12,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2010-10-13 00:00:00','2015-07-25 11:23:05',NULL),
	(153,12,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-10-13 00:00:00','2015-07-25 11:23:05',NULL),
	(154,14,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2012-07-09 00:00:00','2015-07-25 11:23:05',NULL),
	(155,14,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2013-07-09 00:00:00','2015-07-25 11:23:05',NULL),
	(156,14,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2014-07-09 00:00:00','2015-07-25 11:23:05',NULL),
	(157,15,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2012-09-04 00:00:00','2015-07-25 11:23:05',NULL),
	(158,15,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2013-09-04 00:00:00','2015-07-25 11:23:05',NULL),
	(159,15,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2014-09-04 00:00:00','2015-07-25 11:23:05',NULL),
	(160,15,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2015-09-04 00:00:00','2015-07-25 11:23:05',NULL),
	(161,15,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2016-09-04 00:00:00','2015-07-25 11:23:05',NULL),
	(162,16,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2015-02-06 00:00:00','2015-07-25 11:23:05',NULL),
	(163,16,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2016-02-06 00:00:00','2015-07-25 11:23:05',NULL),
	(164,16,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2017-02-06 00:00:00','2015-07-25 11:23:05',NULL),
	(165,16,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2018-02-06 00:00:00','2015-07-25 11:23:05',NULL),
	(166,16,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2019-02-06 00:00:00','2015-07-25 11:23:05',NULL),
	(167,17,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2009-11-20 00:00:00','2015-07-25 11:23:05',NULL),
	(168,17,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2010-11-20 00:00:00','2015-07-25 11:23:05',NULL),
	(169,17,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-11-20 00:00:00','2015-07-25 11:23:05',NULL),
	(170,18,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2011-03-22 00:00:00','2015-07-25 11:23:05',NULL),
	(171,18,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2012-03-22 00:00:00','2015-07-25 11:23:05',NULL),
	(172,18,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2013-03-22 00:00:00','2015-07-25 11:23:05',NULL),
	(173,19,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2009-12-03 00:00:00','2015-07-25 11:23:05',NULL),
	(174,19,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2010-12-03 00:00:00','2015-07-25 11:23:05',NULL),
	(175,19,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2011-12-03 00:00:00','2015-07-25 11:23:05',NULL),
	(176,19,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2012-12-03 00:00:00','2015-07-25 11:23:05',NULL),
	(177,19,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2013-12-03 00:00:00','2015-07-25 11:23:05',NULL),
	(178,20,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-02-04 00:00:00','2015-07-25 11:23:05',NULL),
	(179,20,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-02-04 00:00:00','2015-07-25 11:23:05',NULL),
	(180,20,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2018-02-04 00:00:00','2015-07-25 11:23:05',NULL),
	(181,21,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2010-04-13 00:00:00','2015-07-25 11:23:05',NULL),
	(182,21,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2011-04-13 00:00:00','2015-07-25 11:23:05',NULL),
	(183,21,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2012-04-13 00:00:00','2015-07-25 11:23:05',NULL),
	(184,21,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2013-04-13 00:00:00','2015-07-25 11:23:05',NULL),
	(185,21,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2014-04-13 00:00:00','2015-07-25 11:23:05',NULL),
	(186,22,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2014-01-31 00:00:00','2015-07-25 11:23:05',NULL),
	(187,22,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2015-01-31 00:00:00','2015-07-25 11:23:05',NULL),
	(188,22,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2016-01-31 00:00:00','2015-07-25 11:23:05',NULL),
	(189,22,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2017-01-31 00:00:00','2015-07-25 11:23:05',NULL),
	(190,22,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2018-01-31 00:00:00','2015-07-25 11:23:05',NULL),
	(191,23,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-11-13 00:00:00','2015-07-25 11:23:05',NULL),
	(192,23,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-11-13 00:00:00','2015-07-25 11:23:05',NULL),
	(193,23,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-11-13 00:00:00','2015-07-25 11:23:05',NULL),
	(194,23,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-11-13 00:00:00','2015-07-25 11:23:05',NULL),
	(195,23,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-11-13 00:00:00','2015-07-25 11:23:05',NULL),
	(196,24,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-07-20 00:00:00','2015-07-25 11:23:05',NULL),
	(197,24,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-07-20 00:00:00','2015-07-25 11:23:05',NULL),
	(198,24,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-07-20 00:00:00','2015-07-25 11:23:05',NULL),
	(199,25,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-04-14 00:00:00','2015-07-25 11:23:05',NULL),
	(200,25,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-04-14 00:00:00','2015-07-25 11:23:05',NULL),
	(201,25,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-04-14 00:00:00','2015-07-25 11:23:05',NULL),
	(202,26,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-05-30 00:00:00','2015-07-25 11:23:05',NULL),
	(203,26,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-05-30 00:00:00','2015-07-25 11:23:05',NULL),
	(204,26,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-05-30 00:00:00','2015-07-25 11:23:05',NULL),
	(205,26,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2017-05-30 00:00:00','2015-07-25 11:23:05',NULL),
	(206,26,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2018-05-30 00:00:00','2015-07-25 11:23:05',NULL),
	(207,27,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2014-02-23 00:00:00','2015-07-25 11:23:05',NULL),
	(208,27,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2015-02-23 00:00:00','2015-07-25 11:23:05',NULL),
	(209,27,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2016-02-23 00:00:00','2015-07-25 11:23:05',NULL),
	(210,28,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-07-23 00:00:00','2015-07-25 11:23:05',NULL),
	(211,28,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-07-23 00:00:00','2015-07-25 11:23:05',NULL),
	(212,28,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-07-23 00:00:00','2015-07-25 11:23:05',NULL),
	(213,29,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2011-08-03 00:00:00','2015-07-25 11:23:05',NULL),
	(214,29,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2012-08-03 00:00:00','2015-07-25 11:23:05',NULL),
	(215,29,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2013-08-03 00:00:00','2015-07-25 11:23:05',NULL),
	(216,29,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2014-08-03 00:00:00','2015-07-25 11:23:05',NULL),
	(217,29,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2015-08-03 00:00:00','2015-07-25 11:23:05',NULL),
	(218,30,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2011-06-11 00:00:00','2015-07-25 11:23:05',NULL),
	(219,30,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2012-06-11 00:00:00','2015-07-25 11:23:05',NULL),
	(220,30,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2013-06-11 00:00:00','2015-07-25 11:23:05',NULL),
	(221,31,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-10-05 00:00:00','2015-07-25 11:23:05',NULL),
	(222,31,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-10-05 00:00:00','2015-07-25 11:23:05',NULL),
	(223,31,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-10-05 00:00:00','2015-07-25 11:23:05',NULL),
	(224,32,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2016-01-17 00:00:00','2015-07-25 11:23:05',NULL),
	(225,32,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2017-01-17 00:00:00','2015-07-25 11:23:05',NULL),
	(226,32,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2018-01-17 00:00:00','2015-07-25 11:23:05',NULL),
	(227,32,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2019-01-17 00:00:00','2015-07-25 11:23:05',NULL),
	(228,32,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2020-01-17 00:00:00','2015-07-25 11:23:05',NULL),
	(229,33,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2010-12-29 00:00:00','2015-07-25 11:23:05',NULL),
	(230,33,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2011-12-29 00:00:00','2015-07-25 11:23:05',NULL),
	(231,33,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2012-12-29 00:00:00','2015-07-25 11:23:05',NULL),
	(232,33,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2013-12-29 00:00:00','2015-07-25 11:23:05',NULL),
	(233,33,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2014-12-29 00:00:00','2015-07-25 11:23:05',NULL),
	(234,34,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-04-29 00:00:00','2015-07-25 11:23:05',NULL),
	(235,34,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-04-29 00:00:00','2015-07-25 11:23:06',NULL),
	(236,34,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-04-29 00:00:00','2015-07-25 11:23:06',NULL),
	(237,35,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2010-04-16 00:00:00','2015-07-25 11:23:06',NULL),
	(238,35,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2011-04-16 00:00:00','2015-07-25 11:23:06',NULL),
	(239,35,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2012-04-16 00:00:00','2015-07-25 11:23:06',NULL),
	(240,36,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2011-11-06 00:00:00','2015-07-25 11:23:06',NULL),
	(241,36,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2012-11-06 00:00:00','2015-07-25 11:23:06',NULL),
	(242,36,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2013-11-06 00:00:00','2015-07-25 11:23:06',NULL),
	(243,36,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2014-11-06 00:00:00','2015-07-25 11:23:06',NULL),
	(244,36,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2015-11-06 00:00:00','2015-07-25 11:23:06',NULL),
	(245,37,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2015-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(246,37,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2016-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(247,37,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2017-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(248,37,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2018-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(249,37,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2019-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(250,38,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2010-06-29 00:00:00','2015-07-25 11:23:06',NULL),
	(251,38,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2011-06-29 00:00:00','2015-07-25 11:23:06',NULL),
	(252,38,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2012-06-29 00:00:00','2015-07-25 11:23:06',NULL),
	(253,38,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2013-06-29 00:00:00','2015-07-25 11:23:06',NULL),
	(254,38,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2014-06-29 00:00:00','2015-07-25 11:23:06',NULL),
	(255,39,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2010-12-12 00:00:00','2015-07-25 11:23:06',NULL),
	(256,39,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2011-12-12 00:00:00','2015-07-25 11:23:06',NULL),
	(257,39,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2012-12-12 00:00:00','2015-07-25 11:23:06',NULL),
	(258,40,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2016-02-07 00:00:00','2015-07-25 11:23:06',NULL),
	(259,40,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2017-02-07 00:00:00','2015-07-25 11:23:06',NULL),
	(260,40,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2018-02-07 00:00:00','2015-07-25 11:23:06',NULL),
	(261,41,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2011-02-27 00:00:00','2015-07-25 11:23:06',NULL),
	(262,41,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2012-02-27 00:00:00','2015-07-25 11:23:06',NULL),
	(263,41,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2013-02-27 00:00:00','2015-07-25 11:23:06',NULL),
	(264,42,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2012-03-07 00:00:00','2015-07-25 11:23:06',NULL),
	(265,42,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2013-03-07 00:00:00','2015-07-25 11:23:06',NULL),
	(266,42,5,NULL,NULL,NULL,'This GS5 was automatically generated.',19,NULL,NULL,'2014-03-07 00:00:00','2015-07-25 11:23:06',NULL),
	(267,44,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2014-09-12 00:00:00','2015-07-25 11:23:06',NULL),
	(268,44,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2015-09-12 00:00:00','2015-07-25 11:23:06',NULL),
	(269,44,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2016-09-12 00:00:00','2015-07-25 11:23:06',NULL),
	(270,44,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2017-09-12 00:00:00','2015-07-25 11:23:06',NULL),
	(271,44,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2018-09-12 00:00:00','2015-07-25 11:23:06',NULL),
	(272,45,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-12-19 00:00:00','2015-07-25 11:23:06',NULL),
	(273,45,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-12-19 00:00:00','2015-07-25 11:23:06',NULL),
	(274,45,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-12-19 00:00:00','2015-07-25 11:23:06',NULL),
	(275,45,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-12-19 00:00:00','2015-07-25 11:23:06',NULL),
	(276,45,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-12-19 00:00:00','2015-07-25 11:23:06',NULL),
	(277,46,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2013-01-15 00:00:00','2015-07-25 11:23:06',NULL),
	(278,46,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2014-01-15 00:00:00','2015-07-25 11:23:06',NULL),
	(279,46,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2015-01-15 00:00:00','2015-07-25 11:23:06',NULL),
	(280,46,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2016-01-15 00:00:00','2015-07-25 11:23:06',NULL),
	(281,46,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2017-01-15 00:00:00','2015-07-25 11:23:06',NULL),
	(282,48,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2010-03-24 00:00:00','2015-07-25 11:23:06',NULL),
	(283,48,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2011-03-24 00:00:00','2015-07-25 11:23:06',NULL),
	(284,48,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2012-03-24 00:00:00','2015-07-25 11:23:06',NULL),
	(285,49,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-03-11 00:00:00','2015-07-25 11:23:06',NULL),
	(286,49,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-03-11 00:00:00','2015-07-25 11:23:06',NULL),
	(287,49,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-03-11 00:00:00','2015-07-25 11:23:06',NULL),
	(288,49,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-03-11 00:00:00','2015-07-25 11:23:06',NULL),
	(289,49,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-03-11 00:00:00','2015-07-25 11:23:06',NULL),
	(290,50,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-08-09 00:00:00','2015-07-25 11:23:06',NULL),
	(291,50,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-08-09 00:00:00','2015-07-25 11:23:06',NULL),
	(292,50,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-08-09 00:00:00','2015-07-25 11:23:06',NULL),
	(293,51,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2014-11-13 00:00:00','2015-07-25 11:23:06',NULL),
	(294,51,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2015-11-13 00:00:00','2015-07-25 11:23:06',NULL),
	(295,51,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2016-11-13 00:00:00','2015-07-25 11:23:06',NULL),
	(296,52,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2014-05-16 00:00:00','2015-07-25 11:23:06',NULL),
	(297,52,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2015-05-16 00:00:00','2015-07-25 11:23:06',NULL),
	(298,52,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2016-05-16 00:00:00','2015-07-25 11:23:06',NULL),
	(299,53,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2011-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(300,53,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2012-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(301,53,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2013-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(302,54,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2013-12-26 00:00:00','2015-07-25 11:23:06',NULL),
	(303,54,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2014-12-26 00:00:00','2015-07-25 11:23:06',NULL),
	(304,54,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2015-12-26 00:00:00','2015-07-25 11:23:06',NULL),
	(305,55,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2012-08-28 00:00:00','2015-07-25 11:23:06',NULL),
	(306,55,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2013-08-28 00:00:00','2015-07-25 11:23:06',NULL),
	(307,55,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2014-08-28 00:00:00','2015-07-25 11:23:06',NULL),
	(308,56,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2015-01-11 00:00:00','2015-07-25 11:23:06',NULL),
	(309,56,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2016-01-11 00:00:00','2015-07-25 11:23:06',NULL),
	(310,56,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2017-01-11 00:00:00','2015-07-25 11:23:06',NULL),
	(311,57,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-05-13 00:00:00','2015-07-25 11:23:06',NULL),
	(312,57,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-05-13 00:00:00','2015-07-25 11:23:06',NULL),
	(313,57,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-05-13 00:00:00','2015-07-25 11:23:06',NULL),
	(314,59,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2015-06-06 00:00:00','2015-07-25 11:23:06',NULL),
	(315,59,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2016-06-06 00:00:00','2015-07-25 11:23:06',NULL),
	(316,59,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2017-06-06 00:00:00','2015-07-25 11:23:06',NULL),
	(317,60,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2014-07-23 00:00:00','2015-07-25 11:23:06',NULL),
	(318,60,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2015-07-23 00:00:00','2015-07-25 11:23:06',NULL),
	(319,60,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2016-07-23 00:00:00','2015-07-25 11:23:06',NULL),
	(320,61,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2013-05-12 00:00:00','2015-07-25 11:23:06',NULL),
	(321,61,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2014-05-12 00:00:00','2015-07-25 11:23:06',NULL),
	(322,61,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2015-05-12 00:00:00','2015-07-25 11:23:06',NULL),
	(323,62,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2014-09-10 00:00:00','2015-07-25 11:23:06',NULL),
	(324,62,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2015-09-10 00:00:00','2015-07-25 11:23:06',NULL),
	(325,62,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2016-09-10 00:00:00','2015-07-25 11:23:06',NULL),
	(326,62,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2017-09-10 00:00:00','2015-07-25 11:23:06',NULL),
	(327,62,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2018-09-10 00:00:00','2015-07-25 11:23:06',NULL),
	(328,63,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2014-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(329,63,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2015-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(330,63,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2016-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(331,63,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2017-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(332,63,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2018-12-03 00:00:00','2015-07-25 11:23:06',NULL),
	(333,64,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-04-22 00:00:00','2015-07-25 11:23:06',NULL),
	(334,64,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-04-22 00:00:00','2015-07-25 11:23:06',NULL),
	(335,64,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2018-04-22 00:00:00','2015-07-25 11:23:06',NULL),
	(336,64,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2019-04-22 00:00:00','2015-07-25 11:23:06',NULL),
	(337,64,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2020-04-22 00:00:00','2015-07-25 11:23:06',NULL),
	(338,65,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-03-27 00:00:00','2015-07-25 11:23:06',NULL),
	(339,65,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-03-27 00:00:00','2015-07-25 11:23:06',NULL),
	(340,65,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2017-03-27 00:00:00','2015-07-25 11:23:06',NULL),
	(341,65,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2018-03-27 00:00:00','2015-07-25 11:23:06',NULL),
	(342,65,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2019-03-27 00:00:00','2015-07-25 11:23:06',NULL),
	(343,66,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2013-08-23 00:00:00','2015-07-25 11:23:06',NULL),
	(344,66,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-08-23 00:00:00','2015-07-25 11:23:06',NULL),
	(345,66,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-08-23 00:00:00','2015-07-25 11:23:06',NULL),
	(346,67,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-01-18 00:00:00','2015-07-25 11:23:06',NULL),
	(347,67,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-01-18 00:00:00','2015-07-25 11:23:06',NULL),
	(348,67,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-01-18 00:00:00','2015-07-25 11:23:06',NULL),
	(349,67,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2018-01-18 00:00:00','2015-07-25 11:23:06',NULL),
	(350,67,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2019-01-18 00:00:00','2015-07-25 11:23:06',NULL),
	(351,68,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2011-08-07 00:00:00','2015-07-25 11:23:06',NULL),
	(352,68,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2012-08-07 00:00:00','2015-07-25 11:23:06',NULL),
	(353,68,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2013-08-07 00:00:00','2015-07-25 11:23:06',NULL),
	(354,68,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2014-08-07 00:00:00','2015-07-25 11:23:06',NULL),
	(355,68,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2015-08-07 00:00:00','2015-07-25 11:23:06',NULL),
	(356,69,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2011-01-19 00:00:00','2015-07-25 11:23:06',NULL),
	(357,69,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2012-01-19 00:00:00','2015-07-25 11:23:06',NULL),
	(358,69,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2013-01-19 00:00:00','2015-07-25 11:23:06',NULL),
	(359,69,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2014-01-19 00:00:00','2015-07-25 11:23:06',NULL),
	(360,69,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2015-01-19 00:00:00','2015-07-25 11:23:06',NULL),
	(361,70,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2013-05-01 00:00:00','2015-07-25 11:23:06',NULL),
	(362,70,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2014-05-01 00:00:00','2015-07-25 11:23:06',NULL),
	(363,70,5,NULL,NULL,NULL,'This GS5 was automatically generated.',15,NULL,NULL,'2015-05-01 00:00:00','2015-07-25 11:23:06',NULL),
	(364,71,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2011-11-21 00:00:00','2015-07-25 11:23:06',NULL),
	(365,71,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2012-11-21 00:00:00','2015-07-25 11:23:06',NULL),
	(366,71,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2013-11-21 00:00:00','2015-07-25 11:23:06',NULL),
	(367,72,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2011-01-27 00:00:00','2015-07-25 11:23:06',NULL),
	(368,72,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2012-01-27 00:00:00','2015-07-25 11:23:06',NULL),
	(369,72,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2013-01-27 00:00:00','2015-07-25 11:23:06',NULL),
	(370,72,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2014-01-27 00:00:00','2015-07-25 11:23:06',NULL),
	(371,72,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2015-01-27 00:00:00','2015-07-25 11:23:06',NULL),
	(372,73,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2011-06-30 00:00:00','2015-07-25 11:23:06',NULL),
	(373,73,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2012-06-30 00:00:00','2015-07-25 11:23:06',NULL),
	(374,73,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2013-06-30 00:00:00','2015-07-25 11:23:06',NULL),
	(375,73,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2014-06-30 00:00:00','2015-07-25 11:23:06',NULL),
	(376,73,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2015-06-30 00:00:00','2015-07-25 11:23:06',NULL),
	(377,74,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2011-10-27 00:00:00','2015-07-25 11:23:06',NULL),
	(378,74,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2012-10-27 00:00:00','2015-07-25 11:23:06',NULL),
	(379,74,5,NULL,NULL,NULL,'This GS5 was automatically generated.',20,NULL,NULL,'2013-10-27 00:00:00','2015-07-25 11:23:06',NULL),
	(380,75,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-11-07 00:00:00','2015-07-25 11:23:06',NULL),
	(381,75,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-11-07 00:00:00','2015-07-25 11:23:06',NULL),
	(382,75,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-11-07 00:00:00','2015-07-25 11:23:06',NULL),
	(383,75,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2017-11-07 00:00:00','2015-07-25 11:23:06',NULL),
	(384,75,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2018-11-07 00:00:00','2015-07-25 11:23:06',NULL),
	(385,76,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2011-04-25 00:00:00','2015-07-25 11:23:06',NULL),
	(386,76,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2012-04-25 00:00:00','2015-07-25 11:23:06',NULL),
	(387,76,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2013-04-25 00:00:00','2015-07-25 11:23:06',NULL),
	(388,77,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2015-01-09 00:00:00','2015-07-25 11:23:06',NULL),
	(389,77,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2016-01-09 00:00:00','2015-07-25 11:23:06',NULL),
	(390,77,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2017-01-09 00:00:00','2015-07-25 11:23:06',NULL),
	(391,77,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2018-01-09 00:00:00','2015-07-25 11:23:06',NULL),
	(392,77,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2019-01-09 00:00:00','2015-07-25 11:23:06',NULL),
	(393,78,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2010-08-13 00:00:00','2015-07-25 11:23:06',NULL),
	(394,78,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2011-08-13 00:00:00','2015-07-25 11:23:06',NULL),
	(395,78,5,NULL,NULL,NULL,'This GS5 was automatically generated.',7,NULL,NULL,'2012-08-13 00:00:00','2015-07-25 11:23:06',NULL),
	(396,79,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2015-08-14 00:00:00','2015-07-25 11:23:06',NULL),
	(397,79,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2016-08-14 00:00:00','2015-07-25 11:23:06',NULL),
	(398,79,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2017-08-14 00:00:00','2015-07-25 11:23:06',NULL),
	(399,79,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2018-08-14 00:00:00','2015-07-25 11:23:06',NULL),
	(400,79,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2019-08-14 00:00:00','2015-07-25 11:23:06',NULL),
	(401,80,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2011-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(402,80,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2012-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(403,80,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2013-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(404,80,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2014-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(405,80,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2015-05-19 00:00:00','2015-07-25 11:23:06',NULL),
	(406,81,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2015-08-30 00:00:00','2015-07-25 11:23:06',NULL),
	(407,81,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2016-08-30 00:00:00','2015-07-25 11:23:06',NULL),
	(408,81,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2017-08-30 00:00:00','2015-07-25 11:23:06',NULL),
	(409,81,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2018-08-30 00:00:00','2015-07-25 11:23:06',NULL),
	(410,81,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2019-08-30 00:00:00','2015-07-25 11:23:06',NULL),
	(411,82,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2016-04-27 00:00:00','2015-07-25 11:23:06',NULL),
	(412,82,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2017-04-27 00:00:00','2015-07-25 11:23:06',NULL),
	(413,82,5,NULL,NULL,NULL,'This GS5 was automatically generated.',4,NULL,NULL,'2018-04-27 00:00:00','2015-07-25 11:23:06',NULL),
	(414,84,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2012-01-28 00:00:00','2015-07-25 11:23:06',NULL),
	(415,84,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2013-01-28 00:00:00','2015-07-25 11:23:06',NULL),
	(416,84,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2014-01-28 00:00:00','2015-07-25 11:23:06',NULL),
	(417,84,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2015-01-28 00:00:00','2015-07-25 11:23:06',NULL),
	(418,84,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2016-01-28 00:00:00','2015-07-25 11:23:06',NULL),
	(419,85,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2014-02-15 00:00:00','2015-07-25 11:23:06',NULL),
	(420,85,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2015-02-15 00:00:00','2015-07-25 11:23:06',NULL),
	(421,85,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2016-02-15 00:00:00','2015-07-25 11:23:06',NULL),
	(422,86,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2012-01-23 00:00:00','2015-07-25 11:23:06',NULL),
	(423,86,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2013-01-23 00:00:00','2015-07-25 11:23:06',NULL),
	(424,86,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2014-01-23 00:00:00','2015-07-25 11:23:06',NULL),
	(425,86,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2015-01-23 00:00:00','2015-07-25 11:23:06',NULL),
	(426,86,5,NULL,NULL,NULL,'This GS5 was automatically generated.',9,NULL,NULL,'2016-01-23 00:00:00','2015-07-25 11:23:06',NULL),
	(427,87,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2012-10-18 00:00:00','2015-07-25 11:23:07',NULL),
	(428,87,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2013-10-18 00:00:00','2015-07-25 11:23:07',NULL),
	(429,87,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2014-10-18 00:00:00','2015-07-25 11:23:07',NULL),
	(430,88,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2011-04-01 00:00:00','2015-07-25 11:23:07',NULL),
	(431,88,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2012-04-01 00:00:00','2015-07-25 11:23:07',NULL),
	(432,88,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-04-01 00:00:00','2015-07-25 11:23:07',NULL),
	(433,90,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2014-03-05 00:00:00','2015-07-25 11:23:07',NULL),
	(434,90,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2015-03-05 00:00:00','2015-07-25 11:23:07',NULL),
	(435,90,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2016-03-05 00:00:00','2015-07-25 11:23:07',NULL),
	(436,90,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2017-03-05 00:00:00','2015-07-25 11:23:07',NULL),
	(437,90,5,NULL,NULL,NULL,'This GS5 was automatically generated.',12,NULL,NULL,'2018-03-05 00:00:00','2015-07-25 11:23:07',NULL),
	(438,91,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2012-11-26 00:00:00','2015-07-25 11:23:07',NULL),
	(439,91,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2013-11-26 00:00:00','2015-07-25 11:23:07',NULL),
	(440,91,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2014-11-26 00:00:00','2015-07-25 11:23:07',NULL),
	(441,91,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2015-11-26 00:00:00','2015-07-25 11:23:07',NULL),
	(442,91,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2016-11-26 00:00:00','2015-07-25 11:23:07',NULL),
	(443,92,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2009-11-06 00:00:00','2015-07-25 11:23:07',NULL),
	(444,92,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2010-11-06 00:00:00','2015-07-25 11:23:07',NULL),
	(445,92,5,NULL,NULL,NULL,'This GS5 was automatically generated.',11,NULL,NULL,'2011-11-06 00:00:00','2015-07-25 11:23:07',NULL),
	(446,93,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2012-05-30 00:00:00','2015-07-25 11:23:07',NULL),
	(447,93,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2013-05-30 00:00:00','2015-07-25 11:23:07',NULL),
	(448,93,5,NULL,NULL,NULL,'This GS5 was automatically generated.',13,NULL,NULL,'2014-05-30 00:00:00','2015-07-25 11:23:07',NULL),
	(449,94,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2016-02-10 00:00:00','2015-07-25 11:23:07',NULL),
	(450,94,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2017-02-10 00:00:00','2015-07-25 11:23:07',NULL),
	(451,94,5,NULL,NULL,NULL,'This GS5 was automatically generated.',16,NULL,NULL,'2018-02-10 00:00:00','2015-07-25 11:23:07',NULL),
	(452,95,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2014-01-03 00:00:00','2015-07-25 11:23:07',NULL),
	(453,95,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2015-01-03 00:00:00','2015-07-25 11:23:07',NULL),
	(454,95,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2016-01-03 00:00:00','2015-07-25 11:23:07',NULL),
	(455,95,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2017-01-03 00:00:00','2015-07-25 11:23:07',NULL),
	(456,95,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2018-01-03 00:00:00','2015-07-25 11:23:07',NULL),
	(457,96,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2012-07-28 00:00:00','2015-07-25 11:23:07',NULL),
	(458,96,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2013-07-28 00:00:00','2015-07-25 11:23:07',NULL),
	(459,96,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2014-07-28 00:00:00','2015-07-25 11:23:07',NULL),
	(460,96,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2015-07-28 00:00:00','2015-07-25 11:23:07',NULL),
	(461,96,5,NULL,NULL,NULL,'This GS5 was automatically generated.',10,NULL,NULL,'2016-07-28 00:00:00','2015-07-25 11:23:07',NULL),
	(462,97,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2013-08-24 00:00:00','2015-07-25 11:23:07',NULL),
	(463,97,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2014-08-24 00:00:00','2015-07-25 11:23:07',NULL),
	(464,97,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-08-24 00:00:00','2015-07-25 11:23:07',NULL),
	(465,98,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2010-07-15 00:00:00','2015-07-25 11:23:07',NULL),
	(466,98,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2011-07-15 00:00:00','2015-07-25 11:23:07',NULL),
	(467,98,5,NULL,NULL,NULL,'This GS5 was automatically generated.',8,NULL,NULL,'2012-07-15 00:00:00','2015-07-25 11:23:07',NULL),
	(468,99,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2013-03-13 00:00:00','2015-07-25 11:23:07',NULL),
	(469,99,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2014-03-13 00:00:00','2015-07-25 11:23:07',NULL),
	(470,99,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2015-03-13 00:00:00','2015-07-25 11:23:07',NULL),
	(471,99,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2016-03-13 00:00:00','2015-07-25 11:23:07',NULL),
	(472,99,5,NULL,NULL,NULL,'This GS5 was automatically generated.',17,NULL,NULL,'2017-03-13 00:00:00','2015-07-25 11:23:07',NULL),
	(473,100,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2013-05-21 00:00:00','2015-07-25 11:23:07',NULL),
	(474,100,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2014-05-21 00:00:00','2015-07-25 11:23:07',NULL),
	(475,100,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2015-05-21 00:00:00','2015-07-25 11:23:07',NULL),
	(476,100,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2016-05-21 00:00:00','2015-07-25 11:23:07',NULL),
	(477,100,5,NULL,NULL,NULL,'This GS5 was automatically generated.',14,NULL,NULL,'2017-05-21 00:00:00','2015-07-25 11:23:07',NULL),
	(478,101,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2015-08-01 00:00:00','2015-07-25 11:23:07',NULL),
	(479,101,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2016-08-01 00:00:00','2015-07-25 11:23:07',NULL),
	(480,101,5,NULL,NULL,NULL,'This GS5 was automatically generated.',2,NULL,NULL,'2017-08-01 00:00:00','2015-07-25 11:23:07',NULL);

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table funding_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `funding_types`;

CREATE TABLE `funding_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `funding_types` WRITE;
/*!40000 ALTER TABLE `funding_types` DISABLE KEYS */;

INSERT INTO `funding_types` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Self funding','Students are funded by them-selves.','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Government sponsored','Students are funded by the Government','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'UniL Scholarship','Students are funded by the University of Lincoln','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Project funded','Students are sponsored as a part of the project.','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'Industry funding','Students are funded by the industry company.','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `funding_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table gs_forms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gs_forms`;

CREATE TABLE `gs_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `defaultDuration` tinyint(4) DEFAULT NULL,
  `defaultStartMonth` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `gs_forms` WRITE;
/*!40000 ALTER TABLE `gs_forms` DISABLE KEYS */;

INSERT INTO `gs_forms` (`id`, `name`, `description`, `defaultDuration`, `defaultStartMonth`, `created_at`, `updated_at`)
VALUES
	(1,'GS1','Postgraduate Application',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'GS2','Interview Decision',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'GS3','Confirmation of Programme of Study',NULL,3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'GS4','Record of Consultation Between Research Student and Supervisor',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'GS5','Research Student Progress Record',NULL,12,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,'GS5b','Application for Research Award Transfer',6,12,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,'GS6','Change of Circumstances',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,'GS6a','Withdrawal from Programme of Study',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,'GS6b','Change of Mode of Study',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,'GS6c','Interruption of Study',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11,'GS6d','Extension to The Period of Study',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(12,'GS6e','Change of Research Project Title',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(13,'GS6f','Change in Supervisory Team',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(14,'GS6g','Change of Programme of Study',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(15,'GS7','Proposal for Thesis Examiners and Independent Chair',NULL,33,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(16,'GS8','Candidate Thesis Submission Form',NULL,36,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(17,'GS9','Examiners Initial Report on Thesis',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(18,'GS10','Examiners Final Report on Thesis and Viva',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(19,'GS10a','Examiners Approval of Thesis Amendments',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(20,'GS11','Independent Viva Chair Report Form',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(21,'GS12','Thesis Decision Confirmation of Award',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(22,'GS13','Application for Thesis Pending Fees Status',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `gs_forms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned DEFAULT NULL,
  `created_by` enum('Staff','Admin','System') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Staff',
  `created` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `history_student_id_foreign` (`student_id`),
  KEY `history_staff_id_foreign` (`staff_id`),
  CONSTRAINT `history_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  CONSTRAINT `history_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;

INSERT INTO `history` (`id`, `student_id`, `staff_id`, `created_by`, `created`, `title`, `content`, `created_at`, `updated_at`)
VALUES
	(6,101,14,'Admin','2015-07-14 11:34:00','This is a historic entry','And here\'s some content.','2015-07-14 11:35:09','2015-07-19 16:49:03'),
	(7,46,1,'Admin','2015-07-16 09:33:00','This is a historic entry','With some text.','2015-07-16 09:33:57','2015-07-16 09:33:57'),
	(8,46,2,'Staff','2015-07-16 09:44:00','This is a test','Some text goes here\r\n\r\nThis is an edit by the original author.','2015-07-16 09:44:55','2015-07-17 10:40:27'),
	(10,46,1,'Admin','2015-07-17 10:54:00','This history was originally by TEST STAFF','This has been edited by TEST ADMIN! ;)','2015-07-17 10:54:57','2015-07-17 10:56:59'),
	(20,46,NULL,'System','2015-07-20 19:21:55','Updated supervisor record','Supervisor: Dr. Woodrow Jast\nOrder: 1\nStart: 2015-07-20','2015-07-20 19:21:55','2015-07-20 19:21:55'),
	(21,46,NULL,'System','2015-07-20 19:29:19','New supervisor added','Supervisor: Ms. Arielle Carter\nOrder: 1\nStart: 2015-01-14','2015-07-20 19:29:19','2015-07-20 19:29:19'),
	(22,46,NULL,'System','2015-07-20 19:29:32','New supervisor added','Supervisor: Prof. Finn Jones\nOrder: 2\nStart: 2014-07-17','2015-07-20 19:29:32','2015-07-20 19:29:32'),
	(26,46,NULL,'System','2015-07-21 09:44:34','Award changed','The award was been changed from PhD to MPhil.','2015-07-21 09:44:34','2015-07-21 09:44:34'),
	(28,46,NULL,'System','2015-07-21 09:48:58','Enrolment status changed','The enrolment status has changed from Applied to Enrolled.','2015-07-21 09:48:58','2015-07-21 09:48:58'),
	(29,20,NULL,'System','2015-07-21 10:08:57','Award changed','The award was changed from MPhil to PhD.','2015-07-21 10:08:57','2015-07-21 10:08:57'),
	(30,20,2,'Staff','2015-07-21 10:09:00','This is a comment','Maybe it\'s about the upcoming event?','2015-07-21 10:09:40','2015-07-21 10:09:40'),
	(31,27,NULL,'System','2015-07-21 12:24:35','Award changed','The award was changed from MSc to MPhil.','2015-07-21 12:24:35','2015-07-21 12:24:35'),
	(32,101,NULL,'System','2015-07-24 18:19:50','New supervisor added','Supervisor: Miss Diamond Mann\nOrder: 2\nStart: 2015-02-25','2015-07-24 18:19:50','2015-07-24 18:19:50'),
	(33,101,NULL,'System','2015-07-24 18:20:02','New supervisor added','Supervisor: Dr. Woodrow Jast\nOrder: 3\nStart: 2015-03-26','2015-07-24 18:20:02','2015-07-24 18:20:02'),
	(34,64,NULL,'System','2015-07-25 10:58:59','New supervisor added','Supervisor: TEST STAFF\nOrder: 1\nStart: 2015-07-25','2015-07-25 10:58:59','2015-07-25 10:58:59'),
	(35,44,4,'Staff','2015-07-25 15:04:00','This is a test.','Content goes here...','2015-07-25 15:04:18','2015-07-25 15:04:43');

/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2015_06_12_145621_create_awards_table',1),
	('2015_06_13_134552_create_courses_table',1),
	('2015_06_13_151813_create_enrolment_status_table',1),
	('2015_06_13_153245_create_modes_of_study_table',1),
	('2015_06_14_000000_create_funding_types_table',1),
	('2015_06_14_183417_create_ukba_status_table',1),
	('2015_06_14_300000_create_absence_types_table',1),
	('2015_06_14_500000_create_students_table',1),
	('2015_06_14_600000_create_absence_table',1),
	('2015_06_15_185242_create_staff_table',1),
	('2015_06_15_190001_create_gs_forms_table',1),
	('2015_06_15_190251_create_history_table',1),
	('2015_06_15_192330_create_supervisors_table',1),
	('2015_07_06_195345_create_events_table',1),
	('2015_07_14_122615_entrust_setup_tables',2);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table modes_of_study
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modes_of_study`;

CREATE TABLE `modes_of_study` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `modes_of_study_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `modes_of_study` WRITE;
/*!40000 ALTER TABLE `modes_of_study` DISABLE KEYS */;

INSERT INTO `modes_of_study` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Full time','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Part time','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'Distance learning','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `modes_of_study` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;

INSERT INTO `permission_role` (`permission_id`, `role_id`)
VALUES
	(51,15),
	(52,15),
	(53,15),
	(54,15),
	(55,15),
	(56,15),
	(57,15),
	(58,15),
	(59,15),
	(60,15),
	(61,15),
	(62,15),
	(63,15),
	(64,15),
	(65,15),
	(66,15),
	(67,15),
	(69,15),
	(66,16),
	(68,16);

/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`)
VALUES
	(51,'can_reset_user_password','Can Reset User Password',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(52,'can_create_student','Can Create Students',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(53,'can_edit_student','Can Edit Students',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(54,'can_destroy_student','Can Destroy Students',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(55,'can_recalculate_student_end_date','Can Reset User Password',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(56,'can_create_staff','Can Create Staff',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(57,'can_edit_staff','Can Edit Staff',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(58,'can_destroy_staff','Can Destroy Staff',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(59,'can_create_supervision_record','Can Create Supervision Record',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(60,'can_edit_supervision_record','Can Edit Supervision Record',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(61,'can_destroy_supervision_record','Can Destroy Supervision Record',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(62,'can_create_gs_form_event','Can Create GS Form Event',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(63,'can_edit_gs_form_event','Can Edit GS Form Event',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(64,'can_destroy_gs_form_event','Can Destroy GS Form Event',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(65,'can_auto_generate_gs_form_events','Can Automatically Generate GS Form Events',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(66,'can_create_student_history','Can Create Student History',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(67,'can_edit_student_history','Can Edit Student History',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(68,'can_edit_my_students_history','Can Edit My Students History',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(69,'can_destroy_student_history','Can Destroy Student History',NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`user_id`, `role_id`)
VALUES
	(1,15),
	(2,16),
	(21,17);

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`)
VALUES
	(15,'admin',NULL,NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(16,'staff',NULL,NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38'),
	(17,'student',NULL,NULL,'2015-07-26 16:58:38','2015-07-26 16:58:38');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`key`, `value`)
VALUES
	('enableAutomaticHistoryEntires','true'),
	('fullTimeDefaultStudyDuration','4'),
	('partTimeDefaultStudyDurationMultiplier','1.5'),
	('upcomingEventsTimeFrame','6');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `university_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `staff_user_id_foreign` (`user_id`),
  CONSTRAINT `staff_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;

INSERT INTO `staff` (`id`, `user_id`, `position`, `university_phone`, `room`, `about`, `created_at`, `updated_at`)
VALUES
	(1,1,NULL,'527.787.4870x4348','1101','Aliquam explicabo illum fugiat distinctio minima. Sed magnam voluptatibus eos harum molestias facilis. Est soluta sequi rem voluptate sed. Voluptatum voluptas suscipit dolor omnis hic voluptas totam. Aliquid tenetur aut odio voluptates facere omnis.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(2,2,NULL,'909.966.7806','1979','Provident perferendis sit voluptatem aut quasi cupiditate eveniet. Officiis excepturi voluptatibus voluptas saepe. Consequuntur sed animi earum est. Sunt in laudantium et nostrum ullam modi voluptate. Labore ut unde accusamus quas asperiores aliquid. Ut cum fugit officiis repellat.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(3,3,NULL,'+88(6)3823191624','1786','Corporis tenetur inventore adipisci corporis enim ab. Dolores fugit at perferendis quo voluptas unde. Sit facilis in recusandae sit in. Rerum numquam pariatur expedita ipsam corrupti aut. Et ut eos dicta libero accusamus eveniet molestiae ex. Sit quia praesentium ipsa ab sed.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(4,4,NULL,'255-037-1995','1224','Ut facere aut amet illo possimus. Labore blanditiis possimus earum soluta voluptates possimus dolorem. Sit molestiae cum reprehenderit iusto. Et odio dignissimos quis provident. Delectus ipsum voluptates est nulla natus.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(6,6,NULL,'724-839-2563x0667','2803','Veniam voluptatem consequatur ducimus harum voluptates. Autem aut sequi beatae autem. Consequatur incidunt accusantium quo illo perspiciatis nam quia facilis. Aliquid cum aliquid optio harum repellendus quo enim autem. Porro quis modi rerum id. Exercitationem aperiam vel aspernatur voluptate.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(7,7,NULL,'+18(8)6423340691','1902','Libero alias natus rerum suscipit. Ut aut quia delectus eos vitae. Esse sequi eum numquam. Ullam sint asperiores dicta.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(8,8,NULL,'756-909-5611x6889','2567','Consequatur dolores et dolorem quidem incidunt sapiente libero. Omnis voluptatibus tempore incidunt autem necessitatibus sint aliquid. Praesentium aliquam non et qui consequatur rem voluptatibus. Incidunt molestias minima voluptatum tempora et. Culpa modi nihil recusandae laboriosam ut numquam. Qui quas voluptatem quam dolores.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(9,9,NULL,'1-197-727-4961','2901','Dolor saepe consequuntur aut. Reprehenderit aut assumenda repudiandae modi provident ullam. Illum rerum quis vel et. Modi pariatur unde deleniti rerum temporibus possimus delectus. In dolor qui exercitationem.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(10,10,NULL,'345.826.3943','1552','Aliquid et quo nulla velit consectetur laborum qui. Deserunt autem eligendi iste ab. Ipsam et velit amet at autem. Est fuga odit est molestiae officiis et veniam. Ut voluptatem cupiditate dolor. Ut dolores iste aut quia facere. Repellat quia saepe saepe et adipisci.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(11,11,NULL,'08318368717','1331','Suscipit quos magni quae ipsa voluptas odio quis quia. Eos nihil et velit est. Facere id voluptatem ut et. Omnis nulla sunt id impedit. Dolore est iste fugiat eaque minus.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(12,12,NULL,'(522)301-7184','1363','Consequatur qui qui ad omnis ut culpa. Maiores et laborum modi dicta officiis aut. Minus omnis earum veniam sit sunt repudiandae laudantium. Est voluptatem quia ad itaque voluptas quaerat optio. Soluta cupiditate voluptas quibusdam minus voluptas aspernatur. Laboriosam illo vitae ratione nesciunt recusandae atque.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(13,13,NULL,'06308703945','2440','Minima enim quod velit sint natus nihil. Voluptas officia laudantium ullam a dolores. Quia accusantium tempora qui est ipsam veniam eligendi debitis. Qui eius ut quia nostrum explicabo architecto illum. Quia distinctio inventore atque. Molestias enim dignissimos dolores expedita laborum.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(14,14,NULL,'1-337-124-0860x7271','1041','Aut expedita et ut repellat recusandae aut fugiat. Doloribus vel pariatur magni ipsam ab facilis similique. Est saepe architecto ullam praesentium doloribus. Ut adipisci magni veritatis id. Temporibus ipsum impedit aut animi ad quia eum rerum. Consequatur distinctio exercitationem cum officia officiis voluptatem architecto. Distinctio tempore officia sit reprehenderit.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(15,15,NULL,'857-290-0214','1922','Iste voluptas consequuntur nobis nam veritatis. Neque optio ullam eveniet qui vel laboriosam et. Voluptatem dolorum a et. Occaecati non quas asperiores autem at exercitationem nobis repellendus.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(16,16,'Lecturer','01522 899899','MC2354','Lorem ipsum dolor sit amet, aliquip principes honestatis in his, affert primis in eam, ius ei tale dicat disputationi. Eum id ferri exerci discere. An dictas accumsan consequat pri, quo eu quaeque facilisi, et vivendo laboramus vix. His oblique luptatum no. Tota eirmod iriure eu qui, vis ei erant lucilius constituto. In quo iudico dignissim adolescens, ad errem integre vituperata quo. Minim detracto per no.\r\n\r\nEi errem petentium salutatus pro, habeo quando platonem in his, ea amet enim volutpat mel. Nam an veri commodo sententiae. Modus aperiam volutpat pri in, in pro paulo dicunt fierent. Duo an minim conceptam, id vix diceret salutandi intellegam. Ut cum assum populo audiam.','2015-07-12 09:28:35','2015-07-20 15:04:02'),
	(17,17,NULL,'(166)189-0520','1675','Dolorem nemo nam quasi. Totam excepturi eos earum. Perferendis facere cum quas architecto modi harum in. Odio optio commodi incidunt illo ut corrupti nostrum tenetur. Repellat eaque architecto distinctio ea debitis recusandae veniam consequatur. Dolor velit ex molestias possimus sint laborum architecto. Eum aut vero et voluptate sit repellat occaecati.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(18,18,NULL,'943-570-0406x353','2095','Nisi voluptatem sapiente rerum adipisci corporis velit. Cum culpa recusandae ad porro in natus. Veniam ipsam est sed. Nemo laudantium autem nam et impedit. Et ut atque explicabo minima earum. Iusto id non dicta omnis deleniti.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(19,19,NULL,'+44(2)7380043631','2942','Necessitatibus et eveniet et voluptas est. Quidem dolor vel est necessitatibus iste voluptate quidem. Et facere esse quos quas sit tenetur officia non. Exercitationem asperiores ut similique. Est nam dolores non dolores magnam itaque. Eos neque esse quo eveniet quos eos. Aut sunt repellat quas at totam.','2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(20,20,NULL,'+84(5)4458405509','1454','Et neque omnis rem nam recusandae perferendis. Quis sit maiores perferendis dolorem minus qui. Debitis fugiat molestias voluptatem facere autem quod. Exercitationem consequuntur nobis maiores ab et.','2015-07-12 09:28:35','2015-07-12 09:28:35');

/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table students
# ------------------------------------------------------------

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `dob` date DEFAULT NULL,
  `enrolment` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('Female','Male','Other') COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8_unicode_ci NOT NULL,
  `current_address` text COLLATE utf8_unicode_ci,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `award_id` int(10) unsigned NOT NULL,
  `mode_of_study_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `enrolment_status_id` int(10) unsigned NOT NULL,
  `funding_type_id` int(10) unsigned NOT NULL,
  `ukba_status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_enrolment_unique` (`enrolment`),
  KEY `students_user_id_foreign` (`user_id`),
  KEY `students_award_id_foreign` (`award_id`),
  KEY `students_mode_of_study_id_foreign` (`mode_of_study_id`),
  KEY `students_course_id_foreign` (`course_id`),
  KEY `students_enrolment_status_id_foreign` (`enrolment_status_id`),
  KEY `students_funding_type_id_foreign` (`funding_type_id`),
  KEY `students_ukba_status_id_foreign` (`ukba_status_id`),
  CONSTRAINT `students_award_id_foreign` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`),
  CONSTRAINT `students_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `students_enrolment_status_id_foreign` FOREIGN KEY (`enrolment_status_id`) REFERENCES `enrolment_status` (`id`),
  CONSTRAINT `students_funding_type_id_foreign` FOREIGN KEY (`funding_type_id`) REFERENCES `funding_types` (`id`),
  CONSTRAINT `students_mode_of_study_id_foreign` FOREIGN KEY (`mode_of_study_id`) REFERENCES `modes_of_study` (`id`),
  CONSTRAINT `students_ukba_status_id_foreign` FOREIGN KEY (`ukba_status_id`) REFERENCES `ukba_status` (`id`),
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;

INSERT INTO `students` (`id`, `user_id`, `dob`, `enrolment`, `gender`, `home_address`, `current_address`, `nationality`, `start`, `end`, `award_id`, `mode_of_study_id`, `course_id`, `enrolment_status_id`, `funding_type_id`, `ukba_status_id`, `created_at`, `updated_at`)
VALUES
	(1,21,'1996-10-27','OIW58567869','Male','933 Rogers Divide Apt. 725\nRetaville, WA 33373','3230 Haag Summit Apt. 078\nJenningsport, WA 78468','Saint Helena','2011-08-05','2015-08-05',3,1,1,2,3,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(2,22,'1983-09-22','XCA38871066','Female','241 Schaefer Ridge\nEast Savanahmouth, NJ 02193-5104','8822 Meda Unions Suite 638\nCrystelton, ND 24396-1551','Russian Federation','2015-04-24','2019-04-24',3,1,1,2,2,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(3,23,'2006-07-18','OLD87588906','Female','45985 Funk Fields\nBoehmton, KY 76612','42546 Greenholt Camp\nMcDermottfurt, MS 29327-5947','Oman','2013-07-06','2017-07-06',3,1,1,4,4,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(4,24,'2012-11-01','UNE33958141','Female','243 Dee Glens Apt. 071\nNorbertland, GA 91142','941 Madelyn Burgs Apt. 590\nWest Vickie, WI 78843-9701','Sierra Leone','2014-10-12','2018-10-12',3,1,1,3,2,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(5,25,'1977-03-11','SMF78795192','Male','721 O\'Reilly Forge Suite 557\nMitchellfort, CO 10606','303 Favian Trace\nJaydontown, AR 50377-2759','Libyan Arab Jamahiriya','2012-01-14','2016-01-14',3,1,1,3,3,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(6,26,'1994-08-20','WFJ12192332','Male','85916 Daniela Divide\nMoenview, ME 98110','1768 Conn Estate\nJacklynshire, CO 18590','Zimbabwe','2011-12-26','2017-12-26',1,2,1,4,4,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(7,27,'1986-12-10','NRM63175145','Male','94698 Christy Flats\nEast Madysonport, LA 13701','318 Francisca Extension Suite 852\nPort Taya, ID 15706-1007','Lesotho','2008-07-17','2012-07-17',3,1,1,1,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(8,28,'1979-02-04','WAW21957670','Female','6474 Kadin Run Suite 014\nLilianmouth, AK 25509','91113 Lamar Inlet\nAlanside, CT 09248','Samoa','2010-12-30','2014-12-30',3,1,1,4,5,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(9,29,'1998-10-02','CIV91635829','Female','1367 Raheem Well\nJohnsonton, CT 35903','1886 Maud Knoll\nWest Mellie, PA 94613-4202','Finland','2011-04-25','2015-04-25',1,1,1,3,3,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(10,30,'2011-10-24','OLP91853903','Female','874 Zack Square Suite 895\nEast Horaciofort, NY 79279','52910 Bogisich Courts\nJohnstonberg, OK 40880','Holy See (Vatican City State)','2010-08-14','2016-08-14',3,2,1,1,2,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(11,31,'2003-07-11','HDK04959427','Male','97673 Kihn Rue Apt. 907\nMarcelleburgh, NV 13388','55583 Alan Estates Suite 782\nO\'Harastad, TN 16152','Andorra','2013-12-27','2019-12-27',1,2,1,1,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(12,32,'2004-12-02','RTC03868881','Male','36141 Joyce Knolls Suite 798\nBinsborough, CO 12856-2997','8046 Talon Lock\nJohnsontown, CA 03246','Belgium','2008-10-13','2012-10-13',1,1,1,2,2,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(13,33,'1985-07-19','GPK73777170','Female','5198 Johns Ridge\nLake Jayce, CT 94713-3576','135 Luettgen Parks Apt. 006\nPort Marisa, IA 45197','Isle of Man','2013-03-31','2017-03-31',1,1,1,2,1,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(14,34,'1993-07-24','QHU59216577','Male','5214 Grant Prairie Suite 742\nGislasonville, IN 05265-0459','4551 Alexanne Spur Apt. 951\nNorth Bertramshire, DE 10137','Madagascar','2011-07-09','2015-07-09',2,1,1,1,2,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(15,35,'2004-10-21','XMS64607033','Female','8617 Lera Well\nPaulamouth, NH 57609-7032','6810 Parker Forest\nGislasonmouth, NH 50621','Mauritius','2011-09-04','2017-09-04',3,2,1,2,1,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(16,36,'2012-08-13','UBB03218213','Male','38797 Rolfson Trail Apt. 954\nLake Daniella, HI 31025-6356','17629 Bailey Neck\nAlbertoborough, KS 09922-5590','Greece','2014-02-06','2020-02-06',2,2,1,2,1,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(17,37,'1982-07-10','XHB21615648','Female','0833 Dimitri Harbor Suite 913\nPort Zora, PA 41464','55764 Wendy Springs\nEast Halieport, OH 31892','Guyana','2008-11-20','2012-11-20',1,1,1,3,1,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(18,38,'1997-12-14','ATG75838794','Female','0789 Heaney Light\nEast Kathryne, SC 81731-1119','15538 Roberts Brooks\nNorth Meggieville, FL 73046-2996','Bahamas','2010-03-22','2014-03-22',1,1,1,2,3,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(19,39,'1973-10-28','JXU59912902','Male','108 Denesik Trail\nEast Vivianebury, DC 50746','931 Beahan Stravenue Suite 935\nHettingerton, WA 43969-1355','Montserrat','2008-12-03','2014-12-03',2,2,1,3,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(20,40,'2014-08-18','GDE78520796','Male','509 Nicolas Villages Suite 718\r\nMallorybury, NV 02256','463 Heaney Avenue\r\nLake Amiyastad, OR 87471-4065','Nicaragua','2015-02-04','2019-02-04',3,1,1,2,3,3,'2015-07-12 09:28:47','2015-07-21 10:08:57'),
	(21,41,'1995-02-23','FFW44509757','Male','757 Rowena Summit\nSouth Jeremie, TX 25016','5788 Rolfson Points Suite 539\nEbertshire, IL 97375-4840','Belgium','2009-04-13','2015-04-13',1,2,1,2,1,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(22,42,'1980-11-12','QBX52721688','Male','7842 Dejah Lock\nLake Kevenville, TX 07664-1582','375 Leuschke Turnpike\nLake Lylabury, CA 49134-0862','Brazil','2013-01-31','2019-01-31',1,2,1,1,1,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(23,43,'1971-06-25','QMN93853502','Female','6761 Hoeger Shore Suite 325\nWest Theresiashire, NH 33596-7583','415 Swaniawski Wells\nShayleeburgh, FL 37143','Afghanistan','2010-11-13','2016-11-13',3,2,1,3,4,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(24,44,'2002-04-16','EKM77977394','Male','683 Bechtelar View Apt. 151\nIsidrofurt, SD 96540-2107','07383 Fritsch Keys\nLake Katelyn, WI 66341-0678','Finland','2011-07-20','2015-07-20',3,1,1,3,3,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(25,45,'1978-03-28','ESF13308104','Female','2060 Stiedemann Shore Apt. 987\nBridieborough, NH 93297','64181 Hoeger Mission\nBartolettichester, MA 29427-6348','Portugal','2011-04-14','2015-04-14',2,1,1,4,3,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(26,46,'1984-05-29','RFX01492142','Female','3779 Macie Greens\nHickleberg, CA 93957','5536 Cortney Fall\nSouth Iva, ND 11662-0765','Nigeria','2013-05-30','2019-05-30',2,2,1,1,2,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(27,47,'1977-12-01','AJR36352604','Female','65342 Michaela Village Apt. 665\r\nSouth Deronport, MT 49456','177 Legros Ville\r\nHavenchester, AR 83003-2677','Russian Federation','2013-02-23','2017-02-23',2,1,1,2,2,3,'2015-07-12 09:28:47','2015-07-21 12:24:35'),
	(28,48,'1991-07-13','ROE63274118','Female','6532 Lynch Hill Suite 096\nHymanland, ID 38912','72608 Bernardo Harbors\nDietrichchester, MA 87380-8582','Korea','2013-07-23','2017-07-23',3,1,1,4,5,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(29,49,'1974-07-03','ORL54629113','Male','71052 Altenwerth Trafficway Suite 740\nKalifurt, NM 47064','32707 Gleason Mountains\nCarolyneville, VA 85274','Oman','2010-08-03','2016-08-03',1,2,1,1,2,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(30,50,'1983-11-03','JQA15762440','Female','779 Alysa Keys\nErikshire, OR 15171-6350','086 Verna Hills Suite 165\nLake Marisa, ND 80596','Brazil','2010-06-11','2014-06-11',1,1,1,3,2,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(31,51,'1991-07-11','GYK10384149','Female','05187 Williamson Extensions Suite 311\nVolkmanview, IL 62504','486 Stracke Station\nReingerville, MO 22127-0600','Cayman Islands','2014-10-05','2018-10-05',1,1,1,2,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(32,52,'1976-01-26','QCH30049192','Female','60104 Micheal Island\nNew Alexie, ID 84750-5981','051 Mckenzie Lane Apt. 750\nPort Isadorechester, MI 71832','Swaziland','2015-01-17','2021-01-17',3,2,1,3,1,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(33,53,'2012-02-26','IKH40504663','Male','92396 Bergnaum Roads Apt. 076\nLake Hermannside, SC 58989-6503','82367 Osbaldo Pine\nKoeppton, MN 05912','Vietnam','2009-12-29','2015-12-29',3,2,1,1,3,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(34,54,'1994-04-09','SRN03050163','Male','791 Richie Park Suite 067\nJaynetown, IL 51143','486 Blick Plains Suite 729\nNorth Antonio, NJ 35126-0882','Bahamas','2013-04-29','2017-04-29',2,1,1,3,3,1,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(35,55,'1978-08-24','RGC19616867','Male','81903 Jakubowski Fork\nPort Chadrickland, KS 58447','4553 Lavonne Plains Apt. 576\nNorth Melanyfort, AZ 88206-8040','Saint Helena','2009-04-16','2013-04-16',3,1,1,4,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(36,56,'1985-09-26','ASN81322293','Male','253 Meda Heights Suite 699\r\nNorth Mortimer, UT 62740','238 Friesen Loop\r\nCyrilview, ME 38396','Guinea','2010-11-06','2016-11-06',2,2,1,4,3,1,'2015-07-12 09:28:47','2015-07-20 15:05:47'),
	(37,57,'2005-04-22','VCE88576258','Male','7205 Jalen Stream\nLake Elliemouth, MA 24728','693 Daniel Spring\nJennieton, IL 47906','Kiribati','2014-05-19','2020-05-19',3,2,1,1,3,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(38,58,'1981-06-17','RVF25944840','Male','521 Stiedemann Union Apt. 160\nLake Carmelo, OK 44145-2312','5914 Cassin Ville Suite 706\nPort Carmela, MA 98644','Azerbaijan','2009-06-29','2015-06-29',1,2,1,1,5,4,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(39,59,'1972-12-06','NGS03365645','Male','005 Leonie Grove Apt. 634\nPort Eliseo, MO 32980-3375','7275 Fritsch Cliff Apt. 559\nLeannonhaven, VT 17915','Antigua and Barbuda','2009-12-12','2013-12-12',1,1,1,3,5,2,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(40,60,'2000-01-11','ENZ23957316','Male','143 Turner Place Suite 778\nEveretteland, OK 21411-8235','335 Yundt Camp Apt. 242\nEast Emie, OH 47047','Uzbekistan','2015-02-07','2019-02-07',1,1,1,1,4,3,'2015-07-12 09:28:47','2015-07-12 09:28:48'),
	(41,61,'1985-02-14','NQH28568739','Male','8260 Raven Court\nBrendenland, NH 68809-5886','375 Bruen Village\nWest Estaland, NM 64030','Netherlands','2010-02-27','2014-02-27',3,1,1,4,5,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(42,62,'1987-05-10','EBZ14030093','Female','92218 Powlowski Squares Apt. 586\nArlenehaven, OK 44171-0002','08111 Cordelia Camp\nFunkport, NY 93507','Jersey','2011-03-07','2015-03-07',2,1,1,1,3,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(43,63,'2013-12-17','JYR01021145','Female','5486 Princess Run Apt. 913\nSouth Duane, OH 90699','45476 Crooks Centers Apt. 841\nKulasshire, WI 13361','Haiti','2009-04-15','2013-04-15',2,1,1,4,3,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(44,64,'2006-04-15','TZS41391429','Female','282 Raynor Circles Suite 118\nWest Darylstad, CT 03592','25369 Bernice Locks Apt. 549\nNorth David, DC 29177-3991','Malaysia','2013-09-12','2019-09-12',3,2,1,4,1,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(45,65,'2015-03-05','OZU03787090','Male','79923 Maye Union\nDoyleberg, MN 97886','9593 Murphy Crossing\nNew Trevashire, ME 26087','Israel','2010-12-19','2016-12-19',2,2,1,1,3,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(46,66,'1971-12-07','SPO02251652','Female','16163 Powlowski Gateway Apt. 105\r\nBlazeshire, VA 13765-1402','9181 Torp Pines Suite 363\r\nNew Napoleonton, VT 86061','Djibouti','2012-01-15','2018-01-15',2,2,1,2,1,3,'2015-07-12 09:28:48','2015-07-24 19:49:17'),
	(47,67,'1983-10-02','NLD48067745','Female','7454 Larson Forks\nNorth Tyrese, FL 83240','6730 Imelda Forge Apt. 525\nWest Nathanmouth, OK 53699-3615','Saint Barthelemy','2012-01-12','2016-01-12',2,1,1,3,1,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(48,68,'2008-09-23','LOP03628285','Female','79798 Waelchi Villages Suite 314\nLake Marjorie, IL 98472','50637 Feest Spring\nFayefort, ID 44811-4788','Ireland','2009-03-24','2013-03-24',3,1,1,4,1,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(49,69,'1990-11-15','VDY40941140','Male','15100 Lebsack Estates Apt. 989\nAndersonton, IA 17159','94529 Boehm Hollow\nEast Gudrun, AZ 57975','Suriname','2010-03-11','2016-03-11',1,2,1,3,1,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(50,70,'1971-12-06','UKF15630335','Male','4143 Harold Turnpike Apt. 649\nO\'Konmouth, IA 05354','269 Hand Garden Apt. 731\nRobynport, KS 56219-8584','United States Minor Outlying Islands','2013-08-09','2017-08-09',3,1,1,1,2,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(51,71,'1979-11-20','XMH63978333','Male','775 Valentina Shoal Suite 215\nAbbottborough, NM 18597-6944','079 Leonor Fields\nLeschmouth, NY 45858-1283','Western Sahara','2013-11-13','2017-11-13',3,1,1,1,1,3,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(52,72,'1978-08-02','VPU60524860','Female','0267 Swift Centers Suite 325\nWest Damienstad, NY 26859-9237','86518 Malvina Forest\nNew Valliestad, UT 73925-6915','Lithuania','2013-05-16','2017-05-16',3,1,1,4,3,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(53,73,'2010-09-10','KBU14502434','Male','0686 Iliana Spurs Suite 027\nSouth Nova, DC 03664-9317','027 Kutch Road Apt. 186\nCristborough, WV 54573-5688','Mauritania','2010-12-03','2014-12-03',3,1,1,2,3,3,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(54,74,'1995-11-01','ZZG78615894','Female','2044 Kiehn River Apt. 817\nWeissnatview, CT 07417-1409','1500 Marcia Forest Apt. 519\nJanniefurt, IA 39187','Luxembourg','2012-12-26','2016-12-26',1,1,1,3,5,3,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(55,75,'2003-02-15','WJY87870769','Female','221 Stamm Road\nMcGlynnland, VA 92604-4774','9799 Brittany Crossing Suite 482\nBroderickberg, FL 90626','Sweden','2011-08-28','2015-08-28',3,1,1,4,1,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(56,76,'1972-01-06','NBO25810538','Female','16310 Berta Trace\nLake Judge, ND 31290','222 Gladyce Throughway Apt. 348\nTamaraville, AZ 69880-7082','Saint Lucia','2014-01-11','2018-01-11',2,1,1,2,5,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(57,77,'1998-12-10','FMS27158448','Male','803 Wintheiser Drives Suite 493\nZiemannview, CA 99104','701 Kailyn Court Suite 575\nAnkundingmouth, DE 56565-2915','Uruguay','2013-05-13','2017-05-13',3,1,1,1,5,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(58,78,'1990-04-10','SWV92668498','Female','2882 Quitzon Brook\nWest Marcelina, LA 15543-5980','8190 Flatley Port\nLake Danykachester, FL 72397-0725','Palestinian Territory','2009-11-17','2013-11-17',3,1,1,4,3,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(59,79,'2005-06-22','TSW68664055','Male','61495 Torp Estate Apt. 468\nDustinville, AZ 65812','81950 Hayden Parks Apt. 571\nNorth Wilfredofurt, WY 24185-2358','Kenya','2014-06-06','2018-06-06',1,1,1,2,3,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(60,80,'2007-07-27','MPC06606395','Female','734 Breana Spurs\nHoegermouth, MO 67057-3281','34327 Mariana Rue Apt. 388\nWest Misty, NM 20617-0602','Argentina','2013-07-23','2017-07-23',2,1,1,2,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(61,81,'2012-09-01','ROU79185163','Male','641 Wuckert Streets\nMaximuston, MA 70466-9873','1759 Alvina Drive\nDoylefort, WI 72563','Trinidad and Tobago','2012-05-12','2016-05-12',1,1,1,3,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(62,82,'2014-11-29','EWR22109854','Male','388 Rodriguez Camp Apt. 953\nDooleyland, TN 88278-8828','8788 Rohan Canyon\nVeldafort, VT 12737-8250','Namibia','2013-09-10','2019-09-10',3,2,1,3,4,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(63,83,'1991-10-18','YXZ76064826','Male','4714 Green Springs\nPort Dwight, CT 40770-6821','00419 Leffler Course\nNew Treva, VA 01982-0697','Netherlands Antilles','2013-12-03','2019-12-03',2,2,1,1,1,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(64,84,'1989-10-14','IWI14547940','Female','6792 Osvaldo Well Suite 824\nMooreside, OH 19733-3689','775 Caleigh Square\nLake Aiyanamouth, IL 71747-6164','Lithuania','2015-04-22','2021-04-22',3,2,1,4,5,3,'2015-07-12 09:28:48','2015-07-25 10:59:23'),
	(65,85,'1974-03-23','OWV19215261','Female','7749 Aurelie Glens Apt. 730\nWest Omer, OR 91936-1038','210 Volkman Plains\nOcieborough, NE 16828','Lao People\'s Democratic Republic','2014-03-27','2020-03-27',1,2,1,2,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(66,86,'1984-07-23','CTO11837045','Female','43616 Leuschke Stream\nLake Sydney, OK 10144-4944','909 Dwight Burg\nPort Kingfort, TX 44440-2882','Ghana','2012-08-23','2016-08-23',2,1,1,2,4,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(67,87,'1985-08-14','VKW28277482','Male','9511 Huels Plains Apt. 178\nAshafort, MS 92221-8288','1147 Johann Plains\nWest Imogeneborough, CT 85405','Iran','2014-01-18','2020-01-18',3,2,1,3,1,3,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(68,88,'2001-11-20','SOY71895310','Male','52930 Fay Rapids\nNorth Chase, MT 76605','794 Mattie River\nNew Roscoeshire, MO 43473','Pakistan','2010-08-07','2016-08-07',1,2,1,2,3,2,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(69,89,'1980-05-02','AQE21096138','Male','01444 Keebler Fall Suite 695\nPort Kayli, MN 27457-2480','3327 Lucienne Mill Apt. 722\nNew Karlton, CA 99832-7611','Palestinian Territory','2010-01-19','2016-01-19',3,2,1,4,5,4,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(70,90,'2000-02-29','MFC74629715','Female','392 Chandler Path Suite 173\nFeeneyfurt, CA 67422','9718 Terry Circle\nSouth Miracle, HI 52723-7257','Tokelau','2012-05-01','2016-05-01',2,1,1,4,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(71,91,'1996-03-23','IKE52605016','Male','4775 Blick Hill\nBransonfort, GA 00137','6683 Roel Highway Suite 442\nHowellport, MA 62307','Malta','2010-11-21','2014-11-21',2,1,1,2,1,3,'2015-07-12 09:28:48','2015-07-12 09:28:48'),
	(72,92,'2008-10-19','DLR56819516','Male','554 Augustus Wells Apt. 247\r\nNorth Conorshire, VT 12461','697 McClure Drives\r\nMurphyhaven, ND 80052-2527','Algeria','2010-01-27','2016-01-27',1,2,1,1,3,4,'2015-07-12 09:28:48','2015-07-19 18:35:48'),
	(73,93,'1983-02-03','GVJ51614610','Male','4220 Marks Crossroad\nNew Enolaside, IA 19897-1767','508 Wisoky Shoal Suite 364\nEast Beth, KS 59712','Saint Vincent and the Grenadines','2010-06-30','2016-06-30',3,2,1,1,1,2,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(74,94,'2009-07-10','NTB03571874','Male','31256 Yasmine Mountains Suite 889\nEast Geoffreyfurt, OH 41967','35236 Laverne Circles\nDakotamouth, FL 94872','United Kingdom','2010-10-27','2014-10-27',2,1,1,1,1,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(75,95,'1971-01-05','ODL99235645','Male','9022 Cartwright Pass\nEast Kallie, GA 88563-5156','370 Erick Roads Apt. 265\nAraceliborough, MI 66111-1279','Guernsey','2013-11-07','2019-11-07',2,2,1,4,5,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(76,96,'1973-09-20','DZP22450853','Male','3231 Auer Trail Suite 685\nThelmaberg, WV 35940','5465 Kirk Harbors\nEulaliastad, NM 23596','Guatemala','2010-04-25','2014-04-25',1,1,1,1,3,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(77,97,'1971-04-03','WQG15894533','Male','13077 Flatley Keys\nEast Dianaberg, TN 36513-0973','891 Joanie Heights\nSawaynchester, MA 17645-6574','Antigua and Barbuda','2014-01-09','2020-01-09',1,2,1,2,4,2,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(78,98,'1987-11-04','NRB91902897','Male','392 Conrad Rapids Suite 699\nAbbottberg, IA 82515','869 Roob Mountain Suite 811\nNew Carleton, MO 43616','Burkina Faso','2009-08-13','2013-08-13',2,1,1,2,5,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(79,99,'2004-02-01','OTR33526989','Male','60118 Jaron Road Apt. 872\nBartonmouth, OR 85318','1518 Oral Terrace\nSouth Dan, NV 96275','Portugal','2014-08-14','2020-08-14',3,2,1,4,2,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(80,100,'2004-09-10','BVR55931885','Female','806 Kallie Manor Suite 485\nRosendoberg, RI 21028-5170','72194 Kadin Junction Apt. 701\nGloverton, ID 82495','Dominican Republic','2010-05-19','2016-05-19',3,2,1,3,2,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(81,101,'1996-04-20','CZY12135845','Male','735 Prosacco Crossing\nJeannebury, UT 43419','0610 Rodolfo Alley Apt. 716\nNorth Domenic, SC 91554-9764','Armenia','2014-08-30','2020-08-30',1,2,1,1,5,3,'2015-07-12 09:28:48','2015-07-12 17:55:34'),
	(82,102,'1986-07-04','XLZ07523315','Male','070 Cormier Club Apt. 142\nPort Dave, AL 82549','764 Bernhard Divide\nWest Rod, NY 20431-6746','Tuvalu','2015-04-27','2019-04-27',2,1,1,3,4,2,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(83,103,'1984-11-24','GJS25236466','Female','678 O\'Hara Garden Apt. 557\nPort Derek, OH 83689-3756','36441 Arnold Extension Apt. 541\nEast Jovanychester, AL 52047-4440','Jordan','2010-01-02','2014-01-02',2,1,1,4,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(84,104,'1991-03-23','FQP98729749','Male','10420 Dangelo Shoals Apt. 775\nJaceyville, LA 23884-9607','35509 Effie Plain\nPort Kaseyfort, NH 38631-9348','Zambia','2011-01-28','2017-01-28',3,2,1,1,4,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(85,105,'2010-06-18','IUP15990000','Male','605 Corkery Point\nColbyborough, IN 29561','611 Walker Pike\nBatzmouth, ID 63354-5911','Morocco','2013-02-15','2017-02-15',1,1,1,2,1,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(86,106,'1976-12-13','QJC29197011','Male','249 Elmer Corner\nMargaritastad, VA 11165','078 Harvey Road Apt. 169\nNew Kurtis, MI 47701-5259','Saudi Arabia','2011-01-23','2017-01-23',3,2,1,4,3,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(87,107,'1984-03-21','KZR94723849','Male','704 Friesen Squares Suite 905\nWest Earl, OK 96798','8614 Weber Ranch\nWest Andre, AL 91672','Guyana','2011-10-18','2015-10-18',1,1,1,1,4,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(88,108,'1989-01-08','LNS29864553','Female','7014 Balistreri Square Suite 178\nLake Whitney, TX 23872','180 Effie Stream Apt. 142\nNew Scottiefurt, OK 84118-2939','Palestinian Territory','2010-04-01','2014-04-01',2,1,1,3,4,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(89,109,'2003-01-12','QLL18314681','Female','968 Morissette Lights Suite 374\nSouth Orieville, MD 53546','6087 Glover Spurs Apt. 038\nAshaton, NV 41666','China','2010-11-18','2016-11-18',3,2,1,1,5,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(90,110,'1983-01-31','GOY43967191','Female','58681 Darlene Valley\nPfannerstillmouth, DE 35695','2033 Julia Curve Suite 724\nWest Denis, AL 26920-4637','Gibraltar','2013-03-05','2019-03-05',3,2,1,2,2,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(91,111,'1988-10-27','OCF18809088','Female','865 Hansen Glen\nVicentechester, CO 94088','0385 Ritchie Lane\nKautzertown, AK 67031','Japan','2011-11-26','2017-11-26',2,2,1,1,2,2,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(92,112,'2011-01-11','EDU94318629','Male','02327 Sonny Roads Suite 350\nLake Marcel, HI 46193-3603','684 Schmitt Land\nNorth Laverne, ID 77122-1344','Belize','2008-11-06','2012-11-06',2,1,1,1,3,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(93,113,'1997-01-30','EVT29905162','Male','6902 Bradtke Mall Suite 362\nNew Karelle, DC 91421-3918','312 Belle Inlet Apt. 105\nWest Florineberg, IL 65048','British Indian Ocean Territory (Chagos Archipelago)','2011-05-30','2015-05-30',1,1,1,2,1,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(94,114,'1975-06-22','TKN48788908','Male','7786 Kilback Hill Apt. 654\nCorkeryfurt, WI 21803','8082 Kemmer Junctions\nBartolettimouth, KS 16716','Swaziland','2015-02-10','2019-02-10',3,1,1,2,4,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(95,115,'1999-07-22','MVX88905264','Male','18429 Justice Glens Apt. 557\nWest Carmelo, WA 34882','451 Lourdes Estates Suite 724\nSouth Rooseveltshire, ID 90083-5591','Jamaica','2013-01-03','2019-01-03',1,2,1,3,1,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(96,116,'1997-10-16','URZ43894316','Female','002 Kunze Rest Apt. 959\nMadonnamouth, AL 41873','216 Agustina Cliffs Suite 120\nLangville, MI 79946-6079','Holy See (Vatican City State)','2011-07-28','2017-07-28',1,2,1,3,3,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(97,117,'1971-03-31','GOR11889634','Female','626 Samanta Mill\nTurcotteshire, HI 56798-6766','36289 Rex Street\nJedediahshire, NJ 60062-9937','Germany','2012-08-24','2016-08-24',1,1,1,2,2,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(98,118,'1971-12-08','EIW67667591','Male','845 Mante Circle\nNorth Jordanmouth, WV 11329','5104 Hand Field\nLake Susannaside, GA 48730-6921','Latvia','2009-07-15','2013-07-15',2,1,1,2,4,3,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(99,119,'1997-12-22','ZNU24610985','Female','667 Miller Valleys Apt. 667\nEast Hugh, ID 49088-6185','3560 Una Way\nJudsonhaven, AK 81657-7860','Libyan Arab Jamahiriya','2012-03-13','2018-03-13',3,2,1,4,3,4,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(100,120,'1982-07-23','JBO38875659','Male','187 Wilderman Route Suite 188\nSchmittville, MI 74355-8181','544 Hegmann Causeway Suite 137\nNew Marquisshire, MS 91523','Bahrain','2012-05-21','2018-05-21',2,2,1,2,1,1,'2015-07-12 09:28:48','2015-07-12 09:28:49'),
	(101,121,NULL,'GOL12345678','','Address.','','American','2014-08-01','2018-08-01',2,1,1,2,4,1,'2015-07-14 11:31:02','2015-07-14 11:32:43');

/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supervisors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supervisors`;

CREATE TABLE `supervisors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `staff_id` int(10) unsigned NOT NULL,
  `order` smallint(6) NOT NULL DEFAULT '1',
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `supervisors_student_id_foreign` (`student_id`),
  KEY `supervisors_staff_id_foreign` (`staff_id`),
  CONSTRAINT `supervisors_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
  CONSTRAINT `supervisors_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `supervisors` WRITE;
/*!40000 ALTER TABLE `supervisors` DISABLE KEYS */;

INSERT INTO `supervisors` (`id`, `student_id`, `staff_id`, `order`, `start`, `end`, `created_at`, `updated_at`)
VALUES
	(1,50,2,1,'2014-02-06',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(2,20,2,1,'2014-10-13',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(3,49,2,1,'2014-07-28',NULL,'2015-07-12 09:28:49','2015-07-19 17:19:42'),
	(4,44,9,1,'2013-08-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(5,18,9,1,'2013-02-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(6,83,2,2,'2012-02-23',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(7,73,10,1,'2011-05-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(8,57,13,1,'2010-11-11',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(9,21,12,1,'2013-12-22',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(10,45,2,1,'2011-01-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(11,7,2,1,'2013-12-13',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(12,62,12,1,'2010-05-20',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(13,29,14,1,'2010-05-11',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(14,36,16,1,'2012-12-07',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(15,14,12,1,'2014-10-22',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(16,8,2,1,'2011-06-27',NULL,'2015-07-12 09:28:49','2015-07-20 16:17:34'),
	(17,1,2,1,'2010-04-29',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(18,32,4,1,'2010-04-18',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(19,19,20,1,'2011-06-20',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(20,76,4,1,'2012-01-25',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(21,85,17,1,'2010-11-08',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(22,61,7,1,'2013-02-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(23,91,16,1,'2013-03-08',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(25,17,2,1,'2012-03-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(26,16,7,1,'2011-08-25',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(27,78,7,1,'2010-12-28',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(28,26,13,1,'2011-02-04',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(29,25,2,1,'2012-12-23',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(30,68,10,1,'2014-04-24',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(31,56,12,1,'2013-12-15',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(32,35,17,1,'2012-02-01',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(33,30,16,1,'2010-04-22',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(34,90,12,1,'2015-03-13',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(35,98,8,1,'2012-08-16',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(36,72,11,1,'2011-01-27',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(37,81,12,1,'2014-06-10',NULL,'2015-07-12 09:28:49','2015-07-12 17:58:39'),
	(39,79,13,1,'2010-03-10',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(40,69,16,1,'2014-04-25',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(41,70,15,1,'2012-03-25',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(42,12,2,1,'2011-01-15',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(43,31,2,1,'2013-09-15',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(44,33,10,1,'2013-02-06',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(45,42,19,1,'2011-03-01',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(46,94,16,1,'2012-07-02',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(47,59,14,1,'2010-04-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(48,23,2,1,'2012-05-08',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(49,4,2,1,'2014-09-07',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(50,51,4,1,'2012-07-25',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(51,24,2,1,'2012-06-30',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(52,39,9,1,'2011-07-16',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(54,27,19,1,'2009-12-09',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(55,86,9,1,'2011-02-12',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(56,5,2,1,'2013-08-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(57,2,2,1,'2013-03-09',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(58,38,4,1,'2010-08-28',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(59,77,16,1,'2012-07-11',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(60,75,13,1,'2010-07-14',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(61,9,2,1,'2014-12-02',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(62,15,20,1,'2013-01-11',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(63,65,13,1,'2010-01-01',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(64,48,13,1,'2010-06-05',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(65,99,17,1,'2010-10-05',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(66,66,13,1,'2015-01-31',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(67,22,11,1,'2012-11-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(68,60,7,1,'2015-01-04',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(69,28,13,1,'2012-03-19',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(70,80,9,1,'2012-10-14',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(71,67,2,1,'2010-01-22',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(72,55,14,1,'2012-01-18',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(73,6,2,1,'2013-01-27',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(74,74,20,1,'2011-11-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(75,52,8,1,'2012-01-24',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(76,53,13,1,'2010-12-01',NULL,'2015-07-12 09:28:49','2015-07-19 16:50:26'),
	(77,92,11,1,'2011-01-16',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(78,34,13,1,'2014-02-24',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(79,97,2,1,'2011-10-19',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(80,82,4,1,'2010-03-29',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(81,88,2,1,'2013-10-16',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(82,95,17,1,'2010-05-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(83,3,2,1,'2013-10-02',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(85,37,7,1,'2013-10-06',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(86,63,15,1,'2014-04-13',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(87,93,13,1,'2012-07-12',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(88,89,2,2,'2011-12-05',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(89,84,17,1,'2015-02-16',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(90,71,7,1,'2011-11-20',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(91,43,2,3,'2011-07-30',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(92,41,4,1,'2012-03-26',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(93,10,2,1,'2012-10-29',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(94,87,10,1,'2009-08-06',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(95,100,14,1,'2011-10-03',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(96,96,10,1,'2014-03-29',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(97,13,2,2,'2012-06-09',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(98,40,11,1,'2010-11-03',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(99,54,9,1,'2012-01-21',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(100,11,2,1,'2010-07-14',NULL,'2015-07-12 09:28:49','2015-07-12 09:28:49'),
	(103,46,15,3,'2015-01-20',NULL,'2015-07-12 09:30:51','2015-07-12 09:30:51'),
	(104,101,2,1,'2015-07-14',NULL,'2015-07-14 11:31:20','2015-07-14 11:31:20'),
	(105,40,2,2,'2015-03-12',NULL,'2015-07-19 16:46:05','2015-07-19 16:46:15'),
	(107,26,2,2,'2015-07-01',NULL,'2015-07-19 16:46:54','2015-07-19 16:46:54'),
	(114,46,8,1,'2015-01-14',NULL,'2015-07-20 19:29:19','2015-07-20 19:29:19'),
	(115,46,6,2,'2014-07-17',NULL,'2015-07-20 19:29:32','2015-07-20 19:29:32'),
	(116,101,11,2,'2015-02-25',NULL,'2015-07-24 18:19:50','2015-07-24 18:19:50'),
	(117,101,16,3,'2015-03-26',NULL,'2015-07-24 18:20:02','2015-07-24 18:20:02'),
	(118,64,2,1,'2015-07-25',NULL,'2015-07-25 10:58:59','2015-07-25 10:58:59');

/*!40000 ALTER TABLE `supervisors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ukba_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ukba_status`;

CREATE TABLE `ukba_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ukba_status` WRITE;
/*!40000 ALTER TABLE `ukba_status` DISABLE KEYS */;

INSERT INTO `ukba_status` (`id`, `name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'UK','Citizens of the United Kingdom','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'EU','Citizens of the European Union','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'International','International students','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Foreign','International students','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `ukba_status` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personal_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_first_name_index` (`first_name`),
  KEY `users_last_name_index` (`last_name`),
  KEY `users_personal_email_index` (`personal_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `title`, `first_name`, `middle_name`, `last_name`, `personal_email`, `email`, `personal_phone`, `password`, `locked`, `image`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'§','TEST',NULL,'ADMIN',NULL,'test@test.com',NULL,'$2y$10$0GkKsgH/jOPCjIoHI3GFvOwTdV3iVyctSVHTBPU.GpYylCsaas46O',0,NULL,'LoxPvJY8GLfmgYeCtmAXyHUPxb5Z5uxE8uoSOOQGvcjZH7NgZMcxVh7HPpQm','2015-07-12 09:28:35','2015-07-17 14:57:36'),
	(2,NULL,'TEST',NULL,'STAFF','Laurence.McClure@yahoo.com','staff@test.com','(788)551-0148x285','$2y$10$WbfBGt2qjuwT7zTxxS8Z/.YWTHCesLtOG436LJ98/bkl0HGRhxZES',0,NULL,'nMmznbZ8ZnkzeVZTa8SqjICxpfc3PvvHs1JT71sW3TaIp9QEogJ6XCH67riR','2015-07-12 09:28:35','2015-07-21 10:28:06'),
	(3,NULL,'Mariela','Zella','Schimmel','Christian.Muller@hotmail.com','Zachary73@Quitzon.biz','(637)684-6968','$2y$10$4qUeCPM1UwxDqjUPQVzno.z4SHGrucmzpruHPe/WMb9ycuIchctxK',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(4,'Prof.','Constance','Tiara','Marquardt','oBarton@Rolfson.info','Elvis09@yahoo.com','(014)738-5325','$2y$10$kPtc2yCC2SzRufz8Fau.AOg1RTCMPsSJK/09Jg9xNEN/i3aJ8ewfi',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(6,'Prof.','Finn','Candace','Jones','Larry.Becker@hotmail.com','Gregoria.McGlynn@Altenwerth.com','860-141-1498x387','$2y$10$AtUb8xKti.lYyKr3G928muD3I7f3jI6nI4PY2LHXVB3okmdtxSGHK',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(7,'Miss','Joshuah','Amelia','Maggio','Thurman.Lang@Hodkiewicz.com','Madisyn44@Lynch.com','301-141-5094x2725','$2y$10$q0smOtjCUYtSckUTxUOE3OZMfVL2g0CqZ3jYtyHyS9eYO.pSikQdm',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(8,'Ms.','Arielle','Beryl','Carter','iGreen@Smith.com','yWitting@hotmail.com','231.323.5283x58233','$2y$10$jHINTc5Tb48weE2kwINm8uV9uGlHR.qZiJdQ7s0VMmFkqHJ0N/VEq',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(9,'Ms.','Kim','George','Effertz','Spinka.Pattie@hotmail.com','Adams.Loma@Stiedemann.biz','1-589-207-0503','$2y$10$5d5dq7CvZZEugn5vo1444.TM.I8KNeOe3SjBnqfQtb0pSygoi.CUG',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(10,'Mr.','Arianna','Sarah','Spencer','Christiansen.Ariane@yahoo.com','dDoyle@hotmail.com','+03(6)7129853559','$2y$10$j8kH7/9qLd9uW8QLmuS.wuK9479zlE2iv5B3vLk7alxRyKO9qEXi2',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(11,'Miss','Diamond','Daphnee','Mann','Zieme.Romaine@gmail.com','Cathryn91@yahoo.com','(090)316-4357x9851','$2y$10$lUMaGPsH2synRz4vtkS08OAOsyVNT6TLG5gMQa2UiA7TB.bs5w086',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(12,'Ms.','Lawrence','Jeanne','Doyle','zBoyle@Sipes.com','qSchowalter@Lemke.com','738-941-3450','$2y$10$IlbxPQhGiKTP5/SBy9K8D.fxby/WUiiroj.OohiJ8k6q73VJmbprC',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(13,'Dr.','Tyrell','Rosamond','Wunsch','xHeller@hotmail.com','jKub@hotmail.com','(698)151-1809','$2y$10$xvClXoz3QWMzE9Ii9QSDQewDOdljKtdJxV8zIhEeQuC6lUmInFqd2',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(14,'Mr.','Dulce','Asia','Dach','Predovic.Winfield@Durgan.com','Jack34@hotmail.com','882.455.6013x721','$2y$10$JMVUS9ZgwT.pnIzTdqolsO5oWUwF/wRwfR1Vokj3TDDHL.sy1b/w2',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(15,'Dr.','Shawn','Tate','Barrows','Lonie.Mohr@Lockman.info','Keshaun.Lynch@yahoo.com','1-912-453-4196x4036','$2y$10$qbl1ZXmGVAYSIQVmoVWdOe3OuizlJTFItavvEg7aGZUtNhc2q4oXm',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(16,'Dr.','Woodrow','Hassie','Jast','Jameson77@gmail.com','wjast@lincoln.ac.uk','284-018-1398','$2y$10$JzPtbI0UAj76puWiXxyove5Lb.jS2OX8CWlg5Jq1IUgn8VS7K2HWa',0,'16.jpg',NULL,'2015-07-12 09:28:35','2015-07-20 15:01:56'),
	(17,'Prof.','Cora','Jaquan','Schneider','hWatsica@Paucek.com','Madonna.Bednar@hotmail.com','520.255.8386x7999','$2y$10$1Xj.s2fWhru80XHfDhHL5.FWW5p.mgpB79mGurN3WkivMYFrwqBa.',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(18,'Mrs.','Tanya','Madelyn','Bechtelar','Rosalinda69@Gusikowski.info','vSteuber@Rath.com','960.773.2807x53889','$2y$10$1O1672bE5TNecOxvRJxBNeF/QMfVietvGlclFQ738Zfcj/UbgeTEO',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(19,'Ms.','Hannah','Colleen','Hane','Chelsie.Cummerata@hotmail.com','Henderson.Pfeffer@yahoo.com','1-800-575-9059x2384','$2y$10$7clACLvuBoN2yd60/2yb9.Qa2ZCwCI2lHdbUYeZj9U1V8azyOPeMe',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(20,'Mr.','Ulises','Teagan','Mraz','Kellie62@hotmail.com','Kunze.Estefania@Ryan.net','350.819.8041x2108','$2y$10$d5mn9fBPfIg5kd4hn3BN3.6z3ThHNwND1lEMrOJmnpg0s3Z5KvF6y',0,NULL,NULL,'2015-07-12 09:28:35','2015-07-12 09:28:35'),
	(21,NULL,'TEST',NULL,'STUDENT','Emmet96@Johnston.com','student@test.com','1-564-417-3267','$2y$10$.5ehmUf3XU.njmmzmIueZeWh0hbYy/bX7FPxGTuGjdj4UypAI3L9e',0,NULL,'NRZx3GPKnq0XHn9yVcr0wLyGEvhZ0kKF4YcMNdaFhuRzBs6NormYn3IqO32p','2015-07-12 09:28:47','2015-07-21 11:16:50'),
	(22,'Mrs.','Pamela','Agustina','Brown','Coleman.Stracke@Nolan.com','oUllrich@Haag.com','1-719-909-2749x08555','$2y$10$wRS/xpSin5EHxBlBYVM4D.tV4WZ7WTtd5SrHtghU.Sd7f.176gIUK',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(23,'Miss','Caroline','Clarabelle','Wiegand','Carmella70@gmail.com','Lavonne67@hotmail.com','01078838141','$2y$10$knvsmx0wBBCzLI0kjVEUxuxr6aTVIE7IlWObx3QPFE3TQxSzlpP9K',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(24,'Miss.','Fermin','Aidan','Schaefer','Jedediah58@yahoo.com','lHermann@yahoo.com','535.987.1982','$2y$10$2jC7kTO83cNIvRkx75D1su8yEdy5grfPh70ybft2iONObRHGj1Vzi',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(25,'Mr.','Alda','Marc','Eichmann','Albina11@Welch.com','eHerman@hotmail.com','02455177931','$2y$10$0IdyKKXwzZU6toJ2nvwgEuv9Yvi1Ex3hMZ7RHfNUHM2MqFCq5MM5e',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(26,'Miss.','Wilma','Drake','Keebler','Unique11@hotmail.com','Lehner.Margarete@Wiza.info','1-780-027-0334','$2y$10$iHuZHgAeEkIdfFSi7lN8n.gt8cOW5Kxh/vAII4/tQCSSWzqPuyd8a',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(27,'Mr.','Tristin','Emmett','Hintz','cMraz@yahoo.com','Lelia.Cummings@yahoo.com','1-671-339-8491','$2y$10$L1N4t88CKeRy3aHPsKHDduWegkxvtI6JsPCuIcxJ4D2DGkHjFSnQe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(28,'Miss.','Ivy','Cali','Gulgowski','Leone05@Ward.net','tLakin@yahoo.com','+96(9)0939983456','$2y$10$cnmUCN9xDoj3b95R6BU9WOs1eXdYLg079GplXZlBcdvTw661zFqfe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(29,'Mrs.','Rachelle','Caroline','Kerluke','Lang.Helmer@hotmail.com','Odie22@gmail.com','(026)646-7343x172','$2y$10$Tsie/z1LEyWbkZZztPGyMODVkZFkpmaigEiIrlZWiYLH0vl.ueNum',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(30,'Mr.','Madilyn','Matilda','Smitham','Bradtke.Bernard@hotmail.com','lBatz@Batz.com','740-668-9967','$2y$10$6qEZdrl.GfPV9w17SzUXdeLiohb3hbWhMfdX5A1a/X3tBy62ZwXOC',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(31,'Miss.','Jacynthe','Timothy','Cormier','Zemlak.Joshua@Schinner.info','Kamren.Brakus@Block.net','253.297.9589','$2y$10$nEIz7n8EeQLVSQl3z9hre.iRGaHVsuMvKDvvq4ehqQE2Kt77b5Qyu',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(32,'Miss','Delta','Dasia','Erdman','Hintz.Soledad@Hodkiewicz.biz','Kristian.Denesik@hotmail.com','1-501-707-4221','$2y$10$c19TFliJiQljIVcLJjUSfeuS62uDEflYakRWEHbMTSjQb.zh9OX0u',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(33,'Miss.','Chesley','Darien','Senger','Mafalda.Spencer@Thiel.com','Clara97@hotmail.com','1-090-303-3484x237','$2y$10$MfDNYOFj70sPkfrl0aEBC.xvuNocRVmu92tBeAdUZaeincEvwkedq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(34,'Ms.','Crystal','Sierra','Mosciski','Adolphus07@Hilpert.biz','Dereck83@hotmail.com','792.121.3583x4064','$2y$10$kcVQfdsnZb6tRE6awKC/PueA3JGn81V5T111PYMQy1Mfkj00AJ7Lu',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(35,'Miss','Lauryn','Pasquale','Champlin','Lisette91@hotmail.com','Feest.Braulio@Hickle.com','934.891.6013','$2y$10$SEuNH/92zQQuOSYsRpMhHudPGxTT4qIe3.1pZVSI9/mm2.PY7AWGK',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(36,'Mr.','Jermey','Max','Towne','Hodkiewicz.Laurie@hotmail.com','Tamia.Spinka@Cruickshank.info','1-889-067-6317x177','$2y$10$QNtpJnqTjrCQBxf9G84ynOTPtrzjRhxnCricNG4vBHKlzc5udqjjS',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(37,'Miss','Kory','Wilber','Kuhlman','Levi64@yahoo.com','aTrantow@hotmail.com','(780)850-6177','$2y$10$hUYse/k0bHMulJI9eWddguRGq4hH.WuTAiFWKAT37cCLwpcBF6kr6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(38,'Mr.','Gene','Reece','Rath','Kiarra.Crist@Prosacco.com','Wilderman.Giovanni@Ullrich.net','804-026-7250','$2y$10$gIuePahq97CKqF.kgPKf8e6EbNTpctoN5lIwW.gwy.S96WWq/pj26',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(39,'Ms.','Johnathan','Henderson','Hettinger','Jacobi.Emie@gmail.com','Alejandra.Cartwright@Ward.net','1-451-745-1598x94327','$2y$10$Zzu0AIzqQaz9fK3aQA4BoudMUUcJ.H.FmZanHjrIEvWDujXwjeKgS',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(40,'Miss','Dayton','Celestino','Mann','Helmer22@Fisher.com','Stephen.Cassin@Kuphal.org','1-513-939-0097x442','$2y$10$YHKMHsbwVDEk1HwUnCItJ.o9.aAMnKb7rnOQG1HVnUyp.Qyxg9rWG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(41,'Miss.','Carley','Myrtie','Vandervort','Thiel.Tiara@gmail.com','Towne.Amy@Kovacek.com','1-866-837-4058x019','$2y$10$276GcMPZTn/HfjhAx4Qy7eh88hvlzKEBIAa5vnY3i0ZNK7rCpeRQu',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(42,'Miss','Dawson','Suzanne','Breitenberg','Anais09@Terry.biz','Chasity.Kuphal@gmail.com','+99(1)7578387637','$2y$10$LifvXxpdmQ9ois1wJNeD8ud5tTLd0d6AQWiAN9i.i3D7qAZCsn9i6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(43,'Mr.','Odie','Domenico','Beahan','vHettinger@gmail.com','Marianne.OKeefe@Ankunding.com','1-489-125-8648','$2y$10$m2PkNXB7w4WxI6huX/T2cu9/izJgL39psgjlIo3Fz2Q5Pi9JVG3iO',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(44,'Miss','Benedict','Jude','Shields','Gerson.Christiansen@yahoo.com','sSauer@Hartmann.com','(745)836-2759','$2y$10$qOGFDph4pcxaiRaf9x9G7egHTwc0EbUygYqb2T9Aqw9Km/o9Gksd.',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(45,'Mr.','Tyrell','Joseph','O\'Keefe','Flavie29@yahoo.com','Virgil.Becker@Reinger.com','258.627.7775x30391','$2y$10$9xHu.sQBYgzda.zmg.SN3u4gKZi.vIAsN6xkrwV/Zco531HfaXq82',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(46,'Mr.','Leonor','Friedrich','Braun','Jayda14@Kutch.net','OKon.Ahmed@Pollich.com','1-697-781-3725x41135','$2y$10$v.4t8Yo0nqO2.HqGdkB/LuiTL1SUUzWXhBUELP/6IeJRtqHOSwwNi',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(47,'Miss.','Marion','Agustina','Breitenberg','Hermann.Velda@hotmail.com','eHowe@Mayert.net','1-710-719-7851x54323','$2y$10$l0VNmniCNfYIQBLU6uwLCupiK1xObVECrr7lsleYaqNNb3FM76NBW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(48,'Miss.','Jazmyne','Kaylie','Schaefer','eHarris@yahoo.com','Norene91@hotmail.com','1-964-248-6078x227','$2y$10$nYsSFFPD/kbbJs0SggrPheO0m58RJuPS0NfU0HYAEcf0l2iqukzMq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(49,'Mrs.','Paige','Gordon','Wyman','Lennie.Spencer@Quigley.net','Lynch.Chauncey@Toy.com','1-618-460-6870x4101','$2y$10$cMpytMJz2BCTJjdgd9WL/.gTdxNKvd13J6xc76qj05k.z9Qfdnyb6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(50,'Ms.','Brock','Carleton','Hills','Lizzie.Hagenes@gmail.com','Paolo.Schowalter@hotmail.com','249.898.5192x170','$2y$10$xLkvOviImy6jmNuL9mJ.0OHAQnXi4ZSgzpEY8Kg1KhoH6BGs7HgcG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(51,'Mrs.','Myrna','Simone','Cole','Demetris.Altenwerth@McDermott.com','Estell03@yahoo.com','774-259-6616x418','$2y$10$L6.pWp9DBf3EEA/uXyrqXeUQxen2QINqHrcleTk1tV3W4xnOPaKcq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(52,'Mr.','Tate','Eveline','Rosenbaum','kWelch@yahoo.com','Deron.Effertz@hotmail.com','(301)556-1301x682','$2y$10$2G4SSGD.DNdMOvzHNNQpQeJ9FkJ8ItqWMO/bA2jihG1G5HVA9g.iy',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(53,'Ms.','Wilburn','Cordelia','Gaylord','wWalter@hotmail.com','Welch.Abigail@gmail.com','1-828-628-9335x13173','$2y$10$vjpXuDn7DR1KnhatXYv62uYveZdAruDCKkHa3xclexyZYeaQMHkxq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(54,'Mr.','Susanna','Jermey','Moore','Gavin.Beer@Davis.info','tGerlach@gmail.com','04560571689','$2y$10$xsEKQJ7dTvPlXM5RsL/ML.SKeqY974GpeMBoS4XtnXBLSR1a7pWmK',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(55,'Ms.','Hope','Ivory','Boyer','kBrown@Berge.com','Breitenberg.Everette@Heidenreich.com','705.675.5156','$2y$10$B32HN0SahmKHpj54Ndl9D.VgeCWNA8dbPnRy5DBuLX.HNQ/uvYQOu',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(56,'Mr.','Daron','Davin','Von','Justice44@gmail.com','Claudie07@hotmail.com','774.309.4820','$2y$10$gPpKDCYNAQVRn31Zkf31quT7gfXjfhqSXOUIyJmJp4hrr/M2emm8O',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-20 15:05:47'),
	(57,'Mr.','Tyrell','Shanny','Kessler','Billie.Rippin@hotmail.com','Markus32@Pfannerstill.com','(959)406-6858','$2y$10$cNFym03rs4ubzaCo31piOejfD01/YnrYEKO7ePx6b87/MsOxUb8lW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(58,'Miss.','Celestine','Gerda','Pfeffer','Rocky.Feil@Cremin.com','Maria.Halvorson@Hegmann.biz','(972)022-1124x016','$2y$10$xdwSzfS8GgUZSpqXIBEhKu3f4KZ0/7EFoFguRjetBCUdwpjgGF9Oi',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(59,'Ms.','Johathan','Vivien','Schimmel','dPowlowski@hotmail.com','oWard@gmail.com','073.589.6010x2832','$2y$10$hYCdwz0VvebbFgSPz23mUuA0VZ12q.ywfhu6yUl7NGzA9fm085rGC',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(60,'Ms.','Alene','Francisca','Jacobson','kShanahan@Schiller.com','Houston45@gmail.com','1-853-333-6482x5288','$2y$10$q/r1oh.l3aYcIBNx1XqlDe5N0uPtl7kobXVpV6v.RpKUYVr7cpuT6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(61,'Ms.','Joy','Mitchel','Carter','Domenic46@gmail.com','Caesar.Lind@Johns.com','858.135.9178x214','$2y$10$9PoD8L5NXzEhfKPknfoq4.vlJ5d6sAsk7FQpBjulNm6.ksGo6ZDCW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(62,'Miss.','Pansy','Vilma','Stehr','Jay01@hotmail.com','kMante@hotmail.com','844-136-8776','$2y$10$wEsrkIjZqI9/fPvan48ZKOQsG7MyUZ4dLH22eFV3iGgLKhG7g/A4e',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(63,NULL,'Antonia','Johann','Labadie','Koepp.Heidi@Rath.com','Colleen29@Hansen.biz','848.707.5287','$2y$10$BsR0ffySi4V/p6XtYjvHheDwP5gDxLXidrnfkRS53HAIiaEpLeOlq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(64,NULL,'Carissa','Duncan','Bruen','Candido06@Simonis.info','Williamson.Hayley@hotmail.com','1-228-502-7066x64570','$2y$10$9w1.AMKSbXlJ9H8/z/h8XOtn5mGtd0Gije95lTVIKRDjYXAnYOtYa',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(65,'Miss.','Josue','Cody','Walter','nBorer@Hamill.com','oHarris@Rodriguez.com','1-814-947-1266x083','$2y$10$npfoGVthyVa2F83IvrgqZe1AhE5yJwKje8xfO75eBIz2ZbJsdENtq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(66,'Ms.','Julia','Ima','Sporer','Lockman.Franz@hotmail.com','oUllrich@hotmail.com','153.561.7868','$2y$10$nJL5CLYGgmtdpABmO7BCKeZNovNhYxHOd2AkGgOZwB7TVGBxFE.k2',0,'66.jpg',NULL,'2015-07-12 09:28:47','2015-07-12 19:11:13'),
	(67,'Mr.','Elenor','Anabelle','Hodkiewicz','Stracke.Christelle@gmail.com','qMoen@yahoo.com','(080)509-7841x47108','$2y$10$vIAbRU0Md8eM8WsUmRPqkOUy/BfpZNB9F5Yb6saAut9BgYjDW63Ya',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(68,'Mr.','Reginald','Adeline','Pollich','Nikita21@gmail.com','Orlo.Lemke@hotmail.com','712-332-3801x2673','$2y$10$n2033SB8sQroe71f7ZMjIOYKzg.pXsVHZs.XV2JdN4Zct2JBOlAJG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(69,'Miss.','Melvina','Bonnie','Lynch','Aliya94@hotmail.com','Kiehn.Margaret@OConnell.com','+62(4)1587215809','$2y$10$/C33dqM5dvSfgGD6cwhb3eKvs.SLQw.Y2rKbTMyl1Uoblgz6Byjd2',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(70,'Mr.','Kayden','Alisha','Ritchie','oConroy@Bode.com','Kaylie22@hotmail.com','142-768-8108x58905','$2y$10$zo95zcyef/fk4skkEtJGnOdJqeJOoLhXi8xoutc9QP69AMt5K5FPe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(71,NULL,'Talia','Orrin','Bayer','Rubie10@gmail.com','gMarquardt@Stehr.biz','986-900-4762x00708','$2y$10$BPl7CRK7rxN0xZhRByJ3ZO6tFstsnfxemB2jsQmBOgVoFPr9hIyAe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(72,'Ms.','Nakia','Cullen','Turner','fSatterfield@Toy.org','Carter.Alfreda@Kassulke.org','(584)519-5809','$2y$10$JUU9dHzOQANSl.ieX/zUD.y8csGI3mMNpP.QZ4XA9/aQ.Lle8FBLy',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(73,'Mr.','Wallace','Jazlyn','Ritchie','Maria.Casper@hotmail.com','Wilhelm81@hotmail.com','(873)647-0389x181','$2y$10$oZQ6DkDriX6go8ayOGkk2O5DcsrmDMa9zTVNUIMU/0DTFSmkKD/Ly',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(74,'Miss.','Lizzie','Rodrick','Roob','Joshua.Casper@Sanford.biz','tHauck@Watsica.biz','1-015-462-6610x6546','$2y$10$nQFcxLf59cp5EVcEGqs2EexDu3WhIpSnLY92BybSLOL.lB3J6W7oe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(75,'Miss.','Alf','Chandler','Tremblay','Salvador97@hotmail.com','Houston23@gmail.com','414.728.2330x95474','$2y$10$bXxuTD/lcxBD8HSaVSrcruaFE62hVi7xoBrj3Vs7eTtd1OKrS0tS6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(76,'Mr.','Ewald','Rosella','Stroman','Rosalia.Schamberger@Ondricka.com','Abbott.Wilton@Orn.com','341.958.4281x574','$2y$10$.fgiSsd3/iKewtxtQdUIte5ZxAZNAb2A3WhSuQC/UFbtItLb0uYvy',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(77,'Miss.','Talia','Jody','Heller','vGibson@Kunze.net','Larson.Princess@gmail.com','1-950-978-0326','$2y$10$QiQcBmumHGDMW9afe6SevegFiiXcmHV/gDoprRfNHxmXVxTrOS.RG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(78,'Ms.','Vallie','Marina','Smitham','gDickinson@gmail.com','Kirsten71@Bergstrom.net','651.898.4125','$2y$10$kuIBmNY9HbQb12Qdriw1rO1YjHMh795cLfR34sjmCg3g8Mzept2H6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(79,'Mr.','Colby','Breana','Wunsch','Helmer.Hoeger@hotmail.com','sMayer@Little.org','1-890-284-8347','$2y$10$LU/G3IQQgijE9tg5OHI6p.SHMtTJTzK.3f7R.gzevfAK4Gnv5NWEa',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(80,'Mr.','Vincenza','Elouise','Reilly','vFlatley@Miller.com','Alessandro.Robel@hotmail.com','(015)048-5625','$2y$10$OYWqCwT8C/Yg4zHZvGKddO.ipwsZSgHmQ6.UKYbc6ukfXx7lyfvmO',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(81,'Mr.','Pasquale','Emmet','Bernhard','Coty32@Gusikowski.net','Heathcote.Juana@Botsford.biz','(225)253-7928x60750','$2y$10$4fDqlT53e05ZBP5dFQJACOtQaXLBpYjdHFdxMZsiAD191fNVkNu1e',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(82,'Miss','Lelia','Jaylon','Hintz','Crist.Alisa@Ritchie.biz','Libbie.Volkman@gmail.com','+44(6)3693296533','$2y$10$sZJZi9U/.ojtvziQvzBoO.r7FrPjTvlVi8Fn5jiHhrqzdOgvUxkfe',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(83,'Miss.','Tiffany','Rubye','Muller','Rohan.June@Williamson.org','Shawn11@hotmail.com','1-507-351-3687x494','$2y$10$DeTPLCxLblda1R0brnHGc.3RTwK.e9Y0.lKs054pmkj5f6kCY02V.',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(84,'Miss.','Judy','Trisha','Gusikowski','Pamela55@Padberg.biz','Darien.Russel@yahoo.com','(442)788-4742','$2y$10$ZOb8dnc18NJMWZ5g6qGQhO7PTriEvYhJeIdT/.yHmR7maQ/.G9ncC',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(85,'Mr.','Stuart','Mitchel','Marquardt','Williamson.Brooks@gmail.com','Jaskolski.Morris@yahoo.com','+35(7)0780264769','$2y$10$F0Ge5HJLRmjt9a7S4wqYxu/Dklyl03RBN0xac4OoZ4e/6HqlrGfKO',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(86,'Mrs.','Tatyana','Malachi','Wuckert','Swaniawski.Marcus@yahoo.com','Naomie.Mohr@gmail.com','(071)546-9802x6692','$2y$10$E/5JTEBTp4hQrndcmXUNI.22h2/YkI0YGKAcxIuQSVzqOQmmMIe4S',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(87,'Mr.','Sarai','Jayde','Schamberger','vReichel@hotmail.com','Lera96@Kreiger.com','(520)929-6697','$2y$10$lo410WFceE9mENZlc3ejf.HhUt446dXpQXg.8.Y7Ep2eFQHjIUexK',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(88,'Miss','Norval','Oliver','Schroeder','Darrion58@hotmail.com','Devin08@Hilpert.net','599.537.5528x4581','$2y$10$0ioS0DUE8cj1mioHOFH5Zu6LPPHbyfrmKTLmUcqhSr17Be2Lg5dW6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(89,'Miss.','Sandra','Laverne','Waters','Windler.Abbigail@Hills.info','qWeimann@hotmail.com','326-738-6733x525','$2y$10$4hc5v0LCn/WmB3zjIty4NeDnH88wlel2fna6dBGiRC6aviML4VR/2',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(90,'Miss','Else','Dorothy','Brekke','Efrain.Cartwright@Heidenreich.net','Enola48@gmail.com','528.892.0674x2867','$2y$10$iXYLX4Lgu7nzYYyknNQ2d.SwAME5bDLzouTqxwG23fW8O/czAERLu',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(91,'Mr.','Linwood','Brad','Blanda','qPfeffer@yahoo.com','Columbus.Casper@gmail.com','(555)265-6871','$2y$10$z/TaiX6DAgU1BetwALEntedMYAxgR1R5W1/HqLxf..D6VSo8Uln0y',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(92,'Miss.','Dawn','Sylvan','Boyle','Estevan.Cartwright@Champlin.com','Heathcote.Ahmad@Streich.info','1-072-784-2095x0748','$2y$10$X7X4UrM8aJyIWsJHWu0DT.A4swi5YVtBtrpIRZSv412t7OQ.QUzRW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(93,'Ms.','Dawson','Bridget','Wisoky','Filomena.Skiles@Bogan.com','hConsidine@yahoo.com','1-675-692-5090x224','$2y$10$UNq5KJV/MF7Ti8VIDd1Cyep4QP1i0u6R4B/ecdFvOL4xHjfTdddUa',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(94,NULL,'Carolyn','Iliana','Barton','Moriah19@hotmail.com','Marlee.Stokes@yahoo.com','+29(0)8245200097','$2y$10$4x4CO381hVh1/ps64DJB..oF0KiVuWENQ06YGZl014Kx1hyWFXm4m',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(95,NULL,'Gracie','Alexandro','Fay','Joanie67@hotmail.com','Velda.Hermann@Brown.com','534-041-2470','$2y$10$5X.KZ/2eOg5YVK9jhN1BNu/gT/0JTMYovbK2LtWqR1wM5TX6KEOmq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(96,'Mr.','Reyna','Oswaldo','McClure','mSchroeder@gmail.com','Stanton.Aniyah@Schmidt.org','(680)126-7691x2741','$2y$10$NcCfcZ1kQyWiYlVcHj1vJeBB1BkyEDSzhWrCkM0II7Wu/5ZoV2loq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(97,'Mr.','Arlo','Dana','Carter','Christiana89@Reilly.com','dGerlach@gmail.com','1-613-250-5913','$2y$10$Ml/UXhGTdqCcUF10FNr2.utD8aZBJH1uKtn1rC/88DSIjBtdl5cqO',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(98,'Ms.','Vada','Rosemary','Mante','Jaskolski.Vincenzo@yahoo.com','Arlie.Lubowitz@yahoo.com','+65(8)7250649845','$2y$10$bTJe5SRBQuDVDZiFn7QAxe6GAL3HKmphH9nGl4j9nUO/vnTmgYKTy',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(99,NULL,'Cyril','Edmund','Braun','Dayton.Ernser@hotmail.com','pMoen@Maggio.net','01239087815','$2y$10$Cu9/kh1NOQbsM.t8wQO5xu6WBqOZ2kKpvMPSQ8bYfhVeLHkKeWGa.',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(100,NULL,'Emmitt','Lacy','Prosacco','qRosenbaum@Feeney.org','Bennett.Jacobi@yahoo.com','1-603-730-7116x2823','$2y$10$9SBIk7qmZNxCMR2TXbH54ehbMrczYmBFFM5ordB2HKHlQ6B65/PK6',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(101,NULL,'Cayla','Esta','Stamm','Liza08@yahoo.com','Lucinda02@Block.com','(190)700-2269','$2y$10$4FPs2vfT3em0JE1NboAC/.RNwXM3GRL57./9h0QOnCZzwmTLFteY.',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(102,NULL,'Jace','Jasper','Veum','Considine.Hudson@Zulauf.com','mYundt@hotmail.com','1-187-889-8792','$2y$10$2wLT.ZzuPzrFMsoqul/o7Od7ArdobJg5wC6mzAMJIp5J59FFbbD/G',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(103,NULL,'Kallie','Garret','Ritchie','Lind.Silas@hotmail.com','dArmstrong@yahoo.com','1-946-692-0525','$2y$10$nR2RKZpMYju2tdd0kdUCTOPzn5yfrfz/lnqzEtLms7laq4gHdidNq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(104,NULL,'Anjali','Arjun','Macejkovic','Abdiel75@hotmail.com','Tina.Koelpin@Fay.com','951.146.3455x6475','$2y$10$dMvQbWpobjgPwd8LbJoliedFJMSPJHoGdquoU.nU8ECSLi9Sr/uHW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(105,'Mr.','Giles','Clifton','Hansen','Elise.Macejkovic@gmail.com','Kuvalis.Nikko@hotmail.com','+15(1)1691982949','$2y$10$97CR5OdMXPArtVNnIIDhj.jb6f0T.dROLJ69r/nr5rlLmnctHVwLO',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(106,'Mrs.','Jane','Gerry','Dach','Helene.Schimmel@gmail.com','Leola.Keebler@yahoo.com','1-633-954-3428x8485','$2y$10$M64KQBWZ6q6HIIMN3oDeIuK54kkC5qlXmgoEvKjJmCteu21uENC8G',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(107,'Miss.','June','Ronny','Raynor','Friesen.Nico@Stark.net','Weissnat.Derrick@Hilll.com','(514)407-0802x127','$2y$10$sxsL7L0rnz/NoFJLrxthZequUzodsg6zKqOV5WV5FKj6/GgKR1nkG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(108,'Miss.','Charley','Michale','Morissette','oSchultz@Franecki.com','zHalvorson@Windler.org','224.716.0804x601','$2y$10$63Q8hX0AiEPHH7UIz5uqUutZKGbhQUrGmM7lPSUbZjylg4L0p1PwC',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(109,'Mr.','Shaun','Jonathan','Hyatt','Barrows.Ayana@Greenfelder.com','Magnolia51@Hudson.com','1-721-843-5010','$2y$10$t.NWW/pOsKRnsh.TXCMngegd72s.5K/WnglhnAqZLhXNfj/cGWxNm',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(110,'Miss','Margarita','Linda','Mitchell','qSmitham@gmail.com','oKrajcik@Cummings.info','823-796-9220x55517','$2y$10$NsFBI2RFbCe8NszYe/16GeQkUntxRFR6U4SjLaPCWkolor0Ruu912',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(111,'Mrs.','Shaun','Suzanne','Hansen','Milford36@yahoo.com','Christy29@hotmail.com','1-015-265-5287x135','$2y$10$kX0CS72i40tuPr4GbakfE.4t8zNN7Ptu6cfH16xKEe2zdCpQ1iBZa',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(112,'Mr.','Filiberto','Winnifred','Haag','Shanny98@hotmail.com','Trantow.Henderson@Hamill.com','1-094-786-9680','$2y$10$5x6yK3h3b42mYgLIZbysMOh/aklWGQmxrs53CYepRC4yCmRLO7JUG',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(113,'Mr.','Darlene','Rubye','Stamm','Elouise.Dare@Rempel.com','Amely18@Rath.com','+08(9)5457782981','$2y$10$XEIyB3XbHOg/DJVEBoGYauZ1UuoD4ZpruV5WPqhaG9Aqpza7ZQZyq',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(114,'Mr.','Franco','Tevin','Schultz','Kovacek.Mollie@Haag.net','Mozelle54@Ziemann.net','(494)552-6905x4243','$2y$10$RSCztD.pLAPKo2imRCVYWuSbz3Amljnt0y07Vwvg.JzuFz9J31Z2O',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(115,'Mr.','Jaclyn','Austyn','Kozey','xKlein@Schneider.org','yOberbrunner@yahoo.com','08631235795','$2y$10$fSQmPeKOzwFfFtbKgdGWKuENZRdIinsvgsHM76R3t1wXFmLxV/sum',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(116,'Mrs.','Gage','Margie','Hintz','Jackie34@hotmail.com','Hyman75@Bogisich.com','304-582-9107','$2y$10$6s2ZtnbOr9G7m6Hrb8RSLO5IsQZVa4dUlWQRrm282rqKyORhW74CW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(117,'Mr.','Timmothy','Wyatt','Hoeger','Marks.Veronica@Rippin.com','Leola.Heathcote@hotmail.com','569.742.4912','$2y$10$VUB8eL2qdKMTVICfM64guOjPLFfJHm7grlLo6FPVVWBaaNiP36siC',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(118,'Mr.','Avis','Melyssa','West','Astrid35@gmail.com','Nella.OReilly@Emmerich.com','173.198.3867x94652','$2y$10$e8Q9U7qf.yKaIbG4uQpXNOiv0Ao4c.BHb1i518a5.6DCbo8Trsoei',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(119,'Ms.','Hollie','Shad','Rempel','Thea78@Kunde.com','Jenkins.Frieda@Hamill.com','655.664.4222x6608','$2y$10$1WznX/qRIBlSMNxEVsup1eFUWsUypaki3wezCL2qFTs253DsLD23.',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(120,'Mrs.','Dusty','Maybelle','Runolfsson','cRitchie@yahoo.com','Kadin80@gmail.com','668-235-8993x944','$2y$10$JCPOyh43WfIvy1636HPH6uI/3.VgzamKLNtg6aODG.M064FWLwsNW',0,NULL,NULL,'2015-07-12 09:28:47','2015-07-12 09:28:47'),
	(121,'Mr','Jeffrey','Lynn','Goldblum','','12345678@students.lincoln.ac.uk','','',0,NULL,NULL,'2015-07-14 11:31:02','2015-07-14 11:31:02');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
