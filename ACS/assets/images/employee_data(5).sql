-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 07:26 AM
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
-- Database: `emp_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `ID` int(10) NOT NULL,
  `CODE` varchar(20) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `DEPARTMENT` varchar(30) NOT NULL,
  `WORKNATURE` varchar(30) NOT NULL,
  `JOININGDATE` varchar(10) NOT NULL,
  `COMPANY` varchar(20) NOT NULL,
  `BASIC` varchar(10) NOT NULL,
  `BANKNAME` varchar(20) NOT NULL,
  `ACCOUNTNO` varchar(30) NOT NULL,
  `IFSCCODE` varchar(20) NOT NULL,
  `SALARYACCOUNT` varchar(20) NOT NULL,
  `ESI_EPF` varchar(30) NOT NULL,
  `ESINO` varchar(30) NOT NULL,
  `EPFNO` varchar(30) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `EXITDATE` date NOT NULL,
  `MOBILE` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`ID`, `CODE`, `NAME`, `DEPARTMENT`, `WORKNATURE`, `JOININGDATE`, `COMPANY`, `BASIC`, `BANKNAME`, `ACCOUNTNO`, `IFSCCODE`, `SALARYACCOUNT`, `ESI_EPF`, `ESINO`, `EPFNO`, `STATUS`, `EXITDATE`, `MOBILE`) VALUES
(1, 'EMP1001', 'Nivya Murugan', 'XML', 'Team Leader', '2022-06-01', 'ACS Global Ventures', '11000', 'Indian Bank', '7261927877', 'IDIB000K268', 'Yes', 'Yes', '6634001154', '101794920803', 'Working', '0000-00-00', 8610905253),
(2, '', 'Jenisha G', 'XML', 'Junior XML Developer', '2022-06-01', 'ACS Global Ventures', '7000', 'Indian Bank', '6418269830', 'IDIB000N132', 'No', 'Yes', '1111111111111111', '111111111', 'Exit', '0000-00-00', 9488079462),
(3, 'EMP1003', 'Gayathri', 'XML', 'Team Leader', '2022-06-01', 'ACS Global Ventures', '14000', 'Indian Bank', '6706511488', 'IDIB000N132', 'Yes', 'Yes', '11111111111111', '11111111111', 'Working', '0000-00-00', 9659634220),
(4, '', 'Jomi ', 'Developing', 'xxxxxxxxxxx', '2022-07-05', 'ACS Global Ventures', 'xxxxxxxxxx', 'zzzzzzzzzzz', 'zzzzzzzzzzzzz', 'ccccccccccc', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(5, '', 'xxxxxxxxxx', 'Developing', 'xxxxxxxxxxxxxxx', '2022-08-19', 'ACS Global Ventures', 'xxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxbbbbbb', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(6, '', 'xxxxxxxxxxxxxxxxxxx', 'Developing', 'xxxxxxxxxxx', '2023-07-05', 'ACS Global Ventures', 'xxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(7, '', 'nnnnnnnnnnnnn', 'Developing', 'nnnnnnnnnnnnnn', '2023-02-14', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(8, '', 'mmmmmmmmm', 'Developing', ',,,,,,,,,,,,,', '2023-07-04', 'ACS Global Ventures', 'mmmmmm', 'nnnnnnnnnnn', 'bbbbbbbbbbbbbbbbbb', 'bbbbbbbbbbl', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(9, '', 'nnnnnnnnnn', 'Developing', 'nnnnnnnnnnnnnnnnnn', '2023-07-04', 'ACS Global Ventures', '7000', 'hhhhhhh', 'vvvvvvvvvv', 'bbbbbbbbbbb', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(10, '', 'mmmmmmmmm', 'Developing', 'lllllllllllll', '2023-07-05', 'ACS Global Ventures', ',,,,,,,,,,', ',,,,,,,,,,,,,,,,', 'mkkkkkkkkkkkkkkk', 'kkkkkkkkkkk', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(11, 'EMP1012', 'Mathana Devi', 'Developing', 'QA', '2022-04-01', 'ACS Global Ventures', '11500', 'Indian Bank', '7262053271', 'IDIB000K268', 'Yes', 'Yes', '6634000607', '101754823186', 'Working', '0000-00-00', 8056425703),
(12, 'EMP1013', 'Ashmi Shalini', 'XML', 'Junior XML Developer', '2022-05-23', 'ACS Global Ventures', '12000', 'Indian Bank', '7041560259', 'IDIB000K268', 'Yes', 'Yes', '6634000913', '101947478808', 'Working', '0000-00-00', 9677970197),
(13, '', 'xxxxxxxxxxxxx', 'BPO', 'xxxxxxxx', '2023-07-03', 'ACS Global Ventures', 'xxxxxxxx', 'xxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'Yes', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'Exit', '0000-00-00', 0),
(14, '', 'xxxxxxxxxxx', 'BPO', 'xxxxxxxxxx', '2023-07-01', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'Yes', 'mmmmmmmmmmm', 'nnnnnnnnnnnnnnnn', 'Exit', '0000-00-00', 0),
(15, 'EMP1016', 'Jini D', 'Project Team', 'QA', '2022-06-20', 'ACS Global Ventures', '13000', 'Indian Bank', '6646521801', 'IDIB000K268', 'Yes', 'Yes', '6634000574', '101947478714', 'Working', '0000-00-00', 8760476149),
(16, 'EMP1017', 'Kala', 'Admin', 'office Staff', '2022-06-13', 'ACS Global Ventures', '6000', 'Indian Bank', '6717336285', 'IDIB000K268', 'Yes', 'Yes', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxx', 'Working', '0000-00-00', 9442641029),
(17, '', 'Abisha S', 'Developing', 'QA', '2022-07-07', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'Yes', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxx', 'Exit', '0000-00-00', 0),
(18, '', 'Alwin', 'Designer', 'Junior XML Developer', '2022-07-30', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(19, '', 'Anisha A', 'XML', 'Junior XML Developer', '2022-07-07', 'ACS Global Ventures', '7000', 'Indian Bank', '7261938142', 'IDIB000K268', 'Yes', 'Yes', '6634001973', '101947478751', 'Working', '0000-00-00', 7845571517),
(20, 'EMP1021', 'Shigma C', 'XML', 'Junior XML Developer', '2022-07-11', 'ACS Global Ventures', '9800', 'Indian Bank', '7261946459', 'IDIB000K268', 'Yes', 'Yes', '6634000954', '101947478780', 'Working', '0000-00-00', 6382427148),
(21, 'EMP1022', 'Ashwin D S', 'XML', 'Junior XML Developer', '2022-07-14', 'ACS Global Ventures', '9500', 'Indian Bank', '7261828414', 'IDIB000K268', 'Yes', 'Yes', '6634000791', '101949464508', 'Working', '0000-00-00', 7373673644),
(22, '', 'Chandru K', 'XML', 'Junior XML Developer', '2022-07-15', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(23, '', 'Shajan', 'BPO', 'Junior XML Developer', '2023-06-29', 'ACS Global Ventures', '7000', 'xxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(24, '', 'Sathya', 'BPO', 'xxxxxxxxxxxx', '2023-06-27', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(25, '', 'Sathya', 'BPO', 'xxxxxxxxxxxx', '2023-06-27', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(26, '', 'Selma', 'BPO', 'QA', '2022-05-06', 'ACS Global Ventures', '7000', 'Indian Bank', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(27, 'EMP1027', 'Ramya R', 'XML', 'Junior XML Developer', '2022-09-23', 'ACS Global Ventures', '9000', 'Indian Bank', '7294254084', 'IDIB000K268', 'Yes', 'Yes', '6634000629', '101947478733', 'Working', '0000-00-00', 8300856964),
(28, 'EMP1028', 'Prabha.M.V', 'XML', 'XML Developer', '2022-08-22', 'ACS Global Ventures', '9000', 'Indian Bank', '6895964892', 'IDIB000N132', 'Yes', 'Yes', '6634000616', '101947478722', 'Working', '0000-00-00', 9342250989),
(29, 'EMP1029', 'Manju Arumairaj', 'Admin', 'Admin', '2022-08-08', 'ACS Global Ventures', '8000', 'Indian Bank', '7295461011', 'IDIB000K268', 'Yes', 'Yes', '6634000555', '101947478714', 'Working', '0000-00-00', 7708006678),
(30, '', 'Akhin', 'XML', 'Junior XML Developer', '2022-10-06', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(31, '', 'Vinoth', 'Project Team', 'Process Associate', '2022-11-07', 'ACS Global Ventures', '25000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(32, 'EMP1032', 'Blessa Mary M', 'Developing', 'QA', '2022-09-09', 'ACS Global Ventures', '8000', 'Indian Bank', '7295090768', 'IDIB000K268', 'Yes', 'Yes', '6634000588', '101947478705', 'Working', '0000-00-00', 9514234548),
(33, '', 'Aswini', 'EPub', 'Epub Developer', '2022-10-01', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(34, '', 'Cindya', 'EPub', 'Epub Developer', '2022-10-06', 'ACS Global Ventures', '10000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(35, '', 'Robinson P', 'Admin', 'Process Associate', '2022-02-06', 'ACS Global Ventures', '15500', 'Indian Bank', '7262038377', 'IDIB000K268', 'Yes', 'Yes', '6634001923', '101949464499', 'Working', '0000-00-00', 9626345520),
(36, '', 'Yokesh', 'Developing', 'xxxxxxxxxxx', '2022-11-04', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(37, '', 'SAHAYA REXCILIN', 'Admin', 'Process Associate', '2022-11-06', 'ACS Global Ventures', '7000', 'Indian Bank', '6353243552', 'IDIB000K268', 'Yes', 'Yes', '6634001978', '101949464512', 'Working', '0000-00-00', 7339181232),
(38, '', 'Shyni', 'Admin', 'Process Associate', '2022-09-07', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(39, '', 'Ancy', 'Admin', 'xxxxxxxxxxx', '2022-07-22', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(40, 'EMP1042', 'Akash', 'Developing', 'QA', '2022-11-07', 'ACS Global Ventures', '10500', 'Indian Bank', '7419268409', 'IDIB000K268', 'Yes', 'Yes', '6634000600', '101947479815', 'Working', '0000-00-00', 9488430988),
(41, 'EMP1043', 'Pon S Jayakumar', 'Project Team', 'QA', '2022-10-20', 'ACS Global Ventures', '11000', 'Indian Bank', '7419258424', 'IDIB000K268', 'No', 'Yes', '6634000551', '101947478798', 'Working', '0000-00-00', 6374461844),
(42, 'EMP1044', 'Anushiya K', 'Developing', 'QA', '2022-10-20', 'ACS Global Ventures', '8500', 'Indian Bank', '7419226694', 'IDIB000K268', 'Yes', 'Yes', '11111111111111111', '111111111111111', 'Working', '0000-00-00', 7339293456),
(43, '', 'Leoncy', 'Developing', 'QA', '2022-10-31', 'ACS Global Ventures', '7000', 'Indian Bank', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(44, '', 'Joy', 'Project Team', 'xxxxxxxxxxxx', '2022-12-28', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(45, '', 'Shajin', 'Project Team', 'QA', '2022-12-31', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(46, '', 'Adlin Danika S.D', 'Developing', 'QA', '2022-12-31', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'Yes', 'Yes', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(47, '', 'Boldwin Rino', 'Developing', 'Process Associate', '2022-11-24', 'ACS Global Ventures', '7000', 'Indian Bank', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(48, '', 'Bindhu', 'Developing', 'Process Associate', '2022-11-30', 'ACS Global Ventures', '6000', 'Indian Bank', '6273235165', 'IDIB000K268', 'Yes', 'Yes', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'Working', '0000-00-00', 9486325160),
(49, 'EMP1051', 'Jayanthi', 'Developing', 'QA', '2022-12-06', 'ACS Global Ventures', '8500', 'Indian Bank', '617615449', 'IDIB000K268', 'Yes', 'Yes', '11111111111111111', '111111111111111', 'Working', '0000-00-00', 9677440764),
(50, '', 'Siva Priyanka', 'XML', 'QA', '2022-12-22', 'ACS Global Ventures', '7000', 'Indian Bank', 'xxxxxxxxxxxxxxxxx', 'IDIB000K268', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(51, '', 'Swaminathan', 'Admin', 'Manager', '2022-11-22', 'ACS Global Ventures', '26000', 'HDFC Bank', '50100006748630', 'HDFC0000683', 'No', 'Yes', '11111111111111111', '111111111111111', 'Working', '0000-00-00', 9788048058),
(52, '', 'Deepa', 'Developing', 'QA', '2022-11-17', 'ACS Global Ventures', '7000', 'Indian Bank', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(53, '', 'Shanmuka Keerthy', 'Project Team', 'Process Associate', '2022-11-30', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111111111111111', '111111111111111', 'Exit', '0000-00-00', 0),
(54, 'EMP1056', 'Abirami', 'XML', 'Junior XML Developer', '2022-12-28', 'ACS Global Ventures', '8500', 'Indian Bank', '7419192346', 'IDIB000K268', 'Yes', 'Yes', '11111111111111111', '111111111111111', 'Working', '0000-00-00', 8531990039),
(55, '', 'Anjali', 'EPub', 'xxxxxxxxxxx', '2022-12-23', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '1111111111', '1111111111', 'Exit', '0000-00-00', 0),
(56, '', 'Joys Caroline', 'EPub', 'xxxxxxxxxxx', '2022-12-30', 'ACS Global Ventures', 'xxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '11111', '1111111111', 'Exit', '0000-00-00', 0),
(57, 'EMP1059', 'PRESSDEV DOPSINI', 'XML', 'Junior XML Developer', '2022-12-28', 'ACS Global Ventures', '9200', 'Indian Bank', '7230622917', 'IDIB000K268', 'Yes', 'Yes', '6634000714', '101947478746', 'Working', '0000-00-00', 8300779197),
(58, '', 'Godwell', 'XML', 'Junior XML Developer', '2022-12-28', 'ACS Global Ventures', '7000', 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxx', 'xxxxxxxxxxx', 'No', 'No', '1111111111', '111111111', 'Exit', '0000-00-00', 0),
(59, 'EMP1061', 'Anisha Rani', 'XML', 'Junior XML Developer', '2023-01-30', 'ACS Global Ventures', '7000', 'Indian Bank', '7419086531', 'IDIB000K268', 'Yes', 'Yes', '6634002262', '101831039619', 'Working', '0000-00-00', 8056500765),
(60, 'EMP1062', 'CHIRISBIN NISHA C', 'XML', 'Junior XML Developer', '2023-01-30', 'ACS Global Ventures', '7000', 'Indian Bank', '7419173912', 'IDIB000K268', 'Yes', 'Yes', '6634002280', 'xxxxxxxx', 'Working', '0000-00-00', 9487177603),
(61, 'EMP1063', 'JEBINA JANKLE J', 'XML', 'BOT', '2023-07-01', 'ACS Global Ventures', '7000', 'Indian Bank', '7566328889', 'IDIB000K268', 'Yes', 'Yes', '', '', 'Working', '0000-00-00', 8300248423),
(62, 'EMP1064', 'Aswathy V L', 'XML', 'BOT', '2023-07-01', 'ACS Global Ventures', '7000', 'Indian Bank', '7565104075', 'IDIB000K268', 'Yes', 'Yes', '', '', 'Working', '0000-00-00', 111111111111),
(63, 'EMP1065', 'Vibisha Vincent V', 'XML', 'BOT', '2023-07-01', 'ACS Global Ventures', '5000', 'Indian Bank', '613708155', 'IDIB000K268', 'Yes', 'Yes', '', '', 'Working', '0000-00-00', 112222221212121),
(64, 'EMP1066', 'Sangeetha', 'BPO', 'QA', '2023-07-18', 'ACS Global Ventures', '7000', 'Indian Bank', '7295090768', 'IDIB000K268', 'Yes', 'Yes', '', '', 'Working', '0000-00-00', 6379103601),
(65, 'EMP1067', 'Eugin S', 'Admin', 'Branch Manager', '2023-03-01', 'ACS Global Ventures', '15000', 'Canara Bank', '61862200021090', 'CNRB0016186', 'Yes', 'Yes', '1111111111111111111111', '111111111111111111', 'Working', '0000-00-00', 9442065011),
(66, '', 'Shyjini K J', 'Developing', 'QA', '2023-06-06', 'ACS Global Ventures', '3000', 'State Bank of India', '31649204509', 'SBIN0002199', 'No', 'No', '', '', 'Exit', '0000-00-00', 9384531702),
(67, 'EMP1068', 'Aswathy S', 'Developing', 'QA', '2023-06-02', 'ACS Global Ventures', '5000', 'Indian Bank', '7565121308', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 9787294551),
(68, 'EMP1069', 'Rathisha ', 'Developing', 'QA', '2023-06-16', 'ACS Global Ventures', '5000', 'Indian Bank', '7565156852', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 0),
(69, '', 'Tharshini T', 'Developing', 'QA', '2023-06-16', 'ACS Global Ventures', '5000', 'Indian Bank', '7565084772', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 8220963326),
(70, '', 'Ashmi R S', 'Developing', 'QA', '2023-06-19', 'ACS Global Ventures', '5000', 'Indian Bank', '7565222410', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 8056319283),
(71, '', 'Abijith', 'Developing', 'QA', '2023-06-19', 'ACS Global Ventures', '3000', 'Federal Bank', '16840100066753', 'FDRL0001684', 'No', '', '', '', 'Working', '0000-00-00', 8940679341),
(72, '', 'Anidha I', 'XML', 'QA', '2023-07-03', 'ACS Global Ventures', '5000', 'Indian Bank', '7565190543', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 0),
(73, '', 'Ahila', 'XML', 'Traainee', '2023-07-03', 'ACS Global Ventures', '3000', 'Indian Bank', '7565139155', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 111212121221),
(74, '', 'Jacreet Sahina', 'XML', 'Trainee', '2023-07-03', 'ACS Global Ventures', '5000', 'Indian Bank', '7565277968', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 12121212121212),
(75, 'TR0013', 'Abisha G', 'XML', 'Trainee', '2023-07-18', 'ACS Global Ventures', '5000', 'Indian Bank', '7566650193', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 121212122122121),
(76, 'TR0014', 'Jenisha J', 'XML', 'Trainee', '2023-07-25', 'ACS Global Ventures', '5000', 'Indian Bank', '7565239671', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 1212122221212121),
(77, 'TR0017', 'Jeffrina', 'XML', 'Trainee', '2023-08-21', 'ACS Global Ventures', '3000', 'Indian Bank', '7618185402', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 8682868651),
(78, 'TR0018', 'Akshaya R.P', 'XML', 'Trainee', '2023-08-01', 'ACS Global Ventures', '5000', 'Indian Bank', '7618122101', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 7339095645),
(79, 'TR0019', 'Jemi', 'XML', 'Trainee', '2023-08-22', 'ACS Global Ventures', '3000', 'Indian Bank', '6952032855', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 9789829514),
(80, 'TR0020', 'Ajisha K', 'XML', 'Trainee', '2023-08-28', 'ACS Global Ventures', '3000', 'Indian Bank', '7618136907', 'IDIB000K268', 'Yes', 'No', '', '', 'Working', '0000-00-00', 6383168067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_data`
--
ALTER TABLE `employee_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
