-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2017 at 07:57 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1-log
-- PHP Version: 7.0.15-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_app`
--
CREATE DATABASE IF NOT EXISTS `college_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `college_app`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `a_ID` int(11) NOT NULL,
  `a_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `a_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `a_phone` varchar(40) NOT NULL,
  `a_password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `a_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`a_ID`, `a_name`, `a_email`, `a_phone`, `a_password`, `a_role`) VALUES
(1, 'Evgeniy Neminskiy', 'evgeniy@gmail.com', '0528864255', '$2y$10$hY8J/c4NLti.YmdFSuJcyuN6d8unD.OEbmFWyy88fUALh7q17qi42', 1),
(2, 'Boris Michalson', 'boris@gmail.com', '0545454654', '$2y$10$HKDfA2ne2jPiyQpsywpFGuRikbM6taM2TTwo6lX.NKgGuKLiUokMC', 2),
(3, 'Vadim Mar', 'vad@gmail.com', '0527899123', '789', 2),
(4, 'Johnny Clark', 'jclark0@vk.com', '94-(516)248-9722', '1111', 3),
(5, 'Sarah Hunter', 'shunter1@oaic.gov.au', '51-(555)336-6172', '2222', 3);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_ID` int(11) NOT NULL,
  `c_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `c_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `c_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_ID`, `c_name`, `c_description`, `c_img`) VALUES
(1, 'Java', 'Java Back-End Programming...', 21),
(2, 'mySql', 'mySql Data-Base Learning...', 22),
(3, 'PHP', 'PHP back-end programming and more...', 23),
(4, 'CPP', 'C++ programming language', 24),
(5, 'JavaScript', 'Very popular language with huge number of followers...', 25),
(6, 'WordPress', 'is an online, open source website creation tool written in PHP. But in non-geek speak, it\'s probably the easiest and most powerful blogging and website content management system (or CMS) in existence today. ', 26),
(7, 'AngularJS', 'AngularJS is a structural framework for dynamic web apps. It lets you use HTML as your template language and lets you extend HTML\'s syntax to express your application\'s components clearly and succinctly.', 27);

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `cs_course_ID` int(11) NOT NULL,
  `cs_student_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`cs_course_ID`, `cs_student_ID`) VALUES
(3, 1),
(6, 1),
(4, 3),
(5, 4),
(6, 5),
(1, 7),
(3, 7),
(6, 7),
(4, 8),
(7, 9),
(7, 10),
(1, 13),
(3, 13),
(4, 13),
(6, 16),
(1, 17),
(4, 17),
(7, 17),
(1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `i_ID` int(11) NOT NULL,
  `i_path` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `i_thumb` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`i_ID`, `i_path`, `i_thumb`) VALUES
