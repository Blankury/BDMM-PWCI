#-----------------------------PROCEDURES----------------------------------


delimiter ))
CREATE procedure sp_gestionUsuarios (	pAccion	tinyint,	PID_USUARIO INT,	Pnombre VARCHAR(50),	Papellido VARCHAR(50),	Pnacimiento VARCHAR(45),
				Pusuario VARCHAR(20),	Pcorreo VARCHAR(100),	Pcontrasenia VARCHAR(40),	Psexo VARCHAR(10),	Pprivacidad VARCHAR(10),	Pfoto LONGBLOB,    pID_ROL INT )
BEGIN
DECLARE id_user	INT; DECLARE id_rol_tem INT;
	set id_rol_tem = pID_ROL;
#Altas
	if pAccion = 1 then
		INSERT into usuarios(nombre, apellido, nacimiento, usuario, correo, contrasenia, sexo, privacidad, foto, ID_ROL)
		VALUES (Pnombre, Papellido, Pnacimiento, Pusuario, Pcorreo, Pcontrasenia, Psexo, Pprivacidad, Pfoto, pID_ROL);

       	set id_user = (SELECT ID_USUARIO FROM usuarios ORDER BY ID_USUARIO DESC LIMIT 1);

        if id_rol_tem = 1 then
			INSERT into carrito (ID_CLIENTE) VALUES (id_user);
        end if;
        
    end if;
#Identificar
	if pAccion = 2 then
		SELECT contrasenia, usuario, ID_ROL, ID_USUARIO, estatus FROM usuarios WHERE correo = Pcorreo;
    end if;
    if pAccion = 3 then
		SELECT estatus FROM usuarios WHERE correo = Pcorreo;
    end if;
#Cambios
	if pAccion = 4 then
		SELECT nombre, apellido, usuario, nacimiento, correo, sexo, fechaCreacion, foto, privacidad FROM usuarios WHERE usuario = Pusuario;
    end if;
	if pAccion = 5 then
		if (Pfoto = 'null') then
			UPDATE usuarios set  correo = Pcorreo ,  usuario = Pusuario , nombre = Pnombre, apellido = Papellido,	nacimiento = Pnacimiento, sexo = Psexo, privacidad = Pprivacidad where ID_USUARIO = PID_USUARIO and estatus = 1;
        else
			UPDATE usuarios set  correo = Pcorreo ,  usuario = Pusuario , foto = Pfoto, nombre = Pnombre, apellido = Papellido, nacimiento = Pnacimiento, sexo = Psexo, privacidad = Pprivacidad where ID_USUARIO = PID_USUARIO and estatus = 1;
        end if;
    end if;
#Bajas
	if pAccion = 6 then	#baja lógica
		UPDATE usuarios set estatus = 0 WHERE ID_USUARIO = PID_USUARIO;
    end if;
	if pAccion = 7 then	#baja física
		DELETE FROM usuarios WHERE ID_USUARIO = PID_USUARIO;
    end if;

END ))
delimiter ;


delimiter =)
CREATE procedure sp_GetCorreoContra (	pAccion	tinyint, Pusuario VARCHAR(20),	Pcorreo VARCHAR(100), pID_USUARIO int)
BEGIN
#RevisarCorreoParaeditar
	if pAccion = 1 then
		SELECT correo FROM usuarios WHERE correo = Pcorreo  AND ID_USUARIO != pID_USUARIO;
    end if;
#RevisarUsuarioParaeditar
	if pAccion = 2 then
		SELECT usuario FROM usuarios WHERE usuario = Pusuario  AND ID_USUARIO != pID_USUARIO;
    end if;
    if pAccion = 3 then
		SELECT correo FROM usuarios WHERE correo = Pcorreo;
    end if;
	if pAccion = 4 then
		SELECT usuario FROM usuarios WHERE usuario = Pusuario;
    end if;
END =)
delimiter ;

delimiter =)
CREATE procedure  sp_gestionCategorias (	pAccion	tinyint,	PID_CATEGORIA INT,	Pnombre VARCHAR(50),	Pdescripcion VARCHAR(500),	pID_VENDEDOR INT)
BEGIN
#Altas
	if pAccion = 1 then
		INSERT into categorias (nombre, descripcion, ID_VENDEDOR)
			VALUES (Pnombre, Pdescripcion, PID_VENDEDOR);
    end if;
