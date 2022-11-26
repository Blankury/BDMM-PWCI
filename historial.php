<?php
include('./templates/header.php');
?>

<section>
<br>
    <div class="container bg-light text-center" style="padding: 30px">

        
    <?php
        if ($_SESSION['ID_ROL']==1){
    ?>
            <h1 class="Titulos"> Consulta de compras  </h1>
            <label for=""> Debes comentar cada producto comprado para que aparezca en el historial. </label>

            <p> De esta fecha: </p>
            <input type="date" id="desde">
            <p> a esta fecha: </p>
            <input type="date" id="hasta">
            <br> <br>

            <button type="button" id="buscar_Compras" class="btn btn-primary btn-info" > Buscar compra </button>
            <hr>
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                        <span> Producto: </span> 
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-6">
                                <span> Cantidad: </span>
                                </div>
                                <div class="col-6">
                                <span> Precio: </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                        <span> Categoría: </span>
                        </div>
                        <div class="col-3">
                        <span> Calificacion dada al producto: </span>
                        </div>
                    </div>
                </div>
                <div class="Lista container" id="pedidos">
                    
                </div>
                <hr>
            </div>


    <?php
        } else  if ($_SESSION['ID_ROL']==2){
    ?>

        <h1 class="Titulos"> Consulta de ventas  </h1>
        <p> Para los vendedores</p>

        <p> De esta fecha: </p>
        <input type="date" id ='desde_2'>
        <p> a esta fecha: </p>
        <input type="date" id = 'hasta_2'>
        <br> <br>

        <button type="button" id="buscar_Ventas" class="btn btn-primary btn-info" > Buscar ventas </button>
        <hr>
        <div>
            <p> Consulta detallada </p>
            <br>
            
            <div class="Lista container" id="ventas_historia">
           
            </div>
            <hr>
        </div>

        <div>
            <p> Consulta agrupada </p>
            <span> <b> Mes: </b></span> <span> Mayo </span>
            <span> <b> Año: </b></span> <span> 3600 </span>

            <br> <br>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                    <span> Ventas: </span> 
                    </div>
                    <div class="col-6">
                    <span> Categoría: </span>
                    </div>
                </div>
            </div>
            <div class="Lista container">
                <div class="row">
                    <div class="col-6">
                    <span> 500 </span>
                    </div>
                    <div class="col-6">
                    <span> Categorías </span>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <h1 class="Titulos"> Mis jueguetes en venta </h1>
        <div class="container separadorDoble" >
            <div class="row">
                <div class="col-3" >
                    <img src="images/LOGO - copia.png" class="img-thumbnail" width="200px" alt="">                         
                </div>
                <div class="col-9 separador" >
                    <p> Categoria </p>
                    <p> Nombre producto </p>
                    <p> Existencia: </p>
                    <div align = "right">
                        <button type="button" id="Ver" class="btn btn-primmary bg-warning" style="right: 10px;"> Ver </button>
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-3" >
                    <img src="images/LOGO - copia.png" class="img-thumbnail" width="200px" alt="">                         
                </div>
                <div class="col-9 separador" >
                    <p> Categoria </p>
                    <p> Nombre producto </p>
                    <p> Existencia: </p>
                    <div align = "right">
                        <button type="button" id="Ver" class="btn btn-primmary bg-warning" style="right: 10px;"> Ver </button>
                    </div>
                </div>
            </div>                   
        </div>
    <?php
        }
    ?>


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
    <script src="./js/perfil.js"></script>
    <script src="./js/historial.js"></script>

</body>
</html>