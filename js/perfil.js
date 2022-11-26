
const valores3 = window.location.search;

const urlParams3 = new URLSearchParams(valores3);
var username = urlParams3.get("user");

informaciónvariaspantallas();
infoperfil();

function informaciónvariaspantallas(){
    $.ajax({
        data: {action: 'getInfouser'},
        type: "POST",
        url: './controlador/perfil.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            //header
            $("#icon").attr("src",data[0].foto);
            $("#nombre_usuario").html(data[0].usuario);
            //comentarios
            $("#nombre_usuario_c").html(data[0].usuario);
            $("#foto_de_comentario").attr("src", data[0].foto);  
    
            //perfil_edicion
            $("#edusuario").val(data[0].usuario);
            if (data[0].sexo == "Mujer"){
                $("#flexRadioDefault2").prop("checked", true);
    
            }else{
                $("#flexRadioDefault1").prop("checked", true);
    
            }
            $("#edPrivacidad").val(data[0].privacidad);
            $("#ednombre").val(data[0].nombre);
            $("#ednacimiento").val(data[0].nacimiento);
            $("#edcorreoUsuario").val(data[0].correo);
            $("#foto").attr("src",data[0].foto);
            $("#edapellido").val( data[0].apellido);
        
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
}


function infoperfil(){
    $.ajax({
        data: {action: 'getPERFIL', user: username},
        type: "POST",
        url: './controlador/perfil.php',
        async: false,
        success: function(result){
            var data = JSON.parse(result);
            if (data[0].usuario != $("#nombre_usuario").html()){
                $("#USER").html(data[0].usuario);
                $("#PRIVACIDAD").html(data[0].privacidad);
                $("#foto_pefil").attr("src",data[0].foto);

                if (data[0].privacidad != 'Privado'){
                    $("#NOMBRES").html(data[0].nombre + " " + data[0].apellido);
                    $("#NACIMIENTO").html(data[0].nacimiento);
                    $("#CORREO").html(data[0].correo);
                    $("#UNIONALAPLATAFORMA").html(data[0].fechaCreacion);
                }else{
                    $("#NOMBRES").html(" " );
                    $("#NACIMIENTO").html('');
                    $("#CORREO").html('');
                    $("#UNIONALAPLATAFORMA").html('');
                    $("#txtq").html('');
                    $("#listas_usuario").empty();
            }
            }else{
                $("#USER").html(data[0].usuario);
                $("#PRIVACIDAD").html(data[0].privacidad);
                $("#foto_pefil").attr("src",data[0].foto);        
                $("#NOMBRES").html(data[0].nombre + " " + data[0].apellido);
                $("#NACIMIENTO").html(data[0].nacimiento);
                $("#CORREO").html(data[0].correo);
                $("#UNIONALAPLATAFORMA").html(data[0].fechaCreacion);
                $("#perfilbuttons").append(' <button type="button" id="Editar" class="btn btn-primary btn-info"> Editar </button> <button type="button" id="BorrarCuenta" class="btn btn-primary btn-info"> Desactivar Cuenta </button> <button type="button" id="cerrarSesion" class="btn btn-primary btn-info"> Cerrar Sesion </button>');

            }
                    
        },
        error: function(result){
            console.log("La solicitud regreso con un error: " + result);
        }  
    });
}


$(document).ready(function(){
    $("#cerrarSesion").click(function(){
        $.ajax({
            url: './controlador/cerrarSesion.php',
            success: function(){
                window.location.href = "index.php";
            },
            error: function(data){
                alert("Error");
            }
   
        });
    });
    
    $("#Editar").click(function(){
        window.location.href = "perfil_usuario_edicion.php";
    });

    $("#BorrarCuenta").click(function(){
        $.ajax({
            data: {action: 'desactivar'},
            type: "POST",
            url: './controlador/perfil.php',
            async: false,
            success: function(result){
                alert(result);
                window.location.href = "index.php";
            },
            error: function(data){
                alert("Error");
            }
   
        });
    });
    

    $("#form_actualizar").submit(function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: './controlador/perfil.php',
                data: new FormData(this),
                contentType: false, 
                processData: false, 
                success: function(result) {
                    
                    console.log(result);
                    if (result == 1){
                        alert('se actualizó el perfil.');

                        window.location.href = "perfil_usuario.php?user=" + $("#edusuario").val();
                    }
                }, error: function(result){
                    alert("Error en el php" + result);
                }
            })        
    });
});