#Seleccionar
	if pAccion = 2 then
		SELECT nombre, descripcion, ID_VENDEDOR, ID_CATEGORIA FROM categorias  ORDER BY nombre;
    end if;
END =)
delimiter ;

delimiter %%
CREATE procedure  sp_gestionListas (pAccion	tinyint,	PID_LISTA INT,	Pnombre VARCHAR(50),	Pdescripcion VARCHAR(500),	 pID_CLIENTE INT, Pprivacidad VARCHAR(50),Pimagenes LONGBLOB, pID_PRODUCTO INT)
BEGIN
	DECLARE id_list	INT;
	set id_list = (SELECT ID_LISTA FROM listas ORDER BY ID_LISTA DESC LIMIT 1);
#Altas
	if pAccion = 1 then
		INSERT into listas (nombre, descripcion, ID_CLIENTE, privacidad)
			VALUES (Pnombre, Pdescripcion, pID_CLIENTE, Pprivacidad);
    end if;
    if pAccion = 2 then
        INSERT into imageneslistas (ID_LISTA, ruta)
			VALUES (id_list, Pimagenes);
    end if;
	if pAccion = 3 then
			INSERT into deseos (ID_LISTA, ID_JUGUETE)
			VALUES (PID_LISTA, pID_PRODUCTO );
	end if;
    if pAccion = 4 then
		SELECT ID_LISTA, nombre, descripcion, fechaCreacion, propietario FROM viewlistainfo  WHERE ID_LISTA = PID_LISTA;
	end if;
     if pAccion = 5 then
		SELECT ID_LISTA, nombre FROM listas WHERE privacidad =  Pprivacidad;	end if;
     if pAccion = 6 then
		SELECT ID_LISTA, nombre FROM listas WHERE ID_CLIENTE =  pID_CLIENTE;
	end if;
    if pAccion = 7 then
		SELECT ID_LISTA, nombre, ID_PRODUCTO, icono FROM viewlistadeseos WHERE ID_LISTA  = PID_LISTA;
	end if;
    if pAccion = 8 then
		SELECT ruta FROM imageneslistas where ID_LISTA = PID_LISTA;
	end if;
END %%
delimiter ;

delimiter %%
CREATE procedure  sp_autorizar (pID_PRODUCTO INT)
BEGIN
	UPDATE juguetes set autorizado = 1 WHERE ID_PRODUCTO = pID_PRODUCTO;
END %%
delimiter ;


delimiter %%
CREATE procedure  sp_MISJUGUETES (pID_VENDEDOR INT)
BEGIN

SELECT ID_PRODUCTO, nombre, descripcion, tipoVenta, autorizado, valoracion, precio, cantidad, ID_VENDEDOR, icono, vendedor, categorias,  video, imagenes from viewJuguetesDelVendedorSINAUTORIZAR where ID_VENDEDOR = pID_VENDEDOR ;
END %%
delimiter ;

delimiter =)
CREATE procedure sp_gestionJuguetes (pAccion	tinyint,	pID_PRODUCTO INT,	Pnombre VARCHAR(100),	Pdescripcion VARCHAR(500),    PtipoVenta VARCHAR(30),    
				 Pvaloracion INT,    Pprecio FLOAT,    Pcantidad INT,	pID_VENDEDOR INT, Picono LONGBLOB, Pcategorias INT, Pvideos VARCHAR(500), Pimagenes LONGBLOB,
                 pID_ADMIN INT, Pautorizadojuguetes BIT)
