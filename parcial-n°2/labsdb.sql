-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2023 a las 01:34:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labsdb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarSumatoria` (IN `p_n` INT, IN `p_factorial` INT, IN `p_sumatoria` DECIMAL(10,2))   BEGIN
    INSERT INTO parcial2 (n, factorial, sumatoria) VALUES (p_n, p_factorial, p_sumatoria);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerSumatorias` ()   BEGIN
    SELECT * FROM parcial2;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcial2`
--

CREATE TABLE `parcial2` (
  `id` int(11) NOT NULL,
  `n` int(11) DEFAULT NULL,
  `factorial` int(11) DEFAULT NULL,
  `sumatoria` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `parcial2`
--

INSERT INTO `parcial2` (`id`, `n`, `factorial`, `sumatoria`) VALUES
(1, 2, 1, 3.00),
(2, 2, 1, 5.00),
(3, 2, 2, 5.50),
(4, 2, 1, 3.00),
(5, 2, 1, 5.00),
(6, 2, 2, 5.50),
(7, 4, 1, 5.00),
(8, 4, 1, 9.00),
(9, 4, 2, 10.50),
(10, 4, 6, 10.83),
(11, 4, 24, 10.88),
(12, 2, 1, 3.00),
(13, 2, 1, 5.00),
(14, 2, 2, 5.50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `parcial2`
--
ALTER TABLE `parcial2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `parcial2`
--
ALTER TABLE `parcial2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
