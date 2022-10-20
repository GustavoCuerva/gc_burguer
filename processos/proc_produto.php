<?php
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
    
    if (isset($get['d'])) {
        //Editar
        include("edita_produto.php");
    }else if(isset($get['x'])){
        // Excluir 
        include("exclui_produto.php");
    }else{
        // Cadastrar
        include("cad_produto.php");
    }
?>