-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2024 at 11:07 AM
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
(2, 'Data Analyst', 65000.00, 'Analyze data to provide actionable insights. Develop reports and dashboards to support decision-making processes.', 'Bachelor\'s degree in Computer Science, Data Science, or a related field. Proficiency in SQL, Excel, and data visualization tools. Experience with statistical analysis.', 'Part-Time', 'Collect, clean, and analyze data. Create and maintain reports and dashboards. Communicate findings to stakeholders.', '2024-11-30', 0, 1, '2024-08-20 04:32:27'),
(3, 'Web Developer', 60000.00, 'Build and maintain websites and web applications. Ensure cross-platform optimization and mobile responsiveness.', 'Bachelor\'s degree in Computer Science or related field. Proficiency in HTML, CSS, JavaScript, and web frameworks like React or Angular.', 'Full-Time', 'Develop and maintain front-end and back-end web applications. Optimize applications for maximum speed and scalability.', '2024-10-31', 0, 2, '2024-08-20 04:32:27'),
(4, 'Cybersecurity Analyst', 75000.00, 'Protect an organization\'s systems and networks from cyber threats. Monitor and respond to security incidents.', 'Bachelor\'s degree in Cybersecurity, Computer Science, or related field. Knowledge of security protocols, firewalls, and intrusion detection systems. Experience with ethical hacking.', 'Full-Time', 'Identify and address security vulnerabilities. Monitor network traffic for suspicious activities. Conduct security audits and risk assessments.', '2024-09-30', 0, 2, '2024-08-20 04:32:27'),
(5, 'Product Manager', 85000.00, 'Lead the product development lifecycle from concept to launch. Collaborate with engineering, marketing, and sales teams.', 'Bachelor\'s degree in Business, Computer Science, or a related field. Experience in product management or project management. Strong analytical and leadership skills.', 'Full-Time', 'Define product vision and strategy. Create and manage product roadmaps. Coordinate with cross-functional teams to deliver successful products.', '2024-12-15', 0, 3, '2024-08-20 04:46:41'),
(6, 'UX/UI Designer', 70000.00, 'Design user interfaces and user experiences for digital products. Conduct user research and usability testing to inform design decisions.', 'Bachelor\'s degree in Design, Human-Computer Interaction, or a related field. Proficiency in design tools like Sketch, Figma, or Adobe XD. Strong portfolio demonstrating UX/UI design skills.', 'Full-Time', 'Create wireframes, prototypes, and high-fidelity designs. Conduct user research and usability testing. Collaborate with developers and product managers.', '2024-11-15', 0, 3, '2024-08-20 04:46:41'),
(7, 'Marketing Specialist', 65000.00, 'Develop and execute marketing campaigns to promote products or services. Analyze market trends and adjust strategies accordingly.', 'Bachelor\'s degree in Marketing, Business, or a related field. Experience with digital marketing tools and strategies. Strong analytical and communication skills.', 'Full-Time', 'Create and manage marketing campaigns. Analyze performance metrics and adjust strategies as needed. Coordinate with internal teams and external partners.', '2024-10-15', 0, 4, '2024-08-20 04:46:41'),
(8, 'Sales Representative', 60000.00, 'Generate new business opportunities and maintain relationships with existing clients. Meet sales targets and provide excellent customer service.', 'Bachelor\'s degree in Business, Marketing, or a related field. Proven sales experience and ability to meet targets. Excellent communication and interpersonal skills.', 'Full-Time', 'Identify and develop new business opportunities. Maintain and grow client relationships. Achieve sales targets and provide exceptional customer service.', '2024-09-15', 0, 4, '2024-08-20 04:46:41'),
(9, 'Customer Support Specialist', 55000.00, 'Assist customers with inquiries, issues, and support requests. Provide solutions and ensure high levels of customer satisfaction.', 'High school diploma or equivalent. Previous customer service experience. Strong communication and problem-solving skills.', 'Part-Time', 'Handle customer inquiries and support requests. Provide timely solutions and follow-up. Maintain high levels of customer satisfaction.', '2024-08-31', 0, 5, '2024-08-20 04:46:41');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_company`, `created_at`) VALUES
(8, 'osama', 'ahsanfarabi1971@gmail.com', '$2y$10$./xzSD8rSsC8CgtlQDUxFeFbQ1fKUeUd38qYJBgPhTzrwVnlePHRm', 0, '2024-08-20 06:19:11'),
(9, 'faraboi', 'r@gmaiads', '$2y$10$4cGKZ5reArzUG5KM4SKQWOKssfJ/MP0QanN1RrZHC/zfboRsFc4mu', 1, '2024-08-20 06:24:45'),
(10, 'fdsfds', 'sfsf@d', '$2y$10$yI4Almi9v0s5VSmq/5Im5.qCo/mvii2/1snJFBdH.U/kWMYocq5xK', 1, '2024-08-20 07:07:10'),
(12, 'aaa', 'ahsanfarabi221266@bscse.uiu.ac.bd', '$2y$10$DwlTKwWzPsJy9oPJ5Ge9c.poImwSOIupp1Qa9uKUyh77z6WXslTT2', 1, '2024-08-20 08:02:45'),
(13, 'fgdf', 'a@dds', '$2y$10$xulN.fMC8IhCNB2bWvXVreMKpVnE9hHAI1eUTB/R1jQ3.2awppxK6', 1, '2024-08-20 08:30:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
