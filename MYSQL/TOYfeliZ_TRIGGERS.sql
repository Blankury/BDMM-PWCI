DELIMITER =)
CREATE TRIGGER tg_añadiraHistorial AFTER UPDATE ON poductoscarrito for each row
begin
	declare precios float; declare ID_VENDEDORs int; 
    set precios = (select precio from juguetes where ID_PRODUCTO = new.ID_JUGUETE);
    set ID_VENDEDORs = (select ID_VENDEDOR from juguetes where ID_PRODUCTO = new.ID_JUGUETE);
    
    if (new.preciocotizado = 0) then
		insert into pedidosyventas(precioFinalProducto, cantidadCompradaVendida, ID_JUGUETE, ID_CLIENTE, ID_VENDEDOR)
		values(precios, new.cantidadCompra, new.ID_JUGUETE,new.ID_CLIENTE, ID_VENDEDORs);
	end if;
	if (new.preciocotizado > 0) then
		insert into pedidosyventas(precioFinalProducto, cantidadCompradaVendida, ID_JUGUETE, ID_CLIENTE, ID_VENDEDOR)
		values(new.preciocotizado, new.cantidadCompra, new.ID_JUGUETE,new.ID_CLIENTE, ID_VENDEDORs);    
    end if;
end=)
DELIMITER ;
 
DELIMITER $$
CREATE TRIGGER tg_bajarcantidad AFTER INSERT ON pedidosyventas for each row
begin 
declare rest int;
set rest = (select cantidad from juguetes where ID_PRODUCTO = new.ID_JUGUETE) - new.cantidadCompradaVendida ;
update juguetes set cantidad = rest where ID_PRODUCTO = new.ID_JUGUETE;
end$$
DELIMITER tg_bajarcantidad;


