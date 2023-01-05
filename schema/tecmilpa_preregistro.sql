-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-02-2021 a las 22:15:26
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecmilpa_preregistro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `paterno_usuario` varchar(45) NOT NULL,
  `materno_usuario` varchar(45) NOT NULL,
  `fecha_nacimiento_usuario` date NOT NULL,
  `telefono_usuario` varchar(45) NOT NULL,
  `carrera_usuario` varchar(45) DEFAULT NULL,
  `mail_usuario` varchar(45) NOT NULL,
  `password_usuario` varchar(45) NOT NULL,
  `subio_archivos` int(11) NOT NULL DEFAULT '0',
  `dda_autorizo` int(11) NOT NULL DEFAULT '0',
  `rf_autorizo` int(11) NOT NULL DEFAULT '0',
  `habilitar_examen` int(11) NOT NULL DEFAULT '0',
  `calificacion_usuario` int(11) NOT NULL DEFAULT '0',
  `rol` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `paterno_usuario`, `materno_usuario`, `fecha_nacimiento_usuario`, `telefono_usuario`, `carrera_usuario`, `mail_usuario`, `password_usuario`, `subio_archivos`, `dda_autorizo`, `rf_autorizo`, `habilitar_examen`, `calificacion_usuario`, `rol`) VALUES
(7, 'regina', 'cruz', 'jimenez', '1999-11-11', '5577655927', '', 'dda_milpaalta2@tecnm.mx', 'regina2021', 0, 0, 0, 0, 0, 1),
(8, 'Nely', 'Canedo', 'Alvarado', '1999-11-11', '5577655927', '', 'rf_milpaalta2@tecnm.mx', 'nelly89', 0, 0, 0, 0, 0, 1),
(182, 'JUAN GABRIEL', 'MARTINEZ', 'ORELLANA', '1998-09-14', '1128833940', 'GES', 'gabrielpucheta53@gmail.com', 'J41435047g', 0, 0, 0, 0, 0, 0),
(183, 'JONATHAN', 'AMAYA', 'VELASCO', '1999-07-21', '5586090550', 'SIS', 'jonathanarenascasas@gmail.com', 'jonadr08', 0, 0, 0, 0, 0, 0),
(184, 'MARCOS', 'ROSAS CANO', 'ROSAS CANO', '2000-03-23', '5583880049', 'IND', 'rojasmarcusse@gmail.com', 'marcosrosasXD1', 1, 1, 1, 1, 0, 0),
(185, 'ANDREA NARENY', 'FLORES', 'PASCUAL', '1998-08-12', '5588249706', 'GES', 'andreanarenyflorespascual@gmail.com', 'Amolosgatos12', 0, 0, 0, 0, 0, 0),
(186, 'JESUS ALDAIR', 'RODRIGUEZ', 'FLORES', '2000-09-14', '5582312872', 'SIS', 'tiringon@hotmail.com', 'Aldair14.', 0, 0, 0, 0, 0, 0),
(187, 'JENNIFER', 'ESTRADA', 'MORALES', '2001-10-27', '5568670281', 'SIS', 'jennirm27@hotmail.com', 'kbGWmY3XVWK7qvX', 0, 0, 0, 0, 0, 0),
(188, 'BRAIAN', 'RENTERIA', 'GAONA', '2002-09-07', '5558620137', 'SIS', 'rentegao@gmail.com', 'azul_2017', 0, 0, 0, 0, 0, 0),
(189, 'DANIEL', 'TORRES', 'HERNANDEZ', '1991-11-18', '5531465936', 'SIS', 'sharlemdaniz7@gmail.com', 'slipknot2170', 0, 0, 0, 0, 0, 0),
(190, 'CINTIA VIOLETA', 'CABRERA', 'PENA', '2001-06-07', '5544937641', 'SIS', 'violeta0706cabrera@hotmail.com', 'estrellita325', 0, 0, 0, 0, 0, 0),
(191, 'JULIO CESAR', 'CARDENAS', 'VALENCIA', '1987-06-20', '5532380116', 'SIS', 'azkers@hotmail.com', 'Load2020', 0, 0, 0, 0, 0, 0),
(192, 'ADRIAN', 'GALICIA', 'OLVERA', '2002-02-03', '5558427579', 'SIS', 'adriangaliove123@gmail.com', 'gordo147', 1, 1, 1, 1, 0, 0),
(193, 'ANA KAREN', 'VEGA', 'BARRANCO', '1996-09-20', '5523324595', 'GES', 'zarita.vega1806@gmail.com', '2030', 0, 0, 0, 0, 0, 0),
(194, 'EDUARDO', 'RODRIGUEZ', 'ALFARO', '1988-09-28', '5540692060', 'SIS', 'EDUARDOTIENEHAMBRE_SOCIAL@HOTMAIL.COM', '111111ED', 0, 0, 0, 0, 0, 0),
(195, 'omar', 'perez', 'ramos', '1999-11-11', '5577655927', '', 'acad_milpaalta2@tecnm.mx', 'omar33', 0, 0, 0, 0, 0, 1),
(196, 'edgar', 'Padilla', 'Garcez', '1999-11-11', '5577655927', '', 'admon_milpaalta2@tecnm.mx', 'edgar71', 0, 0, 0, 0, 0, 1),
(197, 'ALEXANDRA', 'GONZALEZ', 'RAMIREZ', '2000-01-09', '5584204415', 'IND', 'gonzalezalexandra334@gmail.com', 'Rimbel35', 0, 0, 0, 0, 0, 0),
(198, 'ANGEL OMAR', 'CASTANEDA', 'MARTINEZ', '1999-03-01', '5532378778', 'GES', 'srfud54@hotmail.com', '58472649minato', 0, 0, 0, 0, 0, 0),
(199, 'DANTE', 'SALCEDO', 'ARIAS', '2001-08-07', '5565118262', 'SIS', 'dantesalcedo666@gmail.com', '5548733134des', 1, 1, 1, 1, 0, 0),
(200, 'JOSE ALBERTO', 'RODRIGUEZ', 'GARCIA', '1998-10-11', '5537454100', 'GES', 'albertheli55@gmail.com', 'alberth37.', 1, 1, 1, 1, 0, 0),
(201, 'MARIANA JAQUELINE', 'BOLLAS', 'PAREDES', '2001-08-30', '5539984702', 'GES', 'marianita.bollaskim@gmail.com', '1kaala23', 1, 1, 1, 1, 0, 0),
(202, 'JUAN ALBERTO', 'DE LA CRUZ', 'CRUZ', '1997-08-10', '5612994015', 'SIS', 'juan_18@live.com.mx', 'juan1018', 1, 1, 1, 1, 0, 0),
(203, 'ROGELIO', 'FLORES', 'HERNANDEZ', '2001-06-21', '5528307735', 'GES', 'rogelio21015@gmail.com', 'rogelioflores', 1, 1, 1, 1, 0, 0),
(204, 'EDUARDO', 'PEREZ', 'BAUTISTA', '2002-01-15', '5535108409', 'IND', 'ep884827@gmail.com', 'lalo150102', 1, 1, 1, 1, 0, 0),
(205, 'MIGUEL ANGEL', 'ESPINOSA', 'TORRALBA', '1987-10-17', '5579150837', 'IND', 'mespinosat1@gmail.com', 'cxT8GB4BmsbEct8', 1, 0, 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
