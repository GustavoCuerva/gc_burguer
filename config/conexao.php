<?php
// DEFININDO CONSTANTES DO BANCO DE DADOS
    define("HOST", "localhost");
    define("DB", "gc_burguer");
    define("USER", "root");
    define("PASS", "");

    try {
        $conexao = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "<h1>Erro ao se conectar, contacte o suporte</h1>";
    }

    date_default_timezone_set('America/Sao_Paulo');
    session_start();
?>