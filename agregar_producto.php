<?php
include('./templates/header.php');
?>


<section>
<br>
    <div class="container bg-light text-center" style="padding: 30px">
        <h1 class="Titulos"> Subir producto </h1>
        <form action="inicio.php" method="POST" id="form_registro_producto" enctype = "multipart/form-data">
        Icono: <input type="file" required name="perfil_producto">
        <hr>
        
        <label style="width: 100%; margin-bottom: 20px; color: rgb(81, 95, 95);"> Nombre del juguete: </label>
            <input type="text" name = "nombre" class="full_input" style="width: 400px;" id="Nombre_producto" placeholder ="Nombre del juguete" required>
            <label style="width: 100%; margin-bottom: 20px; color: rgb(81, 95, 95);"> Descripcion: </label>
            <input type="textarea" name = "Descripcion" class="full_input" style="width: 400px;" id="Descripcion" placeholder ="Descripcion" required>
            <label style="width: 100%; margin-bottom: 20px; color: rgb(81, 95, 95);"> Precio (MXN): </label>
            <input type="number" name = "precio" class="full_input" style="width: 400px;" id="precio"  placeholder ="Precio" required>
            <label style="width: 100%; margin-bottom: 20px; color: rgb(81, 95, 95);"> Cantidad disponible: </label>
            <input type="number" name = "cantidad" class="full_input" style="width: 400px;" id="cantidad"  placeholder ="Cantidad disponible" required>
            <br><br>
            <select name="TipoVenta" id="">
                <option value="cotizar"> Cotizar </option>
                <option value="Vender"> Vender </option>
            </select>
            <br> <br>
            <div id= "categorias_selec" required>
                
            </div>
            <br> <br>
            Imágenes(mínimo 3): <input type="file" name="imagenes[]" multiple="" required>
            Vídeo: <input type="file" name="videos[]" multiple>
            <hr>
            <input type="submit" value="Enviar" multiple class="btn btn-primary btn-info">
        </form>
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

</body>
</html>