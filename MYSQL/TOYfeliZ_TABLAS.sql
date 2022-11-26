CREATE DATABASE IF NOT EXISTS TOYfeliZ;
USE TOYfeliZ;
 
#-----------------------------TABLAS----------------------------------

CREATE TABLE if not exists rol (
ID_ROL INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único del rol; 1 = Cliente, 2 = Vendedor, 3 = Administrador.',
nombreRol VARCHAR(15) NOT NULL COMMENT 'Nombre de del rol.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que se creo la categoría.'
);

INSERT into rol (nombreRol) VALUES ('Cliente');
INSERT into rol (nombreRol) VALUES ('Vendedor');
INSERT into rol (nombreRol) VALUES ('Administrador');

CREATE TABLE if not exists usuarios (
ID_USUARIO INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único del usuario.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que el usuario creó su cuenta.',
nombre VARCHAR(50) NOT NULL COMMENT 'Nombre/s del usuario.',
apellido VARCHAR(50) NOT NULL COMMENT  'Apellido/s de del usuario.',
nacimiento VARCHAR(45) NOT NULL COMMENT 'Fecha de nacimiento del usuario.',
usuario VARCHAR(20) UNIQUE NOT NULL COMMENT 'Nombre de usuario único. Puede llevar numeros y letras.',
correo VARCHAR(100) UNIQUE NOT NULL COMMENT 'Correo electrónico único del usuario. Con él puede iniciar sesión en TOYfeliZ.',
contrasenia VARCHAR(40) NOT NULL  COMMENT 'Contraseña del usuario.',
sexo VARCHAR(10) NOT NULL COMMENT 'Sexo del usuario: hombre o mujer.' ,
privacidad VARCHAR(10) NOT NULL COMMENT 'Privacidad del usuario (Publico/Privado).',
estatus BIT DEFAULT 1 COMMENT 'Estado de la cuenta del usuario; 1 = cuenta activa, 0 = cuenta inactiva.',
foto MEDIUMBLOB NOT NULL  COMMENT 'Foto de perfil del usuario.' ,
ID_ROL INT NOT NULL COMMENT 'Rol del usuario en TOYfeliZ; 1 = Cliente, 2 = Vendedor, 3 = Administrador.' ,
FOREIGN KEY (ID_ROL) REFERENCES rol (ID_ROL)
);

CREATE TABLE if not exists juguetes (
ID_PRODUCTO INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único del juguete.' ,
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que publicó el juguete.',
nombre VARCHAR(100) NOT NULL COMMENT 'Nombre/s del juguete.',
descripcion VARCHAR(500) NOT NULL COMMENT 'Descripción del juguete.',
tipoVenta VARCHAR(30) NOT NULL COMMENT 'Tipo de venta. (Producto para cotizar o venta directa)',
valoracion INT NOT NULL COMMENT 'Valoración promedio del juguete.',
precio FLOAT NOT NULL COMMENT 'Precio del producto en MXN(pesos mexicanos); puede ser 0 SOLO si el producto será para cotizar.',
cantidad INT NOT NULL COMMENT 'Unidades disponibles del juguete.',
ID_VENDEDOR INT NOT NULL COMMENT 'Identificador del usuario que vende el juguete.',
FOREIGN KEY (ID_VENDEDOR) REFERENCES usuarios (ID_USUARIO),
ID_ADMIN INT COMMENT 'Identificador del administrador que autorizó la venta del juguete.',
FOREIGN KEY (ID_ADMIN) REFERENCES usuarios (ID_USUARIO),
autorizado INT DEFAULT 0 COMMENT 'Identificador para saber si el producto puede venderse o todavía no; 0 = no autorizado, 1 = si autorizado.',
icono MEDIUMBLOB NOT NULL COMMENT 'Icono del juguete.',
estatus bit default 1 

);

