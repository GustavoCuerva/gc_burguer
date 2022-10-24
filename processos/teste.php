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
    include("../config/conexao.php");
    
    // $cont = $conexao->query('SELECT * FROM salvos GROUP BY id_produto ORDER BY COUNT(ID_PRODUTO) DESC');
    // $resultado = $cont->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($resultado as $key => $value) {
    //     echo $value['id_produto']. "<br>";
    //     // echo $value['nome'] . "<br>";
    //     echo $value['id_salvo']. "<br>";
    //     echo "<hr>";
    // }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    echo $post['tel'];

?>
<form action="#" method="post">
    <input type="tel" name="tel" id="">
    <input type="submit" value="Enviar">
</form>
</body>
</html>
