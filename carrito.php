<?php
include('./templates/header.php');
include('./paypal/config.php');
$productName = "Producto demostración";
$currency = "MXN";
$productPrice = 10;
$productId = 587965;
$orderNumber = 567;
?>

<section>
    
    <br>
    <div class="container bg-light" >
        <h2 class="Titulos"> Carrito </h5>
        <div id = "Contenido_carrito">
            <!-- Productos se llenan con un for-->
        </div>   
        <div>
            <hr>

            <div style="display:flex;  background-color: pink;" >                     
                <h3 class="Titulos text-center"> TOTAL: MXN</h3>
                <h3 class="Titulos text-center" id="TOTAL_PAGAR">  </h3>
            </div>

            <br>

            <div class="text-center">
                <button type="button" id="quitarTodo" class="btn btn-primmary bg-danger" style="right: 10px; "> Vaciar carrito </button>
                <button type="button" id="Comprar" class="btn btn-primmary bg-info" style="right: 10px;" data-bs-toggle="modal" data-bs-target="#Modalcompra" > Comprar </button>
            </div>

            <br>

        </div>
        
        <p id="No_hay"></p>

        
        <div class="modal fade" id="Modalcompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                    <div class="modal-header">
                        <h2 class="modal-title Titulos" id="exampleModalLabel"> Selecciona el método de pago </h2>
                    </div>
                <div class="modal-body">
                <form action="" method="POST" id="form_pagar">

                    <h5 class="modal-title Titulos" > Pago con tarjeta </h5>
                    <p> Ingresa el número de tarjeta </p>
                    <input type="text" required maxlength="16" minlength="16" > 
                    <input type="submit" id="pagar_carro" class="btn btn-primary btn-info " value="Pagar" name="pagar_carro">
                </form>

                    <h5 class=" Titulos" > Pago con Paypal </h5>
                    
                    <div id="paypal-button"></div>
                        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                        <script>
                            paypal.Button.render({
                            env: '<?php echo PayPalENV; ?>',
                            client: {
                                <?php if(ProPayPal) { ?>  
                                production: '<?php echo PayPalClientId; ?>'
                                <?php } else { ?>
                                sandbox: '<?php echo PayPalClientId; ?>'
                                <?php } ?>  
                            },
                            payment: function (data, actions) {
                                return actions.payment.create({
                                transactions: [{
                                    amount: {
                                    total:  $("#TOTAL_PAGAR").text(),
                                    currency: '<?php echo $currency; ?>'
                                    }
                                }]
                                });
                            },
                            onAuthorize: function (data, actions) {
                                return actions.payment.execute()
                                .then(function () {
                                    $.ajax({
                                    type: "POST",
                                    url: './controlador/carrito.php',
                                    data: {action: 'Pagar'}, 
                                    success: function(result) {
                                        alert(result);
                                        window.location = "<?php echo PayPalBaseUrl ?>orderDetails.php?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&pid=<?php echo $productId; ?>";
                                
                                    }, error: function(result){
                                        alert("Error en el php" + result);
                                    }
                                })
                            });
                            }
                            }, '#paypal-button');
                        </script>
                </div>
            </div>
        </div>

    </div>
</section>

<?php
include('./templates/footer.php');
?>