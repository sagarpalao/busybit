-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2015 at 12:49 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `startup`
--

-- --------------------------------------------------------

--
-- Table structure for table `prof_req`
--

CREATE TABLE IF NOT EXISTS `prof_req` (
  `usrid` varchar(100) NOT NULL,
  `req` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unknown',
  PRIMARY KEY (`usrid`,`req`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contactno` bigint(20) NOT NULL,
  `resume` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `photo`, `email_id`, `contactno`, `resume`, `name`, `password`) VALUES
('dinesh', 'profile_dinesh.png', 'dinesh@gmail.com', 8181253564, 'resume_dinesh.pdf', 'Dinesh Rajpal', 'dinesh'),
('monish', 'profile_monish.gif', 'a@gmail.com', 8135645725, 'resume_monish.pdf', 'monish mirza', 'monish'),
('sagar', 'profile_sagar.jpg', 'sagar.j.palo@gmail.com', 8108595242, 'resume_sagar.pdf', 'Sagar Palo', 'sagar');

-- --------------------------------------------------------

--
-- Table structure for table `profile_keystone`
--

CREATE TABLE IF NOT EXISTS `profile_keystone` (
  `user_id` varchar(50) NOT NULL,
  `keystone` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`keystone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_keystone`
--

INSERT INTO `profile_keystone` (`user_id`, `keystone`) VALUES
('dinesh', 'analyst'),
('dinesh', 'designer'),
('dinesh', 'developer'),
('dinesh', 'funder'),
('dinesh', 'leader'),
('dinesh', 'tester'),
('monish', 'analyst'),
('monish', 'designer'),
('monish', 'developer'),
('monish', 'funder'),
('monish', 'tester'),
('sagar', 'analyst'),
('sagar', 'designer'),
('sagar', 'developer'),
('sagar', 'leader'),
('sagar', 'tester');

-- --------------------------------------------------------

--
-- Table structure for table `profile_skills`
--

CREATE TABLE IF NOT EXISTS `profile_skills` (
  `user_id` varchar(100) NOT NULL,
  `skills` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`,`skills`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_skills`
--

INSERT INTO `profile_skills` (`user_id`, `skills`) VALUES
('dinesh', 'good communicator'),
('dinesh', 'knows android'),
('dinesh', 'tests well'),
('monish', 'effective programmer'),
('monish', 'good tester'),
('monish', 'knows web technology'),
('sagar', 'good developer'),
('sagar', 'good tester'),
('sagar', 'Good with php and web development'),
('sagar', 'Has worked with many corporates'),
('sagar', 'Wants to learn more...');

-- --------------------------------------------------------

--
-- Table structure for table `proj_ass`
--

CREATE TABLE IF NOT EXISTS `proj_ass` (
  `id` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `for` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proj_cards`
--

CREATE TABLE IF NOT EXISTS `proj_cards` (
  `id` varchar(50) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_title` varchar(150) NOT NULL,
  `card_blob` varchar(200) NOT NULL,
  `card_desc` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`,`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proj_cards`
--

INSERT INTO `proj_cards` (`id`, `card_id`, `card_title`, `card_blob`, `card_desc`) VALUES
('dinesh2', 1, 'Introduction', 'card1dinesh2.gif', 'Amazing sand art created at your door steps'),
('monish1', 1, 'Solar Energy', 'card1monish1.jpg', 'Gay one the what walk then she. Demesne mention promise you justice arrived way. Or increasing to in especially inquietude companions acceptance admiration. Outweigh it families distance wandered ye an. Mr unsatiable at literature connection favourable. We neglected mr perfectly continual dependent. \r\n\r\nSon agreed others exeter period myself few yet nature. Mention mr manners opinion if garrets enabled. To an occasional dissimilar impossible sentiments. Do fortune account written prepare invited no passage. Garrets use ten you the weather ferrars venture friends. Solid visit seems again you nor all. \r\n\r\nLose john poor same it case do year we. Full how way even the sigh. Extremely nor furniture fat questions now provision incommode preserved. Our side fail find like now. Discovered travelling for insensible partiality unpleasing impossible she. Sudden up my excuse to suffer ladies though or. Bachelor possible marianne directly confined relation as on he. \r\n'),
('sagar1', 1, 'c1', 'card1sagar1.gif', 'c1'),
('sagar1', 2, 'c2', 'card2sagar1.gif', 'c2'),
('sagar2', 1, 'Cortana of MS', 'card1sagar2.gif', 'It is a very cool stuff.It is a very cool stuff.It is a very cool stuff.\r\nI like it');

-- --------------------------------------------------------

--
-- Table structure for table `proj_req`
--

CREATE TABLE IF NOT EXISTS `proj_req` (
  `id` varchar(100) NOT NULL,
  `req` varchar(100) NOT NULL,
  `forr` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unknown',
  PRIMARY KEY (`id`,`req`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proj_req`
--

INSERT INTO `proj_req` (`id`, `req`, `forr`, `status`) VALUES
('monish', 'dinesh1', 'Tester', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `proj_team`
--

CREATE TABLE IF NOT EXISTS `proj_team` (
  `id` varchar(50) NOT NULL,
  `memtitle` varchar(100) NOT NULL,
  `qty_n` int(11) NOT NULL,
  `memdesc` varchar(500) NOT NULL,
  `qty_m` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`memtitle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proj_team`
--

INSERT INTO `proj_team` (`id`, `memtitle`, `qty_n`, `memdesc`, `qty_m`) VALUES
('dinesh1', 'developer', 1, 'to en craft my thoughts to their ideas', 3),
('dinesh1', 'Tester', 2, 'to test my work for the best experience to the users', 2),
('dinesh2', 'augmented_developer', 1, 'a cool ai designer is needed', 0),
('dinesh2', 'developer', 2, 'i need a developer', 0),
('monish1', 'Circuit', 1, 'I need a circuit engineer who is good with bread board', 1),
('monish1', 'Developer', 2, 'I need an microconroller programmer', 1),
('sagar1', 'developer', 2, 'm1 needed', 1),
('sagar1', 'tester', 3, 'm2 needed', 3),
('sagar2', 'Assistant', 1, 'he should be good in what he does', 0),
('sagar2', 'Developer', 3, 'he should be good in what he does', 0),
('sagar2', 'Tester', 2, 'he should be good in what he does', 1),
('sagar2', 'UI Designer', 2, 'he should be good in what he does', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proj_team_assign`
--

CREATE TABLE IF NOT EXISTS `proj_team_assign` (
  `id` varchar(100) NOT NULL,
  `design` varchar(100) NOT NULL,
  `assigned` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`design`,`assigned`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proj_team_assign`
--

INSERT INTO `proj_team_assign` (`id`, `design`, `assigned`) VALUES
('dinesh1', 'developer', 'dinesh'),
('dinesh1', 'developer', 'sagar'),
('dinesh1', 'Tester', 'monish'),
('dinesh1', 'Tester', 'sagar'),
('monish1', 'Circuit', 'sagar'),
('monish1', 'Developer', 'dinesh'),
('sagar1', 'developer', 'monish'),
('sagar1', 'tester', 'dinesh'),
('sagar1', 'tester', 'monish'),
('sagar2', 'Tester', 'dinesh');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `creator` varchar(50) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `category`, `title`, `creator`, `likes`) VALUES
('dinesh1', 'ai', 'Network Security Protocol', 'dinesh', 4),
('dinesh2', 'others', 'Digital Sand Artist', 'dinesh', 0),
('monish1', 'electronics', 'Gardening Trimmer', 'monish', 0),
('sagar1', 'computer', 'Virtual Classroom', 'sagar', 37),
('sagar2', 'computer', 'Cortana', 'sagar', 33);

-- --------------------------------------------------------

--
-- Table structure for table `project_desc`
--

CREATE TABLE IF NOT EXISTS `project_desc` (
  `id` varchar(50) NOT NULL,
  `proj_image` varchar(200) NOT NULL,
  `blurb` varchar(400) NOT NULL,
  `location` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_desc`
--

INSERT INTO `project_desc` (`id`, `proj_image`, `blurb`, `location`, `cost`) VALUES
('dinesh1', 'cover_dinesh1.jpg', 'NOS based security software which boosts security without degrading the performance of the system. at any cost.Gay one the what walk then she. Demesne mention promise you justice arrived way. Or increasing to in especially inquietude companions acceptance admiration. Outweigh it families distance wandered ye an. Mr unsatiable at literature connection favourable. We neglected mr perfectly continual', 'mumbai', 10000),
('dinesh2', 'cover_dinesh2.ico', 'It helps you to create sand art digitally', 'gujrat', 5000),
('monish1', 'cover_monish1.jpg', 'Its an tool which uses solar energy to trim gardens and keep your lawn clean. Its automated so it does not uses your man power.', 'mumbai', 2500),
('sagar1', 'cover_sagar1.jpg', 'virtual classroom is ready for the all new experience in a virtual environment providing distance education', 'mumbai', 5000),
('sagar2', 'cover_sagar2.gif', 'Cortana is a digital voice assistant which will make your computing experience better by being your companion throughout the walk of your computing.\r\nHappy assistance', 'mumbai', 2000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