CREATE TABLE if not exists videos (
ID_VIDEO INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único del vídeo.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW()  COMMENT 'Fecha en que el usuario subió vídeo.',
video LONGBLOB NOT NULL  COMMENT 'Vídeo.',
ID_JUGUETE INT NOT NULL COMMENT 'Identificador único del juguete al que pertenece el vídeo.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO)
);

CREATE TABLE if not exists imagenes (
ID_IMAGEN INT PRIMARY KEY AUTO_INCREMENT NOT NULL  COMMENT 'Identificador único de la imagen.' ,
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que el usuario subió la imagen.',
imagen MEDIUMBLOB NOT NULL COMMENT 'Contenido de la imagen.' ,
ID_JUGUETE INT NOT NULL COMMENT 'Identificador único del juguete al que pertenece la imagen.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO)
);

CREATE TABLE if not exists comentarios (
ID_COMENTARIO INT PRIMARY KEY AUTO_INCREMENT NOT NULL  COMMENT 'Identificador único del comentario.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que publicó el comentario.',
descripcion VARCHAR(500) NOT NULL COMMENT 'Contenido del comentario que hizo el usuario a el juguete.',
calificación INT COMMENT 'Calificación del 1 - 5 que da el usuario a el jueguete.',
ID_CLIENTE INT NOT NULL COMMENT 'Identificador del usuario que hizo el comentario.',
FOREIGN KEY (ID_CLIENTE) REFERENCES usuarios (ID_USUARIO),
ID_JUGUETE INT NOT NULL  COMMENT 'Identificador del juguete al cual se le comenta.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO)
);

CREATE TABLE if not exists categorias (
ID_CATEGORIA INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único de la categorías.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que se añadió la categoría.',
nombre VARCHAR(50) NOT NULL COMMENT 'Nombre de la categoría.' ,
descripcion VARCHAR(500) NOT NULL COMMENT 'Descripción de la categoría.' ,
ID_VENDEDOR INT NOT NULL COMMENT 'Identificador del usuario vendedor que creó la categoría.',
FOREIGN KEY (ID_VENDEDOR) REFERENCES usuarios (ID_USUARIO)
);

CREATE TABLE if not exists categoriaJuguete (
ID_JUGUETE INT NOT NULL COMMENT 'Identificador del juguete.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO),
ID_CATEGORIA INT NOT NULL COMMENT 'Identificador de la categoría.' ,
FOREIGN KEY (ID_CATEGORIA) REFERENCES categorias (ID_CATEGORIA)
);

CREATE TABLE if not exists listas (
ID_LISTA INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador único de la lista.',
fechaCreacion TIMESTAMP NOT NULL DEFAULT NOW() COMMENT 'Fecha en que se añadió la lista.',
nombre VARCHAR(50) NOT NULL COMMENT 'Nombre de la lista.',
descripcion VARCHAR(500) NOT NULL  COMMENT 'Descripción de la lista.' ,
privacidad VARCHAR(50) NOT NULL COMMENT 'Privacidad de la lista(publica o privada).',
ID_CLIENTE INT NOT NULL 	comment 'Identificador del usuario cliente que creó la lista.' ,
FOREIGN KEY (ID_CLIENTE) REFERENCES usuarios (ID_USUARIO)
);

CREATE TABLE if not exists imagenesListas (
ID_LISTA INT NOT NULL COMMENT 'Identificador de la lista.',
FOREIGN KEY (ID_LISTA) REFERENCES listas (ID_LISTA),
ruta MEDIUMBLOB NOT NULL cOMMENT 'Imagenes de la lista.'
);

CREATE TABLE if not exists deseos (
ID_LISTA INT NOT NULL COMMENT 'Identificador de la lista.',
FOREIGN KEY (ID_LISTA) REFERENCES listas (ID_LISTA) ,
ID_JUGUETE INT NOT NULL COMMENT 'Identificador del juguete que se añadio a la lista de deseos.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO)
);

