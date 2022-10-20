<?php
    // session_start();

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    class Processos{
        public function renomeia($nome){
            //Substituir os caracteres especiais
            $original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
            $substituir = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';	
            $nome_certo = strtr(utf8_decode($nome), utf8_decode($original), $substituir);
            
            //Substituir o espaco em branco pelo traco
            $nome_certo = str_replace(' ', '', $nome_certo);
            
            //Converter para minusculo
            $nome_certo = strtolower($nome_certo);

            return $nome_certo;
        }    
    }
    

?>