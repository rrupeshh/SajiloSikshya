-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 09:07 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajiloshiksha5`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `agree` int(11) DEFAULT NULL,
  `comment` text,
  `comment_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `firstname`, `lastname`, `username`, `date`, `agree`, `comment`, `comment_id`) VALUES
(44, 'Bipul ', 'Thapa', 'bipul', '2017-02-14', 0, 'Hello All! Good morning Everyone! This is try on editing', 49),
(31, 'Bipul', 'Thapa', 'bipul', '2017-02-12', 0, 'Help Needed!', 38),
(32, 'Bipul ', 'Thapa', 'bipul', '2017-02-12', 0, 'Help me out guys', 40),
(33, 'ku1', 'ku1', 'ku1', '2017-02-12', 0, 'I want too to learn this\r<br>', 40),
(34, 'ku1', 'ku1', 'ku1', '2017-02-12', 0, 'It quite easy', 36),
(35, 'Bipul ', 'Thapa', 'bipul', '2017-02-13', 0, 'anyone can contact me', 43),
(36, 'ku1 ', 'ku1', 'ku1', '2017-02-13', 0, 'I need help. Can any one post when  and where  will be this program session held?', 43),
(37, 'ku2', 'ku2', 'ku2', '2017-02-13', 0, 'I also need Help! Is it free?', 43),
(38, 'Bipul ', 'Thapa', 'bipul', '2017-02-13', 0, 'Well just contact me! I am the admin of this page. Hope that you all have my contact number.', 43),
(39, 'Dipesh ', 'Rai', 'dipesh', '2017-02-13', 0, 'Glad to know that many are interested! Looking forward for the session! ####', 43),
(40, 'ku1 ', 'ku1', 'ku1', '2017-02-13', 0, 'Hello! ', 41),
(42, 'ku3', 'ku3', 'ku3', '2017-02-14', 0, 'this is try', 43),
(43, 'Bipul ', 'Thapa', 'bipul', '2017-02-14', 0, 'Good to hear that', 43),
(45, 'Bipul ', 'Thapa', 'bipul', '2017-02-14', 0, 'hello\r<br>', 49),
(46, 'Dipesh ', 'Rai', 'dipesh', '2017-02-16', 0, 'ufyufyf', 53);

-- --------------------------------------------------------

--
-- Table structure for table `forum_questions`
--

CREATE TABLE `forum_questions` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `question` text,
  `date` date DEFAULT NULL,
  `num_answers` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_questions`
--

INSERT INTO `forum_questions` (`id`, `firstname`, `lastname`, `username`, `question`, `date`, `num_answers`) VALUES
(43, 'Dipesh', 'Rai', 'dipesh', 'Hello there! I am the new HTML teacher. Interested People can contact me or admin. Cheers!', '2017-02-13', 7),
(38, 'Bipul', 'Thapa', 'bipul', 'How to write js in PHP?', '2017-02-12', 1),
(50, 'Bipul ', 'Thapa', 'bipul', 'hello\r<br>', '2017-02-14', 0),
(42, 'ku1', 'ku1', 'ku1', 'I am desperate to learn HTML? Can anyone help me?', '2017-02-13', 0),
(52, 'Bipul ', 'Thapa', 'bipul', 'Session starts Today', '2017-02-14', 0),
(53, 'ku3', 'ku3', 'ku3', 'Thank you', '2017-02-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `group_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `user_id_fk`, `group_description`) VALUES
(2, 'Comp202', 0, 'Course CE II year '),
(3, 'Ku CE 2015', 0, 'Class room Group');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `group_users_id` int(11) NOT NULL,
  `groups_id_fk` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mcq_number`
--

CREATE TABLE `mcq_number` (
  `id` int(11) NOT NULL,
  `model_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_number`
--

INSERT INTO `mcq_number` (`id`, `model_no`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mcq_section`
--

CREATE TABLE `mcq_section` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `set_no` int(11) NOT NULL,
  `date` date NOT NULL,
  `correct_ans` int(11) NOT NULL,
  `outof` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_section`
--

INSERT INTO `mcq_section` (`id`, `username`, `firstname`, `lastname`, `set_no`, `date`, `correct_ans`, `outof`) VALUES
(2, 'dipesh', 'Dipesh ', 'Rai', 1, '2017-02-16', 5, 7),
(4, 'ku2', 'ku2', 'ku2', 1, '2017-02-16', 6, 7),
(6, 'dipesh', 'Dipesh ', 'Rai', 1, '2017-02-16', 7, 7),
(7, 'dipesh', 'Dipesh ', 'Rai', 1, '2017-02-16', 3, 7),
(8, 'ku3', 'ku3', 'ku3', 1, '2017-02-16', 1, 7),
(9, 'bipul', 'Bipul ', 'Thapa', 1, '2017-02-16', 3, 3),
(10, 'bipul', 'Bipul ', 'Thapa', 1, '2017-02-17', 3, 4),
(15, 'dipesh', 'Dipesh   ', 'Rai', 1, '2017-02-17', 5, 6),
(13, 'bipul', 'Bipul ', 'Thapa', 2, '2017-02-17', 1, 1),
(14, 'bipul', 'Bipul ', 'Thapa', 2, '2017-02-17', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mcq_section_sets`
--

