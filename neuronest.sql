-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 10:54 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neuronest`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `level_id`, `activity_name`) VALUES
(1, 1, 'Image Recognition'),
(2, 1, 'Image Puzzle'),
(3, 1, 'Music Therapy');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_date` date NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `parent_id`, `trainer_id`, `child_id`, `booking_date`, `session_date`, `remarks`, `status`, `payment_status`, `amount`) VALUES
(1, 1, 1, 1, '2025-03-05 01:19:04', '2025-03-06', 'need to care and analyze my child', 'rejected', 'pending', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `message` text NOT NULL,
  `userid` int(20) NOT NULL,
  `date_time` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sid`, `message`, `userid`, `date_time`, `type`) VALUES
(1, 1, 'hi david.  im john', 1, '2025-03-05 02:33:33', 'parent'),
(2, 1, 'hello john how can i help you?', 1, '2025-03-05 02:43:17', 'trainer'),
(3, 1, 'hi', 1, '2025-03-05 11:13:10', 'trainer'),
(4, 3, 'hi i need assistance', 1, '2025-03-20 11:39:43', 'parent'),
(5, 1, 'hi im john how can i help you', 1, '2025-03-29 13:17:47', 'parent'),
(6, 1, 'hi', 1, '2025-03-29 13:24:06', 'parent'),
(7, 1, 'i need to enquire a course details?', 1, '2025-03-29 13:24:55', 'parent'),
(8, 1, 'i need to enquire a course details?', 1, '2025-03-29 13:25:18', 'parent'),
(9, 1, 'hi mike. Im john how can i help you?', 1, '2025-03-29 13:25:26', 'trainer');

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE IF NOT EXISTS `child` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(100) NOT NULL,
  `photo` tinytext NOT NULL,
  `special_needs` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`id`, `name`, `dob`, `gender`, `photo`, `special_needs`, `level`, `parent_id`) VALUES
(1, 'mike john', '2017-01-05', 'male', '2025-03-05-12-09-26360_F_696166359_TIleer11woeTm0nz4UUgqPujCZZ77lo3.jpg', 'always want to play', 'Beginner (Basic Recognition & Interaction)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cloth_score`
--

CREATE TABLE IF NOT EXISTS `cloth_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cloth_score`
--

INSERT INTO `cloth_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01'),
(2, 1, 0, '2025-04-01'),
(3, 1, 1, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `emotions`
--

CREATE TABLE IF NOT EXISTS `emotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emotion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `emotion_score`
--

CREATE TABLE IF NOT EXISTS `emotion_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `emotion_score`
--

INSERT INTO `emotion_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01'),
(2, 1, 0, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `image_puzzle_score`
--

CREATE TABLE IF NOT EXISTS `image_puzzle_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `image_puzzle_score`
--

INSERT INTO `image_puzzle_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-03-31'),
(2, 1, 1, '2025-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `image_recognition`
--

CREATE TABLE IF NOT EXISTS `image_recognition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL,
  `image` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `image_recognition`
--

INSERT INTO `image_recognition` (`id`, `word`, `image`) VALUES
(1, 'apple', '2025-02-05-02-12-19apple.jpg'),
(2, 'banana', '2025-02-05-02-12-33banana.jpg'),
(3, 'orange', '2025-02-05-02-12-45orange.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `image_rec_score`
--

CREATE TABLE IF NOT EXISTS `image_rec_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `image_rec_score`
--

INSERT INTO `image_rec_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-03-31'),
(2, 1, 1, '2025-03-31'),
(3, 1, 1, '2025-03-31'),
(4, 1, 1, '2025-03-31'),
(5, 1, 1, '2025-03-31'),
(6, 1, 1, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter` varchar(100) NOT NULL,
  `word` varchar(50) NOT NULL,
  `image` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `letter`, `word`, `image`) VALUES
(1, 'A', 'Apple', '2024-03-18-10-46-37apple_158989157.jpg'),
(2, 'B', 'Ball', '2024-03-18-10-47-56ball.jpg'),
(3, 'C', 'Cat', '2024-04-10-10-06-48vecteezy_ilustracion-de-lindo-gato-de-color-imagen-de-gato-de_13078569.png'),
(4, 'D', 'Dog', '2024-04-10-10-11-06pngwing.com (1).png'),
(5, 'E', 'Elephant', '2024-04-10-10-09-59pngwing.com.png'),
(6, 'F', 'Frog', '2024-03-22-01-27-48frog.jpeg'),
(7, 'G', 'Goat', '2024-04-10-10-13-33pngwing.com (2).png'),
(8, 'H', 'House', '2024-04-10-10-14-26pngwing.com (3).png'),
(9, 'I', 'Ice Cream', '2024-04-10-10-16-22pngwing.com (4).png'),
(10, 'J', 'Jelly Fish', '2024-04-10-10-17-58pngwing.com (5).png'),
(11, 'K', 'Kite', '2024-04-10-10-19-21pngwing.com (6).png'),
(12, 'L', 'Lion', '2024-04-10-10-19-51pngwing.com (7).png'),
(13, 'M', 'Monkey', '2024-04-10-10-20-23pngwing.com (8).png'),
(14, 'N', 'Nurse', '2024-04-10-10-21-29pngwing.com (9).png'),
(15, 'O', 'Octopus', '2024-04-10-10-22-39pngwing.com (10).png'),
(16, 'P', 'Penguin', '2024-04-10-10-24-30pngwing.com (11).png'),
(17, 'Q', 'Queen', '2024-04-10-10-25-39pngwing.com (12).png'),
(18, 'R', 'Rat', '2024-04-10-10-26-34pngwing.com (13).png'),
(19, 'S', 'Sun', '2024-04-10-10-27-23pngwing.com (14).png'),
(20, 'T', 'Tea', '2024-04-10-10-29-01pngwing.com (15).png'),
(21, 'U', 'Umbrella', '2024-04-10-10-30-32pngwing.com (16).png'),
(22, 'V', 'Vegetables', '2024-04-10-10-31-46pngwing.com (17).png'),
(23, 'W', 'Wheel', '2024-04-10-10-32-48pngwing.com (18).png'),
(24, 'X', 'X-Ray', '2024-04-10-10-33-52pngwing.com (19).png'),
(25, 'Y', 'Yak', '2024-04-10-10-34-48pngwing.com (20).png'),
(26, 'Z', 'Zip', '2024-04-10-10-36-05pngwing.com (21).png');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `description`) VALUES
(1, 'Level 1', 'Foundational Skills (Beginner)'),
(2, 'Level 2', 'Interactive Language & Cognitive Development (Intermediate)'),
(3, 'Level 3', 'Advanced Communication & Real-World Scenarios (Expert)');

-- --------------------------------------------------------

--
-- Table structure for table `manners_score`
--

CREATE TABLE IF NOT EXISTS `manners_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `manners_score`
--

INSERT INTO `manners_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `music_therapy_score`
--

CREATE TABLE IF NOT EXISTS `music_therapy_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `music_therapy_score`
--

INSERT INTO `music_therapy_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01'),
(2, 1, 0, '2025-04-01'),
(3, 1, 0, '2025-04-01'),
(4, 1, 0, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `number`
--

CREATE TABLE IF NOT EXISTS `number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter` varchar(100) NOT NULL,
  `image` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `number`
--

INSERT INTO `number` (`id`, `letter`, `image`) VALUES
(1, 'A', '2024-03-18-10-46-37apple_158989157.jpg'),
(2, 'B', '2024-03-18-10-47-56ball.jpg'),
(3, 'C', '2024-03-18-10-48-24cat.jpg'),
(4, 'D', '2024-03-18-10-49-25dog.jpg'),
(5, 'E', '2024-03-18-10-49-59uiCrUgVCf64TzEdTM8x9aD-1200-80.jpg'),
(6, 'F', '2024-03-22-01-27-48frog.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

CREATE TABLE IF NOT EXISTS `numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letter` varchar(100) NOT NULL,
  `word` varchar(50) NOT NULL,
  `image` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`id`, `letter`, `word`, `image`) VALUES
(1, '1', '1', '2024-04-22-06-21-251.png'),
(2, '2', '2', '2024-04-22-06-21-362.png'),
(3, '3', '3', '2024-04-22-06-21-493.png'),
(4, '4', '4', '2024-04-22-06-21-584.png'),
(5, '5', '5', '2024-04-22-06-22-085.png'),
(6, '6', '6', '2024-04-22-06-22-206.png'),
(7, '7', '7', '2024-04-22-06-22-307.png'),
(8, '8', '8', '2024-04-22-06-22-418.png'),
(9, '9', '9', '2024-04-22-06-22-529.png'),
(10, '10', '10', '2024-04-22-06-23-0110.png');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'john', 'john@gmail.com', '123', '07558083475');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `card_name` varchar(30) NOT NULL,
  `card_no` varchar(20) NOT NULL,
  `payment_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `booking_id`, `amount`, `card_type`, `card_name`, `card_no`, `payment_date`, `status`) VALUES
(1, 1, 1, 1500, 'credit', 'Mike', '12345654321234', '2025-03-05', 'completed'),
(2, 1, 1, 1500, 'credit', 'Mike', '1234654321234', '2025-03-15', 'completed'),
(3, 1, 1, 1500, 'credit', 'Mike', '1234567234567642', '2025-03-29', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE IF NOT EXISTS `routine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` varchar(100) NOT NULL,
  `task` varchar(255) NOT NULL,
  `image` tinytext NOT NULL,
  `status` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`id`, `date`, `time`, `task`, `image`, `status`, `parent_id`) VALUES
(1, '2025-04-01', '07:00:00', 'Wake up', '2025-02-04-04-14-02wakeup.png', 'completed', 1),
(2, '2025-04-01', '07:15:00', 'Brush teeth & freshen up', '2025-02-04-04-19-49brush_teeth.png', 'completed', 1),
(3, '2025-04-01', '07:30:00', 'Have breakfast', '2025-02-04-04-23-42breakfast.png', 'completed', 1),
(4, '2025-04-01', '08:00:00', 'Get dressed for school', '2025-02-04-04-27-30get_ready.png', 'completed', 1),
(5, '2025-04-01', '08:30:00', 'Leave for school', '2025-02-04-04-33-20go.png', 'Pending', 1),
(6, '2025-04-01', '09:00:00', 'Attend classes', '2025-02-04-04-36-40class.png', 'Pending', 1),
(7, '2025-04-01', '12:30:00', 'Lunch break', '2025-02-04-04-42-21lunch.png', 'Pending', 1),
(8, '2025-04-01', '13:00:00', 'Afternoon classes', '2025-02-04-04-44-46class1.png', 'Pending', 1),
(9, '2025-04-01', '16:00:00', 'Return home from school', '2025-02-04-04-57-36back_home.png', 'Pending', 1),
(10, '2025-04-01', '16:30:00', 'Freshen up & have snacks', '2025-02-04-07-07-41snacks.png', 'Pending', 1),
(12, '2025-04-01', '17:00:00', 'Engage in therapy', '2025-02-04-07-24-03Child-engaging-in-speech-therapy-activities-at-home-with-parent-21.png', 'Pending', 1),
(13, '2025-04-01', '18:00:00', 'Outdoor play', '2025-02-04-07-26-09play.png', 'Pending', 1),
(14, '2025-04-01', '19:00:00', 'Dinner time', '2025-02-04-07-30-38dinner.png', 'Pending', 1),
(15, '2025-04-01', '19:30:00', 'Calm activities', '2025-02-04-07-38-16calm.png', 'Pending', 1),
(16, '2025-04-01', '20:00:00', 'Bath time', '2025-02-04-07-40-18bath.png', 'Pending', 1),
(17, '2025-04-01', '20:30:00', 'Prayer', '2025-02-04-07-43-44prayer.png', 'Pending', 1),
(19, '2025-04-01', '21:00:00', 'Bedtime', '2025-02-04-07-44-32bed1.png', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_score`
--

CREATE TABLE IF NOT EXISTS `social_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `social_score`
--

INSERT INTO `social_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `speech_therapy`
--

CREATE TABLE IF NOT EXISTS `speech_therapy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sentence` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `speech_therapy`
--

INSERT INTO `speech_therapy` (`id`, `sentence`) VALUES
(1, 'My favorite color is blue because it looks peaceful.'),
(2, 'I enjoy playing soccer with my friends after school.'),
(3, 'The rainbow has seven beautiful colors.'),
(4, 'I hear birds singing early in the morning.'),
(5, 'My school has a big library with many books.');

-- --------------------------------------------------------

--
-- Table structure for table `speech_therapy_score`
--

CREATE TABLE IF NOT EXISTS `speech_therapy_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `speech_therapy_score`
--

INSERT INTO `speech_therapy_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01'),
(2, 1, 1, '2025-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `experience_years` int(11) NOT NULL,
  `photo` tinytext NOT NULL,
  `document` tinytext NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `name`, `email`, `password`, `phone`, `specialization`, `experience_years`, `photo`, `document`, `amount`, `status`) VALUES
(1, 'David', 'roshanjose023@gmail.com', '123', '7654345678', 'Audio Therapy', 3, '2025-03-05-12-27-38team-2.jpg', '', '1500', 'accepted'),
(2, 'Laura', 'laura@gmail.com', '123', '7558083476', 'Speech Therapy', 5, '2025-03-05-12-29-11team-3.jpg', '', '3000', 'accepted'),
(3, 'Liya', 'liya@gmail.com', '123', '7558083478', 'Speech Therapy', 3, 'team-3.jpg', '', '3000', 'accepted'),
(4, 'Leya John', 'roshanjose23@gmail.com', '123', '7558083475', 'Speech Therapy', 4, 'cotteon.jpg', 'Bank Bot.pdf', '3500', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` bigint(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'mike', 'mike@gmail.com', '123', 7355612288),
(2, 'Laura Norda', 'laura@gmail.com', '123', 7355612288),
(4, 'Delna', 'AL@gmail.com', '123', 8848029530),
(5, 'hello', 'all@gmail.com', '123', 8848029530),
(7, 'Ammu', 'Ammu@gamil.com', '123', 8848029530),
(8, 'John', 'john@gmail.com', '123', 8848029530),
(9, 'janu', 'janu@gmail.com', '123', 920000000000),
(10, 'Thomas', 'tj@gmail.com', '123', 9447814622),
(11, 'kevin', 'kevin@gmail.com', '123', 8848029530),
(12, 'jaya', 'jaya@gmail.com', '123', 9447814622),
(15, 'Alvin', 'dj@gmail.com', '1234', 9447516622),
(16, 'Hridhya', 'HJ@gmail.com', '123', 8078471622);

-- --------------------------------------------------------

--
-- Table structure for table `writing_test_score`
--

CREATE TABLE IF NOT EXISTS `writing_test_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `attempt_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `writing_test_score`
--

INSERT INTO `writing_test_score` (`id`, `user_id`, `score`, `attempt_date`) VALUES
(1, 1, 1, '2025-04-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
