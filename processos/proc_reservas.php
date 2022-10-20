<?php

$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
    
if (isset($get['d'])) {
    //Editar
    include(".php");
}else if(isset($get['x'])){
    // Excluir 
    include(".php");
}else{
    // Criar
    include("criar_reserva.php");
}

?>