BEGIN
#Altas
	if pAccion = 1 then
		INSERT into juguetes (nombre, descripcion, tipoVenta, valoracion, precio, cantidad, ID_VENDEDOR, icono)
			VALUES (Pnombre, Pdescripcion, PtipoVenta, Pvaloracion, Pprecio, Pcantidad, pID_VENDEDOR, Picono);
    end if;
    if pAccion = 2 then
		INSERT into imagenes (imagen, ID_JUGUETE)
			VALUES (Pimagenes, pID_PRODUCTO);
    end if;
    if pAccion = 3 then
		INSERT into videos (video, ID_JUGUETE)
			VALUES (Pvideos, pID_PRODUCTO);
    end if;
    if pAccion = 4 then
		INSERT into categoriajuguete(ID_JUGUETE, ID_CATEGORIA)
			VALUES (pID_PRODUCTO, Pcategorias);
    end if;
      if pAccion = 5 then
		SELECT ID_PRODUCTO, nombre, descripcion,tipoVenta, valoracion, precio, cantidad, ID_VENDEDOR, icono, vendedor, categorias, video, imagenes FROM viewJuguetesnoAUTORIZ;
    end if;
	if pAccion = 6 then

		SELECT ID_PRODUCTO, nombre, tipoVenta, precio, ID_VENDEDOR, icono, vendedor, ventas FROM viewJuguetesPorVenta where estatus = 1 order by ventas desc ;

#		SELECT ID_PRODUCTO, nombre, tipoVenta, precio, ID_VENDEDOR, icono, vendedor, ventas FROM viewJuguetesPorVenta order by ventas desc;
    end if;
    
    
END =)
delimiter ;

delimiter =)
CREATE procedure sp_gestionBusqueda (pAccion	tinyint, pBusqueda varchar(50))
BEGIN
#Altas
	if pAccion = 1 then
		SELECT ID_PRODUCTO, nombre, tipoVenta, precio, ID_VENDEDOR, icono, vendedor FROM viewJuguetesPorBusqueda  WHERE nombre like pBusqueda and estatus = 1 order by precio asc;
    end if;
    if pAccion = 2 then
		SELECT ID_PRODUCTO, nombre, tipoVenta, precio, ID_VENDEDOR, icono, vendedor  FROM viewJuguetesPorBusqueda WHERE nombre like pBusqueda and estatus = 1 order by precio desc;
    end if;
    if pAccion = 3 then
		SELECT usuario FROM usuarios WHERE usuario like pBusqueda;
    end if;
     if pAccion = 4 then
		SELECT ID_PRODUCTO, nombre, tipoVenta, precio, ID_VENDEDOR, icono, vendedor, categorias FROM viewJuguetesPorCategoria  WHERE categorias like pBusqueda and estatus = 1 order by precio desc;
    end if;
END =)
delimiter ;

delimiter &&
CREATE procedure sp_infoJUGUETE (pAccion tinyint, pID_PRODUCTO int)
BEGIN
	if pAccion = 1 then
		SELECT ID_PRODUCTO, nombre, descripcion, tipoVenta, precio, cantidad, ID_VENDEDOR, icono, vendedor, categorias, (select f_valoracion(pID_PRODUCTO)) valoracion
    FROM viewJugueteInfo WHERE ID_PRODUCTO = pID_PRODUCTO;
    end if;
    if pAccion = 2 then
		SELECT ID_JUGUETE, fechaCreacion, descripcion, calificación, usuario, foto FROM viewComentarios WHERE ID_JUGUETE = pID_PRODUCTO;
    end if;
    if pAccion = 3 then
		SELECT ID_PRODUCTO, video  FROM viewJugueteVIDS WHERE ID_PRODUCTO = pID_PRODUCTO;
    end if;
	if pAccion = 4 then
		SELECT ID_PRODUCTO, imagen FROM viewJugueteImg where ID_PRODUCTO = pID_PRODUCTO;
    end if;
    #baja logica
    if pAccion = 5 then
		UPDATE juguetes set estatus  = 0 where ID_PRODUCTO = pID_PRODUCTO;
    end if;
    #modificar
    if pAccion = 6 then
		SELECT ID_PRODUCTO, imagen FROM viewJugueteImg where ID_PRODUCTO = pID_PRODUCTO;
    end if;
     #modificar 2
    if pAccion = 7 then
		SELECT ID_PRODUCTO, imagen FROM viewJugueteImg where ID_PRODUCTO = pID_PRODUCTO;
    end if;
END &&
delimiter ;

