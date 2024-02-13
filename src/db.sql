/* 
drop database if exists nomina;


create database nomina;
 */
/* use nomina; */

drop table if exists empleados;
drop table if exists cargos;
drop table if exists departamentos;
drop table if exists calculo_nomina;


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
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id) on delete set null,
    FOREIGN KEY (cargo_id) REFERENCES cargos(id) on delete set null
);



ALTER TABLE departamentos
ADD gerente_id INT,
ADD FOREIGN KEY (gerente_id) REFERENCES empleados(id);



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
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) on delete cascade
);


create table peliculas (
    id int auto_increment primary key,
    nombre varchar(100) not null,
    genero varchar(50),
    descripcion text,
    duracion int,
    clasificacion varchar(50)
);

create table productos(
    id int auto_increment primary key,
    nombre_equipo varchar(100) not null,
    n_serie varchar(100),
    estado_general varchar(100),
    lista_de_defectos varchar(100)
); 