-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 11, 2014 at 01:22 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manuscriptlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `folio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `archive_juxta` enum('ARCHIVE','JUXTA') NOT NULL,
  UNIQUE KEY `folio_id` (`folio_id`,`user_id`,`archive_juxta`),
  KEY `folio_id_idx` (`folio_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `folios`
--

CREATE TABLE `folios` (
  `folio_id` int(11) NOT NULL,
  `mscript_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `alt_title` varchar(200) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `date_text` date DEFAULT NULL,
  `folio_contents` tinytext,
  `folio_prov` tinytext,
  `folio_num` int(11) DEFAULT NULL,
  `folio_side` enum('r','v') DEFAULT NULL,
  `no_of_lines` int(11) DEFAULT NULL,
  `no_of_col` tinyint(4) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `width` varchar(20) DEFAULT NULL,
  `height_written` varchar(20) DEFAULT NULL,
  `width_written` varchar(20) DEFAULT NULL,
  `qurie_sign` varchar(100) DEFAULT NULL,
  `catchwords` tinytext,
  `neumes` tinytext,
  `staves_per_page` int(11) DEFAULT NULL,
  `lines_per_staff` int(11) DEFAULT NULL,
  `dim_staff` float DEFAULT NULL,
  `col_staff` varchar(45) DEFAULT NULL,
  `res_ident` text,
  `website` tinytext,
  `contrib_inst` tinytext,
  `rights_mgmt` tinytext,
  `image_format` varchar(45) DEFAULT NULL,
  `digit_specs` tinytext,
  `date_digital` varchar(20) DEFAULT NULL,
  `scan_tech` varchar(200) DEFAULT NULL,
  `meta_catag` tinytext,
  `coll_admin` varchar(200) DEFAULT NULL,
  `faculty_liason` varchar(200) DEFAULT NULL,
  `abreviated_shelf` varchar(200) DEFAULT NULL,
  `no_of_lines_broken` tinyint(1) NOT NULL DEFAULT '0',
  `ht_fol_broken` tinyint(1) NOT NULL DEFAULT '0',
  `width_fol_broken` tinyint(1) DEFAULT '0',
  `ht_written_space_broken` tinyint(1) NOT NULL DEFAULT '0',
  `width_written_space_broken` tinyint(1) NOT NULL DEFAULT '0',
  `staves_per_page_broken` tinyint(1) NOT NULL DEFAULT '0',
  `min_ht` float DEFAULT NULL,
  `max_ht` float DEFAULT NULL,
  `max_width` float DEFAULT NULL,
  `min_width` float DEFAULT NULL,
  `min_writ_ht` float DEFAULT NULL,
  `max_writ_ht` float DEFAULT NULL,
  `min_writ_width` float DEFAULT NULL,
  `max_writ_width` float DEFAULT NULL,
  PRIMARY KEY (`folio_id`),
  KEY `mscript_id_idx` (`mscript_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `folios_temp`
--

CREATE TABLE `folios_temp` (
  `folio_id` int(11) NOT NULL AUTO_INCREMENT,
  `mscript_id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `alt_title` varchar(200) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `date_text` date DEFAULT NULL,
  `folio_contents` tinytext,
  `folio_prov` tinytext,
  `folio_num` int(11) DEFAULT NULL,
  `folio_side` enum('r','v') DEFAULT NULL,
  `no_of_lines` int(11) DEFAULT NULL,
  `no_of_col` tinyint(4) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `width` varchar(20) DEFAULT NULL,
  `height_written` varchar(20) DEFAULT NULL,
  `width_written` varchar(20) DEFAULT NULL,
  `qurie_sign` varchar(100) DEFAULT NULL,
  `catchwords` tinytext,
  `neumes` tinytext,
  `staves_per_page` int(11) DEFAULT NULL,
  `lines_per_staff` int(11) DEFAULT NULL,
  `dim_staff` float DEFAULT NULL,
  `col_staff` varchar(45) DEFAULT NULL,
  `res_ident` text,
  `website` tinytext,
  `contrib_inst` tinytext,
  `rights_mgmt` tinytext,
  `image_format` varchar(45) DEFAULT NULL,
  `digit_specs` tinytext,
  `date_digital` varchar(20) DEFAULT NULL,
  `scan_tech` varchar(200) DEFAULT NULL,
  `meta_catag` tinytext,
  `coll_admin` varchar(200) DEFAULT NULL,
  `faculty_liason` varchar(200) DEFAULT NULL,
  `abreviated_shelf` varchar(200) DEFAULT NULL,
  `no_of_lines_broken` tinyint(1) NOT NULL DEFAULT '0',
  `ht_fol_broken` tinyint(1) NOT NULL DEFAULT '0',
  `width_fol_broken` tinyint(1) DEFAULT '0',
  `ht_written_space_broken` tinyint(1) NOT NULL DEFAULT '0',
  `width_written_space_broken` tinyint(1) NOT NULL DEFAULT '0',
  `staves_per_page_broken` tinyint(1) NOT NULL DEFAULT '0',
  `min_ht` float DEFAULT NULL,
  `max_ht` float DEFAULT NULL,
  `max_width` float DEFAULT NULL,
  `min_width` float DEFAULT NULL,
  `min_writ_ht` float DEFAULT NULL,
  `max_writ_ht` float DEFAULT NULL,
  `min_writ_width` float DEFAULT NULL,
  `max_writ_width` float DEFAULT NULL,
  `ref_folio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`folio_id`),
  KEY `mscript_id_idx` (`mscript_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `folio_id` int(11) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `institution` tinytext,
  `division` varchar(200) DEFAULT NULL,
  `collection` varchar(200) DEFAULT NULL,
  `callno` varchar(200) DEFAULT NULL,
  `series` varchar(200) DEFAULT NULL,
  UNIQUE KEY `folio_id` (`folio_id`),
  KEY `folio_id_fk_idx` (`folio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location_temp`
--

CREATE TABLE `location_temp` (
  `folio_id` int(11) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `institution` tinytext,
  `division` varchar(200) DEFAULT NULL,
  `collection` varchar(200) DEFAULT NULL,
  `callno` varchar(200) DEFAULT NULL,
  `series` varchar(200) DEFAULT NULL,
  UNIQUE KEY `folio_id` (`folio_id`),
  KEY `folio_id_fk_idx` (`folio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manuscript`
--

CREATE TABLE `manuscript` (
  `mscript_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlinknumber` int(11) NOT NULL,
  `part` tinyint(4) NOT NULL DEFAULT '1',
  `date_manuscript` varchar(20) DEFAULT NULL,
  `century` varchar(45) DEFAULT NULL,
  `writing_support` varchar(100) DEFAULT NULL,
  `text_type` varchar(100) DEFAULT NULL,
  `liturgicaluse` varchar(45) DEFAULT NULL,
  `subject.lcsh` text,
  `language` varchar(100) DEFAULT NULL,
  `ruling_medium` varchar(100) DEFAULT NULL,
  `ruling_pattern` varchar(100) DEFAULT NULL,
  `collation` varchar(100) DEFAULT NULL,
  `decoration` text,
  `miniatures` text,
  `text_contents` varchar(200) DEFAULT NULL,
  `history` text,
  `schoenberg_num` varchar(100) DEFAULT NULL,
  `script` varchar(200) DEFAULT NULL,
  `scribe` varchar(200) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `numof_folios` int(11) DEFAULT NULL,
  `numof_avail_folios` int(11) DEFAULT NULL,
  `edition_cited` tinytext,
  `bibliography` tinytext,
  `publisher_digital` tinytext,
  `mlink_part` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mscript_id`),
  UNIQUE KEY `mlinknumber_UNIQUE` (`mlinknumber`,`part`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=233 ;

-- --------------------------------------------------------

--
-- Table structure for table `manuscript_temp`
--

CREATE TABLE `manuscript_temp` (
  `mscript_id` int(11) NOT NULL AUTO_INCREMENT,
  `mlinknumber` int(11) NOT NULL,
  `part` tinyint(4) NOT NULL DEFAULT '1',
  `date_manuscript` varchar(20) DEFAULT NULL,
  `century` varchar(45) DEFAULT NULL,
  `writing_support` varchar(100) DEFAULT NULL,
  `text_type` varchar(100) DEFAULT NULL,
  `liturgicaluse` varchar(45) DEFAULT NULL,
  `subject.lcsh` text,
  `language` varchar(100) DEFAULT NULL,
  `ruling_medium` varchar(100) DEFAULT NULL,
  `ruling_pattern` varchar(100) DEFAULT NULL,
  `collation` varchar(100) DEFAULT NULL,
  `decoration` text,
  `miniatures` text,
  `text_contents` varchar(200) DEFAULT NULL,
  `history` text,
  `schoenberg_num` varchar(100) DEFAULT NULL,
  `script` varchar(200) DEFAULT NULL,
  `scribe` varchar(200) DEFAULT NULL,
  `artist` varchar(100) DEFAULT NULL,
  `numof_folios` int(11) DEFAULT NULL,
  `numof_avail_folios` int(11) DEFAULT NULL,
  `edition_cited` tinytext,
  `bibliography` tinytext,
  `publisher_digital` tinytext,
  `mlink_part` varchar(20) DEFAULT NULL,
  `mscript_id_orig` int(11) DEFAULT NULL,
  PRIMARY KEY (`mscript_id`),
  UNIQUE KEY `mlinknumber_UNIQUE` (`mlinknumber`,`part`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `origin`
--

CREATE TABLE `origin` (
  `mscript_id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `institution` tinytext,
  `commagent` varchar(100) DEFAULT NULL,
  UNIQUE KEY `mscript_id` (`mscript_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `origin_temp`
--

CREATE TABLE `origin_temp` (
  `mscript_id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `institution` tinytext,
  `commagent` varchar(100) DEFAULT NULL,
  UNIQUE KEY `mscript_id` (`mscript_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('READER','EDITOR','ADMIN','SUPERADMIN''') NOT NULL DEFAULT 'READER',
  `isactivated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `id_UNIQUE` (`user_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_search_query`
--

CREATE TABLE `user_search_query` (
  `user_id` int(11) NOT NULL,
  `search_query` text,
  `search_desc` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_folio_id_fk` FOREIGN KEY (`folio_id`) REFERENCES `folios` (`folio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `archives_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `folios`
--
ALTER TABLE `folios`
  ADD CONSTRAINT `folio_mscript_id_fk` FOREIGN KEY (`mscript_id`) REFERENCES `manuscript` (`mscript_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_folio_id_fk` FOREIGN KEY (`folio_id`) REFERENCES `folios` (`folio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `origin`
--
ALTER TABLE `origin`
  ADD CONSTRAINT `origin_mscript_id_fk` FOREIGN KEY (`mscript_id`) REFERENCES `manuscript` (`mscript_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_search_query`
--
ALTER TABLE `user_search_query`
  ADD CONSTRAINT `user_search_query_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
