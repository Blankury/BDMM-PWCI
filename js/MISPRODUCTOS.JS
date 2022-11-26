
const valores = window.location.search;

const urlParams = new URLSearchParams(valores);
var ID_PRODUCTO = urlParams.get("ID_PRODUCTO");
    
    
    $.ajax({
        data: {action: 'getJuguete', ID_PRODUCTO: ID_PRODUCTO},
        type: "POST",
        url: './controlador/juguetes.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            alert(result);
    

            $("#Nombre_producto").val(data['jug'][0].nombre);
            $("#Descripcion").val(data['jug'][0].descripcion);
            $("#cantidad").val(data['jug'][0].cantidad);
            $("#precio").val(data['jug'][0].precio);


            $("#iconp").attr("src",data['jug'][0].icono);
            
            for (let i = 0; i < data['jug'].length;i++){
                $("#categorias_del_juguete").append('<label> <a href=""> '+ data['jug'][i].categorias +'</a> </label> ' );
            }
            
            for (let i = 0; i < data['imgs'].length; i++){
                $("#imgs_extra").append('<img src=" '+ data['imgs'][i].imagen + '" alt="" width=170px height = 170px id="icono_product'+i+'">' );
            }
            for (let i = 0; i < data['vids'].length;i++){
                $("#videos").append('<video width="400" controls="controls" preload = "metadata" > <source src="'+data['vids'][i].video  +'"> </video>  ' );
            }       
    
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
    
    



$.ajax({
    data: {action: 'getmisproductos'},
    type: "POST",
    url: './controlador/juguetes.php',
    async: false,
    success: function(result){
        var data = JSON.parse(result);
        for (let i = 0; i < data.length;i++){
            let autorizado;
            if (data[i].autorizado == 0){
                autorizado = "Aun no revisado";
            }
            else if (data[i].autorizado == 1){
                autorizado = "Autorizado";

            }
            else if (data[i].autorizado == 2){
                autorizado = "NO autorizado";

            }
            $("#Contenido_misproductos").append(' <div class="container-fluid separadorDoble"> <div class="row"> <div class="col-3 text-center" > <img src="'+ data[i].icono +'" class="img-thumbnail" width="200px" alt=""></div> <div class="col-9 bg-info separador">  <p> Vendedor: '+ data[i].vendedor +' </p> <p> Categorias: '+ data[i].categorias +' </p> <p> Nombre del juguete: ' + data[i].nombre +' </p> <p> Descripción del juguete: '+ data[i].descripcion +' </p> <p> Cantidad en stock: ' + data[i].cantidad + '</p> <p> Precio: MXN '+ data[i].precio +'  </p> <p> Tipo de venta: ' + data[i].tipoVenta + '</p> <p> Estatus: '+ autorizado +'</p> <button type="button" id="Ver' + data[i].ID_PRODUCTO +'" value="'+  data[i].ID_PRODUCTO + '" class="btn btn-primmary bg-warning VERau" style="right: 10px;"> Ver detalles completos </button>  </div></div> </div>');       

        }
    },
    error: function(result){
        console.log("La solicitud regreso con un error: " + result);
    }  
});

