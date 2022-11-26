
const valores = window.location.search;

const urlParams = new URLSearchParams(valores);
var ID_PRODUCTO = urlParams.get("ID_PRODUCTO");

cargarinfo();
function cargarinfo(){

    $.ajax({
        data: {action: 'getJuguete', ID_PRODUCTO: ID_PRODUCTO},
        type: "POST",
        url: './controlador/juguetes.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);

            $("#valoraciones").html(data['jug'][0].valoracion);
            $("#nombre_vendedor").html(data['jug'][0].vendedor);
            $("#nombre_product_grande").html(data['jug'][0].nombre);
            $("#nombre_product").html(data['jug'][0].nombre);
            $("#desc_product").html(data['jug'][0].descripcion);
            $("#cantidad_product").html(data['jug'][0].cantidad);
            $("#precio_product").html(data['jug'][0].precio);
            if (data['jug'][0].tipoVenta == "Cotizar"){
                $("#Productocotizar").html(data['jug'][0].tipoVenta);
                if (data['jug'][0].cantidad > 0){
                    $("#botones").append('    <button type="button" id="aCarrito" class="btn btn-primary btn-info" data-bs-toggle="modal" data-bs-target="#cotModal"> Agregar al carrito </button> ' );
                    $("#acomprar").attr("max", data['jug'][0].cantidad );
                }
                

            }
            else{
                $("#Productocotizar").html("Venta");
                
                if (data['jug'][0].cantidad > 0){
                    $("#botones").append('    <button type="button" id="aCarrito" class="btn btn-primary btn-info" data-bs-toggle="modal" data-bs-target="#añadirCarrModal"> Agregar al carrito </button> ' );
                    $("#acomprar").attr("max", data['jug'][0].cantidad );
                }

            }
            $("#icono_product").attr("src",data['jug'][0].icono);
            for (let i = 0; i < data['jug'].length;i++){
                $("#categorias_del_juguete").append('<label> <a href=""> '+ data['jug'][i].categorias +'</a> </label> ' );
            }
            
            for (let i = 0; i < data['imgs'].length; i++){
                $("#imgs_extra").append('<img src=" '+ data['imgs'][i].imagen + '" alt="" width=170px height = 170px id="icono_product'+i+'">' );
            }
            for (let i = 0; i < data['vids'].length;i++){
                $("#videos").append('<video width="400" controls="controls" preload = "metadata" > <source src="'+data['vids'][i].video  +'"> </video>  ' );
            }            
            for (let i = 0; i < data['coment'].length;i++){
                if(data['coment'][i].calificación == 5){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }
                else if(data['coment'][i].calificación == 4){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }else if(data['coment'][i].calificación == 3){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }else if(data['coment'][i].calificación == 2){
                    $('#comentarios').append('<label> Calificacion: </label>  <label> ★ </label> <label> ★ </label> <br> ')
                } else if(data['coment'][i].calificación == 1){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <br> ')
                } 
                $("#comentarios").append('<img src="' + data['coment'][i].foto +'" alt="" width=40px> <label >'+ data['coment'][i].usuario  + '</label><br> <label> Enviado el </label> <label>'+ data['coment'][i].fechaCreacion +'  </label><br>  <p> '+  data['coment'][i].descripcionc +'</p> <br>' );
            }
    
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
    
    
}

function recargarcomentarios(){

    $.ajax({
        data: {action: 'getJuguete', ID_PRODUCTO: ID_PRODUCTO},
        type: "POST",
        url: './controlador/juguetes.php',
        async: false,
        success: function(result){  
            var data = JSON.parse(result);

            $("#valoraciones").html(data['jug'][0].valoracion);

            for (let i = 0; i < data['coment'].length;i++){
                if(data['coment'][i].calificación == 5){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }
                else if(data['coment'][i].calificación == 4){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }else if(data['coment'][i].calificación == 3){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <label> ★ </label> <label> ★ </label> <br> ')
                }else if(data['coment'][i].calificación == 2){
                    $('#comentarios').append('<label> Calificacion: </label>  <label> ★ </label> <label> ★ </label> <br> ')
                } else if(data['coment'][i].calificación == 1){
                    $('#comentarios').append('<label> Calificacion: </label> <label> ★ </label> <br> ')
                } 
                $("#comentarios").append('<img src="' + data['coment'][i].foto +'" alt="" width=40px> <label >'+ data['coment'][i].usuario  + '</label><br> <label> Enviado el </label> <label>'+ data['coment'][i].fechaCreacion +'  </label><br>  <p> '+  data['coment'][i].descripcionc +'</p> <br>' );
            }
    
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
    
    
}

$(document).ready(function(){  
    $("#aLista").click(function(){
            $.ajax({
                type: "POST",
                url: './controlador/listas.php',
                data: {action: 'setTOlist', ID_PRODUCTO: ID_PRODUCTO, ID_LISTA:  $("#listasdisp").val()}, 
                success: function(result) {
                    alert(result);
                }, error: function(result){
                    alert("Error en el php" + result);
                }
            })
    });
    $("#EliminarJuguete").click(function(){
        $.ajax({
            type: "POST",
            url: './controlador/juguetes.php',
            data: {action: 'eliminar', ID_PRODUCTO: ID_PRODUCTO}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
});

    $("#quitarTodo").click(function(){
        $.ajax({
            type: "POST",
            url: './controlador/carrito.php',
            data: { action: 'vaciar'}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $("#AñadirAlCarrito").click(function(){
        $.ajax({
            type: "POST",
            url: './controlador/carrito.php',
            data: {ID_PRODUCTO: ID_PRODUCTO, cantidad:  $("#acomprar").val(), action: 'agregarproducto'}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });




    $("#form_cotizacion").submit(function(event){
        event.preventDefault();
            $.ajax({
            type: "POST",
            url: './controlador/carrito.php',
            data: {ID_PRODUCTO: ID_PRODUCTO, PrecioDado: $("#preciocotizado").val(), action: 'cotizar'}, 
            success: function(result) {
                alert(result);
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });



    $("#EditarJuguete").click(function(){
        window.location.href = "editar_info_producto.php?ID_PRODUCTO="+ ID_PRODUCTO ;
    });
    
    $("#coment_form").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: './controlador/juguetes.php',
            data: {action: 'setComent', ID_PRODUCTO: ID_PRODUCTO, comentario: $("#comentario").val(), estrellas: $("input:radio[name=estrellas]:checked").val() }, 
            success: function(result) {
                if (result == '1'){
                    alert('Ya calificaste este producto antes..');
                }
                else if (result = 3){
                   alert( "Llena todos los campos.");

                }
                else{
                    $("#comentarios").empty();
                    recargarcomentarios();
                }


            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $("#form_registro_producto").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: './controlador/juguetes.php',
            data: new FormData(this),
            contentType: false, 
            processData: false, 
            success: function(result) {
                console.log(result);
                if (result == "Producto enviado a revision."){
                    window.location.href = "inicio.php";
                }
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

});
