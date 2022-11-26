
$.ajax({
    data: {action: 'getcarrito'},
    type: "POST",
    url: './controlador/carrito.php',
    async: false,
    success: function(result){
        //alert(result);
        var data = JSON.parse(result);
        console.log(data);
        for (let i = 0; i < data.length;i++){
            if (data[i].preciocotizado == 0 || data[i].preciocotizado == null)
                $("#Contenido_carrito").append('<div class="container-fluid separadorDoble"> <div class="row"> <div class="col-3 text-center" > <img src="'+ data[i].icono + '" class="img-thumbnail" width="200px" height = "200px" alt=""> </div><div class="col-5 bg-info separador"><h3 class="Titulos"> '+ data[i].nombre +'</h3> </div> <div class="col-2 bg-info text-center" style="padding: 10px;"> <p> Cantidad: '+ data[i].cantidadCompra +' </p> <p class="py-4">Total: MXN' + (data[i].cantidadCompra * data[i].precio) +'</p> </div><div class="col-2 bg-info separador"><div> <button type="button" id="Ver'+ data[i].ID_JUGUETE  +'"  value="'+  data[i].ID_JUGUETE + '" class="btn btn-primmary bg-warning VER" style="right: 10px;"> Ver </button><button type="button" id="Quitar'+  data[i].ID_JUGUETE +'" value="' +  data[i].ID_JUGUETE + '" class="btn btn-primmary bg-danger QUITAR" style="right: 10px;"> Quitar </button> </div></div></div> </div> <hr>');
            else           
                $("#Contenido_carrito").append('<div class="container-fluid separadorDoble"> <div class="row"> <div class="col-3 text-center" > <img src="'+ data[i].icono + '" class="img-thumbnail" width="200px" height = "200px" alt=""> </div><div class="col-5 bg-info separador"><h3 class="Titulos"> '+ data[i].nombre +'</h3> </div> <div class="col-2 bg-info text-center" style="padding: 10px;"> <p> Cantidad: '+ data[i].cantidadCompra +' </p> <p class="py-4">Total: MXN' + (data[i].cantidadCompra * data[i].preciocotizado) +'</p> </div><div class="col-2 bg-info separador"><div> <button type="button" id="Ver'+ data[i].ID_JUGUETE  +'"  value="'+  data[i].ID_JUGUETE + '" class="btn btn-primmary bg-warning VER" style="right: 10px;"> Ver </button><button type="button" id="Quitar'+  data[i].ID_JUGUETE +'" value="' +  data[i].ID_JUGUETE + '" class="btn btn-primmary bg-danger QUITAR" style="right: 10px;"> Quitar </button> </div></div></div> </div> <hr>');

        }
       
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});

$.ajax({
    data: {action: 'totalpagar'},
    type: "POST",
    url: './controlador/carrito.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        $("#TOTAL_PAGAR").html(data);
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});


$(document).ready(function(){
    $("#quitarTodo").click(function(){
        $("#No_hay").text("NO HAY PRODUCTOS.");

        $('#Contenido_carrito').empty();
    
    });

    $(".QUITAR").click(function(){
            alert($(this).val());
            $.ajax({
            type: "POST",
            url: './controlador/carrito.php',
            data: {action: 'deleteJuguetefromCarrito', ID_PRODUCTO: $(this).val()}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $("#form_pagar").submit(function(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: './controlador/carrito.php',
            data: {action: 'Pagar'}, 
            success: function(result) {
                alert(result);
                window.location.href = "inicio.php";

            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

});
