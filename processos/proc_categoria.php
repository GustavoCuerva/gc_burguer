<?php
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
    
    if (isset($get['d'])) {
        //Editar
        include("edita_categoria.php");
    }else if(isset($get['x'])){
        // Excluir 
        include("exclui_categoria.php");
    }else{
        // Cadastrar
        include("cad_categoria.php");
    }
?>