SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `manager` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  `updated_by` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `explanation`;
CREATE TABLE `explanation` (
  `id` int(11) NOT NULL,
  `timesheet` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `description` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `timesheet` (`timesheet`),
  KEY `from` (`from`),
  KEY `to` (`to`),
  CONSTRAINT `explanation_ibfk_1` FOREIGN KEY (`timesheet`) REFERENCES `timesheet` (`id`),
  CONSTRAINT `explanation_ibfk_2` FOREIGN KEY (`from`) REFERENCES `user` (`id`),
  CONSTRAINT `explanation_ibfk_3` FOREIGN KEY (`to`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `activity` text NOT NULL,
  `added_from` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `timesheet`;
CREATE TABLE `timesheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `activity` text NOT NULL,
  `remarks` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginid` varchar(50) NOT NULL,
  `passwd` text NOT NULL,
  `name` text NOT NULL,
  `designation` text NOT NULL,
  `department` int(11) NOT NULL,
  `active` binary(1) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginid` (`loginid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