delimiter &&
CREATE procedure sp_comentarios (pAccion tinyint, pID_PRODUCTO int, Pcomentario VARCHAR(500), Pcalificación INT, pID_USUARIO INT)
BEGIN
	if pAccion = 1 then
		if (SELECT count(ID_COMENTARIO) total from comentarios where ID_JUGUETE = pID_PRODUCTO AND ID_CLIENTE = pID_USUARIO) = 0 then
			INSERT into comentarios (descripcion, calificación, ID_CLIENTE, ID_JUGUETE) VALUES (Pcomentario, Pcalificación, pID_USUARIO, pID_PRODUCTO);
            SELECT count(ID_COMENTARIO) total from comentarios where ID_JUGUETE = pID_PRODUCTO AND ID_CLIENTE = pID_USUARIO;
		else
            SELECT count(ID_COMENTARIO) total from comentarios where ID_JUGUETE = pID_PRODUCTO AND ID_CLIENTE = pID_USUARIO;
        end if;
    end if;
    if pAccion = 2 then
		SELECT ID_JUGUETE, fechaCreacion, descripcion, calificación, usuario, foto FROM viewComentarios WHERE ID_JUGUETE = pID_PRODUCTO;
    end if;
END &&
delimiter ;




delimiter &&
CREATE procedure sp_cotizaciones (pAccion tinyint, pID_PRODUCTO int, pID_VENDEDOR INT, pID_cotizacion int)
BEGIN

DECLARE ID_CARRITO_tmp INT; declare pID_CLIENTE int; declare pPrecio float;
Set pID_CLIENTE = (SELECT ID_USUARIO from cotizaciones WHERE ID_cotizacion = pID_cotizacion);
Set ID_CARRITO_tmp = (SELECT ID_CARRITO from carrito WHERE ID_CLIENTE = pID_CLIENTE);
Set pPrecio = (select precio from cotizaciones WHERE ID_cotizacion = pID_cotizacion);
Set pID_PRODUCTO =(select ID_JUGUETE from cotizaciones WHERE ID_cotizacion = pID_cotizacion);

	if pAccion = 1 then
			UPDATE cotizaciones set response = 1, request = 1 where ID_cotizacion = pID_cotizacion;
            
			INSERT into poductoscarrito (ID_CARRITO, ID_JUGUETE, ID_CLIENTE, cantidadCompra, preciocotizado)
            VALUES (ID_CARRITO_tmp, pID_PRODUCTO, pID_CLIENTE, 1, pPrecio);
    end if;
    if pAccion = 2 then
			UPDATE cotizaciones set response = 2, request = 1  where ID_cotizacion = pID_cotizacion;
    end if;
    if pAccion = 3 then
		select a.ID_cotizacion, a.ID_JUGUETE, a.ID_USUARIO, a.precio, b.usuario, c.nombre
		from cotizaciones a inner join usuarios b on a.ID_USUARIO = b.ID_USUARIO 
        inner join juguetes c on a.ID_JUGUETE = c.ID_PRODUCTO where a.request = 0 AND a.ID_VENDEDOR = pID_VENDEDOR ;
    end if;
END &&
delimiter ;
 
delimiter ==
CREATE procedure sp_gestionCarrito (pAccion	tinyint, pID_PRODUCTO INT, pID_CLIENTE INT, PprecioPagar FLOAT, PcantidadCompra INT)
BEGIN
DECLARE ID_CARRITO_tmp INT; declare tipoventa_tmp VARCHAR(30); declare pID_VENDEDOR int;
Set ID_CARRITO_tmp = (SELECT ID_CARRITO from carrito WHERE ID_CLIENTE = pID_CLIENTE);
Set tipoventa_tmp = (SELECT tipoVenta from juguetes where ID_PRODUCTO = pID_PRODUCTO );
set pID_VENDEDOR = (select ID_VENDEDOR from juguetes where ID_PRODUCTO = pID_PRODUCTO);
#Altas
	if pAccion = 1 then
		if  tipoventa_tmp = 'Cotizar' then
			INSERT into poductoscarrito (ID_CARRITO, ID_JUGUETE, ID_CLIENTE, cantidadCompra, preciocotizado) VALUES (ID_CARRITO_tmp, pID_PRODUCTO, pID_CLIENTE, PcantidadCompra, 1);
        end if;
        if tipoventa_tmp = 'Vender' then
			INSERT into poductoscarrito (ID_CARRITO, ID_JUGUETE, ID_CLIENTE, cantidadCompra, preciocotizado) VALUES (ID_CARRITO_tmp, pID_PRODUCTO, pID_CLIENTE, PcantidadCompra, 0);
        end if;
    end if;
