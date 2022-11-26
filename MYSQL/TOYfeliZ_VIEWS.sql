
CREATE VIEW viewJuguetesDelVendedor AS
	SELECT ID_PRODUCTO, nombre, ID_VENDEDOR, icono, cantidad, autorizado FROM juguetes where ID_VENDEDOR = 1;



CREATE VIEW viewJuguetesPorCategoria AS
	SELECT a.ID_PRODUCTO, a.nombre, a.tipoVenta, a.estatus, a.precio, a.ID_VENDEDOR, a.icono, c.usuario as vendedor,  group_concat(distinct e.nombre) categorias
		FROM juguetes a INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO INNER JOIN categoriajuguete d ON a.ID_PRODUCTO = d.ID_JUGUETE
				INNER JOIN categorias e ON e.ID_CATEGORIA = d.ID_CATEGORIA WHERE autorizado = 1   group by 1;
			
CREATE VIEW viewJuguetesDelVendedorSINAUTORIZAR AS
    SELECT a.ID_PRODUCTO, a.nombre, a.descripcion, a.tipoVenta, a.autorizado, a.valoracion, a.precio, a.cantidad, a.ID_VENDEDOR, a.icono, c.usuario as vendedor, group_concat(distinct e.nombre) categorias, group_concat(distinct b.video) video, group_concat(distinct f.imagen) imagenes 
	FROM juguetes a
    INNER JOIN videos b ON b.ID_JUGUETE = a.ID_PRODUCTO
		INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO
			INNER JOIN categoriajuguete d ON a.ID_PRODUCTO = d.ID_JUGUETE
				INNER JOIN categorias e ON e.ID_CATEGORIA = d.ID_CATEGORIA
                INNER JOIN imagenes f ON f.ID_JUGUETE = a.ID_PRODUCTO group by 1 ;

SELECT ID_PRODUCTO, nombre, descripcion, tipoVenta, autorizado, valoracion, precio, cantidad, ID_VENDEDOR, icono, vendedor, categorias,  video, imagenes from viewJuguetesDelVendedorSINAUTORIZAR where ID_VENDEDOR = 1 ;
    
CREATE VIEW viewCarrito AS
SELECT a.ID_CARRITO, a.ID_JUGUETE, a.cantidadCompra, a.estatus, a.ID_CLIENTE, a.preciocotizado, c.nombre, c.precio, c.cantidad, c.icono FROM poductoscarrito a INNER JOIN carrito b ON b.ID_CARRITO = a.ID_CARRITO
INNER JOIN juguetes c ON a.ID_JUGUETE = c.ID_PRODUCTO;                

CREATE VIEW viewHistorialCliente AS
SELECT a.ID_VENTA, a.fechaCOMPRA, a.cantidadCompradaVendida, a.precioFinalProducto, a.ID_CLIENTE, b.nombre, b.ID_PRODUCTO,  group_concat(distinct e.nombre ) categoria
		FROM pedidosyventas a INNER JOIN juguetes b ON a.ID_JUGUETE = b.ID_PRODUCTO INNER JOIN categoriajuguete c ON a.ID_JUGUETE = c.ID_JUGUETE
		INNER JOIN  categorias e ON e.ID_CATEGORIA = c.ID_CATEGORIA group by 1;
        
CREATE VIEW viewJuguetesnoAUTORIZ AS            
    SELECT a.ID_PRODUCTO, a.nombre, a.descripcion, a.tipoVenta, a.valoracion, a.precio, a.cantidad, a.ID_VENDEDOR, a.icono, c.usuario as vendedor, group_concat(distinct e.nombre) categorias, group_concat(distinct b.video) video, group_concat(distinct f.imagen) imagenes 
	FROM juguetes a
    INNER JOIN videos b ON b.ID_JUGUETE = a.ID_PRODUCTO
		INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO
			INNER JOIN categoriajuguete d ON a.ID_PRODUCTO = d.ID_JUGUETE
				INNER JOIN categorias e ON e.ID_CATEGORIA = d.ID_CATEGORIA
                INNER JOIN imagenes f ON f.ID_JUGUETE = a.ID_PRODUCTO	WHERE autorizado = 0 group by 1;
                
