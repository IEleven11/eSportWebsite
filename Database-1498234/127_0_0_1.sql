-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2020 at 04:04 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esportwebsite`
--
CREATE DATABASE IF NOT EXISTS `esportwebsite` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `esportwebsite`;

-- --------------------------------------------------------

--
-- Table structure for table `fort`
--

CREATE TABLE `fort` (
  `userid` int(11) NOT NULL,
  `Account` varchar(255) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fort`
--

INSERT INTO `fort` (`userid`, `Account`, `Level`) VALUES
(81, 'eweEleven223', 65);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageid` int(11) NOT NULL,
  `imageurl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageid`, `imageurl`) VALUES
(1, 'includes/layout/images/genji.jpg'),
(2, 'includes/layout/images/eleven.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsid` int(11) NOT NULL,
  `newstitle` varchar(255) NOT NULL,
  `newsdescribe` text NOT NULL,
  `newsdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsid`, `newstitle`, `newsdescribe`, `newsdate`) VALUES
(9, 'sfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfd', '<p>sfdsfdsfdsfdsfdsfdsfdsfd</p><p>sfdsfdsfdsfdsfdsfdsfd</p><p>sfdsfdsfd</p>', '2019-06-19'),
(10, 'dfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfs', '<p>dfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfs</p><p>dfsdfsdfsdfsdfsdfsdfs</p><p>dfsdfsdfsdfs</p>', '2019-06-19'),
(11, 'sgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgd', '<p>sgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgd</p><p>sgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgdsgfgd</p>', '2019-06-19'),
(12, 'asdsadsad', '<p>dasdasdasdas</p>', '2020-01-31'),
(13, 'sdfasdfs', '<p>sdafsdafasdffad</p>', '2020-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `overwatch`
--

CREATE TABLE `overwatch` (
  `userid` int(11) NOT NULL,
  `Account` varchar(255) NOT NULL,
  `CompSR` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Main` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overwatch`
--

INSERT INTO `overwatch` (`userid`, `Account`, `CompSR`, `Level`, `Main`) VALUES
(26, 'fsafsfasfsadf', 4000, 582, 'D.va'),
(74, 'fsafsfasfsadf', 5000, 582, 'Ashe'),
(77, 'fsafsfasfsadf', 3002, 233, 'Hanzo'),
(82, 'dsadsad', 4000, 25, 'Ana');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sectionid` int(11) NOT NULL,
  `sectionname` varchar(255) NOT NULL,
  `sectioncut` varchar(255) NOT NULL,
  `form1` varchar(255) DEFAULT NULL,
  `form2` varchar(255) DEFAULT NULL,
  `form3` varchar(255) DEFAULT NULL,
  `form4` varchar(255) DEFAULT NULL,
  `form5` varchar(255) DEFAULT NULL,
  `form6` varchar(255) DEFAULT NULL,
  `form7` varchar(255) DEFAULT NULL,
  `form8` varchar(255) DEFAULT NULL,
  `sectionpicture` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sectionid`, `sectionname`, `sectioncut`, `form1`, `form2`, `form3`, `form4`, `form5`, `form6`, `form7`, `form8`, `sectionpicture`) VALUES
(1, 'overwatch', 'overwatch', 'Account', 'CompSR', 'Level', 'Main', NULL, NULL, NULL, NULL, 'includes/layout/images/OW_bg.jpg'),
(56, 'Fortnite', 'Fort', 'Account', 'Level', '', '', '', '', '', '', 'includes/layout/images/2495585e483d1015b15Fortnite_bg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sectionterms`
--

CREATE TABLE `sectionterms` (
  `sectionid` int(11) NOT NULL,
  `formname` varchar(255) NOT NULL,
  `max` int(11) DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `empty` tinyint(1) DEFAULT NULL,
  `number` tinyint(1) DEFAULT NULL,
  `selection` tinyint(1) NOT NULL,
  `selectionpool` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sectionterms`
--

INSERT INTO `sectionterms` (`sectionid`, `formname`, `max`, `min`, `empty`, `number`, `selection`, `selectionpool`) VALUES
(1, 'Account', 18, 5, 0, 0, 0, NULL),
(1, 'CompSR', 5000, 3000, 0, 1, 0, NULL),
(1, 'Level', 1000, 25, 0, 1, 0, NULL),
(1, 'Main', 500, 0, 0, 0, 1, 'Ana, Ashe, Bastio,n Brigitte, D.va, Doomfist, Genji, Hanzo'),
(56, 'Account', 18, 4, 0, 0, 0, NULL),
(56, 'Level', 100, 1, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomments`
--

CREATE TABLE `ticketcomments` (
  `ticketid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `commentdescribe` varchar(255) NOT NULL,
  `commentdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketid` int(11) NOT NULL,
  `ticketname` varchar(255) NOT NULL,
  `ticketemail` varchar(255) NOT NULL,
  `tickettype` varchar(255) NOT NULL,
  `ticketsubject` varchar(255) NOT NULL,
  `ticketdescribe` tinytext NOT NULL,
  `ticketdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketid`, `ticketname`, `ticketemail`, `tickettype`, `ticketsubject`, `ticketdescribe`, `ticketdate`) VALUES
(1, 'adasdsa', 'dsasdsad@dsads.com', 'Ø´ÙƒÙˆÙ‰', 'asdasdas', 'dasdsadasdasdsaasdasdasdsadsadsadasdasdsdfggsgfdfdfgsdfgsdasdsadasdasdsaasdasdasdsadsadsadasdasdsdfggsgfdfdfgsdfgsdasdsadasdasdsaasdasdasdsadsadsadasdasdsdfggsgfdfdfgsdfgs', '2020-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'member',
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `phone`, `twitter`, `instagram`, `sex`, `country`, `specialty`, `platform`, `role`, `picture`) VALUES
(26, 'admin', 'admin', 'admin', 'sbahawi@gmail.com', '$2y$10$7toZH9rk8vJrjG3Z4IhA6.t0Gkwt5It5GBqDq.aOkMRJniFKC78Qe', '223423424332', '@admin', '@admin', 'male', 'Saudi Arabia', '', 'pc', 'administration', ''),
(74, 'Suhail', 'Bahawi', 'Eleven0_11', 'ds34hawi@gmail.com', '$2y$10$x00UyoTGM/lnB7GxNaTbYO..VMPNfuUDin7rUmPugLEewWyLUaID.', '2222222222', '@fa4', '', 'male', 'Saudi Arabia', 'overwatch', 'pc', 'support', ''),
(77, 'cemel', 'same', 'c_ant10', 'ant_hawi@gmail.com', '$2y$10$98MrTKUQR8EUqcEImxwwCO2dHueuEHoxy71I3dCzFRq3FBX9UgNDa', '43242342', '@fad2', '@dsad', 'male', 'Saudi Arabia', 'overwatch', 'ps4', 'member', ''),
(82, 'mohaa', 'dfsgfdsgdsfg', 'suhail123', 'otaku4ever321@gmail.com', '$2y$10$yrY7oQ4n8UQeMRVBRAuuGeUHpb8/vjnCtnBbJbycFpMGVZzEFTNMW', '4324234243', '@fasdf', '', 'male', 'Saudi Arabia', 'overwatch', 'pc', 'manager', 'includes/layout/images/genji.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `visitorid` int(11) NOT NULL,
  `visitorip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitorid`, `visitorip`) VALUES
(1, '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fort`
--
ALTER TABLE `fort`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- Indexes for table `overwatch`
--
ALTER TABLE `overwatch`
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sectionid`);

--
-- Indexes for table `sectionterms`
--
ALTER TABLE `sectionterms`
  ADD KEY `sectionid` (`sectionid`);

--
-- Indexes for table `ticketcomments`
--
ALTER TABLE `ticketcomments`
  ADD KEY `ticketid` (`ticketid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sectionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `overwatch`
--
ALTER TABLE `overwatch`
  ADD CONSTRAINT `overwatch_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sectionterms`
--
ALTER TABLE `sectionterms`
  ADD CONSTRAINT `Sections - SectionForms` FOREIGN KEY (`sectionid`) REFERENCES `sections` (`sectionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticketcomments`
--
ALTER TABLE `ticketcomments`
  ADD CONSTRAINT `ticketcomments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticketcomments_ibfk_2` FOREIGN KEY (`ticketid`) REFERENCES `tickets` (`ticketid`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"relation_lines\":\"true\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"esportwebsite\",\"table\":\"tickets\"},{\"db\":\"esportwebsite\",\"table\":\"users\"},{\"db\":\"esportwebsite\",\"table\":\"sections\"},{\"db\":\"esportwebsite\",\"table\":\"lol\"},{\"db\":\"esportwebsite\",\"table\":\"overwatch\"},{\"db\":\"esportwebsite\",\"table\":\"sectionterms\"},{\"db\":\"esportwebsite\",\"table\":\"asdfasd\"},{\"db\":\"esportwebsite\",\"table\":\"asdfsdaf\"},{\"db\":\"esportwebsite\",\"table\":\"league of legends\"},{\"db\":\"esportwebsite\",\"table\":\"r6s\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float UNSIGNED NOT NULL DEFAULT '0',
  `y` float UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Dumping data for table `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('esportwebsite', 'sections', 'sectionname'),
('esportwebsite', 'sectionterms', 'formname'),
('esportwebsite', 'users', 'firstname');

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'esportwebsite', 'sections', '{\"sorted_col\":\"`sectionname`  DESC\"}', '2020-02-10 16:04:57'),
('root', 'esportwebsite', 'users', '{\"sorted_col\":\"`users`.`specialty`  ASC\"}', '2020-02-14 10:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2020-02-17 15:04:33', '{\"Console\\/Mode\":\"collapse\",\"NavigationWidth\":242}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `sbhost`
--
CREATE DATABASE IF NOT EXISTS `sbhost` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sbhost`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