#Seleccion
    if pAccion = 2 then
		SELECT ID_CARRITO, ID_JUGUETE, preciocotizado, cantidadCompra, nombre, precio, icono, cantidad FROM viewCarrito WHERE  ID_CLIENTE = pID_CLIENTE and estatus = 0;
        
    end if;
#Compra
    if pAccion = 3 then
		UPDATE poductoscarrito set estatus = 1 where ID_CLIENTE = pID_CLIENTE;
		DELETE FROM poductoscarrito where ID_CLIENTE = pID_CLIENTE;
    end if;
#Totalprecio
	if pAccion = 4 then
		SELECT  f_precioAPagar(pID_CLIENTE) as total;
    end if;
#Vaciar
	if pAccion = 5 then
		DELETE FROM poductoscarrito where ID_CLIENTE = pID_CLIENTE;
    end if;
#Eliminar producto///
	if pAccion = 6 then
		DELETE FROM poductoscarrito where ID_CLIENTE = pID_CLIENTE and ID_JUGUETE = pID_PRODUCTO;
    end if;
    #cotizar///
	if pAccion = 7 then
		INSERT into cotizaciones (ID_USUARIO, ID_JUGUETE, ID_VENDEDOR, precio) VALUES (pID_CLIENTE, pID_PRODUCTO, pID_VENDEDOR , PprecioPagar);
    end if;
    
END ==
delimiter ;

    
delimiter &&
CREATE procedure sp_gestionHistorial (pAccion	tinyint, Pdesde VARCHAR(100), Phasta VARCHAR(100), pID_USUARIO int)
BEGIN
	if pAccion = 1 then
		SELECT a.ID_VENTA, a.fechaCOMPRA, a.cantidadCompradaVendida, a.precioFinalProducto, a.ID_CLIENTE, b.nombre, b.ID_PRODUCTO,  group_concat(distinct e.nombre ) categoria
		FROM pedidosyventas a INNER JOIN juguetes b ON a.ID_JUGUETE = b.ID_PRODUCTO INNER JOIN categoriajuguete c ON a.ID_JUGUETE = c.ID_JUGUETE
		INNER JOIN  categorias e ON e.ID_CATEGORIA = c.ID_CATEGORIA WHERE a.ID_CLIENTE = pID_USUARIO AND a.fechaCOMPRA between Pdesde and Phasta group by 1;
    end if;
#Seleccion
    if pAccion = 2 then
		SELECT a.ID_VENTA, a.fechaCOMPRA, a.cantidadCompradaVendida, a.precioFinalProducto, a.ID_CLIENTE, q.calificación, b.nombre, b.cantidad, group_concat(distinct e.nombre ) categoria
		FROM pedidosyventas a INNER JOIN juguetes b ON a.ID_JUGUETE = b.ID_PRODUCTO INNER JOIN categoriajuguete c ON a.ID_JUGUETE = c.ID_JUGUETE
		INNER JOIN  categorias e ON e.ID_CATEGORIA = c.ID_CATEGORIA INNER JOIN  comentarios q ON q.ID_JUGUETE = b.ID_PRODUCTO  WHERE a.ID_VENDEDOR =  pID_USUARIO AND a.fechaCOMPRA between  Pdesde and Phasta group by 1;
    end if;
    if pAccion = 3 then
		SELECT a.ID_VENTA, a.fechaCOMPRA, a.cantidadCompradaVendida, a.precioFinalProducto, a.ID_CLIENTE, b.nombre, b.cantidad, b.ID_PRODUCTO, b.valoracion, group_concat(distinct e.nombre ) categoria
		FROM pedidosyventas a INNER JOIN juguetes b ON a.ID_JUGUETE = b.ID_PRODUCTO INNER JOIN categoriajuguete c ON a.ID_JUGUETE = c.ID_JUGUETE
		INNER JOIN  categorias e ON e.ID_CATEGORIA = c.ID_CATEGORIA WHERE a.ID_VENDEDOR =  pID_USUARIO group by 1;
    end if;
END &&
delimiter ;