
#-----------------------------FUNCTIONS----------------------------------

delimiter =)
CREATE FUNCTION f_unidadesDisponibles ( fID_PRODUCTO smallint)
	RETURNS INT
READS SQL DATA
BEGIN
    DECLARE total_UNIDADES	INT;
	set total_UNIDADES = (SELECT cantidad	FROM juguetes WHERE ID_PRODUCTO = pID_PRODUCTO);
	return total_UNIDADES;
END =)
delimiter ;

delimiter (?
CREATE FUNCTION f_precioAPagar ( fID_CLIENTE int)
	RETURNS float
READS SQL DATA
BEGIN
    DECLARE totalcotizado float; DECLARE totalNormal float; Declare totalFinal float;
    set totalcotizado = (SELECT sum(a.preciocotizado) precioCotizado FROM poductoscarrito a INNER JOIN juguetes b on b.ID_PRODUCTO = a.ID_JUGUETE where ID_CLIENTE = fID_CLIENTE);
	set totalNormal = (SELECT sum(b.precio * a.cantidadCompra) preciojuguete FROM poductoscarrito a INNER JOIN juguetes b on b.ID_PRODUCTO = a.ID_JUGUETE where ID_CLIENTE = fID_CLIENTE );
    set totalFinal = totalcotizado + totalNormal;
	return totalFinal;
END (?
delimiter ;

delimiter (?
CREATE FUNCTION f_valoracion ( fID_PRODUCTO float)
	RETURNS float
READS SQL DATA
BEGIN
    DECLARE promedio float;
	set promedio = (SELECT sum(calificación)/count(calificación) FROM comentarios WHERE ID_JUGUETE = fID_PRODUCTO);
	return promedio;
END (?
delimiter ;
