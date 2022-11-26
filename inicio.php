<?php
include('./templates/header.php');
?>

<section >
    <br>

    <?php
        if ($_SESSION['ID_ROL'] != 1){   
    ?>
    <div class="container px-4">
        <div class="row">
            <div class="col-4 separadorDoble">

            <?php
                if ($_SESSION['ID_ROL']==2){ ?>
            <button type="button" id="pendientesdeAutori" class="btn btn-primary btn-info full_input"> Ver productos pendientes </button>

            <?php
                }
            ?>
            </div>
            <div class="col-4 separadorDoble">
            <?php
                if ($_SESSION['ID_ROL']==2){ ?>
            <button type="button" id="Agregar_Producto" class="btn btn-primary btn-info full_input"> Agregar Producto </button>

            <?php
                }else if ($_SESSION['ID_ROL']== 3) {
            ?>
                <button type="button" id="Autorizar_Producto" class="btn btn-primary btn-info full_input" > Autorizar Producto </button>
            <?php 
                }
            ?>
            </div>
            <div class="col-4 separadorDoble">
            <?php
                if ($_SESSION['ID_ROL']==2){ ?>
            <button type="button" id="cotizaPendiente" class="btn btn-primary btn-info full_input"> Cotizaciones </button>

            <?php
                }
            ?>


            </div>
        </div>                    
    </div>
    <?php
    }
    ?>

    <div class="container px-4"  >
        <div class="row">
            <div class="col-2 categorías py-2 px-4 bg-light">

                <h6 class="Titulos text-center"> CATEGORÍAS </h6>
                <div>
                    <!-- categorias se llenan en java script-->
                    <ul style="list-style:none;" id="categs">
                        
                    </ul>
                </div>
                <?php
                    if ($_SESSION['ID_ROL']==2){
                        echo '<button type="button" id="crearCategoria" class="btn btn-primary btn-info full_input" data-bs-toggle="modal" data-bs-target="#exampleModal" > Crear categoría </button>';
                }
                ?>
             
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="" method="POST" id="form_categorias">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title Titulos" id="exampleModalLabel"> Crear categoría</h5>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nombreCateg" id="nombreCateg" class="full_input" placeholder="Nombre de la categoría" required>
                                    <input type="text" name="descripcionCateg" id="descripcionCateg" class="full_input" placeholder="Descripcion" required >   
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn bg-warning" data-dismiss="modal"> Cerrar </button>
                                    <input type="submit" id ="crearCateg" class="btn btn-primary btn-info" value="Crear" name="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <div class="col-10 bg-light">
                <div class="container">
                    <h2 class="Titulos text-center"> JUGUETES </h2>
                </div>
                <h4 class="Titulos text-center"> Más vendidos </h4>

                <div id="container_juguetes">
                    <!-- Productos se llenan con un for-->
                    

                </div>

            </div>
        </div>
    </div>


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
                <div>

                </div>
                
                </div>
            </div>
        </div>                    
    </div>

</section>

<?php
include('./templates/footer.php');
?>