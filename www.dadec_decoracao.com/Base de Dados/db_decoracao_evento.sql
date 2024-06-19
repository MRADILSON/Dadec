-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2024 às 20:33
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_decoracao_evento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `calendario`
--

INSERT INTO `calendario` (`id`, `title`, `startdate`, `enddate`, `allDay`) VALUES
(2, 'New Event', '2018-02-25T00:00:00+2:00', '2018-02-25T00:00:00+2:00', 'false'),
(3, 'New Event', '2018-03-06T00:00:00+2:00', '2018-03-06T00:00:00+2:00', 'false'),
(4, 'New Event', '2018-03-02T00:00:00+2:00', '2018-03-02T00:00:00+2:00', 'false'),
(5, 'New Event', '2018-02-27T00:00:00+2:00', '2018-02-27T00:00:00+2:00', 'false'),
(6, 'New Event', '2018-03-06T00:00:00+2:00', '2018-03-06T00:00:00+2:00', 'false');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`, `file_path`) VALUES
(79, 11, 1, 'Olá Dani, tudo bem?', 1, '2024-06-09 16:05:57', NULL),
(80, 11, 3, 'oi ana?', 1, '2024-06-09 16:17:21', NULL),
(81, 1, 3, 'oi ana', 1, '2024-06-09 16:17:49', NULL),
(82, 11, 1, 'Esse screeshoot é da ficha...', 1, '2024-06-09 16:40:32', '6665ccf0e508c7.84065289.jpg'),
(83, 3, 11, 'Estou bem e voce?', 1, '2024-06-09 16:57:38', NULL),
(84, 11, 3, 'também bem, envia comprovativo!', 1, '2024-06-09 16:58:12', NULL),
(85, 3, 11, 'Aqui está', 1, '2024-06-09 16:58:28', '6665d1241a2415.57217240.pdf'),
(86, 3, 2, 'Olá Adriano?', 1, '2024-06-09 17:57:17', NULL),
(87, 2, 3, 'Como estás?', 1, '2024-06-09 17:57:35', NULL),
(88, 3, 11, 'Olá', 0, '2024-06-10 15:28:37', NULL),
(89, 11, 3, 'Tudo bem?', 0, '2024-06-10 15:28:53', NULL),
(90, 11, 3, 'Aqui', 0, '2024-06-10 15:29:15', '66670dbb2d78d3.45912696.jpg'),
(91, 3, 11, 'comprovativo', 0, '2024-06-10 15:29:37', '66670dd1ef8a09.45644568.pdf'),
(92, 1, 11, 'olá', 1, '2024-06-10 15:31:38', NULL),
(93, 4, 11, 'oi Jonas', 1, '2024-06-10 18:44:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(1, 1, 2),
(2, 11, 1),
(3, 11, 3),
(4, 1, 3),
(5, 3, 2),
(6, 4, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `booking_id`, `title`, `location`, `date_created`, `color`, `start`, `end`) VALUES
(1, 0, 'Cocktail hour', 'aclc', '2018-03-07 03:12:52', '#40E0D0', '2018-03-07 00:00:00', '2018-03-08 00:00:00'),
(2, 1, 'Guests seated at the reception', 'Malaybalay', '2018-03-07 03:13:59', '#40E0D0', '2018-03-08 00:00:00', '2018-03-09 00:00:00'),
(3, 2, 'The wedding party & the happy couple are introduced', 'valencia city ', '2018-03-07 18:06:30', '#FF0000', '2018-03-19 08:00:00', '2018-03-19 20:00:00'),
(4, 2, 'First dance', 'valencia city ', '2018-03-07 18:07:11', '#FF0000', '2018-03-09 07:30:00', '2018-03-09 21:00:00'),
(5, 2, 'Toast & speeches', 'asdasd', '2018-03-07 18:09:28', '#FFD700', '2018-03-07 00:00:00', '2018-03-08 00:00:00'),
(6, 2, 'Dinner', 'asdasd', '2018-03-07 18:10:10', '', '2018-03-07 00:00:00', '2018-03-08 00:00:00'),
(7, 2, 'Father/daughter dance', 'asdasd', '2018-03-07 18:14:36', '#FF8C00', '2018-03-09 00:00:00', '2018-03-10 00:00:00'),
(8, 1, 'Mother/son dance', 'asdasd', '2018-03-07 18:15:03', '#008000', '2018-03-07 06:00:00', '2018-03-07 10:00:00'),
(9, 1, 'Bouquet & garter toss', 'asdasd', '2018-03-07 18:15:53', '#008000', '2018-03-09 00:00:00', '2018-03-10 00:00:00'),
(10, 1, 'Dancing', 'asdasd', '2018-03-07 18:18:44', '#008000', '2018-03-09 00:00:00', '2018-03-10 00:00:00'),
(11, 0, 'Cake-cutting', 'ASDASD', '2018-03-07 18:21:58', '#008000', '2018-03-10 00:00:00', '2018-03-11 00:00:00'),
(12, 0, 'Last song', 'ASDASD', '2018-03-07 18:22:26', '#008000', '2018-03-10 00:00:00', '2018-03-11 00:00:00'),
(13, 0, 'End of reception/After-party', 'ASDASD', '2018-03-07 18:22:38', '', '2018-03-10 00:00:00', '2018-03-11 00:00:00'),
(14, 34, 'Demo Title', 'Demo Location', '2022-04-13 18:30:17', '#FF0000', '2022-04-13 00:00:00', '2022-04-14 00:00:00'),
(16, 31, 'Title One', 'Loc 1', '2022-04-13 18:32:25', '#000', '2022-04-28 00:00:00', '2022-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `cliente` varchar(45) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `produto` varchar(400) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tipo_pagamento` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `comprovante` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `cliente`, `cliente_id`, `produto`, `total`, `tipo_pagamento`, `descricao`, `comprovante`, `data`, `estado`) VALUES
(20, 'Ana Antonio', 3, 'Cadeira de Noivo - Mini Rei Par', 300.00, 'PayPal', 'Pagamento Feito', 'lo-removebg-preview.png', '2024-05-24 08:05:03', 'aprovado'),
(21, 'Ana Antonio', 3, 'Cadeira de Noivo - Mini Rei Par', 2700.00, 'Unitel Money', 'Pagamento Feito', 'lo-removebg-preview.png', '2024-05-24 08:05:08', 'aprovado'),
(24, 'Adriano Miguel', 1, 'Cadeira Acliricas', 21000.00, 'PayPal', 'Pagamento Feito', 'pngwing.com.png', '2024-05-24 06:05:44', 'pendente'),
(25, 'Ana Antonio', 3, 'Cadeira Acliricas', 1400.00, 'Mulicaixa Express', 'Pagamento', 'comprovativo_20231121_161918_5525603720_signed.pdf', '2024-06-10 04:06:09', 'aprovado'),
(26, 'Ana Antonio', 3, 'Cadeira Acliricas; Cadeira de Alumnio - Dourada;', 600.00, 'BAI DIRETO', 'Pagamento', 'comprovativo_20231121_161918_5525603720_signed.pdf', '2024-06-12 02:06:29', 'pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento_decoracao`
--

CREATE TABLE `pagamento_decoracao` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `cliente` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `data_evento` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cadeiras` varchar(45) NOT NULL,
  `tipo_pagamento` varchar(45) NOT NULL,
  `localizacao` varchar(45) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `estilo` varchar(45) NOT NULL,
  `comprovante` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pagamento_decoracao`
--

INSERT INTO `pagamento_decoracao` (`id`, `cliente_id`, `cliente`, `tipo`, `data_evento`, `total`, `cadeiras`, `tipo_pagamento`, `localizacao`, `cor`, `estilo`, `comprovante`, `data`, `estado`) VALUES
(3, 3, 'Ana Antonio', 'Casamento', '2024-04-30', 52000.00, '1', 'Unitel Money', 'Cuito-Bi', 'Preta', 'Dual', 'IMG-20231126-WA0053-removebg-preview.jpg', '2024-05-25 05:05:01', 'aprovado'),
(4, 3, 'Ana Antonio', 'Aniversario', '2024-04-30', 52000.00, '1', 'Unitel Money', 'Cuito-Bi', 'Preta', 'Dual', 'IMG-20231126-WA0053-removebg-preview.jpg', '2024-05-25 05:05:02', 'aprovado'),
(5, 3, 'Ana Antonio', 'Aniversario', '2024-06-13', 104000.00, '2', 'Bai Direto', 'cuit', 'azul', 'duplo', 'comprovativo_20231121_161918_5525603720_signed.pdf', '2024-06-12 03:06:56', 'aprovado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblaccounts`
--

CREATE TABLE `tblaccounts` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `access_level` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblaccounts`
--

INSERT INTO `tblaccounts` (`user_id`, `user_email`, `user_password`, `access_level`) VALUES
(1, 'jasonp@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(2, 'anniel@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(3, 'rosieing@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(4, 'marklw@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(5, 'deweyv@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(6, 'berrynich@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(7, 'vicrroyo@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(8, 'danielwbk@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(9, 'sharoncn@mail.com', '5278536a32d07ce18f876feaf18eae02', ''),
(10, 'michaelcomb@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(11, 'peggykhoury@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(12, 'paulproc@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(13, 'dekkersus@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(14, 'gingerlw@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(15, 'jameswf@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(16, 'lindagd@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(17, 'guemary@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(18, 'davidwls@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(19, 'donniehr@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(20, 'bettyvass@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(21, 'cherlylp@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(22, 'carolcass@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(23, 'angelocl@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
(24, 'peggybkk@mail.com', '', ''),
(25, 'test@mail.com', '', ''),
(26, 'troybrl@mail.com', '', ''),
(27, 'uuu@mail.com', '', ''),
(28, 'qweqw@asdas.com', 'a8f5f167f44f4964e6c998dee827110c', ''),
(29, 'aaaa@aaa.com', '47bce5c74f589f4867dbd57e9ca9f808', ''),
(30, 'andrewc@mail.com', '1a1dc91c907325c69271ddf0c944bc72', ''),
(31, 'aaront@mail.com', '1a1dc91c907325c69271ddf0c944bc72', ''),
(32, 'bruce@mail.com', '', ''),
(33, 'amy@mail.co', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(34, 'ww@mail.com', '', ''),
(35, 'stevenn@mail.com', '', ''),
(36, 'joaofernandomatias17@gmail.com', '', ''),
(37, 'dddd@gmail.com', '', ''),
(38, 'teste@gmail.com', '', ''),
(39, 'joao17@gmail.com', '', ''),
(40, 'joao12@gmail.com', '', ''),
(41, 'joao112@gmail.com', '', ''),
(42, 'joao12@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', ''),
(43, 'dddd1@gmail.com', '', ''),
(44, 'joaofernandom9999atias17@gmail.com', '', ''),
(45, 'admin@mail.com', '', ''),
(46, 'admin2024@mail.com', '', ''),
(47, 'ddd77d1@gmail.com', '', ''),
(48, 'ddd1@gmail.com', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblaccounts_detail`
--

CREATE TABLE `tblaccounts_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `datetime_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `location` text NOT NULL,
  `expectation_visitor` varchar(100) NOT NULL,
  `cash_advanced` decimal(10,2) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  `date_signed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblaccounts_detail`
--

INSERT INTO `tblaccounts_detail` (`id`, `user_id`, `firstname`, `lastname`, `phone`, `city`, `datetime_created`, `description`, `location`, `expectation_visitor`, `cash_advanced`, `status`, `date_signed`) VALUES
(1, 1, 'Jason', 'Phares', '8520001450', 'Corpus Christi', '2018-03-05 16:03:18', 'description', 'location', '100', 11000.00, 'confirm', '0000-00-00 00:00:00'),
(2, 2, 'Annie', 'Lin', '1458003650', 'Chillicothe', '2018-03-06 22:03:05', 'none', '94 Fairmont Avenue', '100', 10000.00, 'confirm', '0000-00-00 00:00:00'),
(3, 3, 'Rosie', 'Ingram', '0147852220', 'Olympia', '2018-03-08 14:03:03', 'none', '15 Honeysuckle Lane', '512', 1500.00, 'Pendente', '0000-00-00 00:00:00'),
(4, 4, 'Mark', 'Lew', '1478521456', 'Greenville', '2018-03-08 14:03:35', 'none', '521 Brown Avenue', '150', 1000.00, 'Pendente', '0000-00-00 00:00:00'),
(5, 5, 'Dewey', 'Vasquez', '3214589999', 'Scottsdale', '2018-03-08 14:03:36', 'none', '96 East Avenue', '210', 1100.00, 'Pendente', '0000-00-00 00:00:00'),
(6, 6, 'Nicholas', 'Berry', '1479996650', 'New York', '2018-03-08 14:03:40', 'none', '74 Godfrey Road', '300', 2500.00, 'Pendente', '0000-00-00 00:00:00'),
(7, 7, 'Victoria', 'Arroyo', '3256665870', 'Columbus', '2018-03-08 14:03:41', 'none', '98 Collins Avenue', '120', 1250.00, 'Pendente', '0000-00-00 00:00:00'),
(8, 8, 'Daniel', 'Wilbanks', '4580001450', 'Salina', '2018-03-08 14:03:42', 'none', '28 Sherman Street', '90', 1000.00, 'Pendente', '0000-00-00 00:00:00'),
(9, 9, 'Sharon', 'Cintron', '1456662210', 'Grand Rapids', '2018-03-08 14:03:44', 'none', '61 Bee Street', '300', 5000.00, 'Pendente', '0000-00-00 00:00:00'),
(10, 10, 'Michael', 'Halcomb', '4545554700', 'Portland', '2018-03-08 14:03:47', 'none', '101 Pratt Avenue', '300', 4500.00, 'Pendente', '0000-00-00 00:00:00'),
(11, 11, 'Peggy', 'Khoury', '4589780000', 'Pittsburg', '2018-03-08 14:03:51', 'none', '87 Breezewood Court', '250', 4000.00, 'Pendente', '0000-00-00 00:00:00'),
(12, 12, 'Paul', 'Prochaska', '7896665450', 'Fort Lauderdale', '2018-03-08 14:03:53', 'none', '42 West Fork Drive', '300', 5000.00, 'Pendente', '0000-00-00 00:00:00'),
(13, 13, 'Susan', 'Dekker', '6541258888', 'Jackson', '2018-03-08 14:03:54', 'none', '66 Lena Lane', '150', 1500.00, 'Pendente', '0000-00-00 00:00:00'),
(14, 14, 'Ginger', 'Lowe', '3214589650', 'Huntington', '2018-03-08 14:03:57', 'none', '602 Columbia Mine Road', '200', 2000.00, 'confirm', '0000-00-00 00:00:00'),
(15, 15, 'James', 'Wolff', '1458545000', 'Salina', '2018-03-08 15:03:00', 'none', '69 Sherman Street', '450', 4000.00, 'Pendente', '0000-00-00 00:00:00'),
(16, 16, 'Linda', 'Gordon', '1478545450', 'Cambridge', '2018-03-08 15:03:01', 'none', '27 Gerald L. Bates Drive', '100', 1200.00, 'Pendente', '0000-00-00 00:00:00'),
(17, 17, 'Mary', 'Guerrero', '9547854780', 'Edgemont', '2018-03-08 15:03:02', 'none', '66 Denver Avenue', '510', 7000.00, 'Pendente', '0000-00-00 00:00:00'),
(18, 18, 'David', 'Wells', '8545454750', 'Schaumburg', '2018-03-08 01:03:31', 'none', '82 Millbrook Road', '200', 3000.00, 'confirm', '0000-00-00 00:00:00'),
(19, 19, 'Donnie', 'Hernandez', '3214589650', 'Lancaster', '2018-03-08 01:03:34', 'none', '66 Stout Street', '350', 2500.00, 'Pendente', '0000-00-00 00:00:00'),
(20, 20, 'Betty', 'Vassar', '2547850000', 'Pennsauken', '2018-03-08 01:03:42', 'none', '', '170', 2000.00, 'Pendente', '0000-00-00 00:00:00'),
(21, 21, 'Cheryl', 'Lapine', '4589650014', 'Kenney', '2018-03-08 01:03:46', 'none', '95 Little Acres Lane', '300', 2500.00, 'cancel', '0000-00-00 00:00:00'),
(22, 22, 'Carol', 'Casey', '2458954500', 'Lecompte', '2018-03-08 01:03:48', 'none', '52 Emerson Road', '480', 6500.00, 'Pendente', '0000-00-00 00:00:00'),
(23, 23, 'Angelo', 'Clark', '3245785540', 'Phoenix', '2018-03-09 02:03:01', 'none', '98 Hillside Street', '260', 4500.00, 'Pendente', '0000-00-00 00:00:00'),
(24, 24, 'Peggy', 'Buck', '6547778540', 'Baltimore', '2018-03-09 02:03:44', 'none', '93 Columbia Boulevard', '320', 6000.00, 'Pendente', '0000-00-00 00:00:00'),
(25, 25, 'Test', 'Account', '7777777777', 'Chicago', '2022-04-08 06:19:21', 'Demo Text', '115 Test Street', '210', 1200.00, 'confirm', '0000-00-00 00:00:00'),
(30, 30, 'Andrew', 'Copeland', '7412220000', 'Iron Mountain', '2022-04-12 19:19:53', 'This is a demo test', '450 Lewis Street', '180', 23000.00, 'confirm', '0000-00-00 00:00:00'),
(31, 31, 'Aaron', 'Turner', '1478555545', 'Chicago', '2022-04-12 19:19:55', '', '', '', 0.00, 'Pendente', '0000-00-00 00:00:00'),
(32, 32, 'Bruce', 'Wright', '7854785555', 'Durham', '2022-04-13 00:19:58', 'This is a demo description.', 'Location One', '200', 13000.00, 'confirm', '0000-00-00 00:00:00'),
(33, 33, 'Amy', 'Stewart', '4444444444', 'Houston', '2022-04-13 01:19:02', '', '', '', 0.00, 'Pendente', '0000-00-00 00:00:00'),
(34, 34, 'Steven', 'Grant', '7777777777', '', '2022-04-13 02:19:35', '', '', '', 0.00, 'Pendente', '0000-00-00 00:00:00'),
(35, 35, 'Steven', 'Grant', '7774441470', 'TestCity', '2022-04-13 02:19:38', 'This is a demo description for demo testing purpose!', 'Demo Location One', '250', 16000.00, 'confirm', '0000-00-00 00:00:00'),
(37, 37, 'Testando', 'Fernandes', '939390070', '', '2024-05-12 04:05:27', '', 'Luanda', '', 0.00, 'confirm', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblgallery`
--

CREATE TABLE `tblgallery` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(100) NOT NULL,
  `alternate_text` varchar(100) NOT NULL,
  `type` char(5) NOT NULL,
  `size` varchar(10) NOT NULL,
  `relate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblgallery`
--

INSERT INTO `tblgallery` (`id`, `booking_id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`, `relate_id`) VALUES
(37, 35, 'Noivos na Selva', 'Noivos na Selva', 'Noivos na Selva', 'daniel-suarez-photography-107973-unsplash.jpg', 'Noivos na Selva', 'image', '2479437', 0),
(51, 35, 'Noiva Casada', 'Melhor Foto', 'Best', 'zelle-duda-365988-unsplash.jpg', 'Melhor', 'image', '872033', 0),
(52, 47, 'Teste', 'Melhor Foto', 'GGG', 'carreras-universidad-de-tijuana.jpg', 'Melhor', 'image', '287623', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblguest`
--

CREATE TABLE `tblguest` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `guestname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `state` char(4) NOT NULL,
  `zipcode` char(10) NOT NULL,
  `priority` enum('A','B','C','D','E') NOT NULL,
  `out_of_town` enum('y','n') NOT NULL,
  `relationship` varchar(32) NOT NULL,
  `tracks_and_gifts` text NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblguest`
--

INSERT INTO `tblguest` (`id`, `booking_id`, `fullname`, `guestname`, `address`, `state`, `zipcode`, `priority`, `out_of_town`, `relationship`, `tracks_and_gifts`, `city`) VALUES
(1, 1, 'josh dragon', 'josh', 'valencia', 'ph', '9098', 'A', 'y', 'g', 'asdasdsad', 'valencia'),
(2, 1, 'jane gest', 'jane', 'address', 'ph', '9807', 'A', 'y', 'b', 'color thing', 'valencia city'),
(3, 2, 'jane gest', 'jane', 'address', 'ph', '9807', 'A', 'y', 'b', 'color thing', 'valencia city'),
(4, 1, 'joshua deasi', 'designa', 'san fernando', 'ph', '0982', 'A', 'y', 'g', 'asdasdasdasdasd', 'asdsad'),
(5, 30, 'Betty M. Barber', 'Betty M. Barber', '3 Olen Thomas Drive', 'TX', '73600', 'A', 'y', 'g', 'Demo Text Demo Text', 'Wichita Falls'),
(6, 34, 'Guest One', 'Guest Name', '11 Test Address', 'DS', '70001', 'B', 'y', 'g', 'Demo Demo Demo', 'Democity'),
(7, 36, 'Daniel Zacarias', 'Daniel Zacarias', 'Cuito-Bi&eacute;', 'gg', 'gg', 'A', 'y', 'b', 'Nao leve crianaca', 'gg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblorganizer`
--

CREATE TABLE `tblorganizer` (
  `organizer_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `datetime_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblpostwedding`
--

CREATE TABLE `tblpostwedding` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `preview_image` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `wedding_date` varchar(100) NOT NULL,
  `wedding_type` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `date_published` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblpostwedding`
--

INSERT INTO `tblpostwedding` (`id`, `title`, `description`, `preview_image`, `location`, `status`, `wedding_date`, `wedding_type`, `date_created`, `date_published`) VALUES
(32, 'MR. &amp; MRS. Levy', 'Charming hilltop chapel with a rustic stone interior and graceful arched windows that offer unobstructed views of the Blue Ridge Mountains. Receptions are held at the nearby clubhouse where you can continue the celebration in the ballroom, or beneath a tent on the sprawling lawn.', '20160726_160113.jpg', 'The Cliffs at Glassy', '0', '04/01/2022', 'Anivers&aacute;rios', 'March 8, 2022, 11:29 am', ''),
(35, 'MR. MRS Redmond', 'Mountain beauty meets warm sophistication at this resort, which boasts a luxury lodge, chic hotel, two country clubs, and plenty of indoor and outdoor wedding venues from refined ballrooms to lush gardens to shabby-chic wood pavilions.', 'wdnf8.JPG', 'Crystal Springs Resort', '1', '03/16/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:10 pm'),
(40, 'MR. &amp; MRS. Collins', 'Lush, tropical garden setting with an open-air chapel and stunning views of the Ko\'olau Mountains.', 'wdnf3.JPG', 'Haiku Gardens', '1', '02/20/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:17 pm'),
(45, 'MR. MRS  Graham', 'Faithful replica of a classic medieval castle, complete with turrets, a drawbridge, a vast collection of Medieval and Renaissance artifacts, and a romantic garden overlooking the Atlantic.', 'wdnf7.JPG', 'Hammond Castle Museum', '1', '02/20/2022', 'Gold', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:09 pm'),
(50, 'MR. MRS. Yorke', 'Fairy-tale Tudor Revival mansion and lakeside chapel surrounded by 100 acres of formal gardens and 900 acres of natural woodlands.', 'wdnf9.JPG', 'The Skylands Manor', '1', '03/23/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:13 pm'),
(52, 'MR. &amp; MRS. Pearson', 'Beautifully restored historic home with elegant indoor event spaces, a Parterre Garden, and a lovely courtyard strung with market lights that\'s perfect for intimate celebrations.', 'wdnf4.JPG', 'Beauregard-Keyes House', '1', '04/30/2018', 'Elite', 'March 8, 2022, 11:29 am', 'April 13, 2022, 6:17 pm'),
(55, 'MR. &amp; MRS. Raftery', 'Relaxed and refined private complex on 24 acres along the Carmel River where you can wed, dine, and stay.', 'wdnf.JPG', 'Gardener Ranch', '1', '02/20/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:18 pm'),
(57, 'MR. &amp; MRS. Brower', 'Exchange vows in a natural woodland &ldquo;cathedral&rdquo; surrounded by towering pines, followed by cocktails served from a charming tipi and a delightful tented reception in the heart of the woods.', 'wdnf5.JPG', 'Blue Moon Rising', '1', '04/18/2022', 'Aniversario', 'March 8, 2022, 11:29 am', 'May 29, 2024, 4:22 pm'),
(60, 'MR. &amp; MRS. Reid', 'Romantic 1929 Art Deco, blufftop mansion with indoor and outdoor event venues that offer fantastic ocean and shoreline views.', 'wdnf6.JPG', 'Yankee Clipper Inn', '1', '02/20/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:06 pm'),
(62, 'MR. &amp; MRS. Squires', 'Magnificent 102-acre coastal resort on a bluff overlooking the stunning Palos Verdes Peninsula, boasting landscaped grounds, verdant lawns, and warm, elegant ballrooms with terraces&mdash;all with jaw-dropping views.', 'wdnf12.JPG', 'Terranea Resort', '1', '04/03/2022', 'Premier', 'March 8, 2022, 11:29 am', 'April 13, 2022, 7:31 pm'),
(65, 'MR. &amp; MRS. Jones', 'Relaxed, full-service resort presents an alluring choices of indoor and outdoor venues, from al fresco ceremonies with sweeping Pacific vistas to luxe reception ballrooms with classic columns and hand-blown glass chandeliers.', 'wdnf10.JPG', 'Hyatt Regency Huntington Beach Resort and Spa', '1', '04/05/2022', 'Elite', 'March 4, 2022, 11:44 am', 'April 13, 2022, 6:14 pm'),
(67, 'MR. &amp; MRS. Russell', 'This Rockies hideaway boasts incredible mountain vistas and streamside paths, with multiple venue options for al fresco events, from the Shaker, an open-air platform tented with sailcloth, to the Highbanker Beach, a creekside lounge area perfect for cocktails and bonfires.', 'wdnf2.JPG', 'Blackstone Rivers Ranch', '1', '03/31/2022', 'Elegant', 'March 8, 2022, 11:29 am', 'April 13, 2022, 6:18 pm'),
(69, 'MR. &amp; MRS. Smith', 'This rustic farmstead getaway offers picture-perfect event spaces, including a hilltop pergola and the Chimney Pond Meadow, surrounded by neat rows of Christmas trees, and a stylishly rustic reception barn highlighted by Tuscan lights and globe chandeliers.', 'wdnf11.JPG', 'Sawyer Family Farmstead', '1', '03/29/2018', 'Elite', 'March 8, 2022, 11:50 am', 'April 13, 2022, 6:16 pm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblweddingbook`
--

CREATE TABLE `tblweddingbook` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bride` varchar(32) NOT NULL,
  `groom` varchar(32) NOT NULL,
  `wedding_type` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `wedding_date` varchar(100) NOT NULL,
  `organizer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblweddingbook`
--

INSERT INTO `tblweddingbook` (`booking_id`, `user_id`, `bride`, `groom`, `wedding_type`, `user_email`, `wedding_date`, `organizer_id`) VALUES
(1, 1, 'Jane Doe', 'John Dee', 3, 'jason@mail.com', '03/30/2022', 1),
(2, 2, 'Elizabeth Brown', 'Pedro Afonso', 4, 'anniel@mail.com', '03/30/2022', 1),
(3, 3, '', '', 0, 'rosieing@mail.com', '03/30/2022', 1),
(4, 4, '', '', 0, 'marklw@mail.com', '03/30/2022', 1),
(5, 5, '', '', 0, 'deweyv@mail.com', '03/30/2022', 1),
(6, 6, '', '', 0, 'berrynich@mail.com', '03/30/2022', 1),
(7, 7, '', '', 0, 'vicrroyo@mail.com', '03/30/2022', 1),
(8, 8, '', '', 0, 'danielwbk@mail.com', '03/30/2022', 1),
(9, 9, '', '', 0, 'sharoncn@mail.com', '03/30/2022', 1),
(10, 10, '', '', 0, 'michaelcomb@mail.com', '03/30/2022', 1),
(11, 11, '', '', 0, 'peggykhoury@mail.com', '03/30/2022', 1),
(12, 12, '', '', 0, 'paulproc@mail.com', '03/08/2022', 1),
(13, 13, '', '', 0, 'dekkersus@mail.com', '03/31/2022', 1),
(14, 14, '', '', 5, 'gingerlw@mail.com', '04/02/2022', 1),
(15, 15, '', '', 5, 'jameswf@mail.com', '04/28/2022', 1),
(16, 16, '', '', 0, 'lindagd@mail.com', '05/18/2022', 1),
(17, 17, '', '', 0, 'guemary@mail.com', '05/24/2022', 1),
(18, 18, 'Nora Westley', 'David Wells', 0, 'davidwls@mail.com', '04/27/2022', 1),
(19, 19, '', '', 0, 'donniehr@mail.com', '05/25/2022', 1),
(20, 20, '', '', 0, 'bettyvass@mail.com', '03/27/2022', 1),
(21, 21, '', '', 5, 'asdasdasdsad@gmail.com', '06/08/2022', 0),
(22, 22, '', '', 0, 'carolcass@mail.com', '06/23/2022', 1),
(23, 23, '', '', 0, 'angelocl@mail.com', '06/15/2022', 1),
(24, 24, '', '', 0, 'peggybkk@mail.com', '07/07/2022', 1),
(25, 25, 'Test Two', 'Test Account', 5, 'test@mail.com', '04/19/2022', 1),
(26, 26, '', '', 0, 'troybrl@mail.com', '04/27/2022', 1),
(30, 30, 'Stella', 'Andrew Copeland', 4, 'andrewc@mail.com', '05/01/2022', 1),
(31, 31, 'Eliza Williams', 'Aaron Turner', 4, 'aaront@mail.com', '05/09/2022', 1),
(32, 32, 'Christine Walmer', 'Bruce Wright', 5, 'bruce@mail.com', '04/26/2022', 1),
(33, 33, 'Test', 'Test', 1, 'amy@mail.co', '05/18/2022', 1),
(34, 35, 'Ellen Moore', 'Steven Grant', 5, 'stevenn@mail.com', '05/04/2022', 1),
(35, 36, '', '', 4, 'joaofernandomatias17@gmail.com', '05/22/2024', 0),
(36, 37, '', '', 3, 'dddd@gmail.com', '05/14/2024', 1),
(37, 38, '', '', 5, 'teste@gmail.com', '05/21/2024', 0),
(38, 39, '', '', 5, 'joao17@gmail.com', '06/30/2024', 0),
(39, 40, '', '', 3, 'joao12@gmail.com', '08/15/2024', 0),
(40, 41, '', '', 3, 'joao112@gmail.com', '11/15/2024', 0),
(41, 42, 'teste', 'teste', 1, 'joao12@gmail.com', '05/29/2024', 3),
(42, 43, '', '', 0, 'dddd1@gmail.com', '06/06/2024', 0),
(43, 44, '', '', 4, 'joaofernandom9999atias17@gmail.com', '12/03/2024', 0),
(44, 45, '', '', 4, 'admin@mail.com', '03/07/2025', 0),
(45, 46, '', '', 4, 'admin2024@mail.com', '03/04/2025', 0),
(46, 47, '', '', 0, 'ddd77d1@gmail.com', '07/10/2024', 0),
(47, 48, '', '', 0, 'ddd1@gmail.com', '12/14/2024', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_caracteristica`
--

CREATE TABLE `tbl_caracteristica` (
  `feature_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_caracteristica`
--

INSERT INTO `tbl_caracteristica` (`feature_id`, `category_id`, `title`, `descricao`) VALUES
(3, 2, 'Fot&oacute;grafo', 'unlimited shot\r\nSoftCopy(CD/DVD)'),
(8, 1, 'PACOTE B&Aacute;SICO -  250.000 KZ', 'Our own professional worker'),
(10, 1, 'PACOTE NORMAL -  350.000kz', 'Vegetable &amp; Cheese Platters'),
(11, 1, 'PACOTE AVAN&Ccedil;ADO - 500.000 kz', 'DJ Services'),
(21, 4, 'Photographer', 'unlimited shot'),
(22, 4, 'Bar Service', 'Beer, Wine'),
(23, 4, 'Reception Decor', 'Stage Decor'),
(24, 3, 'Hair And Make Up', 'unlimited shot'),
(25, 3, 'Appetizers and Meal Services', 'Choice Six Hot/Cold, 3-Entr&eacute;e Buffet or Duet Plate'),
(26, 3, 'Invitations &amp; Accessories', 'none'),
(27, 3, 'DJ &amp; MC Services', 'none'),
(28, 2, 'Aperitivos', 'Vegetable &amp; Cheese Platters'),
(29, 2, 'Decora&ccedil;&atilde;o', 'Stage Decorations'),
(30, 3, 'Wedding Cake', 'Custom Wedding Cake'),
(35, 5, 'Grand Sparklers', 'Grand Sparklers'),
(36, 5, 'Specialty Lighting', 'Specialty Lighting');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `genero` enum('m','f') NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `endereco` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `data_criacao` varchar(100) NOT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`id`, `nome`, `email`, `password`, `genero`, `telefone`, `endereco`, `foto`, `data_criacao`, `estado`, `last_seen`) VALUES
(2, 'Adriano Miguel', 'adriano@gmail.com', 'Adriano1234', 'm', '991129529', 'Cuito-Bi&eacute;', 'pngwing.com.png', '2024-05-24 15:05:03', 'activo', '2024-06-10 15:27:32'),
(3, 'Ana Antonio', 'anaantonio@gmail.com', 'ana2001', 'f', '932345111', 'Cuito-Bi&eacute;', 'SEMM.png', '2024-05-24 15:05:03', 'activo', '2024-06-10 17:51:33'),
(4, 'Justino Eyala', 'justino@gmail.com', '2024', 'm', '939390070', 'Talatona', '', '24-06-10 06:06:42', 'activo', '2024-06-10 22:11:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_decoracao_categoria`
--

CREATE TABLE `tbl_decoracao_categoria` (
  `id` int(11) NOT NULL,
  `wedding_type` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `preview_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_decoracao_categoria`
--

INSERT INTO `tbl_decoracao_categoria` (`id`, `wedding_type`, `price`, `preview_image`) VALUES
(1, 'Casamento', 250000.00, 'classic.jpg'),
(2, 'Pedidos', 20000.00, 'elegnant.jpg'),
(4, 'Outros', 39500.00, 'timeless gold.jpg'),
(5, 'Aniversario', 52000.00, 'Imagem WhatsApp 2024-05-21 às 21.48.36_7e9e7b72.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_funcionario`
--

CREATE TABLE `tbl_funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `idade` int(11) NOT NULL,
  `contacto` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `funcao` varchar(45) NOT NULL,
  `salario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_funcionario`
--

INSERT INTO `tbl_funcionario` (`id`, `nome`, `idade`, `contacto`, `endereco`, `funcao`, `salario`) VALUES
(1, 'Daniel Zacarias', 29, '991129529', 'Cuito-Bi&eacute;', 'Gerente', 2000000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_liquidacao`
--

CREATE TABLE `tbl_liquidacao` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `date_issue` varchar(100) NOT NULL,
  `date_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_liquidacao`
--

INSERT INTO `tbl_liquidacao` (`id`, `booking_id`, `user_id`, `event_id`, `payment`, `cash`, `credit`, `date_issue`, `date_modified`) VALUES
(1, 1, 1, 34, 10000.00, 10000.00, 0.00, 'March 10, 2018, 5:16 pm', 'March 9, 2018, 1:46 pm'),
(2, 1, 1, 30, 2022.00, 2022.00, 0.00, 'March 11, 2018, 1:16 pm', ''),
(3, 1, 1, 33, 4500.00, 2500.00, 20000.00, 'March 12, 2018, 8:16 am', ''),
(4, 1, 1, 8, 2000.00, 1000.00, 1000.00, 'June 10, 2018, 5:16 pm', ''),
(5, 2, 2, 8, 2000.00, 1000.00, 1000.00, 'June 10, 2018, 5:16 pm', ''),
(6, 30, 30, 5, 2500.00, 2500.00, 0.00, 'April 13, 2022, 2:04 am', ''),
(7, 30, 30, 6, 3950.00, 3950.00, 0.00, 'April 13, 2022, 2:21 am', ''),
(8, 25, 25, 1, 1660.00, 1660.00, 0.00, 'April 13, 2022, 2:23 am', ''),
(9, 30, 30, 11, 1500.00, 0.00, 1500.00, 'April 13, 2022, 6:55 pm', ''),
(10, 30, 30, 11, 1500.00, 1500.00, 0.00, 'April 13, 2022, 6:55 pm', ''),
(11, 34, 35, 5, 3500.00, 3500.00, 0.00, 'April 13, 2022, 8:42 pm', ''),
(12, 34, 35, 11, 1100.00, 1100.00, 0.00, 'April 13, 2022, 8:43 pm', ''),
(13, 34, 35, 10, 3000.00, 3000.00, 0.00, 'April 13, 2022, 8:43 pm', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_material`
--

CREATE TABLE `tbl_material` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `imagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_material`
--

INSERT INTO `tbl_material` (`id`, `nome`, `preco`, `quantidade`, `imagem`) VALUES
(4, 'Cadeira de Noivo - Mini Rei Par', 7000.00, 10, 'Imagem WhatsApp 2024-05-21 às 21.49.09_cf1d21b9.jpg'),
(7, 'Cadeira de Alumnio - Dourada', 250.00, 100, 'Imagem WhatsApp 2024-05-21 às 21.49.12_5a1b1d66.jpg'),
(8, 'Cadeira Acliricas', 350.00, 100, 'Imagem WhatsApp 2024-05-21 às 21.49.14_db1139cb.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `genero` enum('m','f') NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designacao` varchar(100) NOT NULL,
  `endereco` text NOT NULL,
  `nivel_acesso` enum('0','1','2') NOT NULL,
  `foto` varchar(100) NOT NULL,
  `data_criacao` varchar(100) NOT NULL,
  `last_seen` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `nome`, `genero`, `usuario`, `password`, `email`, `designacao`, `endereco`, `nivel_acesso`, `foto`, `data_criacao`, `last_seen`) VALUES
(1, 'Daniel', 'f', 'admin', 'D00F5D5217896FB7FD601412CB890830', 'admin@mail.com', 'Administrador', 'Cuito-Bi&eacute;', '', 'pngaaa.com-4051919.png', 'March 6, 2021, 5:15 pm', '2024-06-10 15:31:52'),
(11, 'Jonathan Fernandes', 'm', 'admin', '07811dc6c422334ce36a09ff5cd6fe71', 'joaofernandomatias17@gmail.com', 'Administrador', 'Luanda', '', 'IMG_20211025_110017~2.jpg', 'May 21, 2024, 7:45 pm', '2024-06-10 18:45:14'),
(13, 'Justino Eyala', 'm', 'justino', '07811dc6c422334ce36a09ff5cd6fe71', 'justino@gmail.com', 'Funcionario', 'Cuito', '', '', 'June 12, 2024, 6:36 pm', '2024-06-12 18:36:28');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Índices para tabela `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagamento_decoracao`
--
ALTER TABLE `pagamento_decoracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tblaccounts`
--
ALTER TABLE `tblaccounts`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices para tabela `tblaccounts_detail`
--
ALTER TABLE `tblaccounts_detail`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tblguest`
--
ALTER TABLE `tblguest`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tblorganizer`
--
ALTER TABLE `tblorganizer`
  ADD PRIMARY KEY (`organizer_id`);

--
-- Índices para tabela `tblpostwedding`
--
ALTER TABLE `tblpostwedding`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tblweddingbook`
--
ALTER TABLE `tblweddingbook`
  ADD PRIMARY KEY (`booking_id`);

--
-- Índices para tabela `tbl_caracteristica`
--
ALTER TABLE `tbl_caracteristica`
  ADD PRIMARY KEY (`feature_id`);

--
-- Índices para tabela `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `tbl_decoracao_categoria`
--
ALTER TABLE `tbl_decoracao_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_liquidacao`
--
ALTER TABLE `tbl_liquidacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de tabela `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `pagamento_decoracao`
--
ALTER TABLE `pagamento_decoracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tblaccounts_detail`
--
ALTER TABLE `tblaccounts_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `tblguest`
--
ALTER TABLE `tblguest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tblorganizer`
--
ALTER TABLE `tblorganizer`
  MODIFY `organizer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tblpostwedding`
--
ALTER TABLE `tblpostwedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `tblweddingbook`
--
ALTER TABLE `tblweddingbook`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `tbl_caracteristica`
--
ALTER TABLE `tbl_caracteristica`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbl_decoracao_categoria`
--
ALTER TABLE `tbl_decoracao_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_liquidacao`
--
ALTER TABLE `tbl_liquidacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