CREATE TABLE if not exists carrito (
ID_CARRITO INT PRIMARY KEY AUTO_INCREMENT NOT NULL  COMMENT 'Identificador único del carrito.',
ID_CLIENTE INT NOT NULL COMMENT 'Identificador del cliente al cual pertenece el carrito.' ,
FOREIGN KEY (ID_CLIENTE) REFERENCES usuarios (ID_USUARIO),
preciototalPagar FLOAT COMMENT 'Precio total en MXN que pagarà el cliente por todos los productos.',
fechaCOMPRA TIMESTAMP NOT NULL DEFAULT NOW()  COMMENT 'Fecha en que se hizo la compra de todos los productos.' 
);

CREATE TABLE if not exists poductosCarrito (
ID_PRODUCTOS_CARRITO INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador.',
ID_CARRITO INT NOT NULL  COMMENT 'Identificador único del carrito.',
FOREIGN KEY (ID_CARRITO) REFERENCES carrito (ID_CARRITO),
ID_CLIENTE INT NOT NULL COMMENT 'Identificador del cliente al cual pertenecen los productos.' ,
FOREIGN KEY (ID_CLIENTE) REFERENCES usuarios (ID_USUARIO),
ID_JUGUETE INT NOT NULL  COMMENT 'Identificador del juguete añadido al carrito.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO),
cantidadCompra INT NOT NULL  COMMENT 'Cantidad de unidades del juguete añadidas al carrito.' ,
preciocotizado float,
estatus Bit default 0 comment '0 no ha sido comprado, 1 ya se compró'
);

CREATE TABLE if not exists cotizaciones (
ID_cotizacion INT PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador.',
ID_JUGUETE INT NOT NULL COMMENT 'Identificador de la cotizacion.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO),
ID_USUARIO INT NOT NULL COMMENT 'Identificador del usuario CLIENTE',
FOREIGN KEY (ID_USUARIO) REFERENCES usuarios (ID_USUARIO),
ID_VENDEDOR INT NOT NULL COMMENT 'Identificador del usuario VENDEDOR',
FOREIGN KEY (ID_VENDEDOR) REFERENCES usuarios (ID_USUARIO),
precio FLOAT NOT NULL COMMENT 'Precio pedido.' ,
request bit default 0 comment '0 = no atendido, 1 = atendido',
response INT comment 'acepta el precio o no; 0 = nulo, 1 = aceptado, 2 = rechazados'
);

CREATE TABLE if not exists pedidosYventas (
ID_VENTA INT PRIMARY KEY AUTO_INCREMENT NOT NULL  COMMENT 'Identificador único de la compra/venta.',
fechaCOMPRA TIMESTAMP NOT NULL DEFAULT NOW()  COMMENT 'Fecha en que se hizo la compra/venta.',
precioFinalProducto FLOAT NOT NULL COMMENT 'Precio unitario al cual se comprò el juguete.',
cantidadCompradaVendida INT NOT NULL COMMENT 'Cantidad que se compro/vendio del juguete.',
#ID_ProductosCarrito INT NOT NULL,
#FOREIGN KEY (ID_ProductosCarrito) REFERENCES poductosCarrito (ID_CARRITO),
ID_JUGUETE INT NOT NULL  COMMENT 'Juguete que se compro/vendio.',
FOREIGN KEY (ID_JUGUETE) REFERENCES juguetes (ID_PRODUCTO),
ID_CLIENTE INT NOT NULL  COMMENT 'Identificador del cliente que compro el producto.',
FOREIGN KEY (ID_CLIENTE) REFERENCES usuarios (ID_USUARIO),
ID_VENDEDOR INT NOT NULL  COMMENT 'Identificador del vendedor del producto.',
FOREIGN KEY (ID_VENDEDOR) REFERENCES usuarios (ID_USUARIO)
);

INSERT into usuarios(nombre, apellido, nacimiento, usuario, correo, contrasenia, sexo, privacidad, foto, ID_ROL)
			VALUES ('Blanca', 'Trujillo', '15/05/2001', 'Blankury', 'b@gmail.com', 'contra', 'Mujer', 'Publico', 'imagenes/logo.png', '2');