SELECT ID_PRODUCTO, nombre, descripcion,tipoVenta, valoracion, precio, cantidad, ID_VENDEDOR, icono, vendedor, categorias, video, imagenes FROM viewJuguetesnoAUTORIZ;

CREATE VIEW viewlistadeseos AS
	SELECT a.ID_PRODUCTO, a.nombre, a.icono, b.ID_LISTA
		FROM juguetes a INNER JOIN deseos b ON b.ID_JUGUETE = a.ID_PRODUCTO
			WHERE autorizado = 1;

CREATE VIEW viewlistainfo AS
	SELECT a.ID_LISTA, a.nombre, a.descripcion, a.fechaCreacion, b.usuario as propietario 
		FROM listas a INNER JOIN usuarios b ON a.ID_CLIENTE = b.ID_USUARIO;
        
CREATE VIEW viewJuguetesPorBusqueda AS
	SELECT a.ID_PRODUCTO, a.nombre, a.tipoVenta, a.estatus, a.precio, a.ID_VENDEDOR, a.icono, c.usuario as vendedor
		FROM juguetes a INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO
			WHERE autorizado = 1;

CREATE VIEW viewJuguetesPorVenta AS
	SELECT a.ID_PRODUCTO, a.nombre, a.tipoVenta, a.precio, a.estatus, a.ID_VENDEDOR, a.icono, c.usuario as vendedor, sum(cantidadCompradaVendida) ventas
		FROM juguetes a INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO INNER JOIN pedidosyventas k ON k.ID_JUGUETE = a.ID_PRODUCTO
			WHERE autorizado = 1 
				GROUP BY a.ID_PRODUCTO;

CREATE VIEW viewJugueteInfo AS
SELECT a.ID_PRODUCTO, a.nombre, a.descripcion, a.tipoVenta, a.valoracion, a.precio, a.cantidad, a.ID_VENDEDOR, a.icono, c.usuario as vendedor, e.nombre as categorias
	FROM juguetes a
		INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO
			INNER JOIN categoriajuguete d ON a.ID_PRODUCTO = d.ID_JUGUETE
				INNER JOIN categorias e ON e.ID_CATEGORIA = d.ID_CATEGORIA;

CREATE VIEW viewJugueteInfo AS
SELECT a.ID_PRODUCTO, a.nombre, a.descripcion, a.tipoVenta, a.precio, a.cantidad, a.ID_VENDEDOR, a.icono, c.usuario as vendedor, e.nombre as categorias
	FROM juguetes a
		INNER JOIN usuarios c ON a.ID_VENDEDOR = c.ID_USUARIO
			INNER JOIN categoriajuguete d ON a.ID_PRODUCTO = d.ID_JUGUETE
				INNER JOIN categorias e ON e.ID_CATEGORIA = d.ID_CATEGORIA;
                
CREATE VIEW viewJugueteImg AS
	SELECT a.ID_PRODUCTO, b.imagen FROM imagenes b INNER JOIN juguetes a ON a.ID_PRODUCTO = b.ID_JUGUETE;


CREATE VIEW viewJugueteVIDS AS
	SELECT a.ID_PRODUCTO, b.video FROM videos b INNER JOIN juguetes a ON a.ID_PRODUCTO = b.ID_JUGUETE;
    
CREATE VIEW viewComentarios AS
	SELECT a.ID_JUGUETE, a.fechaCreacion, a.descripcion, a.calificación, c.usuario, c.foto FROM comentarios a
		INNER JOIN juguetes b ON a.ID_JUGUETE = b.ID_PRODUCTO
			INNER JOIN usuarios c ON a.ID_CLIENTE = c.ID_USUARIO;
 