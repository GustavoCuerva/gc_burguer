<?php
    session_start();

    if (!isset($_SESSION['permissao']) || $_SESSION['permissao'] ==0 ) {
        header("location: ../index.php");
    }else if ($_SESSION['permissao'] == 1) {
        header("location: painel.php");
    }
?>