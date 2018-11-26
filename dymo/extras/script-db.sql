/*
 S=Sintaxis
 C=Constraints
 P=PhpMyAdmin

  #  |  TABLA                   | SCP
---------------------------------------
  1  |  Administrador           | √√√
  2  |  Administrador_Permiso   | √√√
  3  |  Permiso                 | √√√
  4  |  Vendedor_Permiso        | √√√
  5  |  Vendedor                | √√√
  6  |  Zona                    | √√√
  7  |  Cliente                 | √√√
  8  |  Empresa                 | √√√
  9  |  Direccion               | √√√
  10 |  Comentario              | √√√
  11 |  Medida                  | √√√
  12 |  Unidades                | √√√
  13 |  Contacto                | √√√
  14 |  Pedido                  | √√√
  15 |  Pedido_Producto         | √√√
  16 |  EvaluacionServicio      | √√√
  17 |  Servicio_Pregunta       | √√√
  18 |  Pregunta                | √√√
  19 |  Web_Pregunta            | √√√
  20 |  EvaluacionWeb           | √√√
-----|--------------------------|------
  21 |  Producto                | √√√
  22 |  Aguja                   | √√√
  23 |  Aplicador               | √√√
  24 |  AtaCable                | √√√
  25 |  Etiqueta                | √√√
  26 |  Etiquetadora            | √√√
  27 |  Impresora               | √√√
  28 |  Ribbon                  | √√√
  29 |  Rodillo                 | √√√
  30 |  Sujetador               | √√√
  31 |  Tinta                   | √√√
  32 |  Proveedor               | √√√
---------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

drop table  if exists Administrador;
drop table  if exists Administrador_Permiso;
drop table  if exists Permiso;
drop table  if exists Vendedor_Permiso;
drop table  if exists Vendedor;
drop table  if exists Zona;
drop table  if exists Cliente;
drop table  if exists Empresa;
drop table  if exists Direccion;
drop table  if exists Comentario;
drop table  if exists Medida;
drop table  if exists Unidades;
drop table  if exists Contacto;
drop table  if exists Pedido;
drop table  if exists Pedido_Producto;
drop table  if exists EvaluacionServicio;
drop table  if exists Servicio_Pregunta;
drop table  if exists Pregunta;
drop table  if exists Web_Pregunta;
drop table  if exists EvaluacionWeb;
drop table  if exists Producto;
drop table  if exists Aguja;
drop table  if exists Aplicador;
drop table  if exists AtaCable;
drop table  if exists Etiqueta;
drop table  if exists Etiquetadora;
drop table  if exists Impresora;
drop table  if exists Ribbon;
drop table  if exists Rodillo;
drop table  if exists Sujetador;
drop table  if exists Tinta;
drop table  if exists Proveedor;

SET FOREIGN_KEY_CHECKS = 1;
*/

DROP DATABASE IF EXISTS `u221062269_dymo`;
CREATE DATABASE IF NOT EXISTS u221062269_dymo;
USE `u221062269_dymo`;


/*
--
-- Estructura de tabla para la tabla `Administrador`
--
*/

