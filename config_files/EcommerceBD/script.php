<?php 

//Referencia del pedido = Abvreviacion Tipo Pedido + cod_pedido + Fecha + cod_cliente
// ed: PYP-1-22112017-1

$script =
	//Crea las tablas y por defecto inserta algunos valores de ejemplo
	'CREATE TABLE Usuario(
	    id_usuario INT AUTO_INCREMENT,
		correo_usuario VARCHAR(150),
		clave_usuario VARCHAR(128),
		estado INT DEFAULT 1,
	    PRIMARY KEY ( id_usuario ), 
	    UNIQUE `unique_correo` ( correo_usuario ) 
	) ENGINE=INNODB;

	CREATE TABLE Provincia ( 
		id_Provincia INT, 
		nombre varchar(30), 
		PRIMARY KEY ( id_Provincia ) 
	) ENGINE=INNODB; 

	CREATE TABLE Canton( 
		id_Canton INT, 
		id_Provincia INT, 
		nombre VARCHAR(30), 
		PRIMARY KEY ( id_Canton, id_Provincia), 
		FOREIGN KEY ( id_Provincia ) REFERENCES Provincia( id_Provincia )
	) ENGINE=INNODB; 

	CREATE TABLE Distrito( 
		id_Distrito INT, 
		id_Canton INT, 
		id_Provincia INT, 
		nombre VARCHAR(30), 
		PRIMARY KEY ( id_Distrito, id_Canton, id_Provincia), 
		FOREIGN KEY ( id_Provincia ) REFERENCES Canton( id_Provincia ),
		FOREIGN KEY ( id_Canton ) REFERENCES Canton( id_Canton )
	) ENGINE=INNODB;

	CREATE TABLE Cliente(
		id_cliente INT AUTO_INCREMENT,
		Nombre VARCHAR(100), 
		Apellidos VARCHAR(200),
		Correo VARCHAR(200),
		Telefono VARCHAR(50),
		direccion VARCHAR(500),
		clave VARCHAR(128),
		fk_cod_distrito INT,
		cod_activacion VARCHAR(500),
		estado INT DEFAULT 0,
		PRIMARY KEY (id_cliente),
		FOREIGN KEY (fk_cod_distrito) REFERENCES Distrito(id_Distrito),
		UNIQUE `unique_correo_cliente` ( Correo ),
		UNIQUE `unique_activacion` ( cod_activacion )
	)ENGINE=INNODB;

	CREATE TABLE Marca(
		id_marca INT AUTO_INCREMENT,
		marca VARCHAR(100),
		estado INT DEFAULT 1,
		PRIMARY KEY (id_marca)
	) ENGINE=INNODB;

	CREATE TABLE Categoria(
		id_categoria INT AUTO_INCREMENT,
		categoria VARCHAR(50),
		estado INT DEFAULT 1,
		PRIMARY KEY (id_categoria),
		UNIQUE `unique_categoria` ( categoria )
	) ENGINE=INNODB;

	CREATE TABLE Destacado(
		id_destacado INT AUTO_INCREMENT,
		tipo VARCHAR(100),
		estado INT DEFAULT 1,
		PRIMARY KEY ( id_destacado ),
		UNIQUE `unique_tipo_destacado` (tipo)
	) ENGINE=INNODB;

	CREATE TABLE Producto (
		id_producto INT AUTO_INCREMENT,
		id_destacado INT DEFAULT 1,
		id_categoria INT,
		id_marca INT,
		codigo VARCHAR(150), 
		nombre VARCHAR(100),
		descripcion VARCHAR(500),
		peso DOUBLE, 
		precio DOUBLE,
		imagen VARCHAR(500),
		PRIMARY KEY ( id_producto ),
		UNIQUE `unique_nombre_producto` ( nombre ),
		FOREIGN KEY ( id_categoria ) REFERENCES Categoria( id_categoria ),
		FOREIGN KEY ( id_destacado ) REFERENCES Destacado( id_destacado ),
		FOREIGN KEY ( id_marca ) REFERENCES Marca( id_marca ),
		estado INT DEFAULT 1
	) ENGINE=INNODB;

	CREATE TABLE Tipo_Pedido(
		id_tipo_pedido INT AUTO_INCREMENT,
		tipo VARCHAR(100),
		abv_tipo VARCHAR(3),
		estado INT DEFAULT 1,
		PRIMARY KEY ( id_tipo_pedido ),
		UNIQUE `unique_abreviacion` ( abv_tipo )
	) ENGINE=INNODB;

	CREATE TABLE Pedido (
		id_pedido INT AUTO_INCREMENT,
		id_cliente INT,
		id_tipo_pedido INT,
		referencia_pedido VARCHAR(150),
		fecha Date,
		ConfirmaPago INT DEFAULT 0,
		Despachado INT DEFAULT 0,
		PRIMARY KEY (id_pedido),
		FOREIGN KEY (id_tipo_pedido) REFERENCES Tipo_Pedido(id_tipo_pedido),
		FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente),
		UNIQUE `unique_ref` (referencia_pedido)
	) ENGINE=INNODB;

	CREATE TABLE Det_Pedido (
		id_detalle INT AUTO_INCREMENT,
		id_pedido INT,
		id_producto INT,
		cantidad INT,
		total_linea DOUBLE,
		descuento INT DEFAULT 0,
		estado INT DEFAULT 1,
		PRIMARY KEY ( id_detalle ),
		FOREIGN KEY ( id_pedido ) REFERENCES Pedido(id_pedido),
		FOREIGN KEY ( id_producto ) REFERENCES Producto( id_producto )
	) ENGINE=INNODB;

	INSERT INTO usuario (correo_usuario, clave_usuario) VALUES ("admin@domain.com", "c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec");

	INSERT INTO Categoria (categoria) VALUES ("Coffee Maker");
	INSERT INTO Categoria (categoria) VALUES ("Licuadoras");
	
	INSERT INTO Destacado ( tipo ) VALUES 
		("No"), 
		("Descuento"), 
		("Nuevo");

	INSERT INTO Tipo_Pedido (tipo, abv_tipo) VALUES ("PayPal", "PYP"), ("Transferencia", "TRS");

	INSERT INTO Provincia(id_Provincia,nombre) VALUES(1,"San Jose"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(2,"Alajuela"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(3,"Cartago"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(4,"Heredia"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(5,"Guanacaste"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(6,"Puntarenas"); 
	INSERT INTO Provincia(id_Provincia,nombre) VALUES(7,"Limon"); 


	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,1,"San Jose"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,1,"Escazu"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,1,"Desamparados"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,1,"Puriscal"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,1,"Aserri"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,1,"Mora"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,1,"Goicoechea"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,1,"Santa Ana"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(9,1,"Alajuelita"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(10,1,"Vasquez de Coronado"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(11,1,"Acosta"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(12,1,"Tibas"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(13,1,"Moravia"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(14,1,"Montes de Oca"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(15,1,"Turrubares"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(16,1,"Dota"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(17,1,"Curridabat"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(18,1,"Perez Zeledon"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(19,1,"Leon Cortez"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,2,"Alajuela"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,2,"San Ramon"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,2,"Grecia"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,2,"San Mateo"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,2,"Atenas"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,2,"Naranjo"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,2,"Palmares"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,2,"Poas"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(9,2,"Orotina"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(10,2,"San Carlos"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(11,2,"Alfaro Ruiz"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(12,2,"Valverde Vega"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(13,2,"Upala"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(14,2,"Los Chiles"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(15,2,"Guatuso"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,3,"Cartago"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,3,"Paraiso"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,3,"La Union"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,3,"Jimenez"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,3,"Turrialba"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,3,"Alvarado"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,3,"Oreamuno"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,3,"El Guarco"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,4,"Heredia"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,4,"Barva"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,4,"Santo Domingo"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,4,"Santa Barbara"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,4,"San Rafael"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,4,"San Isidro"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,4,"Belen"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,4,"Flores"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(9,4,"San Pablo"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(10,4,"Sarapiqui"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,5,"Liberia"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,5,"Nicoya"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,5,"Santa Cruz"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,5,"Bagaces"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,5,"Carrillo"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,5,"Cañas"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,5,"Abangares"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,5,"Tilaran"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(9,5,"Nandayure"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(10,5,"La Cruz"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(11,5,"Hojancha"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,6,"Puntarenas"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,6,"Esparza"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,6,"Buenos Aires"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,6,"Montes de Oro"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,6,"Osa"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,6,"Aguirre"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(7,6,"Golfito"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(8,6,"Coto Brus"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(9,6,"Parrita"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(10,6,"Corredores"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(11,6,"Garabito"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(1,7,"Limon"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(2,7,"Pococi"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(3,7,"Siquirres"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(4,7,"Talamanca"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(5,7,"Matina"); 
	INSERT INTO Canton(id_Canton,id_Provincia,nombre) VALUES(6,7,"Guacimo"); 

	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,1,"Carmen"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,1,"Merced"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,1,"Hospital"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,1,"Catedral"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,1,"Zapote"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,1,1,"San Francisco de Dos Rios"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,1,1,"Uruca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,1,1,"Mata Redonda"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,1,1,"Pavas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,1,1,"Hatillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,1,1,"San Sebastian"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,1,"Escazu"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,1,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,1,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,1,"Desamparados"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,1,"San Miguel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,1,"San Juan de Dios"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,1,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,1,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,1,"Frailes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,1,"Patarra"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,1,"San Cristobal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,3,1,"Rosario"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,3,1,"Damas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,3,1,"San Rafael Abajo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,3,1,"Gravillas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,1,"Santiago"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,1,"Mercedes Sur"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,1,"Barbacoas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,4,1,"Grito Alto"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,4,1,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,4,1,"Candelarita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,4,1,"Desamparaditos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,4,1,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,4,1,"Chires"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,4,1,"Tarrazu"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,4,1,"San Marcos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,4,1,"San Lorenzo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(13,4,1,"San Carlos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,1,"Aserri"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,1,"Tarbaca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,1,"Vuelta de Jorco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,1,"San Gabriel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,5,1,"Legua"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,5,1,"Monterrey"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,5,1,"Salitrillos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,1,"Colon"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,1,"Guayabo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,1,"Tabarcia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,6,1,"Piedras Negras"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,6,1,"Picagres"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,1,"Guadalupe"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,1,"San Francisco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,1,"Calle Blancos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,7,1,"Mata de Platano"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,7,1,"Ipis"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,7,1,"Rancho Redondo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,7,1,"Purral"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,1,"Santa Ana"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,1,"Salitral"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,1,"Pozos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,8,1,"Uruca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,8,1,"Piedades"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,8,1,"Brasil"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,9,1,"Alajuelita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,9,1,"San Josecito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,9,1,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,9,1,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,9,1,"San Felipe"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,10,1,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,10,1,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,10,1,"Jesus (Dulce Nombre)"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,10,1,"Patalillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,10,1,"Cascajal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,11,1,"San Ignacio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,11,1,"Guaitil"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,11,1,"Palmichal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,11,1,"Cangrejal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,11,1,"Sabanillas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,12,1,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,12,1,"Cinco Esquinas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,12,1,"Anselmo Llorente"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,12,1,"Leon XIII"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,12,1,"Colima"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,13,1,"San Vicente"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,13,1,"San Jeronimo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,13,1,"Trinidad"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,14,1,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,14,1,"Sabanilla"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,14,1,"Mercedes(Betania)");
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,14,1,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,15,1,"San Pablo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,15,1,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,15,1,"San Juan de Mata"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,15,1,"San Luis"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,16,1,"Santa Maria"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,16,1,"Jardin"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,16,1,"Copey"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,16,1,"Curridabat"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,17,1,"Granadilla"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,17,1,"Sanchez"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,17,1,"Tirrases"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,17,1,"Curridabat"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,18,1,"San Isidro del General"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,18,1,"General"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,18,1,"Daniel Flores"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,18,1,"Rivas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,18,1,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,18,1,"Platanares"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,18,1,"Pejibaye"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,18,1,"Cajon"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,18,1,"Baru"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,18,1,"Rio Nuevo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,18,1,"El Páramo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,19,1,"San Pablo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,19,1,"San Andres"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,19,1,"Llano Bonito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,19,1,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,19,1,"Santa Cruz"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,19,1,"San Antonio"); 

	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,2,"Alajuela"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,2,"Carrizal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,2,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,2,"Guacima"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,2,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,1,2,"Sabanilla"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,1,2,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,1,2,"Rio Segundo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,1,2,"Desamparados"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,1,2,"Turrucares"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,1,2,"Tambor"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,1,2,"Garita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(13,1,2,"Sarapiqui"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,2,"San Ramon"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,2,"Santiago"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,2,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,2,"Piedades Norte"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,2,"Piedades Sur"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,2,2,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,2,2,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,2,2,"Angeles"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,2,2,"Alfaro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,2,2,"Volio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,2,2,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,2,2,"Zapotal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(13,2,2,"Peñas Blancas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,2,"Grecia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,2,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,2,"San Jose"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,2,"San Roque"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,2,"Tacares"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,2,"Rio Cuarto"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,2,"Puente de Piedra"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,2,"Bolivar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,2,"San Mateo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,2,"Desmonte"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,2,"Jesus Maria"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,2,"Atenas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,2,"Jesus"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,2,"Mercedes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,2,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,5,2,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,5,2,"San Jose"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,5,2,"Santa Eulalia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,2,"Naranjo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,2,"San Miguel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,2,"San Jose"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,6,2,"Cirri Sur"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,6,2,"San Jeronimo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,6,2,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,6,2,"Rosario"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,2,"Palmares"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,2,"Zaragoza"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,2,"Buenos Aires"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,7,2,"Santiago"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,7,2,"Candelaria"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,7,2,"Esquipulas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,7,2,"Granja"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,2,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,2,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,2,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,8,2,"Carrillos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,8,2,"Sabana Redonda"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,9,2,"Orotina"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,9,2,"Mastate"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,9,2,"Hacienda Vieja"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,9,2,"Coyolar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,9,2,"Ceiba"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,10,2,"Quesada"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,10,2,"Florencia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,10,2,"Buenavista"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,10,2,"Aguas Zarcas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,10,2,"Venecia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,10,2,"Pital"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,10,2,"Fortuna"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,10,2,"Tigra"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,10,2,"Palmera"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,10,2,"Venado"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,10,2,"Cutris"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,10,2,"Monterrey"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(13,10,2,"Pocosol"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,11,2,"Zarcero"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,11,2,"Laguna"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,11,2,"Tapezco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,11,2,"Guadalupe"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,11,2,"Palmira"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,11,2,"Zapote"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,11,2,"Brisas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,12,2,"Sarchi Norte"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,12,2,"Sarchi Sur"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,12,2,"Toro Amarillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,12,2,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,12,2,"Rodriguez"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,13,2,"Upala"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,13,2,"Aguas Claras"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,13,2,"San Jose (Pizote)"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,13,2,"Bijagua"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,13,2,"Delicias"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,13,2,"Dos Rios (Colonia Mayorga)"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,13,2,"Yolillal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,14,2,"Los Chiles"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,14,2,"Caño Negro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,14,2,"El Amparo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,14,2,"San Jorge"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,15,2,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,15,2,"Buena Vista"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,15,2,"Cote"); 


	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,3,"Oriental"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,3,"Occidental"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,3,"Carmen"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,3,"San Nicolas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,3,"Aguacaliente (San Francisco)"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,1,3,"Guadalupe (Arenilla)");
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,1,3,"Corralillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,1,3,"Tierra Blanca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,1,3,"Dulce Nombre"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,1,3,"Llano Grande"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,1,3,"Quebradilla"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,3,"Paraiso"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,3,"Santiago"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,3,"Orosi"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,3,"Cachi"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,3,"Llanos de Santa Lucia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,3,"Tres Rios"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,3,"San Diego"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,3,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,3,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,3,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,3,"Dulce Nombre"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,3,"San Ramon"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,3,"Rio Azul"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,3,"Juan Viñas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,3,"Tucurrique"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,3,"Pejibaye"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,3,"Turrialba"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,3,"La Suiza"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,3,"Peralta"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,3,"Santa cruz"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,5,3,"Santa Teresita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,5,3,"Pavones"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,5,3,"Tuis"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,5,3,"Tayutic"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,5,3,"Santa Rosa"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,5,3,"Tres Equis"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,5,3,"La Isabel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,5,3,"Chirripo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,3,"Pacayas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,3,"Cervantes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,3,"Capellades"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,3,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,3,"Cot"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,3,"Potrero Cerrado"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,7,3,"Cipreses"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,7,3,"Santa Rosa"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,3,"Tejar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,3,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,3,"Tobosi"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,8,3,"Patio de Agua"); 

	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,4,"Heredia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,4,"Mercedes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,4,"San Francisco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,4,"Ulloa"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,4,"Varablanca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,4,"Barva"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,4,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,4,"San Pablo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,4,"San Roque"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,4,"Santa Lucia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,2,4,"San Jose de la Montaña"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,4,"Santo Domingo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,4,"San Vicente"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,4,"San Miguel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,4,"Paracito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,4,"Santo Tomas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,4,"Santa Rosa"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,4,"Tures"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,4,"Para"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,4,"Santa Barbara"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,4,"San Pedro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,4,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,4,4,"Jesus"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,4,4,"Santo Domingo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,4,4,"Puraba"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,4,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,4,"San Josecito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,4,"Santiago"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,4,"Angeles"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,5,4,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,4,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,4,"San Jose"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,4,"Concepcion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,6,4,"San Francisco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,4,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,4,"Ribera"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,4,"Asuncion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,4,"San Joaquin de Flores"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,4,"Barrantes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,4,"Llorente"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,9,4,"San Pablo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,9,4,"Rincon de Sabanilla"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,10,4,"Puerto Viejo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,10,4,"La Virgen"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,10,4,"Horquetas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,10,4,"Llanuras del Gaspar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,10,4,"Cureña"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,5,"Liberia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,5,"Cañas Dulces"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,5,"Mayorga"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,5,"Nacascolo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,5,"Curubande"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,5,"Nicoya"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,5,"Mansion"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,5,"San Antonio"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,5,"Quebrada Honda"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,5,"Samara"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,2,5,"Nosara"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,2,5,"Belen de Nosarita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,5,"Santa Cruz"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,5,"Bolson"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,5,"Veintisiete de Abril"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,5,"Tempate"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,5,"Cartagena"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,5,"Coajiniquil"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,5,"Diria"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,5,"Cabo Velas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,3,5,"Tamarindo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,5,"Bagaces"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,5,"Fortuna"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,5,"Mogote"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,4,5,"Rio Naranjo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,5,"Filadelfia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,5,"Palmira"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,5,"Sardinal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,5,"Belen"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,5,"Cañas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,5,"Palmira"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,5,"San Miguel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,6,5,"Bebedero"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,6,5,"Porozal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,5,"Juntas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,5,"Sierra"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,5,"San Juan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,7,5,"Colorado"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,5,"Tilaran"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,5,"Quebrada Grande"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,5,"Tronadora"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,8,5,"Santa Rosa"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,8,5,"Libano"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,8,5,"Tierras Morenas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,8,5,"Arenal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,9,5,"Carmona"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,9,5,"Santa Rita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,9,5,"Zapotal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,9,5,"San Pablo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,9,5,"Porvenir"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,9,5,"Bejuco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,10,5,"La Cruz"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,10,5,"Santa Cecilia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,10,5,"Garita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,10,5,"Santa Elena"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,11,5,"Hojancha"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,11,5,"Monte Romo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,11,5,"Puerto Carrillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,11,5,"Huacas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,6,"Puntarenas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,6,"Pitahaya"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,6,"Chomes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,6,"Lepanto"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,1,6,"Paquera"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,1,6,"Manzanillo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,1,6,"Guacimal"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,1,6,"Barranca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,1,6,"Monte Verde"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(10,1,6,"Isla del Coco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(11,1,6,"Cobano"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(12,1,6,"Chacarita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(13,1,6,"Chira"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(14,1,6,"Acapulco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(15,1,6,"El Roble"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(16,1,6,"Arancibia"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,6,"Espiritu Santo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,6,"San Juan Grande"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,6,"Macacona"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,6,"San Rafael"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,6,"San Jeronimo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,6,"Buenos Aires"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,6,"Volcan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,6,"Potrero Grande"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,6,"Boruca"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,6,"Pilas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,6,"Colinas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,3,6,"Changuenas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,3,6,"Biolley"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,4,6,"Miramar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,4,6,"Union"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,4,6,"San Isidro"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,6,"Cortes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,6,"Palmar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,6,"Sierpe"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,5,6,"Bahia Ballena"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,5,6,"Piedras Blancas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,6,"Quepos"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,6,"Savegre"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,6,"Naranjito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,7,6,"Golfito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,7,6,"Jimenez"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,7,6,"Guaycar"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,7,6,"Corredor"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,8,6,"San Vito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,8,6,"Sabalito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,8,6,"Aguabuena"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,8,6,"Limoncito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,8,6,"Pittier"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,9,6,"Parrita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,10,6,"Corredores"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,10,6,"La Cuesta"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,10,6,"Canoas"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,10,6,"Laurel"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,11,6,"Jaco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,11,6,"Tarcoles"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,1,7,"Limon"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,1,7,"Valle la Estrella"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,1,7,"Rio Blanco"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,1,7,"Matama"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,2,7,"Guapiles"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,2,7,"Jimenez"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,2,7,"Rita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,2,7,"Roxana"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,2,7,"Cariari"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,2,7,"Colorado"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,3,7,"Siquirres"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,3,7,"Pacuarito"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,3,7,"Florida"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,3,7,"Germania"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,3,7,"Cairo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(6,3,7,"Alegria"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(7,4,7,"Bratsi"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(8,4,7,"Sixaola"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(9,4,7,"Cahuita"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,5,7,"Matina"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,5,7,"Batan"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,5,7,"Carrandi"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(1,6,7,"Guacimo"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(2,6,7,"Mercedes"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(3,6,7,"Pocora"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(4,6,7,"Rio Jimenez"); 
	INSERT INTO Distrito(id_Distrito,id_Canton,id_Provincia,nombre) VALUES(5,6,7,"Duacari");
	';

?>