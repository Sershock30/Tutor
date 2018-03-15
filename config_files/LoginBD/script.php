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
	    FOREIGN KEY ( id_tipo ) REFERENCES TipoUsuario(cod_tipo) 
	) ENGINE=INNODB;',
	//insert de usuario y tipos de usuario
	'INSERT INTO tipousuario (cod_tipo,tipo) VALUES (1,"Admin");',
	'INSERT INTO tipousuario (cod_tipo,tipo) VALUES (2,"User");',
	'INSERT INTO usuario (id_tipo, correo_usuario, clave_usuario) VALUES (1, "admin@domain.com", "c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec")'
);

?>