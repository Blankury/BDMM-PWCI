<?php
include('./templates/header.php');
?>

<section>
<br>
    <div class="container bg-light" style="padding: 30px">
      <div class="row">
        <div class="col-6 text-center">
          <img src="images/logo.png" alt="" width=370px height = 370px id="icono_product" >
          
          
          <br><br>
          
          <span id="imgs_extra"></span> <br><br>

          
        </div>

        <div class="col-6">
            
          <h5 class="Titulos" id = "nombre_vendedor"> Undefined</h5>
          <h1 class="Titulos" id="nombre_product_grande"> Producto </h1>
          <label>Nombre producto: </label> <label id="nombre_product"> </label> <br>
          
          <label > Categorías: </label>
          <span id="categorias_del_juguete">
          </span>
          <br>
          <label> Descripcion: </label> <label id="desc_product"> </label> <br> <br>
          <label> Precio: MXN </label> <label id="precio_product"> </label> <br> <br>
          <label id="Productocotizar" style="font-weight: bold;"></label> <br><br>
          <label> Cantidad disponible: </label> <label id="cantidad_product"> </label><br> <br>
          <label> Valoración promedio: </label>           

          <label> ★ </label>
          <label> ★ </label>
          <label> ★ </label>
          <label> ★ </label>
          <label> ★ </label> <label id="valoraciones">  </label>
          <br> <br>
          <div id="videos"></div>
          
        </div> 
      </div>
    <div  class="text-center">
        <br>
            <?php
                if ($_SESSION['ID_ROL']==1){
            ?>
            <div id="botones">            
                <button type="button" id="aListamodal" class="btn btn-primary btn-info" data-bs-toggle="modal" data-bs-target="#listModal"> Agregar a lista </button>
                <button type="button" id="facebook" class="btn btn-primary " onclick="compartir_producto()"> Compartir en facebook </button>
            </div>
            <?php
                } else if ($_SESSION['ID_ROL']==2){
            ?>
                <button type="button" id="EditarJuguete" class="btn btn-primary btn-info"> Editar </button>
                <button type="button" id="EliminarJuguete" class="btn btn-primary btn-info"> Eliminar </button>

            <?php
                }
            ?>
    </div>
    <hr>

    <?php
    if ($_SESSION['ID_ROL']==1){
    ?>
    <h1 class="Titulos"> Comentar </h1>
        <div><span>
            <form action="" method="POST" id="coment_form">
                <img src="images/logo.png" id="foto_de_comentario" alt="" width=40px>
                <label id ="nombre_usuario_c"> </label> <br> 
                <label for=""> Califica este producto:</label>
                <label class="clasificacion clas"> 
                       <input id="radio1" type="radio" name="estrellas" class="estrellas" value="5"><!--
                    --><label for="radio1">★</label><!--
                    --><input id="radio2" type="radio" name="estrellas" value="4" class="estrellas"><!--
                    --><label for="radio2">★</label><!--
                    --><input id="radio3" type="radio" name="estrellas" value="3" class="estrellas"><!--
                    --><label for="radio3">★</label><!--
                    --><input id="radio4" type="radio" name="estrellas" value="2" class="estrellas"><!--
                    --><label for="radio4">★</label><!--
                    --><input id="radio5" type="radio" name="estrellas" value="1" class="estrellas"><!--
                    --><label for="radio5">★</label>
                </label>
                <textarea name="comentario" id="comentario" cols="20" rows="4" class="full_input" placeholder="Añade un comentario del producto." require></textarea>    
                <input type="submit" id="Comentar" class="btn btn-primary btn-info"  value ="Enviar">
                <hr>
            </form>
        </span></div>
    <?php
      }
    ?>
     
    <h1 class="Titulos"> Comentarios </h1>

    <span id="comentarios">
    
    </span>
    

    <div class="container px-4">
        <div class="row">
            <div class="col-12 separadorDoble" style="background-color: pink;">
                <h4 class="Titulos"> Productos recomendados </h4>
                <div class="bg-light text-center" style="display: flex; overflow-x: scroll;">
                    <!-- for de productos -->
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper1.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper1.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper2.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper1.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper1.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>
                    <div style="padding: 20px 20px;">
                        <img src="images/wallpaper1.png" width="150px" alt="">                         
                    <p> Nombre del producto</p>
                    <span> categoria </span>
                    </div>               
                </div>
            </div>
        </div>                    
    </div>

    <div class="modal fade" id="cotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="inicio.php" method="POST" id="form_cotizacion">
            <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title Titulos" id="exampleModalLabel"> El juguete es para cotizar </h5>
                    </div>
                <div class="modal-body">
                    <div>
                        <label for="yes_no_radio"> Ingresa un precio razonable: </label>
                        <br> <br>
                        <input type="number" id="preciocotizado" min="1" required>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-warning" data-bs-dismiss="modal"> Cerrar </button>
                        <input type="submit" id="cotizacionCompleta" class="btn btn-primary btn-info" value="Enviar. " name="">
                    </div>
                </div>
            </form>
        </div>
    </div> 
    <div class="modal fade" id="añadirCarrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title Titulos" id="exampleModalLabel"> Unidades a comprar </h5>
                    </div>
                <div class="modal-body">
                    <input type="number" id="acomprar" name="acomprar" min="1"  value="1">
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-warning" data-bs-dismiss="modal"> Cerrar </button>
                        <button type="button" id="AñadirAlCarrito" class="btn btn-primary btn-info"  name="" > Añadir al carrito </button>
                    </div>
                </div>
        </div>
    </div> 
        


    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title Titulos" id="exampleModalLabel"> Listas públicas </h5>
                </div>
                <div class="modal-body">
                    <select id ="listasdisp"> </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-warning" data-dismiss="modal"> Cerrar </button>
                    <button type="button" id="aLista" class="btn btn-primary btn-info" data-bs-toggle="modal" data-bs-target="#listModal"> Agregar a lista </button>
                </div>
            </div>
        </div>
    </div>


</section>

<div class="container" >
        <FOOTer class="bg-info">
            <div class="text-center py-3">
                <fieldset>
                    <p> Universidad Autonoma de Nuevo Leon</p>
                    <p> Facultad de Ciencias Físico Matemáticas</p>
                    <p> © Blanca Elizabeth Delgadillo Trujillo 1986178</p>
                </fieldset>
            </div>
        </FOOTer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="./js/inicio.js"></script>
    <script src="./js/productos.js"></script>
    <script src="./js/perfil.js"></script>
    <script src="./js/busqueda.js"></script>
    <script src="./facebook/API.js"></script>

</body>
</html>