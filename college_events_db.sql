-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 05:33 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_events_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(128) NOT NULL,
  `date` datetime NOT NULL,
  `message` varchar(200) NOT NULL,
  `event` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `date`, `message`, `event`) VALUES
(17, 'Sophia Mcconnell', '2021-04-15 19:43:50', 'Sounds fun! Can wait!', 'First DnD Session'),
(18, 'Angelica Longo', '2021-04-16 10:42:54', 'Make sure to arrive 20 minutes early!', 'School Board Meeting'),
(19, 'Angelica Longo', '2021-04-16 10:45:17', 'Hope yall are ready for this!!', 'Hackathon'),
(20, 'Johanna Bauer', '2021-04-16 10:46:36', 'Always wanted to get better at math haha', 'Tips To Get Better At Math!'),
(21, 'Johanna Bauer', '2021-04-16 10:47:08', 'Yeah! Gunna be tons of fun!', 'First DnD Session'),
(22, 'Gretchen Castaneda', '2021-04-16 10:48:59', 'I wont be able to go, but I hope you guys have a great time! (:', 'First Track Meeting'),
(23, 'Gretchen Castaneda', '2021-04-16 10:50:14', 'Best game of ALL TIME!', 'Lets Talk Dota!'),
(24, 'Haleigh Melton', '2021-04-16 10:53:07', 'Same lol. Ill definitely be there!', 'Tips To Get Better At Math!'),
(25, 'Haleigh Melton', '2021-04-16 10:53:13', 'I could spend an entire day talking about Dota lol', 'Lets Talk Dota!'),
(27, 'Emerson Bray', '2021-04-16 11:19:55', 'Bring it on!', 'Hackathon'),
(28, 'Elliot Bradford', '2021-04-16 17:05:28', 'Id love to learn how to make a videogame in an hour!', 'Make a videogame in 60 Minutes!');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `eventDateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` varchar(1000) NOT NULL,
  `phone_num` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `approved` varchar(100) NOT NULL,
  `rso_event` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `category`, `description`, `eventDateTime`, `location`, `phone_num`, `email`, `university`, `status`, `approved`, `rso_event`) VALUES
