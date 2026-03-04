create table alarmas
(
    id            int auto_increment
        primary key,
    persona_id    int                  not null,
    medicacion_id int                  not null,
    fecha         datetime             not null,
    apagada       tinyint(1) default 0 not null
);

create table medicamentos
(
    id     int auto_increment
        primary key,
    nombre varchar(120) not null,
    dosis  varchar(120) not null
);

create table pacientes
(
    id                int auto_increment
        primary key,
    nombre_completo   varchar(100) null,
    dni_paciente      varchar(20)  null,
    telefono_contacto varchar(20)  null,
    nss               varchar(20)  null
);

create table permisos
(
    id     int auto_increment
        primary key,
    nombre varchar(80) not null,
    constraint nombre
        unique (nombre)
);

create table personas
(
    id                   int auto_increment
        primary key,
    nombre               varchar(80)  not null,
    dni                  varchar(20)  not null,
    telefono             varchar(20)  null,
    direccion            varchar(120) null,
    num_seguridad_social varchar(20)  not null
);

create table pines_temporales
(
    id               int auto_increment
        primary key,
    pin              varchar(10)       not null,
    fecha_expiracion datetime          not null,
    usado            tinyint default 0 null
);

create table roles
(
    id     int auto_increment
        primary key,
    nombre varchar(50) not null,
    constraint nombre
        unique (nombre)
);

create table rol_permisos
(
    rol_id     int not null,
    permiso_id int not null,
    primary key (rol_id, permiso_id),
    constraint rol_permisos_ibfk_1
        foreign key (rol_id) references roles (id)
            on update cascade on delete cascade,
    constraint rol_permisos_ibfk_2
        foreign key (permiso_id) references permisos (id)
            on update cascade on delete cascade
);

create index permiso_id
    on rol_permisos (permiso_id);

create table usuarios
(
    id       int auto_increment
        primary key,
    nombre   varchar(100) not null,
    email    varchar(120) not null,
    password varchar(255) not null,
    rol_id   int          not null,
    pin      varchar(20)  null,
    constraint email
        unique (email)
);