CREATE TABLE `mcq_section_sets` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `opt_one` text NOT NULL,
  `opt_two` text NOT NULL,
  `opt_three` text NOT NULL,
  `opt_four` text NOT NULL,
  `opt_corr` text NOT NULL,
  `set_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_section_sets`
--

INSERT INTO `mcq_section_sets` (`id`, `question`, `opt_one`, `opt_two`, `opt_three`, `opt_four`, `opt_corr`, `set_no`) VALUES
(1, 'WWW stands for ?', 'World Whole Web', 'Wide World Web', 'Web World Wide', 'World Wide Web', 'World Wide Web', 1),
(2, 'Which of the following are components of Central Processing Unit (CPU) ?', 'Arithmetic logic unit, Mouse', 'Arithmetic logic unit, Control unit', 'Arithmetic logic unit, Integrated Circuits', 'Control Unit, Monitor', 'Arithmetic logic unit, Control unit', 1),
(3, 'Which among following first generation of computers had ?', 'Vaccum Tubes and Magnetic Drum', 'Integrated Circuits', 'Magnetic Tape and Transistors', 'All of above', 'Vaccum Tubes and Magnetic Drum', 1),
(4, 'Where is RAM located ?', 'Expansion Board', 'External Drive', 'Mother Board', 'All of above', 'Mother Board', 1),
(5, 'If a computer has more than one processor then it is known as ?', 'Uniprocess', 'Multiprocessor', 'Multithreaded', 'Multiprogramming', 'Multiprocessor', 1),
(6, 'What?', 'a', 'b', 'c', 'd', 'a', 1),
(7, 'What?', 'a', 'b', 'c', 'd', 'a', 2),
(8, 'Full form of URL is ?', 'Uniform Resource Locator', 'Uniform Resource Link', 'Uniform Registered Link', 'Unified Resource Link', 'Uniform Resource Locator', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_headline` varchar(255) NOT NULL,
  `news_short_description` text NOT NULL,
  `news_full_story` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_headline`, `news_short_description`, `news_full_story`, `date`) VALUES
(1, 'Try news 1', 'This is try news 1', 'This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.This is a try news.', '2017-01-25'),
(35, 'News 1', 'This is news one.', 'News One description goes here.', '2017-02-01'),
(36, 'News 2', 'This is news two', 'News Two goes here.', '2017-02-01'),
(38, 'Create', '3', 'News', '2017-02-02'),
(39, '25m lane road construction', 'In hetauda there was a problem with the road construction ', 'Recently in hetauda due to departmemt of road  work to expand the tribhuwan highway in hetauda area there was conflict between the landowners and police.Local people says that they are going to be made refugee by the government', '2017-02-02'),
(41, 'News Four', 'This is news Four', 'THis is news 4.Hello All ! GOOD MORNING!', '2017-02-02'),
(42, 'GM', 'Good morning!', 'SajiloShiksha News!', '2017-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `post` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `usersex` text NOT NULL,
  `dob` date NOT NULL,
  `birthplace` text NOT NULL,
  `biography` text NOT NULL,
  `image` longblob NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `email`, `password`, `post`, `username`, `college`, `usersex`, `dob`, `birthplace`, `biography`, `image`, `role`) VALUES
(1, 'Bipul ', 'Thapa', 'bipulthapa23@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Student', 'bipul', 'kathmandu university', 'Male', '1996-07-23', 'hetauda-4,makwanpur', 'Studying Computer Engineering', 0x646f776e6c6f61642e706e67, 'admin'),
(4, 'ku1 ', 'ku1', 'ku1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Student', 'ku1', '', 'Male', '1970-01-01', '', '', 0x696e74656c2e6a7067, 'user'),
(5, 'ku2', 'ku2', 'ku2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Student', 'ku2', '', '', '0000-00-00', '', '', '', 'user'),
(6, 'ku3', 'ku3', 'ku3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Student', 'ku3', '', '', '0000-00-00', '', '', '', 'user'),
(7, 'Dipesh   ', 'Rai', 'dipeshrai@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Teacher', 'dipesh', 'Kathmandu University', 'Male', '1998-03-12', 'Hetauda', 'Computer Engineering At KU', 0x50524f46494c455f504943545552452e4a5047, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `update_id` int(11) NOT NULL,
  `update Text` text NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `group_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_questions`
--
ALTER TABLE `forum_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`group_users_id`);

--
-- Indexes for table `mcq_number`
--
ALTER TABLE `mcq_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_section`
--
ALTER TABLE `mcq_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcq_section_sets`
--
ALTER TABLE `mcq_section_sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`update_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `forum_questions`
--
ALTER TABLE `forum_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mcq_number`
--
ALTER TABLE `mcq_number`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mcq_section`
--
ALTER TABLE `mcq_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `mcq_section_sets`
--
ALTER TABLE `mcq_section_sets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `update_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
