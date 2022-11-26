<?php
define('ProPayPal', 0);
if(ProPayPal){
    define("PayPalClientId", "ASv84BO86jsVZTfWGTk-PpUmQWVdvOCgVEpSCd5oFB31EmIsz960472O96YCyn01LiloA9MACwDc0XPv");
    define("PayPalSecret", "ENtAlkGX6NZAImpjxw2Q0aWq4D0cr4PDsY5_dw56fJTiWq0tmYOQtdMWcXCT2-W4VIdJA6y8mUfyhi5b");
    define("PayPalBaseUrl", "http://localhost/BDMMyPWCI_PIA/");
    define("PayPalENV", "production");
} else {
    define("PayPalClientId", "ASv84BO86jsVZTfWGTk-PpUmQWVdvOCgVEpSCd5oFB31EmIsz960472O96YCyn01LiloA9MACwDc0XPv");
    define("PayPalSecret", "ENtAlkGX6NZAImpjxw2Q0aWq4D0cr4PDsY5_dw56fJTiWq0tmYOQtdMWcXCT2-W4VIdJA6y8mUfyhi5b");
    define("PayPalBaseUrl", "http://localhost/BDMMyPWCI_PIA/");
    define("PayPalENV", "sandbox");
}
?>