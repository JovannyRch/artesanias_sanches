drop database if exists nomina;
create database nomina;

use nomina;

CREATE TABLE cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    salario_base DECIMAL(10, 2),
    descripcion TEXT
);

CREATE TABLE departamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    paterno VARCHAR(100) NOT NULL,
    materno VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(50),
    email VARCHAR(100),
    rfc VARCHAR(50),
    curp VARCHAR(50),
    fecha_ingreso DATE NOT NULL,
    departamento_id INT,
    cargo_id INT,
    estatus_empleado VARCHAR(50),
    informacion_bancaria_id INT,
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id),
    FOREIGN KEY (cargo_id) REFERENCES cargos(id)
);

CREATE TABLE informacion_bancaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empleado_id INT NOT NULL,
    banco VARCHAR(100),
    numero_cuenta VARCHAR(100),
    tipo_cuenta VARCHAR(50),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);


ALTER TABLE departamentos
ADD gerente_id INT,
ADD FOREIGN KEY (gerente_id) REFERENCES empleados(id);

