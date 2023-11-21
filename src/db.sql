create table tblusuario(
    id_usuario int not null auto_increment PRIMARY KEY,
    nombre_usuario varchar(50) not null,
    contrasena varchar(255) not null,
    rol varchar(50) not null,
    email varchar(100) not null,
    fecha_registro date not null,
    ultima_conexion date not null
);

create table tblcliente(
    id_cliente int not null auto_increment PRIMARY KEY,
    nombre varchar(50) not null,
    ap_paterno varchar(50) not null,
    ap_materno varchar(50) not null,
    rfc varchar(13) not null,
    curp varchar(18) not null,
    tipo_membresia varchar(10) not null,
    fecha_inicio_membresia date not null,
    fecha_termino_membresia date not null
);

create table tbldirector(
    id_director int not null auto_increment PRIMARY KEY,
    nombre varchar(50) not null,
    ap_paterno varchar(50) not null,
    ap_materno varchar(50) not null,
    nacionalidad varchar(50) not null,  
    fecha_nacimiento date not null
);

create table tblcategoria(
    id_categoria int not null auto_increment PRIMARY KEY,
    nombre varchar(50) not null
);

create table tblactor(
    id_actor int not null auto_increment PRIMARY KEY,
    nombre varchar(50) not null,
    ap_paterno varchar(50) not null,
    ap_materno varchar(50) not null,
    nacionalidad varchar(50) not null,
    fecha_nacimiento date not null
);

create table tbl_pelicula(
    id_pelicula int not null auto_increment PRIMARY KEY,
    id_categoria int not null,
    id_actor1 int not null,
    id_actor2 int not null,
    nombre varchar(50) not null,
    pais varchar(50) not null,
    sinopsis varchar(200) not null,
    anio_lanzamiento int not null,
    clasificacion varchar(10) not null,
    imagen varchar(255) not null
);
