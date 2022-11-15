SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE DATABASE BancoDeSangre;
USE BancoDeSangre;

--
-- Estructura de tabla para la tabla `personas`
--
CREATE TABLE personas (
  id_persona int(11) NOT NULL,
  dni char(10) NOT NULL,
  nombres varchar(90) NOT NULL,
  apellidos varchar(90) NOT NULL,
  tipo_sangre varchar(90) NOT NULL,
  cantidad_donacion_ml int(11) NOT NULL,
  fecha_donacion date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indices de la tabla `personas`
--
ALTER TABLE personas
  ADD PRIMARY KEY (id_persona);

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE personas
  MODIFY id_persona int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO personas (dni,nombres,apellidos,tipo_sangre,cantidad_donacion_ml,fecha_donacion) 
  VALUES ('94319226','JUAN CARLOS','DIAZ','B+','500','2022-11-04');

INSERT INTO personas (dni,nombres,apellidos,tipo_sangre,cantidad_donacion_ml,fecha_donacion) 
  VALUES ('1144101360','ALEJANDRO','DIAZ','O+','600','2022-11-06');