(5, 'Spooky Stories!', 'Social', 'We will be reading scary stories to kids at the Orlando public library on Halloween!', '2021-04-15 21:41:54', '101 E Central Blvd, Orlando, FL 32801', 'none', ' angelica@knights.ucf.edu', 'University of Central Florida', 'Members', 'No', 'Book Club'),
(6, 'Tips To Get Better At Math!', 'Workshop', 'Join this upcoming workshop to learn 5 neat tricks to improve your math skills!', '2021-04-15 21:41:36', 'UCF Mathematical Sciences Building', 'none', 'kevin@knights.ucf.edu', 'University of Central Florida', 'Private', 'Yes', 'Math Club'),
(7, 'First Track Meeting', 'Social', 'Track practice. All are welcome to come and show support to our team.', '2021-04-25 14:04:00', 'Azalea Park, FL 32807', 'none', 'bradford@knights.ucf.edu', 'University of Central Florida', 'Public', 'Yes', 'Fellowship of Christian Atheltics'),
(8, 'School Board Meeting', 'Corporate', 'Formal business meeting for the district where items are voted upon by the entire board for approval.', '2021-04-19 21:04:00', '12715 Pegasus Dr, Orlando, FL 32816', 'none', 'bradford@knights.ucf.edu', 'University of Central Florida', 'Private', 'Yes', 'Student Council'),
(10, 'First DnD Session', 'Social', 'Roleplay your characters, order the initiative, and do all of the combat things!', '2021-04-29 17:04:00', '2451 Dean Rd, Union Park, FL 32817', 'none', 'potter@usf.edu', 'University of South Florida', 'Members', 'Yes', 'Dungeons and Dragons Club'),
(11, 'Lets Talk Dota!', 'Fundraising', 'Learn more about the game, and why so many play it. Bring friends!', '2021-05-05 20:05:00', '1505 S Semoran Blvd, Orlando, FL 32807', 'none', 'bauer@usf.edu', 'University of South Florida', 'Public', 'Yes', 'Dota 2 Club'),
(12, 'Hackathon', 'Virtual', 'Gather your friends and join our first coding competition!', '2021-04-27 19:04:00', '1995 Dade Ave #1973, Boca Raton, FL 33431', 'none', 'wall@fau.edu', 'Florida Atlantic University', 'Private', 'Yes', 'Programming Club'),
(13, 'Christmas Party', 'Social', 'Fun party to enjoy the holidays!', '2021-12-21 01:12:00', '6000 W Osceola Pkwy, Kissimmee, FL 347466000 W Osceola Pkwy, Kissimmee, FL 34746', '407-321-456', 'griffin@uf.edu', 'University of Florida', 'Public', 'No', 'No'),
(14, 'Beach Party', 'Social', 'Lets have some fun at Clearwater Beach!', '2021-05-19 16:05:00', 'Clearwater, FL', '407-123-456', 'bray@usf.edu', 'University of South Florida', 'Public', 'No', 'No'),
(15, 'Movie Night!', 'Social', 'Lets watch Frozen 2!', '2021-12-10 22:12:00', '777 Glades Rd, Boca Raton, FL 33431', '407-123-321', 'mcconnell@fau.edu', 'Florida Atlantic University', 'Public', 'No', 'No'),
(17, 'Make a videogame in 60 Minutes!', 'Workshop', 'Join this free workshop and learn the basics of how to implement your own videogame!', '2021-04-19 21:04:00', 'UCF Mathematical Sciences Building', 'none', 'pham@usf.edu', 'University of South Florida', 'Public', 'Yes', 'Game Dev Club');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `rso_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `members` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `rso_name`, `description`, `user_name`, `user_id`, `members`) VALUES
(12, 'Math Club', 'The purpose of the Math Club is to promote an enthusiasm for mathematics in and out of the school environment.  The club will use problem-solving activities to build mathematical skills.  The club will also participate in community service and in local mathematical competitions. ', 'Kevin Samsoe', 15436, 7),
(13, 'Book Club', 'Book Club will meet once every 9 weeks to discuss a previously read book. There are no dues, but students must obtain a copy of the current book on their own and read it before the club meeting. Cost per book will range from $10 to $20.', 'Angelica Longo', 54612, 4),
(14, 'Spanish Club', 'The Spanish Club serves to expand the study of the Spanish language and culture.', 'Adriana Kennedy', 1232, 6),
(15, 'Student Council', 'Student Council serves as thevoice of the student body. The club is an advocate of student issues and concerns. ', 'Elliot Bradford', 1820, 9),
(16, 'Fellowship of Christian Atheltics', 'The mission of FCA is to present to coaches and athletes, and all whom they influence, the challenge and adventure of receiving Jesus Christ as Savior and Lord, serving Him in their relationships and in the fellowship of the church.', 'Elliot Bradford', 1820, 3),
(17, 'Friends in Hand', 'Raising awareness for mental health. Providing a personal journey that leads to help others.', 'Mohamed Palmer', 88601, 4),
(18, 'The Revision', 'Help clean up and restore the community!', 'Karla Griffin', 83515, 4),
(19, 'Anonymous Theatre', 'An organization fundamentally invested in teaching and sharing discussions of theatre with young children.', 'Casey Lester', 9320, 4),
(20, 'Dungeons and Dragons Club', 'Come join us to play DnD! We play traditional games as well as custom ones, online and in person!', 'Ella Potter', 8140, 5),
(21, 'Dota 2 Club', 'If you play Dota 2 in any capacity, this is the club for you! We lay casual and semi-pro teams.', 'Johanna Bauer', 3156, 5),
(22, 'Debate Club', 'We host debates between students weekly. Topics range from silly to serious, politics included.', 'Amiah Kennedy', 9575, 1),
(23, 'Game Dev Club', 'ome see the latest developments from students like you! Need help with Unity? Want to participate in a game jam? Come join today!', 'Presley Pham', 89488, 5),
(24, 'Deep Connections', 'Connect with other people in your field of study, both students and professional.', 'Kaitlynn Mueller', 5362, 3),
(25, 'Programming Club', 'Get help from other likeminded programmers! Come discuss projects and the latest theory.', 'Morgan Wall', 40643, 5),
(26, 'Fireflies', 'Join today and listen to the greatest song 24/7!', 'Morgan Wall', 40643, 4),
(27, 'Big Shots', 'Join us and shoot some hoops! Land 3-pointers for free pizza on Tuesdays!!!', 'Gretchen Castaneda', 76394, 2),
(28, 'Sticks and Stones', 'Nature at its finest! Come and study the most incredible plant life and rock structures out there!', 'Gina Elliott', 9374, 2),
(29, 'RC Club', 'Helicopters, cars, planes, and more! If youre interested in RC vehicles, join us today!', 'Gina Elliott', 9374, 3),
(30, 'Fancy Fanfairs', 'Upper class manners for the upper class minded. Come join and live like royalty.', 'Isla Castro', 91715, 2),
(31, 'Bean Secrets', 'Interested in beans? Enjoy eating them? Then this is the club for you! Baked beans, refried beans, black beans, and more!', 'Jorge Hickman', 9457, 2),
(32, 'Creation Club', 'Have an affinity for right-brain thinking? Come join us for activities and studies on the arts!', 'Angelica Longo', 54612, 2);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `students` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`, `location`, `description`, `students`) VALUES
(23, 'University of Central Florida', '4000 Central Florida Blvd, Orlando, FL 32816', 'The University of Central Florida is a public research university in unincorporated Orange County, Florida. It is part of the State University System of Florida. With almost 72,000 students, it currently has the largest student body in the United States.', 66183),
(24, 'University of Florida', 'Gainesville, FL 32611', 'The University of Florida is a public land-grant research university in Gainesville, Florida. It is a senior member of the State University System of Florida and traces its origins to 1853 and has operated continuously on its Gainesville campus since September 1906.', 52367),
(25, 'University of South Florida', '4202 E Fowler Ave, Tampa, FL 33620', 'The University of South Florida is a public research university with campuses in Tampa, St. Petersburg, and Sarasota, Florida; with the main campus located in Tampa. It is one of 12 members of the State University System of Florida.', 49591),
(26, 'Florida Atlantic University', '777 Glades Rd, Boca Raton, FL 33431', 'Florida Atlantic University is a public research university with its main campus in Boca Raton, Florida and satellite campuses in Dania Beach, Davie, Fort Lauderdale, Jupiter, and Fort Pierce.', 30377);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `acc_type` varchar(100) NOT NULL,
  `university` varchar(100) NOT NULL,
  `followingRSOs` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `password`, `email`, `acc_type`, `university`, `followingRSOs`) VALUES
