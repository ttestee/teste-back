<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if(isset($_GET["servidor"])){
    $servidor = $_GET["servidor"];
    
    $ping = @fsockopen($servidor, 80, $errno, $errstr, 5);

    if ($ping) {
        echo "online";
        fclose($ping);
    } else {
        echo "offline";
    }
} else {
    echo "Por favor, forneça o parâmetro 'servidor' na consulta.";
}
?>
