
$.ajax({
    data: {action: 'getcotiz'},
    type: "POST",
    url: './controlador/carrito.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        console.log(data);
        for (let i = 0; i < data.length;i++){
            $("#Contenido_aceptar").append('<div class="container-fluid separadorDoble"> <label for=""> Usuario: '+ data[i].usuario +'</label> <br> <label for=""> Producto: '+data[i].nombre+'</label> <br> <label for=""> Pago ofrecido: '+ data[i].precio+' </label> <br> <button type="button" value="'+ data[i].ID_cotizacion +'"  class="btn btn-primary btn-info aceptarprecio"> Aceptar </button> <button type="button" value=" '+ data[i].ID_cotizacion +'" id="" class="btn btn-primary btn_warning rechazarp"> Rechazar </button> </div> <hr>');
        }
       
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});
                                                                                                                                                                                                                       
$(document).ready(function(){
    $(".aceptarprecio").click(function(){
       alert($(this).val());
        $.ajax({
            data: {action: 'aceptarcot', cotiz: $(this).val()},
            type: "POST",
            url: './controlador/carrito.php',
            async: false,
            success: function(result){
                alert(result);               
            },
            error: function(result){
                console.log("La solicitud regreso con un error: " + result);
            }  
        });
    });
    $(".rechazarp").click(function(){
        alert($(this).val());

        $.ajax({
            data: {action: 'rechcot', cotiz: $(this).val()},
            type: "POST",
            url: './controlador/carrito.php',
            async: false,
            success: function(result){
                alert(result);              
            },
            error: function(result){
                console.log("La solicitud regreso con un error: " + result);
            }  
        });
    });
});
