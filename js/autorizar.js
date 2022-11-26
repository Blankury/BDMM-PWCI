
 $.ajax({
    data: {action: 'getSinAutorizar'},
    type: "POST",
    url: './controlador/juguetes.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        for (let i = 0; i < data.length;i++){
            $("#Contenido_Autorizar").append(' <div class="container-fluid separadorDoble"> <div class="row"> <div class="col-3 text-center" > <img src="'+ data[i].icono +'" class="img-thumbnail" width="200px" alt=""></div> <div class="col-9 bg-info separador">  <p> Vendedor: '+ data[i].vendedor +' </p> <p> Categorias: '+ data[i].categorias +' </p> <p> Nombre del juguete: ' + data[i].nombre +' </p> <p> Descripción del juguete: '+ data[i].descripcion +' </p> <p> Cantidad en stock: ' + data[i].cantidad + '</p> <p> Precio: MXN '+ data[i].precio +'  </p> <p> Tipo de venta: ' + data[i].tipoVenta + '</p> <button type="button" id="Ver' + data[i].ID_PRODUCTO +'" value="'+  data[i].ID_PRODUCTO + '" class="btn btn-primmary bg-warning VERau" style="right: 10px;"> Ver detalles completos </button>  </div></div> </div>');       

        }
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});

$(document).ready(function(){  
    $("#Autorizar").click(function(){
        alert(ID_PRODUCTO);
        $.ajax({
            type: "POST",
            url: './controlador/juguetes.php',
            data: {action: 'Autorizar', ID_PRODUCTO: ID_PRODUCTO }, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $("#Rechazar").click(function(){
        $.ajax({
            type: "POST",
            url: './controlador/juguetes.php',
            data: {action: 'Rechazar', ID_PRODUCTO:ID_PRODUCTO}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $(".VERau").click(function(){
        window.location.href = "autorizar_producto_principal.php?ID_PRODUCTO=" + $(this).val() ;
    });
});
