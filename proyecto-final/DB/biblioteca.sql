-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2023 a las 21:30:48
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
-- Base de datos: `biblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarEstadoLibro` (IN `p_libro_id` INT, IN `p_nuevo_estado` ENUM('Leyendo','Por leer','Leido'))   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error al actualizar el estado del libro: No se pudo realizar la actualización.';
    END;

    UPDATE libros
    SET
        estado = p_nuevo_estado
    WHERE
        id = p_libro_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarLibro` (IN `p_titulo` VARCHAR(255), IN `p_autor` VARCHAR(100), IN `p_genero` VARCHAR(100), IN `p_anio_publicacion` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error al insertar el libro: Ya existe un libro con este título y autor.';
    END;

    INSERT INTO libros (titulo, autor, genero, anio_publicacion)
    VALUES (p_titulo, p_autor, p_genero, p_anio_publicacion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EditarLibro` (IN `p_libro_id` INT, IN `p_titulo` VARCHAR(255), IN `p_autor` VARCHAR(100), IN `p_genero` VARCHAR(100), IN `p_anio_publicacion` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error al editar el libro: No se pudo realizar la actualización.';
    END;

    UPDATE libros
    SET
        titulo = p_titulo,
        autor = p_autor,
        genero = p_genero,
        anio_publicacion = p_anio_publicacion
    WHERE
        id = p_libro_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarLibro` (IN `p_id` INT)   BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error al eliminar el libro: No se encontró el libro con el ID proporcionado.';
    END;

    -- Verificar si el libro existe antes de intentar eliminarlo
    IF (SELECT COUNT(*) FROM `libros` WHERE `id` = p_id) > 0 THEN
        -- El libro existe, proceder con la eliminación
        DELETE FROM `libros` WHERE `id` = p_id;
    ELSE
        -- El libro no existe, generar una excepción
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error al eliminar el libro: No se encontró el libro con el ID proporcionado.';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `anio_publicacion` int(4) DEFAULT NULL,
  `estado` enum('Leyendo','Por leer','Leido') DEFAULT 'Leyendo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `genero`, `anio_publicacion`, `estado`) VALUES
(12, 'Hush Hush', 'Becca Fitzpatrick', 'Romance', 2009, 'Leido'),
(14, 'Nerve', 'Jeanne Ryan.', 'techno-thriller', 2016, 'Leyendo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$EzqfaTATg4Phf3CxzGF.1uulkGA3qQcw/pU5J6Z8liCtePLMJxE8G');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