CREATE TABLE `Administrador` (
  `id` 				  INT 		                             ,
  `nombre` 		  VARCHAR(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoP`   VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoM`   VARCHAR(30) COLLATE latin1_spanish_ci,
  `usuario` 	  VARCHAR(15) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena`  VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Administrador`
--
*/

INSERT INTO `Administrador` (`id`, `nombre`, `apellidoP`, `apellidoM`, `usuario`, `contrasena`) VALUES
(01, 'Jesús Emmanuel',  'Zetina',     'Chevez',   'ZCJO151861A', 'contraseña' ),
(02, 'Juan Carlos',     'Gerónimo',   'Padilla',  'GPJO151861A', 'admin'      ),
(03, 'Luis Fernando',   'Gerónimo',   'Carranza', 'GCLO151861A', 'admin'      ),
(04, 'Josué Eduardo',   'Rodríguez',  'Perez',    'RPJO15934A',  'admin'      ),
(05, 'Jesús Adrián',    'Ocampo',     'Salinas',  'OSJO159493A', 'admin'      );




/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Administrador_Permiso`
--
*/

CREATE TABLE `Administrador_Permiso` (
  `administradorID`   INT NOT NULL,
  `permisoID`         INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `AtaCable`
--
*/

CREATE TABLE `AtaCable` (
  `codigo`   VARCHAR(24) COLLATE latin1_spanish_ci,
  `medida`   INT,
  `color`    VARCHAR(24) COLLATE latin1_spanish_ci,
  `modelo`   VARCHAR(12) COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Aguja`
--
*/

CREATE TABLE `Aguja` (
  `codigo`    VARCHAR(24) COLLATE latin1_spanish_ci,
  `tipo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `material`  VARCHAR(24) COLLATE latin1_spanish_ci,
  `generico`  BIT(1)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Aplicador`
--
*/

CREATE TABLE `Aplicador` (
  `codigo`    VARCHAR(24) COLLATE latin1_spanish_ci,
  `modelo`    VARCHAR(12) COLLATE latin1_spanish_ci,
  `tipo`      VARCHAR(24) COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Cliente`
--
*/

CREATE TABLE `Cliente` (
  `id`          INT                                  ,
  `nombre`      VARCHAR(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoP`   VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoM`   VARCHAR(30) COLLATE latin1_spanish_ci,
  `telefono`    VARCHAR(24) COLLATE latin1_spanish_ci NOT NULL,
  `correo`      VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena`  VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `empresaID`   INT                                   NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Cliente`
--
*/

INSERT INTO `Cliente` (`id`, `nombre`, `apellidoP`, `apellidoM`, `telefono`, `correo`, `contrasena`, `empresaID`) VALUES
(01, 'Luis Fernando', 'Gerónimo', 'Carranza', '7777654321', 'gclo@u', 'contra', 01),
(02, 'Jesús Emmanuel', 'Zetina', 'Chevez', '7771234567', 'zcjo151173@upemor.edu.mx', 'contraseña', 02),
(03, 'Josué Eduardo', 'Rodríguez', 'Perez', '7771234567', 'rpjo15934@upemor.edu.mx', 'contraseña', 03),
(04, 'Jesús Adían', 'Ocampo', 'Salinas', '7771234567', 'osjo159493@upemor.edu.mx', 'contraseña', 04),
(05, 'Axel', 'Martínez', '', '7771234567', 'axel15993@upemor.edu.mx', 'contraseña', 05);




/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/
/*
--
-- Estructura de tabla para la tabla `Comentario`
--
*/

CREATE TABLE `Comentario` (
  `id`          INT                                             ,
  `comentario`  VARCHAR(600)  COLLATE latin1_spanish_ci NOT NULL,
  `fecha`       DATE                                    NOT NULL,
  `autor`       VARCHAR(105)  COLLATE latin1_spanish_ci NOT NULL,
  `pedidoID`    INT                                     NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Comentario`
--
*/



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Contacto`
--
*/

CREATE TABLE `Contacto` (
  `id`          INT                                    ,
  `nombre`      VARCHAR(45)   COLLATE latin1_spanish_ci NOT NULL,
  `empresa`     VARCHAR(100)  COLLATE latin1_spanish_ci NOT NULL,
  `correo`      VARCHAR(64)   COLLATE latin1_spanish_ci NOT NULL,
  `telefono`    VARCHAR(24)   COLLATE latin1_spanish_ci NOT NULL,
  `comentario`  VARCHAR(600)  COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------


--
-- Estructura de tabla para la tabla `Direccion`
--
*/

CREATE TABLE `Direccion` (
  `id`          INT                                    ,
  `numeroExt`   INT                                     NOT NULL,
  `numeroInt`   INT                                    ,
  `calle`       VARCHAR(32)   COLLATE latin1_spanish_ci NOT NULL,
  `colonia`     VARCHAR(32)   COLLATE latin1_spanish_ci NOT NULL,
  `cp`          INT                                     NOT NULL,
  `municipio`   VARCHAR(32)   COLLATE latin1_spanish_ci NOT NULL,
  `estado`      VARCHAR(32)   COLLATE latin1_spanish_ci NOT NULL,
  `empresaID`   INT                                     NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Direccion`
--
*/

/*
INSERT INTO `Direccion` (`id`, `numeroExt`, `numeroInt`, `calle`, `colonia`, `cp`, `municipio`, `estado`, `empresaID`) VALUES
(),
();
*/



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------


--
-- Estructura de tabla para la tabla `Empresa`
--
*/

CREATE TABLE `Empresa` (
  `id`          INT                                             ,
  `nombre`      VARCHAR(100)  COLLATE latin1_spanish_ci NOT NULL,
  `telefono`    VARCHAR(24)   COLLATE latin1_spanish_ci NOT NULL,
  `correo`      VARCHAR(64)   COLLATE latin1_spanish_ci NOT NULL,
  `zonaID`      INT                                     
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Empresa`
--
*/

INSERT INTO `Empresa` (`id`, `nombre`, `telefono`, `correo`, `zonaID`) VALUES
(1, 'DymoCliente_1', '7771234567', 'dymoCliente1@dymosa.com', 1),
(2, 'DymoCliente_2', '7777654321', 'dymoCliente2@dymosa.com', 2),
(3, 'DymoCliente_3', '7777654321', 'dymoCliente2@dymosa.com', 3),
(4, 'DymoCliente_4', '7777654321', 'dymoCliente2@dymosa.com', 4),
(5, 'DymoCliente_5', '7777654321', 'dymoCliente2@dymosa.com', 5);





/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Etiquetadora`
--
*/

CREATE TABLE `Etiqueta`(
  `codigo`        VARCHAR(24) COLLATE latin1_spanish_ci,
  `color`         VARCHAR(32) COLLATE latin1_spanish_ci,
  `tipo`          VARCHAR(32) COLLATE latin1_spanish_ci,
  `marcaSensora`  BIT(1)                               ,
  `medida`        INT        
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Etiquetadora`
--
*/

CREATE TABLE `Etiquetadora`(
  `codigo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `digitos`     INT        ,
  `modelo`      VARCHAR(12) COLLATE latin1_spanish_ci,
  `variante`    VARCHAR(24) COLLATE latin1_spanish_ci,
  `medida`      INT        
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `EvaluacionServicio`
--
*/

CREATE TABLE `EvaluacionServicio`(
  `id`        INT          ,
  `fecha`     DATE NOT NULL,
  `pedidoID`  INT  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `EvaluacionWeb`
--
*/

CREATE TABLE `EvaluacionWeb`(
  `id`        INT          ,
  `fecha`     DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Impresora`
--
*/

CREATE TABLE `Impresora`(
  `codigo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `tipo`        VARCHAR(32) COLLATE latin1_spanish_ci,
  `modelo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `dpi`         INT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Medida`
--
*/

CREATE TABLE `Medida`(
  `id`            INT           ,
  `ancho`         FLOAT NOT NULL,
  `largo`         FLOAT NOT NULL,
  `unidadesID`    INT   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Medida`
--
*/

INSERT INTO `Medida` (`id`, `ancho`, `largo`, `unidadesID`) VALUES
(1, 38, 300, 1),
(2, 38, 360, 1);




/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Pedido`
--
*/

CREATE TABLE `Pedido` (
  `id`            INT           ,
  `fechaPedido`   DATE  NOT NULL,
  `fechaEntrega`  DATE          ,
  `estado`        INT   NOT NULL,
  /*`costo`         FLOAT NOT NULL,  *//* Float */
  `clienteID`     INT   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Pedido`
--
*/

INSERT INTO `Pedido` (`id`, `fechaPedido`, `fechaEntrega`, `estado`, /*`costo`,*/ `clienteID`) VALUES
(01, '2018-11-11', null,         1, 1),

(02, '2018-11-06', '2018-11-16', 7,  2),
(03, '2018-11-08', null,         3,     2),

(04, '2018-11-09', null,         4,     3),
(05, '2018-11-01', '2018-11-05', 7,  3),

(06, '2018-11-01', '2018-11-02', 7,  4),

(07, '2018-11-09', null,         5,  5),
(08, '2018-11-09', null,         6,  5),
(09, '2018-11-09', null,         2, 5);



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Pedido_Producto`
--
*/

CREATE TABLE `Pedido_Producto` (
  `pedidoID`        INT,
  `productoCodigo`  VARCHAR(24)   COLLATE latin1_spanish_ci         ,
  `cantidad`        INT                                     NOT NULL,
  `detalles`        VARCHAR(600)  COLLATE latin1_spanish_ci         ,
  `costo`           FLOAT                                   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Pedido_Producto`
--
*/

INSERT INTO `Pedido_Producto` (`pedidoID`, `productoCodigo`, `cantidad`, `detalles`, `costo`) VALUES
(01, 'RI38X300MCP', 200, "Buen día, necesito 200 ribbon's de este tipo, por favor. Gracias. ",  2053.53),
(02, 'RI38X300RAP', 200, "Buen día, necesito 200 ribbon's de este tipo, por favor. Gracias. ",  5643.75),
(03, 'RI38X300RCI', 900, "Buen día, necesito 900 ribbon's de este tipo, por favor. Gracias. ",  45645.87),
(04, 'RI38X300RCP', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  8000.80),
(05, 'RI38X300RBS', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  5792.80),
(06, 'RI38X300FBE', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  6456.80),
(07, 'RI38X300RGI', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  1234.80),
(08, 'RI38X300RGP', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  4567.80),
(09, 'RI38X360FAD', 350, "Buen día, necesito 350 ribbon's de este tipo, por favor. Gracias. ",  6788.97);


/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Permiso`
--
*/

CREATE TABLE `Permiso` (
  `id`          INT                                           ,
  `permiso`     VARCHAR(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Pregunta`
--
*/

CREATE TABLE `Pregunta`(
  `id`        INT                                           ,
  `pregunta`  VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `tipo`      VARCHAR(24) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Producto`
--
*/

CREATE TABLE `Producto` (
  `codigo`          VARCHAR(24)   COLLATE latin1_spanish_ci           ,
  `nombre`          VARCHAR(32)   COLLATE latin1_spanish_ci   NOT NULL,
  `marca`           VARCHAR(24)   COLLATE latin1_spanish_ci           ,
  `descripcion`     VARCHAR(256)  COLLATE latin1_spanish_ci           ,
  `costo`           FLOAT                 ,
  `unidadDePedido`  VARCHAR(12)   COLLATE latin1_spanish_ci           ,
  `proveedorID`       INT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Producto`
--
*/

INSERT INTO `Producto` (`codigo`, `nombre`, `marca`, `descripcion`, `costo`, `unidadDePedido`, `proveedorID`) VALUES
('RI38X300MCP', 'Ribbon 1', 'Marca01', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RAP', 'Ribbon 2', 'Marca02', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RCI', 'Ribbon 3', 'Marca03', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RCP', 'Ribbon 4', 'Marca04', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RBS', 'Ribbon 5', 'Marca05', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300FBE', 'Ribbon 6', 'Marca06', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RGI', 'Ribbon 7', 'Marca07', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X300RGP', 'Ribbon 8', 'Marca08', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1),
('RI38X360FAD', 'Ribbon 9', 'Marca09', 'Rbbbon textil de color [color] para...', 367.50, 'Unidad', 1);

/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Proveedor`
--
*/

CREATE TABLE `Proveedor` (
  `id`      INT                   ,
  `nombre`  VARCHAR(100) COLLATE latin1_spanish_ci  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Proveedor`
--
*/

INSERT INTO `Proveedor` (`id`, `nombre`) VALUES
('1', 'García');


/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Ribbon`
--
*/

CREATE TABLE `Ribbon`(
  `codigo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `material`    VARCHAR(24) COLLATE latin1_spanish_ci NOT NULL,
  `medida`      INT NOT NULL,
  `in`          INT NOT NULL,
  `maquina`     VARCHAR(32) COLLATE latin1_spanish_ci NOT NULL,
  `letras`      VARCHAR(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Ribbon`
--
*/

INSERT INTO `Ribbon` (`codigo`, `material`, `medida`, `in`, `maquina`, `letras`) VALUES
('RI38X300MCP', 'cera', 1, 1, 'Eltron', 'Letras1'),
('RI38X300RAP', 'resina/cera', 1, 1, 'Datacard', 'Letras1'),
('RI38X300RCI', 'resina', 1, 1, 'Datamax', 'Letras1'),
('RI38X300RCP', 'cera GP', 1, 1, 'Zebra', 'Letras1'),
('RI38X300RBS', 'resina TR', 1, 1, 'Zebra TLP', 'Letras1'),
('RI38X300FBE', 'resina TP', 1, 1, 'Zebra Original', 'Letras1'),
('RI38X300RGI', 'resina textil', 1, 1, 'Toshiba', 'Letras1'),
('RI38X300RGP', 'cera', 1, 1, 'Eltron', 'Letras1'),
('RI38X360FAD', 'resina', 2, 1, 'Datamax', 'Letras1');


/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Rodillo`
--
*/

CREATE TABLE `Rodillo`(
  `codigo`      VARCHAR(24) COLLATE latin1_spanish_ci,
  `color`       VARCHAR(24) COLLATE latin1_spanish_ci,
  `modelo`      VARCHAR(12) COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Servicio_Pregunta`
--
*/

CREATE TABLE `Servicio_Pregunta`(
  `servicioID`  INT NOT NULL,
  `preguntaID`  INT NOT NULL,
  `respuesta`   INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Sujetador`
--
*/

CREATE TABLE `Sujetador`(
  `codigo`  VARCHAR(24) COLLATE latin1_spanish_ci,
  `tipo`    VARCHAR(32) COLLATE latin1_spanish_ci,
  `genero`  BIT(1)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Tinta`
--
*/

CREATE TABLE `Tinta`(
  `codigo`  VARCHAR(24) COLLATE latin1_spanish_ci,
  `color`   VARCHAR(36) COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Unidades`
--
*/

CREATE TABLE `Unidades`(
  `id`              INT                 ,
  `unidadAncho`     VARCHAR(4) COLLATE latin1_spanish_ci  NOT NULL,
  `unidadLargo`     VARCHAR(4) COLLATE latin1_spanish_ci  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
--
-- Volcado de datos para la tabla `Unidades`
--
*/

INSERT INTO `Unidades` (`id`, `unidadAncho`, `unidadLargo`) VALUES
(1, 'mm', 'm');



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Vendedor_Permiso`
--
*/

CREATE TABLE `Vendedor_Permiso` (
  `vendedorID`    INT NOT NULL,
  `permisoID`     INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Vendedor`
--
*/

CREATE TABLE `Vendedor` (
  `id`          INT                                  ,
  `nombre`      VARCHAR(45) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoP`   VARCHAR(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellidoM`   VARCHAR(30) COLLATE latin1_spanish_ci,
  `usuario`     VARCHAR(15) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena`  VARCHAR(64) COLLATE latin1_spanish_ci NOT NULL,
  `zonaID`      INT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Administrador`
--
*/

INSERT INTO `Vendedor` (`id`, `nombre`, `apellidoP`, `apellidoM`, `usuario`, `contrasena`, `zonaID`) VALUES
(01, 'Jesús Emmanuel',  'Zetina',    'Chevez',   'ZCJO151861V',  'contraseña', 1),
(02, 'Juan Carlos',     'Gerónimo',  'Padilla',  'GPJO151861V',  'admin',      2),
(03, 'Luis Fernando',   'Gerónimo',  'Carranza', 'GCLO151861V',  'admin',      3),
(04, 'Josué Eduardo',   'Rodríguez', 'Perez',    'RPJO15934V',   'admin',      4),
(05, 'Jesús Adrián',    'Ocampo',    'Salinas',  'OSJO159493V',  'admin',      5);




/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Web_Pregunta`
--
*/

CREATE TABLE `Web_Pregunta`(
  `webID`       INT NOT NULL,
  `preguntaID`  INT NOT NULL,
  `respuesta`   INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/

/*
--
-- Estructura de tabla para la tabla `Zona`
--
*/

CREATE TABLE `Zona` (
  `id`    INT                                           ,
  `zona`  VARCHAR(32) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*
--
-- Volcado de datos para la tabla `Zona`
--
*/

INSERT INTO `Zona` (`id`, `zona`) VALUES
(1, 'Noroeste'),
(2, 'Noreste'),
(3, 'Suroeste'),
(4, 'Sureste'),
(5, 'Centro');




/*
----------------------------------------------------------
----------------------------------------------------------
----------------------------------------------------------
*/




















/*
--
-- Índices para tablas volcadas
--
*/

/*
--
-- Indices de la tabla `Administrador`
--
*/

ALTER TABLE `Administrador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);



/*
--
-- Indices de la tabla `Aguja`
--
*/

ALTER TABLE `Aguja`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Aplicador`
--
*/

ALTER TABLE `Aplicador`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `AtaCable`
--
*/

ALTER TABLE `AtaCable`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Cliente`
--
*/

ALTER TABLE `Cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);



/*
--
-- Indices de la tabla `Contacto`
--
*/

ALTER TABLE `Contacto`
  ADD PRIMARY KEY (`id`);


/*
--
-- Indices de la tabla `Comentario`
--
*/

ALTER TABLE `Comentario`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Direccion`
--
*/

ALTER TABLE `Direccion`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Empresa`
--
*/

ALTER TABLE `Empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);



/*
--
-- Indices de la tabla `Etiqueta`
--
*/

ALTER TABLE `Etiqueta`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Etiquetadora`
--
*/

ALTER TABLE `Etiquetadora`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `EvaluacionServicio`
--
*/

ALTER TABLE `EvaluacionServicio`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `EvaluacionWeb`
--
*/

ALTER TABLE `EvaluacionWeb`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Impresora`
--
*/

ALTER TABLE `Impresora`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Medida`
--
*/

ALTER TABLE `Medida`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Pedido`
--
*/

ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Pedido_Producto`
--
*/

ALTER TABLE `Pedido_Producto`
  ADD PRIMARY KEY (`pedidoID`, `productoCodigo`);



/*
--
-- Indices de la tabla `Permiso`
--
*/

ALTER TABLE `Permiso`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Pregunta`
--
*/

ALTER TABLE `Pregunta`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Producto`
--
*/

ALTER TABLE `Producto`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Proveedor`
--
*/

ALTER TABLE `Proveedor`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Ribbon`
--
*/

ALTER TABLE `Ribbon`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Rodillo`
--
*/

ALTER TABLE `Rodillo`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Sujetador`
--
*/

ALTER TABLE `Sujetador`
  ADD PRIMARY KEY (`codigo`);



/*
--
-- Indices de la tabla `Tinta`
--
*/

ALTER TABLE `Tinta`
  ADD PRIMARY KEY (`codigo`);




/*
--
-- Indices de la tabla `Unidades`
--
*/

ALTER TABLE `Unidades`
  ADD PRIMARY KEY (`id`);



/*
--
-- Indices de la tabla `Vendedor`
--
*/

ALTER TABLE `Vendedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);



/*
--
-- Indices de la tabla `Zona`
--
*/

ALTER TABLE `Zona`
  ADD PRIMARY KEY (`id`);





















/*
--
-- AUTO_INCREMENT de las tablas volcadas
--
*/



/*
--
-- AUTO_INCREMENT de la tabla `Administrador`
--
*/

ALTER TABLE `Administrador`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Cliente`
--
*/

ALTER TABLE `Cliente`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Comentario`
--
*/

ALTER TABLE `Comentario`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Contacto`
--
*/

ALTER TABLE `Contacto`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Direccion`
--
*/

ALTER TABLE `Direccion`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Empresa`
--
*/

ALTER TABLE `Empresa`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `EvaluacionServicio`
--
*/

ALTER TABLE `EvaluacionServicio`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `EvaluacionWeb`
--
*/

ALTER TABLE `EvaluacionWeb`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Medida`
--
*/

ALTER TABLE `Medida`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Pedido`
--
*/

ALTER TABLE `Pedido`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Permiso`
--
*/

ALTER TABLE `Permiso`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Pregunta`
--
*/

ALTER TABLE `Pregunta`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Proveedor`
--
*/

ALTER TABLE `Proveedor`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;;



/*
--
-- AUTO_INCREMENT de la tabla `Unidades`
--
*/

ALTER TABLE `Unidades`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Vendedor`
--
*/

ALTER TABLE `Vendedor`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;



/*
--
-- AUTO_INCREMENT de la tabla `Zona`
--
*/

ALTER TABLE `Zona`
  MODIFY `id` INT NOT NULL AUTO_INCREMENT;


























/*
--
-- Restricciones para tablas volcadas
--
*/



/*
--
-- Filtros para la tabla `Administrador_Permiso`
-- 
*/
ALTER TABLE `Administrador_Permiso`
  ADD CONSTRAINT `Administrador_Permiso_administradorID_fk1` FOREIGN KEY (`administradorID`) REFERENCES `Administrador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Administrador_Permiso_permisoID_fk2` FOREIGN KEY (`permisoID`) REFERENCES `Permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Aguja`
-- 
*/
ALTER TABLE `Aguja`
  ADD CONSTRAINT `Aguja_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `AtaCable`
-- 
*/
ALTER TABLE `AtaCable`
  ADD CONSTRAINT `AtaCable_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AtaCable_medida_fk2` FOREIGN KEY (`medida`) REFERENCES `Medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Aplicador`
-- 
*/
ALTER TABLE `Aplicador`
  ADD CONSTRAINT `Aplicador_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Cliente`
-- 
*/
ALTER TABLE `Cliente`
  ADD CONSTRAINT `Cliente_empresaID_fk1` FOREIGN KEY (`empresaID`) REFERENCES `Empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Comentario`
-- 
*/
ALTER TABLE `Comentario`
  ADD CONSTRAINT `Comentario_pedidoID_fk1` FOREIGN KEY (`pedidoID`) REFERENCES `Pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Direccion`
-- 
*/
ALTER TABLE `Direccion`
  ADD CONSTRAINT `Direccion_empresaID_fk1` FOREIGN KEY (`empresaID`) REFERENCES `Empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Empresa`
-- 
*/
ALTER TABLE `Empresa`
  ADD CONSTRAINT `Empresa_zonaID_fk1` FOREIGN KEY (`zonaID`) REFERENCES `Zona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Etiqueta`
-- 
*/
ALTER TABLE `Etiqueta`
  ADD CONSTRAINT `Etiqueta_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Etiqueta_medida_fk2` FOREIGN KEY (`medida`) REFERENCES `Medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Etiquetadora`
-- 
*/
ALTER TABLE `Etiquetadora`
  ADD CONSTRAINT `Etiquetadora_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Etiquetadora_medida_fk2` FOREIGN KEY (`medida`) REFERENCES `Medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `EvaluacionServicio`
-- 
*/
ALTER TABLE `EvaluacionServicio`
  ADD CONSTRAINT `EvaluacionServicio_pedidoID_fk1` FOREIGN KEY (`pedidoID`) REFERENCES `Pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Impresora`
-- 
*/
ALTER TABLE `Impresora`
  ADD CONSTRAINT `Impresora_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Medida`
-- 
*/
ALTER TABLE `Medida`
  ADD CONSTRAINT `Medida_unidadesID_fk1` FOREIGN KEY (`unidadesID`) REFERENCES `Unidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Pedido`
-- 
*/
ALTER TABLE `Pedido`
  ADD CONSTRAINT `Pedido_clienteID_fk1` FOREIGN KEY (`clienteID`) REFERENCES `Cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Pedido_Producto`
-- 
*/
ALTER TABLE `Pedido_Producto`
  ADD CONSTRAINT `Pedido_Producto_pedidoID_fk1` FOREIGN KEY (`pedidoID`) REFERENCES `Pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pedido_Producto_codigo_fk2` FOREIGN KEY (`productoCodigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Producto`
-- 
*/
ALTER TABLE `Producto`
  ADD CONSTRAINT `Producto_proveedorID_fk1` FOREIGN KEY (`proveedorID`) REFERENCES `Proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Ribbon`
-- 
*/
ALTER TABLE `Ribbon`
  ADD CONSTRAINT `Ribbon_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ribbon_medida_fk2` FOREIGN KEY (`medida`) REFERENCES `Medida` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Rodillo`
-- 
*/
ALTER TABLE `Rodillo`
  ADD CONSTRAINT `Rodillo_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Servicio_Pregunta`
-- 
*/
ALTER TABLE `Servicio_Pregunta`
  ADD CONSTRAINT `Servicio_Pregunta_servicioID_fk1` FOREIGN KEY (`servicioID`) REFERENCES `EvaluacionServicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Servicio_Pregunta_preguntaID_fk2` FOREIGN KEY (`preguntaID`) REFERENCES `Pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Sujetador`
-- 
*/
ALTER TABLE `Sujetador`
  ADD CONSTRAINT `Sujetador_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Tinta`
-- 
*/
ALTER TABLE `Tinta`
  ADD CONSTRAINT `Tinta_codigo_fk1` FOREIGN KEY (`codigo`) REFERENCES `Producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Vendedor`
-- 
*/
ALTER TABLE `Vendedor`
  ADD CONSTRAINT `Vendedor_zonaID_fk1` FOREIGN KEY (`zonaID`) REFERENCES `Zona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Vendedor_Permiso`
-- 
*/
ALTER TABLE `Vendedor_Permiso`
  ADD CONSTRAINT `Vendedor_Permiso_vendedorID_fk1` FOREIGN KEY (`vendedorID`) REFERENCES `Vendedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Vendedor_Permiso_permisoID_fk2` FOREIGN KEY (`permisoID`) REFERENCES `Permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



/*
--
-- Filtros para la tabla `Web_Pregunta`
-- 
*/
ALTER TABLE `Web_Pregunta`
  ADD CONSTRAINT `Web_Pregunta_webID_fk1` FOREIGN KEY (`webID`) REFERENCES `EvaluacionWeb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Web_Pregunta_preguntaID_fk2` FOREIGN KEY (`preguntaID`) REFERENCES `Pregunta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;






DROP VIEW IF EXISTS `ListarClientesView`;

CREATE VIEW `ListarClientesView` AS (
    SELECT  `Zona`.`id`                                             AS `id`, 

            `Empresa`.`id`                                          AS `empresaID`, 
            `Empresa`.`nombre`                                      AS `empresa`,

            `Cliente`.`id`                                          AS `clienteID`,
            CONCAT(`Cliente`.`nombre`, ' ', `Cliente`.`apellidoP`)  AS `nombres`,
            `Cliente`.`correo`                                      AS `correo`

    FROM `Cliente` 
    JOIN `Empresa`   ON `Empresa`.`id`  = `Cliente`.`empresaID`
    LEFT JOIN `Zona` ON `Zona`.`id`     = `Empresa`.`zonaID`
);


DROP VIEW IF EXISTS `ListarPedidosView`;


CREATE VIEW `ListarPedidosView` AS (
    SELECT  `Empresa`.`id`                                         AS `empresaID`, 
            `Empresa`.`nombre`                                     AS `empresa`, 
            `Empresa`.`telefono`                                   AS `telefono`,

            `Cliente`.`id`                                         AS `clienteID`, 
            CONCAT(`Cliente`.`nombre`, ' ', `Cliente`.`apellidoP`) AS `nombres`,

            `Pedido`.`id`                                          AS `id`, 
            `Pedido`.`fechaPedido`                                 AS `fecha-de-pedido`, 
            `Pedido`.`fechaEntrega`                                AS `fecha-de-entrega`, 
            `Pedido`.`estado`                                      AS `estado`,

            `Pedido_Producto`.`cantidad`                           AS `cantidad`, 
            `Pedido_Producto`.`costo`                              AS `costo`,

            `Producto`.`codigo`                                    AS `producto`

    FROM `Empresa` 
    JOIN `Cliente`          ON `Empresa`.`id`                     = `Cliente`.`empresaID`
    JOIN `Pedido`           ON `Cliente`.`id`                     = `Pedido`.`clienteID`
    JOIN `Pedido_Producto`  ON `Pedido`.`id`                      = `Pedido_Producto`.`pedidoID`
    JOIN `Producto`         ON `Pedido_Producto`.`productoCodigo` = `Producto`.`codigo`
);


DROP VIEW IF EXISTS `PedidosView`;

CREATE VIEW `PedidosView` AS (
    SELECT  `Pedido`.`id`                            AS `id`,
            `Pedido`.`fechaPedido`                   AS `fecha-de-pedido`,
            `Pedido`.`fechaEntrega`                  AS `fecha-de-entrega`,
            `Pedido`.`estado`                        AS `estado`,
            `Pedido`.`clienteID`                     AS `clienteID`,
            `Pedido_Producto`.`pedidoID`             AS `pedidoID`,
            `Pedido_Producto`.`productoCodigo`       AS `producto`,
            `Pedido_Producto`.`cantidad`             AS `cantidad`,
            `Pedido_Producto`.`costo`                AS `costo`,
            `Pedido_Producto`.`detalles`             AS `detalles`

    FROM `Pedido`
    INNER JOIN `Pedido_Producto` ON `Pedido`.`id` = `Pedido_Producto`.`pedidoID`
);


DROP VIEW IF EXISTS `RibbonView`;

CREATE VIEW `RibbonView` AS
  SELECT 
        `Producto`.`codigo`,
        `Producto`.`nombre`,
        `Producto`.`marca`,
        `Producto`.`descripcion`,
        `Producto`.`costo`,
        `Producto`.`unidadDePedido`,
        `Ribbon`.`material`,
        `Ribbon`.`in`,
        `Ribbon`.`maquina`,
        `Ribbon`.`letras`,
        CONCAT(`Medida`.`ancho`, `Unidades`.`unidadAncho`, 'x', `Medida`.`largo`, `Unidades`.`unidadLargo`) AS `medidas`,
        `Medida`.`ancho`,
        `Unidades`.`unidadAncho`,
        `Medida`.`largo`,
        `Unidades`.`unidadLargo`

  FROM `Producto` 
      LEFT JOIN `Ribbon` ON `Producto`.`codigo` = `Ribbon`.`codigo`
      JOIN `Medida` ON `Medida`.`id` = `Ribbon`.`medida`
      JOIN `Unidades` ON `Unidades`.`id` = `Medida`.`unidadesID`;


/*

  UNION ALL 

  SELECT 
        `Producto`.`codigo`,
        `Producto`.`nombre`,
        `Producto`.`marca`,
        `Producto`.`descripcion`,
        `Producto`.`costo`,
        `Producto`.`unidadDePedido`,
        `Ribbon`.`material`,
        `Ribbon`.`in`,
        `Ribbon`.`maquina`,
        `Ribbon`.`letras`,
        CONCAT(`Medida`.`ancho`, `Unidades`.`unidadAncho`, 'x', `Medida`.`largo`, `Unidades`.`unidadLargo`) AS `medidas`,
        `Medida`.`ancho`,
        `Unidades`.`unidadAncho`,
        `Medida`.`largo`,
        `Unidades`.`unidadLargo`

  FROM `Producto` 
      RIGHT JOIN `Ribbon` ON `Producto`.`codigo` = `Ribbon`.`codigo`
      JOIN `Medida` ON `Medida`.`id` = `Ribbon`.`medida`
      JOIN `Unidades` ON `Unidades`.`id` = `Medida`.`unidadesID`;
*/