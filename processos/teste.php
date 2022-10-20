<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include("../config/classes.php");
    $texto = "Testé sçsdçsa d  ^][sd}[!@ $# %&(&*%2 3 kadm";

    $processos = new Processos;

    $nome_certo = $processos->renomeia($texto);

    echo $nome_certo;

?>
</body>
</html>
