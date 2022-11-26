<?php
include('./templates/header.php');
?>

<section>
<br>
    <div class="container bg-light text-center" style="padding: 30px">
        <form action="" method="POST" id="form_actualizar" enctype = "multipart/form-data">
            
            <img src="images/Logo - copia.png"  style="border-radius: 50%;"  width = 200px height =200px alt="" id = "foto_pefil">
            <br> <br>
            <input type="file" name ="foto" id="foto" >
            <hr>
            <input type="text" class="full_input" style="width: 400px;" id= "ednombre" name="ednombre" placeholder ="Nombre" required>
            <input type="text" class="full_input" style="width: 400px;" id= "edapellido" name="edapellido" placeholder ="Apellido" required>
            <input type="text" class="full_input" style="width: 400px;" id= "edusuario" name= "edusuario" placeholder ="Usuario" required>
            <input type="text" class="full_input" style="width: 400px;" id= "edcorreoUsuario" name="edcorreoUsuario" placeholder ="Correo" required>
            <input type="date"  class="full_input" id= "ednacimiento" name="ednacimiento" style="width: 400px;" required>
            
            <?php
                if ($_SESSION['ID_ROL']==1){
            ?>
                <select name="Privacidad" id="edPrivacidad" class="full_input"  style="width: 400px;"  >
                    <option value="Publico"> Publico </option>
                    <option value="Privado"> Privado </option>
                </select>
            <?php
            }
            ?>
            
            
            <label style="width: 100%; margin-bottom: 20px; color: rgb(81, 95, 95);"> Sexo: </label>
                        <input  type="radio" name="Sexo" id="flexRadioDefault1" value="Hombre"  > 
                        <label class="form-check-label" for="flexRadioDefault1">Hombre </label>
                        <br> <br>
                        <input  type="radio" name="Sexo" id="flexRadioDefault2"  value="Mujer" >
                        <label class="form-check-label" for="flexRadioDefault2"> Mujer    
            </label>

            <hr>
            <input type="submit" id="Actualizar" class="btn btn-primary btn-info" value = "Actualizar">  </button>
        </form>
    </div>
</section>

<?php
include('./templates/footer.php');
?>