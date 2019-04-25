CREATE DATABASE IF NOT EXISTS dblikes;
USE dblikes;

/* CREAMOS LA TABLA PUBLICACIONES */
CREATE TABLE IF NOT EXISTS dblikes.publicaciones(
    publicaciones_id int NOT NULL AUTO_INCREMENT,
    publicaciones_tema varchar(128) NOT NULL,
    publicaciones_fecha_creacion datetime NOT NULL,
    publicaciones_contenido varchar(128) NOT NULL,
    publicaciones_titulo varchar(128) NOT NULL,
    publicaciones_likes int,
    PRIMARY KEY (publicaciones_id)
 );

/* CREAMOS LA TABLA USUARIOS */
CREATE TABLE IF NOT EXISTS dblikes.usuarios(
    usuarios_id_usuario int NOT NULL AUTO_INCREMENT,
    usuarios_nombre varchar(32) NOT NULL,
    usuarios_apellidos varchar(16) NOT NULL,
    usuarios_contrasenna varchar(256) NOT NULL,
    usuarios_correo varchar(64) NOT NULL,
    usuarios_alias varchar(16) NOT NULL,
    usuarios_direccion varchar(128) NOT NULL,
    usuarios_fecha_registro datetime NOT NULL,
    usuarios_pais varchar(16) NOT NULL,
    usuarios_codigo_postal varchar(5) NOT NULL,
    usuarios_rango int(4),
    usuarios_logros int,
    usuarios_img varchar(265),
    PRIMARY KEY (usuarios_id_usuario)
 ); 

/* CREAMOS LA TABLA LIKES USUARIOS PUBLICACIÓN */
CREATE TABLE IF NOT EXISTS dblikes.likes(
    like_usuario_id int NOT NULL,
    like_publicacion_id int NOT NULL
 ); 


INSERT INTO dblikes.usuarios (usuarios_nombre, usuarios_correo, usuarios_contrasenna)
  SELECT * FROM (SELECT 'administradorA3PF','administradorA3PF@gmail.com', '$2a$07$usesomadasdsadsadsadaeJREaZotGc7v0JP8kS.0l16uxaC0fo7m') AS tmp
    WHERE NOT EXISTS (SELECT usuarios_nombre FROM dblikes.usuarios WHERE usuarios_correo = 'administradorA3PF@gmail.com') LIMIT 1;

INSERT INTO dblikes.usuarios (usuarios_nombre, usuarios_apellidos, usuarios_correo, usuarios_contrasenna, usuarios_alias, usuarios_fecha_registro, usuarios_pais, usuarios_codigo_postal)
  SELECT * FROM (SELECT 'prueba','apellido','prueba@gmail.com', '$2a$07$usesomadasdsadsadsadaeJREaZotGc7v0JP8kS.0l16uxaC0fo7m', 'pruebaAlias', date("Y-m-d H:i:s"), 'es', '28940') AS tmp
    WHERE NOT EXISTS (SELECT usuarios_nombre FROM dblikes.usuarios WHERE usuarios_correo = 'prueba@gmail.com') LIMIT 1;

INSERT INTO `dblikes`.`publicaciones`(
`publicaciones_tema`,
`publicaciones_fecha_creacion`,
`publicaciones_contenido`,
`publicaciones_titulo`,
`publicaciones_likes`)
VALUES
('php',
sysdate(),
'contenido del post',
'esto es un título',
0);
SELECT * FROM dblikes.usuarios;