(30, 75094, 'Nyla Sloan', '03174447', 'nyla@knights.ucf.edu', 'Super Admin', 'University of Central Florida', ''),
(31, 40153, 'Micheal Doyle', '1116879', 'micheal@uf.edu', 'Super Admin', 'University of Florida', ''),
(32, 2406, 'Madeleine Mueller', '7562821', 'mueller@usf.edu', 'Super Admin', 'University of South Florida', ''),
(33, 78009, 'Roger Jensen', '719415', 'jensen@fau.edu', 'Super Admin', 'Florida Atlantic University', ''),
(34, 15436, 'Kevin Samsoe', '790067', 'kevin@knights.ucf.edu', 'Admin', 'University of Central Florida', ' Math Club Dungeons and Dragons Club Game Dev Club Programming Club Dota 2 Club Bean Secrets'),
(35, 54612, 'Angelica Longo', '55666107', ' angelica@knights.ucf.edu', 'Admin', 'University of Central Florida', ' Book Club Creation Club Game Dev Club Fireflies Student Council Programming Club'),
(36, 1232, 'Adriana Kennedy', '1128', 'kennedy@knights.ucf.edu', 'Admin', 'University of Central Florida', ' Spanish Club'),
(37, 1820, 'Elliot Bradford', '87033965', 'bradford@knights.ucf.edu', 'Admin', 'University of Central Florida', ' Student Council Math Club Book Club Spanish Club Fellowship of Christian Atheltics'),
(39, 6965, 'Miah Shepard', '4958430', 'shepard@knights.ucf.edu', 'Student', 'University of Central Florida', ' Student Council Anonymous Theatre Programming Club Fancy Fanfairs Spanish Club'),
(40, 39001, 'Haleigh Melton', '67446', 'melton@knights.ucf.edu', 'Student', 'University of Central Florida', ''),
(41, 6112, 'Dayanara Ellison', '97348', 'ellison@knights.ucf.edu', 'Student', 'University of Central Florida', ''),
(42, 9457, 'Jorge Hickman', '440982', 'hickman@knights.ucf.edu', 'Student', 'University of Central Florida', ' Bean Secrets Fireflies Math Club Big Shots RC Club'),
(43, 88601, 'Mohamed Palmer', '25089328', 'palmer@uf.edu', 'Admin', 'University of Florida', ' Friends in Hand'),
(44, 47682, 'Keshawn Kaiser', '2958605', 'kaiser@uf.edu', 'Student', 'University of Florida', 'Spanish Club Fellowship of Christian Atheltics'),
(45, 83515, 'Karla Griffin', '811316', 'griffin@uf.edu', 'Student', 'University of Florida', ' The Revision Book Club Friends in Hand Student Council'),
(46, 9320, 'Casey Lester', '19170224', 'lester@uf.edu', 'Student', 'University of Florida', ' Anonymous Theatre  '),
(47, 7762, 'Madison Greene', '27838', 'greene@uf.edu', 'Student', 'University of Florida', ' Dota 2 Club Sticks and Stones Creation Club Programming Club'),
(48, 8140, 'Ella Potter', '3317920', 'potter@usf.edu', 'Admin', 'University of South Florida', ' Dungeons and Dragons Club Book Club Math Club Student Council'),
(49, 3156, 'Johanna Bauer', '21955', 'bauer@usf.edu', 'Admin', 'University of South Florida', ' Dota 2 Club Math Club Dungeons and Dragons Club'),
(50, 9575, 'Amiah Kennedy', '7562', 'kennedy@usf.edu', 'Student', 'University of South Florida', ' Debate Club Friends in Hand Anonymous Theatre Student Council The Revision'),
(51, 33, 'Emerson Bray', '3541', 'bray@usf.edu', 'Student', 'University of South Florida', ''),
(52, 89488, 'Presley Pham', '0449184', 'pham@usf.edu', 'Admin', 'University of South Florida', ' Game Dev Club Math Club Dota 2 Club Dungeons and Dragons Club'),
(53, 1322, 'Mohammad Browning', '5052256', 'browning@usf.edu', 'Student', 'University of South Florida', ' RC Club Dungeons and Dragons Club Fellowship of Christian Atheltics Student Council'),
(54, 5362, 'Kaitlynn Mueller', '60795', 'mueller@fau.edu', 'Student', 'Florida Atlantic University', ' Deep Connections Student Council Game Dev Club'),
(55, 713, 'Sophia Mcconnell', '5190', 'mcconnell@fau.edu', 'Student', 'Florida Atlantic University', '    Spanish Club'),
(56, 40643, 'Morgan Wall', '81286610', 'wall@fau.edu', 'Admin', 'Florida Atlantic University', ' Programming Club Game Dev Club Dota 2 Club Student Council Fireflies'),
(57, 76394, 'Gretchen Castaneda', '457383', 'castaneda@fau.edu', 'Student', 'Florida Atlantic University', ' Big Shots Fellowship of Christian Atheltics Fireflies The Revision'),
(58, 9374, 'Gina Elliott', '1914606', 'elliott@fau.edu', 'Student', 'Florida Atlantic University', ' Sticks and Stones RC Club The Revision Friends in Hand Math Club Student Council Deep Connections'),
(59, 91715, 'Isla Castro', '51422082', 'castro@fau.edu', 'Student', 'Florida Atlantic University', ' Fancy Fanfairs Spanish Club Anonymous Theatre Deep Connections'),
(60, 53142, 'Farrell Drew', '16898', 'drew@fiu.edu', 'Super Admin', 'None', ''),
(61, 7732, 'Kyle Brooks', '98852729', 'brooks@uf.edu', 'Student', 'University of South Florida', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
