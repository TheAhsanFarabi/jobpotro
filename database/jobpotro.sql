-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2024 at 06:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobpotro`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `passed` tinyint(1) DEFAULT 0,
  `uploaded_cv` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `link`) VALUES
(1, 'Intro to Programming', 'Learn the basics of programming.', 'https://example.com/intro-to-programming'),
(2, 'Web Development Bootcamp', 'Learn HTML, CSS, and JavaScript.', 'https://example.com/web-development'),
(3, 'SQL for Beginners', 'Understand the basics of SQL and databases.', 'https://example.com/sql-course');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `requirements` text DEFAULT NULL,
  `job_type` varchar(50) DEFAULT NULL,
  `responsibility` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `total_applied` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `salary`, `details`, `requirements`, `job_type`, `responsibility`, `deadline`, `total_applied`, `created_by`, `created_at`) VALUES
(1, 'Software Developer', 70000.00, 'Develop and maintain software applications. Work with cross-functional teams to design and implement new features.', 'Bachelor\'s degree in Computer Science or related field. Proficiency in Java, Python, or C++. Experience with Agile methodologies.', 'Full-Time', 'Design, code, test, and deploy software applications. Collaborate with product managers and other developers.', '2024-12-31', 0, 1, '2024-08-20 04:32:27'),
(2, 'Data Analyst', 65000.00, 'Analyze data to provide actionable insights. Develop reports and dashboards to support decision-making processes.', 'Bachelor\'s degree in Computer Science, Data Science, or a related field. Proficiency in SQL, Excel, and data visualization tools. Experience with statistical analysis.', 'Part-Time', 'Collect, clean, and analyze data. Create and maintain reports and dashboards. Communicate findings to stakeholders.', '2024-11-30', 0, 2, '2024-08-20 04:32:27'),
(3, 'Web Developer', 60000.00, 'Build and maintain websites and web applications. Ensure cross-platform optimization and mobile responsiveness.', 'Bachelor\'s degree in Computer Science or related field. Proficiency in HTML, CSS, JavaScript, and web frameworks like React or Angular.', 'Full-Time', 'Develop and maintain front-end and back-end web applications. Optimize applications for maximum speed and scalability.', '2024-10-31', 0, 3, '2024-08-20 04:32:27'),
(4, 'Cybersecurity Analyst', 75000.00, 'Protect an organization\'s systems and networks from cyber threats. Monitor and respond to security incidents.', 'Bachelor\'s degree in Cybersecurity, Computer Science, or related field. Knowledge of security protocols, firewalls, and intrusion detection systems. Experience with ethical hacking.', 'Full-Time', 'Identify and address security vulnerabilities. Monitor network traffic for suspicious activities. Conduct security audits and risk assessments.', '2024-09-30', 0, 4, '2024-08-20 04:32:27'),
(5, 'Need Product Manager ', 85000.00, 'Lead the product development lifecycle from concept to launch. Collaborate with engineering, marketing, and sales teams.', 'Bachelor\'s degree in Business, Computer Science, or a related field. Experience in product management or project management. Strong analytical and leadership skills.', 'Full-Time', 'Define product vision and strategy. Create and manage product roadmaps. Coordinate with cross-functional teams to deliver successful products.', '2024-12-15', 0, 1, '2024-08-20 04:46:41'),
(6, 'UX/UI Designer', 70000.00, 'Design user interfaces and user experiences for digital products. Conduct user research and usability testing to inform design decisions.', 'Bachelor\'s degree in Design, Human-Computer Interaction, or a related field. Proficiency in design tools like Sketch, Figma, or Adobe XD. Strong portfolio demonstrating UX/UI design skills.', 'Full-Time', 'Create wireframes, prototypes, and high-fidelity designs. Conduct user research and usability testing. Collaborate with developers and product managers.', '2024-11-15', 0, 4, '2024-08-20 04:46:41'),
(7, 'Marketing Specialist', 65000.00, 'Develop and execute marketing campaigns to promote products or services. Analyze market trends and adjust strategies accordingly.', 'Bachelor\'s degree in Marketing, Business, or a related field. Experience with digital marketing tools and strategies. Strong analytical and communication skills.', 'Full-Time', 'Create and manage marketing campaigns. Analyze performance metrics and adjust strategies as needed. Coordinate with internal teams and external partners.', '2024-10-15', 0, 2, '2024-08-20 04:46:41'),
(8, 'Sales Representative', 60000.00, 'Generate new business opportunities and maintain relationships with existing clients. Meet sales targets and provide excellent customer service.', 'Bachelor\'s degree in Business, Marketing, or a related field. Proven sales experience and ability to meet targets. Excellent communication and interpersonal skills.', 'Full-Time', 'Identify and develop new business opportunities. Maintain and grow client relationships. Achieve sales targets and provide exceptional customer service.', '2024-09-15', 0, 4, '2024-08-20 04:46:41'),
(9, 'Customer Support Specialist', 55000.00, 'Assist customers with inquiries, issues, and support requests. Provide solutions and ensure high levels of customer satisfaction.', 'High school diploma or equivalent. Previous customer service experience. Strong communication and problem-solving skills.', 'Part-Time', 'Handle customer inquiries and support requests. Provide timely solutions and follow-up. Maintain high levels of customer satisfaction.', '2024-08-31', 0, 3, '2024-08-20 04:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_company` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_company`, `created_at`, `profile_pic`) VALUES
(1, 'Google Insiders', 'support@google.com', '$2y$10$yyH6XHU8nXM4f8kBcn6Dh.jIg1IYtobtQYUCESxx/b1VcC7qfXmKK', 1, '2024-09-16 03:51:07', '66e7b2015c2e7.png'),
(2, 'United Group', 'support@united.org', '$2y$10$exRsh/SdQE3cDJ39KlxS7OKy5bwuJMYgLIXNK0OVOKLs1bPd.N10K', 1, '2024-09-16 13:20:27', '66e832c3e26e3.png'),
(3, 'BRAC', 'support@brac.org', '$2y$10$kweEOpG8Ia.6.P5pW4CEdeGf6V/av1QaLZqLMgaMvp2CHE3Ei5.1O', 1, '2024-09-16 13:21:12', '66e8326f94adb.png'),
(4, 'Microsoft Corporation', 'support@microsoft.com', '$2y$10$VSYfLhEKgaXiArX70MKw8ecAkgQmrStaTiYWXbteusvfrR8E7o9aS', 1, '2024-09-16 13:22:26', '66e8329fe2504.png'),
(15, 'Ahsan Farabi', 'ahsanfarabi1971@gmail.com', '$2y$10$ByUWGXzAg4Es6.M4igJQmeEOCwF7TEo0U5XDqJMB13e/48IlQyirm', 0, '2024-09-16 12:51:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_job` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_user_job` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
