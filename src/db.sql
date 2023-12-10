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
    salario DECIMAL(10, 2) default 0,
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




CREATE TABLE nominas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empleado_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    dias_trabajados INT,
    salario_bruto DECIMAL(10, 2),
    salario_neto DECIMAL(10, 2),
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);



CREATE TABLE calculo_nomina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empleado_id INT,
    periodo_inicio DATE,
    periodo_fin DATE,
    horas_extras DECIMAL(10, 2),
    precio_por_horas_extra DECIMAL(10, 2),
    asignaciones TEXT,
    deducciones TEXT,
    total_asignaciones DECIMAL(10, 2),
    total_deducciones DECIMAL(10, 2),
    comentarios TEXT,
    salario_neto DECIMAL(10, 2),
    dias_de_pago INT,
    salario_bruto DECIMAL(10, 2),
    fecha_procesamiento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);