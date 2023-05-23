-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 03:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `english_course`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `name` varchar(250) NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `year_of_birth` date NOT NULL,
  `email` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `level`, `name`, `birthplace`, `year_of_birth`, `email`, `photo`) VALUES
(10, 'user', 'Harry', 'Bandung', '2022-11-03', 'harrymuliawan03@gmail.com', '63844b1c8118e.jpg'),
(11, 'admin', 'Anisah', 'Cirebon', '1992-10-03', 'anisah.rizkiani@gmail.com', '6412ef49ae2ba.jpg'),
(14, 'user', 'Falisha Alizhea Muliawan', 'Cirebon', '2020-08-21', 'zhea123@gmail.com', '645f238b41a82.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `name` varchar(250) NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `year_of_birth` date NOT NULL,
  `email` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'harry123', '$2y$10$NKN69D74rItwXP9R83W3m.vQ/a4TRj41PNc5ZbTvyzsGFoVmCFfkS'),
(2, 'admin', '$2y$10$PH4kyHilBUdwvaiPBDh5EePhb/czBEVuiwzsAdGcs0TkKG0nPbx8O'),
(3, 'user', '$2y$10$N4bnNYPhEVXFEOql99wja.axofd3y8fHkwrzSS8Hhb.ORFLvOlJjS'),
(4, '123', '$2y$10$hn5KBnft9cB14O5SYikvFOjXLQ6e/4Gafpk9EG3.s/xJ6dOfyz12G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
