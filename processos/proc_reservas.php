<?php

$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

if (isset($get['confirma'])) {
    // Confirmar reserva
    include("confirma_reserva.php");
}else if (isset($get['cancela'])) {
    //Cancelar
    include("cancela_reserva.php");
}else{
    // Criar
    include("criar_reserva.php");
}

?>