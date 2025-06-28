-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedbacksys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `year` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `best_teachers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`best_teachers`)),
  `quality_teaching` varchar(20) DEFAULT NULL,
  `technical_resources` varchar(20) DEFAULT NULL,
  `faculty_support` varchar(20) DEFAULT NULL,
  `college_library_facilities` varchar(20) DEFAULT NULL,
  `computer_labs` varchar(20) DEFAULT NULL,
  `extracurricular` varchar(20) DEFAULT NULL,
  `sports` varchar(20) DEFAULT NULL,
  `cleanliness` varchar(20) DEFAULT NULL,
  `suggestions` text DEFAULT NULL,
  `positive_comments` text DEFAULT NULL,
  `negative_comments` text DEFAULT NULL,
  `syllabus_completion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`syllabus_completion`)),
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `email`, `mobile`, `year`, `semester`, `best_teachers`, `quality_teaching`, `technical_resources`, `faculty_support`, `college_library_facilities`, `computer_labs`, `extracurricular`, `sports`, `cleanliness`, `suggestions`, `positive_comments`, `negative_comments`, `syllabus_completion`, `submitted_at`) VALUES
(1, 'student3@college.com', '9871234567', 'Second', 'Semester 3', '[\"NVW\", \"BPS\", \"DGR\"]', 'Excellent', 'Excellent', 'Excellent', 'Very Good', 'Well-equipped', 'Excellent', 'Excellent', 'Very Clean', 'Create coding club.', 'Engaged lectures.', 'Canteen hygiene poor.', '{\"EngineeringMathematicsIII\": 85, \"DiscreteMathematics\": 82, \"DataStructures\": 90, \"ComputerArchitectureOrganization\": 88, \"ObjectOrientedProgramminginC\": 91, \"ObjectOrientedProgramminginJava\": 92}', '2025-06-27 13:15:11'),
(2, 'student4@college.com', '9000000004', 'Second', 'Semester 4', '[\"BRB\", \"WGS\"]', 'Good', 'Fair', 'Good', 'Good', 'Adequate', 'Good', 'Moderate', 'Clean', 'Extend library hours.', 'Helpful faculty.', 'Outdated projectors.', '{\"DesignAnalysisAlgorithms\": 83, \"OperatingSystems\": 87, \"BasicHumanRights\": 80, \"ProbabilityStatistics\": 85, \"DigitalLogicDesignMicroprocessors\": 90}', '2025-06-27 13:17:30'),
(3, 'student5@college.com', '9000000005', 'Third', 'Semester 5', '[\"DNP\", \"PBK\"]', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Modern', 'Very Active', 'Good', 'Excellent', 'Organize tech fest.', 'Best faculty.', 'None.', '{\"DatabaseSystems\": 95, \"TheoryofComputation\": 90, \"SoftwareEngineering\": 92, \"HumanComputerInteraction\": 88, \"NumericalMethods\": 91, \"EconomicsManagement\": 87, \"BusinessCommunication\": 89}', '2025-06-27 13:17:31'),
(4, 'student6@college.com', '9000000006', 'Third', 'Semester 6', '[\"DGR\", \"NVW\", \"TA\"]', 'Good', 'Good', 'Good', 'Good', 'Basic', 'Limited', 'Low', 'Average', 'Improve cafeteria.', 'Interactive labs.', 'Labs sometimes full.', '{\"CompilerDesign\": 86, \"ComputerNetworks\": 84, \"MachineLearning\": 90, \"InternetofThings\": 78, \"EmbeddedSystems\": 80}', '2025-06-27 13:17:31'),
(5, 'student7@college.com', '9000000007', 'Final', 'Semester 7', '[\"PBK\", \"WGS\"]', 'Excellent', 'Excellent', 'Excellent', 'Very Good', 'Advanced', 'Active', 'Moderate', 'Clean', 'Better project guidance.', 'Very practical.', 'Lack of real projects.', '{\"ArtificialIntelligence\": 88, \"CloudComputing\": 85, \"BigDataAnalytics\": 82, \"CryptographyNetworkSecurity\": 90, \"BlockchainTechnology\": 83}', '2025-06-27 13:17:31'),
(6, 'student8@college.com', '9000000008', 'Final', 'Semester 8', '[\"TA\", \"BRB\"]', 'Good', 'Good', 'Excellent', 'Good', 'Good', 'Moderate', 'Good', 'Good', 'Improve placement help.', 'Guidance was good.', 'Less internships.', '{\"ProjectInternship\": 92}', '2025-06-27 13:17:31'),
(7, 'student9@college.com', '9000000009', 'First', 'Semester 1', '[\"LI\", \"DNP\"]', 'Fair', 'Fair', 'Good', 'Average', 'Basic', 'Low', 'Very Low', 'Average', 'New lab equipment.', 'Good mentorship.', 'Old PCs.', '{\"EngineeringMathematicsI\": 70, \"EngineeringPhysics\": 75, \"EngineeringPhysicsLab\": 72, \"CommunicationSkills\": 78, \"CommunicationSkillsLab\": 74}', '2025-06-27 13:17:31'),
(8, 'student10@college.com', '9000000010', 'Second', 'Semester 3', '[\"BPS\", \"NVW\", \"PBK\"]', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Great', 'High', 'Moderate', 'Excellent', 'Start technical newsletter.', 'Learning is fun.', 'Old chairs.', '{\"DataStructures\": 94, \"ComputerArchitectureOrganization\": 92, \"DiscreteMathematics\": 89}', '2025-06-27 13:17:31'),
(9, 'student11@college.com', '9000000011', 'Third', 'Semester 6', '[\"DGR\", \"TA\"]', 'Good', 'Good', 'Good', 'Good', 'Functional', 'Moderate', 'Fair', 'Good', 'More interactive seminars.', 'Teachers are supportive.', 'No guest lectures.', '{\"MachineLearning\": 88, \"ComputerNetworks\": 87, \"GeographicInformationSystem\": 85}', '2025-06-27 13:17:31'),
(10, 'student12@college.com', '9000000012', 'Final', 'Semester 7', '[\"WGS\", \"BRB\"]', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Updated', 'Excellent', 'Very Good', 'Very Clean', 'Include AI internships.', 'Innovative lectures.', 'No complaints.', '{\"CloudComputing\": 90, \"ArtificialIntelligence\": 92, \"DeepLearning\": 89}', '2025-06-27 13:17:31'),
(11, 'student1@example.com', '9876543210', 'First', 'Semester 1', '[\"Prof. A\", \"Prof. B\"]', 'Excellent', 'Good', 'Excellent', 'Good', 'Excellent', 'Fair', 'Good', 'Excellent', 'More guest lectures would be helpful.', 'Teachers are very supportive.', 'Labs are sometimes overcrowded.', '{\"Maths\": \"90\", \"Physics\": \"85\"}', '2025-06-28 13:51:55'),
(12, 'student2@example.com', '9876543211', 'Second', 'Semester 3', '[\"Prof. C\", \"Prof. A\"]', 'Good', 'Good', 'Fair', 'Fair', 'Good', 'Fair', 'Poor', 'Good', 'Need more reference books in library.', 'Library staff is helpful.', 'Lack of sports events.', '{\"Maths\": \"78\", \"DSA\": \"82\"}', '2025-06-28 13:51:55'),
(13, 'student3@example.com', '9876543212', 'Third', 'Semester 5', '[\"Prof. D\", \"Prof. E\"]', 'Fair', 'Excellent', 'Good', 'Excellent', 'Excellent', 'Good', 'Good', 'Excellent', 'Include industrial visits.', 'Enjoyed the hackathons.', 'Some faculty lack communication.', '{\"DBMS\": \"95\", \"OS\": \"92\"}', '2025-06-28 13:51:55'),
(14, 'student4@example.com', '9876543213', 'Final', 'Semester 8', '[\"Prof. B\", \"Prof. E\"]', 'Excellent', 'Excellent', 'Excellent', 'Good', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Extend project submission deadlines.', 'Campus is clean and peaceful.', 'Wi-Fi speed is low.', '{\"AI\": \"98\", \"ML\": \"94\"}', '2025-06-28 13:51:55'),
(15, 'student5@example.com', '9876543214', 'Second', 'Semester 4', '[\"Prof. C\", \"Prof. F\"]', 'Good', 'Fair', 'Fair', 'Fair', 'Fair', 'Poor', 'Poor', 'Fair', 'Improve classroom ventilation.', 'Helpful peer group.', 'Not enough practical sessions.', '{\"COA\": \"70\", \"OOP\": \"75\"}', '2025-06-28 13:51:55'),
(16, 'student6@example.com', '9876543215', 'Third', 'Semester 6', '[\"Prof. A\", \"Prof. D\"]', 'Excellent', 'Good', 'Good', 'Excellent', 'Excellent', 'Fair', 'Good', 'Excellent', 'Need more interaction with alumni.', 'Teaching is really good.', 'Timetable is very tight.', '{\"TOC\": \"88\", \"CN\": \"90\"}', '2025-06-28 13:51:55'),
(17, 'student7@example.com', '9876543216', 'First', 'Semester 2', '[\"Prof. G\", \"Prof. H\"]', 'Good', 'Fair', 'Good', 'Good', 'Fair', 'Fair', 'Fair', 'Good', 'Counseling sessions needed.', 'Friendly staff.', 'Confusing course structure.', '{\"Maths\": \"80\", \"BEE\": \"77\"}', '2025-06-28 13:51:55'),
(18, 'student8@example.com', '9876543217', 'Final', 'Semester 7', '[\"Prof. D\", \"Prof. A\"]', 'Excellent', 'Excellent', 'Excellent', 'Excellent', 'Good', 'Good', 'Excellent', 'Excellent', 'Increase placement drives.', 'Good placement training.', 'Need more practice interviews.', '{\"ML\": \"96\", \"DL\": \"91\"}', '2025-06-28 13:51:55'),
(19, 'student9@example.com', '9876543218', 'Third', 'Semester 5', '[\"Prof. C\", \"Prof. B\"]', 'Good', 'Good', 'Fair', 'Fair', 'Good', 'Fair', 'Fair', 'Good', 'Better tools in lab.', 'Good classroom environment.', 'Too many assignments.', '{\"OS\": \"89\", \"DBMS\": \"86\"}', '2025-06-28 13:51:55'),
(20, 'student10@example.com', '9876543219', 'Second', 'Semester 4', '[\"Prof. F\", \"Prof. E\"]', 'Fair', 'Good', 'Excellent', 'Excellent', 'Fair', 'Good', 'Good', 'Excellent', 'Organize webinars regularly.', 'Good support from seniors.', 'Mess food is not good.', '{\"OOP\": \"82\", \"COA\": \"85\"}', '2025-06-28 13:51:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
