-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2014 at 09:13 AM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `national_jobs`
--

-- --------------------------------------------------------

--
-- Table structure for table `kj_access_level`
--

CREATE TABLE IF NOT EXISTS `kj_access_level` (
  `access_level_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`access_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kj_access_level`
--

INSERT INTO `kj_access_level` (`access_level_id`, `type`) VALUES
(1, 'simple member'),
(2, 'Enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `kj_admin`
--

CREATE TABLE IF NOT EXISTS `kj_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(34) NOT NULL,
  `mobile` bigint(20) unsigned NOT NULL,
  `last_connection_date` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL COMMENT '0: blocked, 1: active',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_award`
--

CREATE TABLE IF NOT EXISTS `kj_award` (
  `award_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_member` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL COMMENT 'the title of the award received by the memebr',
  `issuing_organization` varchar(200) NOT NULL COMMENT 'the organization that issue the award(certificate)',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'the issuing date',
  `place` varchar(200) NOT NULL COMMENT 'the place where the award was delivered',
  `description` varchar(200) NOT NULL COMMENT 'the award description',
  PRIMARY KEY (`award_id`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kj_award`
--

INSERT INTO `kj_award` (`award_id`, `id_member`, `title`, `issuing_organization`, `date`, `place`, `description`) VALUES
(1, 11, 'Top Executive', 'Global Who''s Who', '0000-00-00 00:00:00', 'Baltimore, MD', 'High Executive');

-- --------------------------------------------------------

--
-- Table structure for table `kj_company_details`
--

CREATE TABLE IF NOT EXISTS `kj_company_details` (
  `company_details_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `industry_type_id` int(11) NOT NULL COMMENT 'foeign key from "industry type" table',
  `portrait` varchar(200) DEFAULT NULL,
  `name_of_hiring_personnel` varchar(100) DEFAULT NULL COMMENT 'the human ressources manager',
  `date_of_company_creation` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`company_details_id`),
  KEY `industry_type_id` (`industry_type_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kj_company_details`
--

INSERT INTO `kj_company_details` (`company_details_id`, `member_id`, `industry_type_id`, `portrait`, `name_of_hiring_personnel`, `date_of_company_creation`) VALUES
(4, 7, 1, '    company description', 'jjnnn', 1374879600);

-- --------------------------------------------------------

--
-- Table structure for table `kj_degree_type`
--

CREATE TABLE IF NOT EXISTS `kj_degree_type` (
  `degree_type_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`degree_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_documents`
--

CREATE TABLE IF NOT EXISTS `kj_documents` (
  `documents_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `document_name` varchar(50) NOT NULL,
  `owner` int(11) unsigned NOT NULL COMMENT 'the owner of the document: member_id',
  `creation_date` bigint(20) NOT NULL COMMENT 'date on which its uploaded to the site',
  `type_of_document_id` tinyint(2) unsigned NOT NULL,
  `document_url` varchar(50) NOT NULL COMMENT 'relative URI',
  PRIMARY KEY (`documents_id`),
  KEY `type_of_document_id` (`type_of_document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `kj_documents`
--

INSERT INTO `kj_documents` (`documents_id`, `document_name`, `owner`, `creation_date`, `type_of_document_id`, `document_url`) VALUES
(14, 'comment mieux gérer son temps', 7, 1382228323, 15, '52632163ad6b7'),
(15, '75 lois pour devenir N°1', 7, 1382228425, 1, '526321c969c51'),
(16, 'B.Kima', 11, 1382302713, 3, '526443f9731c3'),
(17, 'B.Kima_Resume', 11, 1382302721, 3, '526444019701a'),
(18, 'sample timesheet', 11, 1382302839, 1, '52644477ea29c');

-- --------------------------------------------------------

--
-- Table structure for table `kj_education_history`
--

CREATE TABLE IF NOT EXISTS `kj_education_history` (
  `education_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `date_from` bigint(20) DEFAULT NULL,
  `date_to` bigint(20) DEFAULT NULL,
  `study_program` varchar(100) NOT NULL,
  `graduated_or_not` tinyint(1) unsigned NOT NULL COMMENT '0: not graduated, 1: graduated',
  `degree_type_id` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`education_history_id`),
  KEY `member_id` (`member_id`,`degree_type_id`),
  KEY `member_id_2` (`member_id`),
  KEY `degree_type_id` (`degree_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_employment_status`
--

CREATE TABLE IF NOT EXISTS `kj_employment_status` (
  `employment_status_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` blob,
  PRIMARY KEY (`employment_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contain values like "employed", "unemployed" for TITLE field,\r\nDESCRIPTION field is less important' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_industry_type`
--

CREATE TABLE IF NOT EXISTS `kj_industry_type` (
  `industryTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `industry_type_categories` text,
  PRIMARY KEY (`industryTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='should be prefilled with industry types, this facilitates job search by "industry types" later, given its a job search site' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kj_industry_type`
--

INSERT INTO `kj_industry_type` (`industryTypeID`, `industry_type_categories`) VALUES
(1, 'computer fields\r\n'),
(2, 'economic fields'),
(3, 'automoile'),
(4, 'hottelerie'),
(5, 'politics'),
(6, 'banking'),
(7, 'telecom'),
(8, 'medicine'),
(9, 'electronics');

-- --------------------------------------------------------

--
-- Table structure for table `kj_job`
--

CREATE TABLE IF NOT EXISTS `kj_job` (
  `job_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `deadline` bigint(20) DEFAULT NULL,
  `job_registration_date` bigint(20) DEFAULT NULL COMMENT 'the date in wich the job has been registered on the system',
  `owner` int(11) unsigned DEFAULT NULL COMMENT 'the member_id, the person who registered the job',
  `skills` tinytext NOT NULL,
  `special_training` tinytext,
  `visit_counter` smallint(6) unsigned DEFAULT '0' COMMENT 'the number of time the job has been viewed by visitors',
  `job_category_id` int(11) unsigned NOT NULL COMMENT 'corresponds to the id of the table "kj_industry_type"',
  `contract_type` varchar(200) NOT NULL,
  `education_requirement` tinytext NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city_or_zip` varchar(50) DEFAULT NULL,
  `salary_range` double(15,3) unsigned DEFAULT NULL COMMENT 'in this fields will be the max amount for the range. Ex: range 200 to 500, here we will have 500.',
  `year_of_experience` tinyint(3) unsigned DEFAULT NULL COMMENT 'the max. Ex: for a range of 1 to 5 year, we will have 5 here. If no value, then the year of experience doesn''t matter',
  PRIMARY KEY (`job_id`),
  KEY `owner` (`owner`),
  KEY `job_category_id` (`job_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kj_job`
--

INSERT INTO `kj_job` (`job_id`, `description`, `title`, `deadline`, `job_registration_date`, `owner`, `skills`, `special_training`, `visit_counter`, `job_category_id`, `contract_type`, `education_requirement`, `state`, `country`, `city_or_zip`, `salary_range`, `year_of_experience`) VALUES
(1, 'do php files', 'developer ing', 2013, 1375950645, 7, 'php, css, html', 'CCNA certified', 0, 1, 'CDI', 'BAC+3', NULL, NULL, NULL, NULL, NULL),
(3, 'do php files', 'developer ing', 1377903600, 1376635902, 7, 'php, css, html', ' CCNA certified', 0, 1, 'CDI', 'BAC+3', NULL, NULL, NULL, NULL, NULL),
(4, 'LIKE CHRIS BROWN', 'RAPPING', 1377039600, 1376635739, 7, 'CHRIS BREEZY DANCING TO THE DEATH', '   KRUMP', 0, 1, 'TMP', 'DANCER', NULL, NULL, NULL, NULL, NULL),
(5, 'do the wood jobs', 'capenter at obili', 1376607600, 1376636465, 9, 'paint; cut', '  no special training', 0, 1, 'CDD', 'not necessary', NULL, NULL, NULL, NULL, NULL),
(6, 'des', 'tit', 1376694000, 1376773703, 7, 'req', ' specv', 0, 1, 'cdd', 'php++', NULL, NULL, NULL, NULL, NULL),
(7, 'Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores  Lorem Ipsum Dolores', 'Java Developer', 1385787600, 1384958915, 7, 'Java, PHP, CSS, HTML, Perl, R, C++', ' ', 0, 0, 'Freelancer', 'Masters in Science', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kj_jobs_and_their_categories`
--

CREATE TABLE IF NOT EXISTS `kj_jobs_and_their_categories` (
  `tableID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL COMMENT 'a company is a member on the site, this field therefore comes from "member_id"',
  `categorieID` int(11) NOT NULL COMMENT 'comes from table "kj_industry_type"',
  PRIMARY KEY (`tableID`,`companyID`,`categorieID`),
  KEY `companyID` (`companyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='this table lists jobs with the categories to which the job belongs (exple: MTN belongs to  sectors (computing, banking, telecom)\r\nso it associated companyID to categorieID' AUTO_INCREMENT=21 ;

--
-- Dumping data for table `kj_jobs_and_their_categories`
--

INSERT INTO `kj_jobs_and_their_categories` (`tableID`, `companyID`, `categorieID`) VALUES
(12, 7, 8),
(18, 7, 1),
(19, 7, 7),
(20, 7, 3),
(15, 9, 1),
(16, 9, 2),
(17, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kj_job_alerts`
--

CREATE TABLE IF NOT EXISTS `kj_job_alerts` (
  `job_alerts_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `job_category_id` int(11) unsigned DEFAULT NULL,
  `skills` tinytext,
  `job_title` varchar(50) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`job_alerts_id`),
  KEY `member_id` (`member_id`,`job_category_id`),
  KEY `job_category_id` (`job_category_id`),
  KEY `member_id_2` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_job_applied_for`
--

CREATE TABLE IF NOT EXISTS `kj_job_applied_for` (
  `job_applied_for_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(11) unsigned NOT NULL,
  `member_id` int(11) unsigned NOT NULL,
  `application_date` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`job_applied_for_id`),
  KEY `member_id` (`member_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `kj_job_applied_for`
--

INSERT INTO `kj_job_applied_for` (`job_applied_for_id`, `job_id`, `member_id`, `application_date`) VALUES
(10, 6, 8, 1379299712),
(11, 1, 8, 1379326319),
(12, 3, 8, 1379326322),
(13, 4, 8, 1379326349),
(14, 6, 12, 1379898650),
(15, 5, 12, 1379898655),
(16, 5, 8, 1380804313),
(17, 6, 15, 1384957141);

-- --------------------------------------------------------

--
-- Table structure for table `kj_job_category`
--

CREATE TABLE IF NOT EXISTS `kj_job_category` (
  `job_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`job_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kj_job_category`
--

INSERT INTO `kj_job_category` (`job_category_id`, `title`, `description`) VALUES
(1, 'cat 1', 'descr'),
(2, 'cat 2', 'desc');

-- --------------------------------------------------------

--
-- Table structure for table `kj_member`
--

CREATE TABLE IF NOT EXISTS `kj_member` (
  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(33) NOT NULL,
  `access_level_id` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 is default for simple member; but should be modified for enterprises',
  `visit_counter` smallint(6) unsigned DEFAULT NULL COMMENT 'the number of time the profile has been viewed',
  `gender` varchar(20) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `dob` bigint(20) unsigned DEFAULT NULL COMMENT 'the date of birthday',
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL COMMENT 'the photo name, the path is out inside the code',
  `employment_status_id` tinyint(2) unsigned DEFAULT NULL,
  `home_address` varchar(100) DEFAULT NULL,
  `work_address` varchar(100) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `linkedIn` varchar(50) DEFAULT NULL,
  `hobbies` tinytext,
  `extra_activities` tinytext,
  PRIMARY KEY (`member_id`),
  KEY `access_level_id` (`access_level_id`),
  KEY `employment_status_id` (`employment_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kj_member`
--

INSERT INTO `kj_member` (`member_id`, `email`, `password`, `access_level_id`, `visit_counter`, `gender`, `mobile`, `username`, `dob`, `name`, `photo`, `employment_status_id`, `home_address`, `work_address`, `fax`, `facebook`, `twitter`, `linkedIn`, `hobbies`, `extra_activities`) VALUES
(7, 'shloch2007@yahoo.fr', 'd273307a77da3c08036c706eb6775006', 2, NULL, NULL, '74458578', 'ingenieriRtye', 1374879600, 'INGENIERIS', '5203fe7ec1a8f.jpg', NULL, NULL, NULL, NULL, 'http://www.delta-search.com/', '', '', NULL, NULL),
(8, 'shloch2007@gmail.com', 'd273307a77da3c08036c706eb6775006', 1, NULL, NULL, NULL, 'shloch2007@gmail.com', NULL, NULL, '520fe8fe4a788.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'chris@live.fr', 'd273307a77da3c08036c706eb6775006', 2, NULL, NULL, NULL, 'oups', NULL, 'Oups', NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL),
(10, 'breezy@yahoo.Fr', 'd273307a77da3c08036c706eb6775006', 1, NULL, NULL, NULL, 'breezy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'kkimberts@gmail.com', '5ff4582d8513ed766df0b03058bf3b5d', 1, NULL, 'Male', '4434168446', 'kkimberts', 649483200, 'Bertrand Kima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'kkimberts@njorku.com', '5ff4582d8513ed766df0b03058bf3b5d', 1, NULL, NULL, NULL, 'kimberts', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'shylois@yahoo.fr', '8a2db8c74e593a83804b2a658345e322', 1, NULL, NULL, NULL, 'shylois', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'spacenas2000@yahoo.com', 'ca19f06a75b039eb63764f594e6fe70c', 1, NULL, NULL, NULL, 'spacenas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'bkima@njorku.com', '5ff4582d8513ed766df0b03058bf3b5d', 1, NULL, NULL, NULL, 'bkima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'kkimberts@kimberts.net', '5ff4582d8513ed766df0b03058bf3b5d', 2, NULL, NULL, NULL, 'enterprise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kj_reference`
--

CREATE TABLE IF NOT EXISTS `kj_reference` (
  `reference_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `reference` varchar(200) NOT NULL,
  PRIMARY KEY (`reference_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='people to contact to add weight to ya reputation\r\ncan be link; project realised name; person name etc' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kj_reference`
--

INSERT INTO `kj_reference` (`reference_id`, `member_id`, `reference`) VALUES
(1, 11, 'Frank Bolion');

-- --------------------------------------------------------

--
-- Table structure for table `kj_sent_mail`
--

CREATE TABLE IF NOT EXISTS `kj_sent_mail` (
  `sent_mail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` blob NOT NULL,
  `receiver_email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL COMMENT 'the delivery report. 0: not sent, 1: sent',
  PRIMARY KEY (`sent_mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_skills`
--

CREATE TABLE IF NOT EXISTS `kj_skills` (
  `skills_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `title` tinytext,
  PRIMARY KEY (`skills_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kj_skills`
--

INSERT INTO `kj_skills` (`skills_id`, `member_id`, `title`) VALUES
(1, 11, 'CNA');

-- --------------------------------------------------------

--
-- Table structure for table `kj_sms`
--

CREATE TABLE IF NOT EXISTS `kj_sms` (
  `sms_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `receiver_mobile` bigint(20) unsigned NOT NULL,
  `message` varchar(250) NOT NULL,
  `sms_code` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '0: system sms sent, 1: user sms sent, 2: system sms received',
  `status` tinyint(1) NOT NULL COMMENT '1: Sent, 0: notsent',
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`sms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_special_professionnal_training`
--

CREATE TABLE IF NOT EXISTS `kj_special_professionnal_training` (
  `special_professionnal_training_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `trainer` varchar(100) NOT NULL,
  `training_period` varchar(50) NOT NULL,
  `certificate_obtened` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`special_professionnal_training_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kj_special_professionnal_training`
--

INSERT INTO `kj_special_professionnal_training` (`special_professionnal_training_id`, `member_id`, `trainer`, `training_period`, `certificate_obtened`) VALUES
(1, 11, 'Health FOcus', '2 months', 'CPR'),
(2, 11, 'Health Focus', '4weeks', 'First Aid');

-- --------------------------------------------------------

--
-- Table structure for table `kj_type_of_document`
--

CREATE TABLE IF NOT EXISTS `kj_type_of_document` (
  `type_of_document_id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `price` smallint(6) unsigned DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL COMMENT 'pdf, doc, jpeg, etc',
  PRIMARY KEY (`type_of_document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `kj_type_of_document`
--

INSERT INTO `kj_type_of_document` (`type_of_document_id`, `price`, `title`, `type`) VALUES
(1, 0, 'Portable Document Format', 'pdf'),
(2, 0, 'Microsoft Word Document', 'doc'),
(3, 0, 'Microsoft Word Document', 'docx'),
(4, 0, 'Microsoft Excel Document', 'xls'),
(5, 0, 'Microsoft Excel Document', 'xlsx'),
(6, 0, 'Simple Text Document', 'txt'),
(7, 0, 'image Document', 'jpg'),
(8, 0, 'image Document', 'jpeg'),
(9, 0, 'image Document', 'png'),
(10, 0, 'image Document', 'gif'),
(11, 0, 'Compressed Document', 'zip'),
(12, 0, 'Compressed Document', 'rar'),
(13, 0, 'Microsoft Compiled HTML Help', 'chm'),
(14, 0, 'Microsoft Office Powerpoint Document', 'ppt'),
(15, 0, 'Microsoft Office Powerpoint Document', 'pptx');

-- --------------------------------------------------------

--
-- Table structure for table `kj_visit_history`
--

CREATE TABLE IF NOT EXISTS `kj_visit_history` (
  `visit_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `visitor` int(11) unsigned NOT NULL COMMENT 'the visitor is a member: a person or a company',
  `visited` int(11) unsigned NOT NULL COMMENT 'the visited is a member: a person or a company',
  `visit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`visit_history_id`),
  KEY `visitor` (`visitor`),
  KEY `visited` (`visited`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kj_working_history`
--

CREATE TABLE IF NOT EXISTS `kj_working_history` (
  `working_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_address` varchar(100) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `job_description` tinytext NOT NULL,
  PRIMARY KEY (`working_history_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kj_working_history`
--

INSERT INTO `kj_working_history` (`working_history_id`, `member_id`, `company_name`, `company_address`, `start_date`, `end_date`, `job_description`) VALUES
(1, 11, 'Baltimore City Community Colege', '2901 Liberty Height Ave., Baltimore, MD - 21207', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lab Tech'),
(2, 11, 'Kimberts Solutions', '3409 Aurora Lane, Baltimore, MD 21207', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'IT Solutions');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kj_award`
--
ALTER TABLE `kj_award`
  ADD CONSTRAINT `kj_award_fk` FOREIGN KEY (`id_member`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_company_details`
--
ALTER TABLE `kj_company_details`
  ADD CONSTRAINT `kj_company_details_fk1` FOREIGN KEY (`industry_type_id`) REFERENCES `kj_industry_type` (`industryTypeID`),
  ADD CONSTRAINT `kj_company_details_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_documents`
--
ALTER TABLE `kj_documents`
  ADD CONSTRAINT `kj_documents_fk` FOREIGN KEY (`type_of_document_id`) REFERENCES `kj_type_of_document` (`type_of_document_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kj_education_history`
--
ALTER TABLE `kj_education_history`
  ADD CONSTRAINT `kj_education_history_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kj_education_history_fk1` FOREIGN KEY (`degree_type_id`) REFERENCES `kj_degree_type` (`degree_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kj_job`
--
ALTER TABLE `kj_job`
  ADD CONSTRAINT `kj_job_fk` FOREIGN KEY (`owner`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_job_alerts`
--
ALTER TABLE `kj_job_alerts`
  ADD CONSTRAINT `kj_job_alerts_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kj_job_alerts_fk1` FOREIGN KEY (`job_category_id`) REFERENCES `kj_job_category` (`job_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_job_applied_for`
--
ALTER TABLE `kj_job_applied_for`
  ADD CONSTRAINT `kj_job_applied_for_fk` FOREIGN KEY (`job_id`) REFERENCES `kj_job` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kj_job_applied_for_fk1` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_member`
--
ALTER TABLE `kj_member`
  ADD CONSTRAINT `kj_member_fk` FOREIGN KEY (`access_level_id`) REFERENCES `kj_access_level` (`access_level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kj_member_fk1` FOREIGN KEY (`employment_status_id`) REFERENCES `kj_employment_status` (`employment_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kj_reference`
--
ALTER TABLE `kj_reference`
  ADD CONSTRAINT `kj_reference_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_skills`
--
ALTER TABLE `kj_skills`
  ADD CONSTRAINT `kj_skills_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_special_professionnal_training`
--
ALTER TABLE `kj_special_professionnal_training`
  ADD CONSTRAINT `kj_special_professionnal_training_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_visit_history`
--
ALTER TABLE `kj_visit_history`
  ADD CONSTRAINT `kj_visit_history_fk` FOREIGN KEY (`visitor`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kj_visit_history_fk1` FOREIGN KEY (`visited`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kj_working_history`
--
ALTER TABLE `kj_working_history`
  ADD CONSTRAINT `kj_working_history_fk` FOREIGN KEY (`member_id`) REFERENCES `kj_member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
