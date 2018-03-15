<?php 

$script = array(
	//tabla tipo_usuario
	'CREATE TABLE TipoUsuario(
		cod_tipo INT AUTO_INCREMENT,
		tipo VARCHAR(50),
		estado INT DEFAULT 1,
		PRIMARY KEY ( cod_tipo ),
		UNIQUE `unique_tipo` ( tipo )
	) ENGINE=INNODB;',
	//Tabla usuario
	'CREATE TABLE Usuario(
	    id_usuario INT AUTO_INCREMENT,
		id_tipo INT,
		correo_usuario VARCHAR(150),
		clave_usuario VARCHAR(128),
		estado INT DEFAULT 1,
	    PRIMARY KEY ( id_usuario ), 
	    UNIQUE `unique_correo` ( correo_usuario ), 
	    FOREIGN KEY ( id_tipo ) REFERENCES TipoUsuario( cod_tipo ) 
	) ENGINE=INNODB;',
	//categorias de noticias
	'CREATE TABLE CatNoticia(
		cod_categoria INT AUTO_INCREMENT,
		categoria VARCHAR(50),
		estado INT DEFAULT 1,
		PRIMARY KEY (cod_categoria),
		UNIQUE `unique_categoria` ( categoria )
	)',
	//insert de usuario y tipos de usuario
	'INSERT INTO tipousuario (cod_tipo,tipo) VALUES (1,"Admin");',
	'INSERT INTO tipousuario (cod_tipo,tipo) VALUES (2,"User");',
	'INSERT INTO usuario (id_tipo, correo_usuario, clave_usuario) VALUES (1, "admin@domain.com", "admin")'
);

?>