(1, 'https://robohash.org/modieteos.jpg?size=120x120&set=set1', 'https://robohash.org/oditeoscumque.jpg?size=50x50&set=set1'),
(2, 'https://robohash.org/quidemquialias.jpg?size=120x120&set=set1', 'https://robohash.org/voluptatibusanimimagnam.jpg?size=50x50&set=set1'),
(3, 'https://robohash.org/laboriosamrecusandaesunt.jpg?size=120x120&set=set1', 'https://robohash.org/utmollitiadoloremque.jpg?size=50x50&set=set1'),
(4, 'https://robohash.org/oditreiciendisprovident.jpg?size=120x120&set=set1', 'https://robohash.org/nullavoluptatemmolestias.jpg?size=50x50&set=set1'),
(5, 'https://robohash.org/earumnobiseum.jpg?size=120x120&set=set1', 'https://robohash.org/reiciendissuntquibusdam.jpg?size=50x50&set=set1'),
(6, 'https://robohash.org/molestiaeetet.jpg?size=120x120&set=set1', 'https://robohash.org/quosineveniet.jpg?size=50x50&set=set1'),
(7, 'https://robohash.org/utminimaqui.jpg?size=120x120&set=set1', 'https://robohash.org/consequaturquosipsum.jpg?size=50x50&set=set1'),
(8, 'https://robohash.org/perspiciatisvoluptatumeos.jpg?size=120x120&set=set1', 'https://robohash.org/etdelectusconsectetur.jpg?size=50x50&set=set1'),
(9, 'https://robohash.org/mollitiaprovidentsit.jpg?size=120x120&set=set1', 'https://robohash.org/nihilveldoloribus.jpg?size=50x50&set=set1'),
(10, 'https://robohash.org/autemofficiaid.jpg?size=120x120&set=set1', 'https://robohash.org/autdoloremquis.jpg?size=50x50&set=set1'),
(11, 'https://robohash.org/sitdistinctiorerum.jpg?size=120x120&set=set1', 'https://robohash.org/suntrepellendusnostrum.jpg?size=50x50&set=set1'),
(12, 'https://robohash.org/quasrationeut.jpg?size=120x120&set=set1', 'https://robohash.org/utautenim.jpg?size=50x50&set=set1'),
(13, 'https://robohash.org/quosinventorevoluptatem.jpg?size=120x120&set=set1', 'https://robohash.org/quibusdaminventorenobis.jpg?size=50x50&set=set1'),
(14, 'https://robohash.org/eiusaliasfuga.jpg?size=120x120&set=set1', 'https://robohash.org/laudantiumaccusamuseveniet.jpg?size=50x50&set=set1'),
(15, 'https://robohash.org/modietin.jpg?size=120x120&set=set1', 'https://robohash.org/eaquevoluptatemfuga.jpg?size=50x50&set=set1'),
(16, 'https://robohash.org/veritatisdoloresexplicabo.jpg?size=120x120&set=set1', 'https://robohash.org/consequaturmodinisi.jpg?size=50x50&set=set1'),
(17, 'https://robohash.org/liberonumquamaccusamus.jpg?size=120x120&set=set1', 'https://robohash.org/enimidexcepturi.jpg?size=50x50&set=set1'),
(18, 'https://robohash.org/itaquereiciendisvelit.jpg?size=120x120&set=set1', 'https://robohash.org/repellendusminimanesciunt.jpg?size=50x50&set=set1'),
(19, 'https://robohash.org/oditeaofficia.jpg?size=120x120&set=set1', 'https://robohash.org/minimaquibusdamest.jpg?size=50x50&set=set1'),
(20, 'https://robohash.org/consequaturestfacere.jpg?size=120x120&set=set1', 'https://robohash.org/nonasperioresratione.jpg?size=50x50&set=set1'),
(21, 'http://exitonsoftware.com/images/java-logo.png', 'http://sky777.ru/sites/javalogo.png'),
(22, 'http://www.bigfanta.com/wp-content/uploads/2011/07/logo-mysql.png', 'http://ezisetup.com/designs/euclides/wp-content/themes/wp_euclides5-v1.3/images/icon_mysql.png'),
(23, 'http://www.bigfanta.com/wp-content/uploads/2011/07/logo-php.png', 'http://college.monster.com/nfs/college/photos/0005/0373/php-logo-virus_sq50.jpg?1431253503'),
(24, 'http://www.mekatronikmuhendisligi.com/wp-content/uploads/2016/10/c-logo-icon-0-250x250.png', 'http://bestwindows8apps.s3.amazonaws.com/icons/Icon.115312.png'),
(25, 'http://codeposter.com/wp-content/uploads/2016/09/Unofficial_JavaScript_logo_2.svg_-e1474556506721.png', 'http://orig07.deviantart.net/2583/f/2016/282/6/1/javascript_icon_by_linux_rules-dakgoq1.png'),
(26, 'http://codeposter.com/wp-content/uploads/2016/08/WordPress-Logo-250x250.png', 'http://ministerfortson.com/wp-content/themes/blogolife/images/apple-touch-icon.png'),
(27, 'http://www.angular-js.fr/wp-content/uploads/2014/05/angularjs_logo.png', 'https://www.ninjadevs.io/wp-content/uploads/group-avatars/18/57d8f55eea7f5-bpthumb.png'),
(28, 'https://s3.amazonaws.com/evg-college-app/58cd3c67b350f5.44134813Stock-Photo-cock-fighting-rooster.jpg', 'https://s3.amazonaws.com/evg-college-appresized/resized-58cd3c67b350f5.44134813Stock-Photo-cock-fighting-rooster.jpg'),
(29, 'https://s3.amazonaws.com/evg-college-app/58cd3d4920e157.46530189Stock-Photo-cock-fighting-rooster.jpg', 'https://s3.amazonaws.com/evg-college-appresized/resized-58cd3d4920e157.46530189Stock-Photo-cock-fighting-rooster.jpg'),
(30, 'https://s3.amazonaws.com/evg-college-app/58cd3d9e966059.26653297Stock-Photo-cock-fighting-rooster.jpg', 'https://s3.amazonaws.com/evg-college-appresized/resized-58cd3d9e966059.26653297Stock-Photo-cock-fighting-rooster.jpg'),
(31, 'https://s3.amazonaws.com/evg-college-app/58cd3dc3816c52.59240132Stock-Photo-cock-fighting-rooster.jpg', 'https://s3.amazonaws.com/evg-college-appresized/resized-58cd3dc3816c52.59240132Stock-Photo-cock-fighting-rooster.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_ID` int(11) NOT NULL,
  `r_name` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_ID`, `r_name`) VALUES
(1, 'Owner'),
(2, 'Manager'),
(3, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_ID` int(11) NOT NULL,
  `s_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `s_email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `s_phone` varchar(40) CHARACTER SET utf8 NOT NULL,
  `s_img` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_ID`, `s_name`, `s_email`, `s_phone`, `s_img`) VALUES
(1, 'Kathy Harper', 'kharper0@list-manage.com', '351-(947)935-6579', 1),
(2, 'Martha Hill', 'mhill1@google.com.br', '60-(322)291-2953', 2),
(3, 'Mary Moreno', 'mmoreno2@yelp.com', '86-(318)733-7832', 3),
(4, 'Anna Marshall', 'amarshall3@whitehouse.gov', '86-(868)370-4785', 4),
(5, 'Kenneth Hernandez', 'khernandez4@yahoo.com', '7-(511)818-8072', 5),
(6, 'Kathleen Gonzalez', 'kgonzalez5@youtu.be', '51-(273)721-7322', 6),
(7, 'Marilyn Reynolds', 'mreynolds6@mlb.com', '7-(777)401-9759', 7),
(8, 'Jean Allen', 'jallen7@salon.com', '7-(836)736-1344', 8),
(9, 'Jack Ward', 'jward8@redcross.org', '502-(640)905-5540', 9),
(10, 'Mildred Rodriguez', 'mrodriguez9@sina.com.cn', '7-(114)393-8905', 10),
(11, 'Mark Garcia', 'mgarciaa@japanpost.jp', '62-(744)370-5798', 11),
(12, 'Sandra Owens', 'sowensb@samsung.com', '351-(399)891-8666', 12),
(13, 'Benjamin Nelson', 'bnelsonc@usgs.gov', '86-(922)329-9313', 13),
(14, 'David Fields', 'dfieldsd@wiley.com', '55-(137)975-0334', 14),
(15, 'Andrea Richards', 'arichardse@wordpress.org', '86-(555)922-2167', 15),
(16, 'Todd Ramirez', 'tramirezf@lulu.com', '86-(644)142-0585', 16),
(17, 'Jimmy Myers', 'jmyersg@msn.com', '7-(188)174-4366', 17),
(18, 'Lillian Taylor', 'ltaylorh@google.pl', '62-(181)943-9220', 18),
(19, 'Martin Wells', 'mwellsi@people.com.cn', '62-(925)767-0254', 19),
(20, 'Susan Hamilton', 'shamiltonj@cam.ac.uk', '389-(872)361-5847', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`a_ID`),
  ADD UNIQUE KEY `a_email` (`a_email`),
  ADD UNIQUE KEY `a_password` (`a_password`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_ID`),
  ADD KEY `FK_courses_images_ID` (`c_img`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`cs_student_ID`,`cs_course_ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`i_ID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_ID`),
  ADD UNIQUE KEY `s_email` (`s_email`),
  ADD KEY `FK_students_images_ID` (`s_img`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `a_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `i_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `FK_courses_images_ID` FOREIGN KEY (`c_img`) REFERENCES `images` (`i_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
