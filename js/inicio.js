getCategorias();


$.ajax({
    data: {action: 'getJuguetes'},
    type: "POST",
    url: './controlador/juguetes.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        for (let i = 0; i < data['jug'].length;i++){
            

            if (data['jug'][i].tipoVenta == "Cotizar"){
                $("#container_juguetes").append('<div class="container-fluid separadorDoble" > <div class="row"> <div class="col-3 text-center" > <img src="' + data['jug'][i].icono +'" class="img-thumbnail" width="150px " height =150px alt=""> </div> <div class="col-9 bg-info separador" > <h4 id="Nombre producto"> ' +  data['jug'][i].nombre +'</h4> <label> Total de ventas: '+ data['jug'][i].ventas +'  </label> <br> <label> Disponible para cotizar '+ data['jug'][i].tipoVenta +' </label> <br> <label > Venta de: </label> <label > ' +  data['jug'][i].vendedor + '</label> <div align = "right"> <button type="button" id="Ver' + data['jug'][i].ID_PRODUCTO +'" value="'+  data['jug'][i].ID_PRODUCTO + '" class="btn btn-primmary bg-warning VER" style="right: 10px;"> Ver </button></div> </div> </div> </div> <hr>');
            }
            else{
                $("#container_juguetes").append('<div class="container-fluid separadorDoble" > <div class="row"> <div class="col-3 text-center" > <img src="' + data['jug'][i].icono +'" class="img-thumbnail" width="150px " height =150px alt=""> </div> <div class="col-9 bg-info separador" > <h4 id="Nombre producto"> ' +  data['jug'][i].nombre +'</h4> <label> Total de ventas: '+ data['jug'][i].ventas +' </label><br>  <label> MXN ' + data['jug'][i].precio +' </label> <br> <label > Venta de: </label> <label > ' +  data['jug'][i].vendedor + '</label> <div align = "right"> <button type="button" id="Ver' + data['jug'][i].ID_PRODUCTO +'" value="'+  data['jug'][i].ID_PRODUCTO + '" class="btn btn-primmary bg-warning VER" style="right: 10px;"> Ver </button></div> </div> </div> </div> <hr>');
            }
        }
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});


try{

    const valoresCAT = window.location.search;

    const urlParamsCAT = new URLSearchParams(valoresCAT);
    var busquedacat = urlParamsCAT.get("categoria");
    $('#container_juguetes').empty();

    
$.ajax({
    data: {action: 'getporCategoria', busqueda: busquedacat},
    type: "GET",
    url: './controlador/busqueda_ctrl.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        for(let i = 0; i < data.length; i++){
            $("#container_juguetes").append('<div class="container-fluid separadorDoble" > <div class="row"> <div class="col-3 text-center" > <img src="' + data[i].icono +'" class="img-thumbnail" width="150px " height =150px alt=""> </div> <div class="col-9 bg-info separador" > <h4 id="Nombre producto"> ' +  data[i].nombre +'</h4> <label> MXN ' + data[i].precio +' </label> <br> <label> Categorías: ' +  data[i].categorias +' </label> <label > Venta de: </label> <label > ' +  data[i].vendedor + '</label> <div align = "right"> <button type="button" id="Ver' + data[i].ID_PRODUCTO +'" value="'+  data[i].ID_PRODUCTO + '" class="btn btn-primmary bg-warning VER" style="right: 10px;"> Ver </button></div> </div> </div> </div> <hr>');
        }
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});
}catch (error){

}


$(document).ready(function(){
    
    $.ajax({
        data: {action: 'getlistas'},
        type: "POST",
        url: './controlador/listas.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            for (let i = 0; i < data.length;i++){
                $("#list_container").append('<li> <a href="ver_lista.php?lista=' + data[i].ID_LISTA  +'"><span><b> ' +data[i].nombre +'  </b> </span></a> </li>');
            }
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });

    $.ajax({
        data: {action: 'getlistaspublicas'},
        type: "POST",
        url: './controlador/listas.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            for (let i = 0; i < data.length;i++){              
                $("#listasdisp").append('<option value="'+ data[i].ID_LISTA +'"> '+ data[i].nombre+' </option>');
            }
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });  


    $("#Carrito").click(function(){
        window.location.href = "carrito.php";
    });
    $("#Listas").click(function(){
        window.location.href = "listas.php";
    });
    $("#Consultas").click(function(){
        window.location.href = "historial.php";
    });
    $("#logo").click(function(){
        window.location.href = "inicio.php";
    });
    $("#Agregar_Producto").click(function(){
        window.location.href = "agregar_producto.php";
    });
    $("#Autorizar_Producto").click(function(){
        window.location.href = "autorizar_producto.php";
    });
    $(".VER").click(function(){
        window.location.href = "producto.php?ID_PRODUCTO=" + $(this).val() ;
    });
    $("#cotizaPendiente").click(function(){
        window.location.href = "cotizaciones.php";
    });
    $("#pendientesdeAutori").click(function(){
        window.location.href = "misproductos.php" ;
    });


    $("#form_listas").submit(function(event){
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: './controlador/listas.php',
            data: new FormData(this),
            contentType: false, 
            processData: false, 
            success: function(result) {
                alert(result);
                $("#nombreLista").val("");
                $("#descLista").val("");
            }, error: function(result){
                alert("Error en el php" + result);
            }
        })
    });

    $("#FormSearch").submit(function(event){
        event.preventDefault();
        window.location.href = "busqueda.php?search=" + $("#busqueda").val() ;
    });

    $("#form_categorias").submit(function(event){
        if (campoVacioCat()){
            event.preventDefault();
            $.ajax({
                data: {nombreCateg: $("#nombreCateg").val(), descripcionCateg: $("#descripcionCateg").val(), action: 'setCategories'},
                type: "GET",
                url: './controlador/categorias.php',
                success: function(result) {
                    $("#categs").empty();       
                    getCategorias();
                    $("#nombreCateg").val("");
                    $("#descripcionCateg").val("");
                }, error: function(result){
                    alert("Error en el php" + result);
                }
            })
        }else{
            alert("Campos vacios");
            event.preventDefault();
        }
    });

});

function campoVacioCat(){
    if($("#nombreCateg").val().length < 1) {
        alert("Campo de nombre vacío.");
        return false;
    }
    if($("#descripcionCateg").val().length < 1 ) {
        alert("Campo de descripcion vacío.");
        return false;
    }

    return true;
};

function getCategorias(){
    $.ajax({
        data: {action: 'getCategories'},
        type: "GET",
        url: './controlador/categorias.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            for(let i = 0; i < data.length; i++){
                $("#categs").append('<li> <a href="porcategoria.php?categoria='+ data[i].nombre +'" >' + data[i].nombre + '</a>  </li>');       
                $("#categorias_selec").append('<label><input type="checkbox" name="categoria_Selec[]" value='+  data[i].ID_CATEGORIA +'><span> '+ data[i].nombre +'</span></label>');        
            }
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
}