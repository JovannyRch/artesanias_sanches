-- Crear la base de datos
DROP DATABASE IF EXISTS pagos_escolares;
CREATE DATABASE IF NOT EXISTS pagos_escolares;
USE pagos_escolares;

-- Crear tabla USUARIOS
CREATE TABLE IF NOT EXISTS USUARIOS (
    IDUsuario VARCHAR(4) PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    ApellidoPaterno VARCHAR(255) NOT NULL,
    ApellidoMaterno VARCHAR(255),
    Edad INT,
    Sexo CHAR(1),
    Email VARCHAR(255) UNIQUE NOT NULL,
    TipoUsuario VARCHAR(50),
    Password VARCHAR(255) NOT NULL
);

-- Crear tabla PAGOS
CREATE TABLE IF NOT EXISTS PAGOS (
    FolioPago INT AUTO_INCREMENT PRIMARY KEY,
    IDUsuario VARCHAR(4),
    Concepto VARCHAR(255) NOT NULL,
    MesPagado VARCHAR(50),
    Monto DECIMAL(10, 2),
    FechaPago DATE,
    FOREIGN KEY (IDUsuario) REFERENCES USUARIOS(IDUsuario)
);

INSERT INTO USUARIOS(IdUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, TipoUsuario, Password) 
VALUES ('0000', 'Juan', 'Hernandez', 'Gonzales', 20, 'M', 'pdc1@mail.com', 'PDC', 'Progweb2#');

INSERT INTO USUARIOS(IdUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, TipoUsuario, Password) 
VALUES ('9999', 'Juan', 'Hernandez', 'Gonzales', 20, 'M', 'pf1@mail.com', 'PF', 'Progweb2#');