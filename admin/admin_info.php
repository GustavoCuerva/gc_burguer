<?php
    include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
      }
  
      if ($_SESSION['permissao'] != 1) {
          header("Location: ../index.php");
      }

      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

      if (isset($post['editar'])) {
        // EDITAR
        $abri = $post['horario_inicio'];
        $fecha = $post['horario_fim'];
        $endereco = $post['endereco'];
        $capacidade = $post['capacidade'];
        $mesas = $post['mesas'];

        $atualizar = $conexao->prepare("UPDATE informacoes_hamburgueiria SET horario_inicio = ?, horario_fim = ?, endereco = ?, capacidade = ?, mesas = ? WHERE id = 1");
        $atualizar->execute(array($abri, $fecha, $endereco, $capacidade, $mesas));
      }

      // CONSULTA DAS CATEGORIAS
      $consulta = $conexao->query("SELECT * FROM informacoes_hamburgueiria");
      $info = $consulta->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/painel.css">
    
    <title>Hamburgueria GC</title>
</head>
<body>
    <section class="info_empresa">
    <a href="painel.php"><img src="../icons/backward-svgrepo-com.svg" style="margin-top: 30px; margin-left:30px;" width="25px"></a>
        <form action="#" method="POST">
            <h2>--Informações da Hamburgueria--</h2>
            <div>
                <label for="horario_inicio">Aberto das </label>
                <input type="time" name="horario_inicio" placeholder="00:00" value="<?=$info['horario_inicio']?>">
                <span> ás </span>
                <input type="time" name="horario_fim" placeholder="00:00" value="<?=$info['horario_fim']?>">
            </div>

            <div>
                <label for="endereco">Endereço: </label>
                <input type="text" name="endereco" placeholder="Avenida Paulista 2222" value="<?=$info['endereco']?>">
            </div>

            <div>
                <label for="capacidade">Capacidade</label>
                <input type="number" placeholder="50" name="capacidade" value="<?=$info['capacidade']?>"> <span>Pessoas</span>
            </div>

            <div>
                <label for="mesas">Mesas</label>
                <input type="number" placeholder="12" name="mesas" value="<?=$info['mesas']?>"> <span>Mesas</span>
            </div>

            <div>
                <input type="submit" name="editar" value="Editar">
            </div>
        </form>
    </section>

    <script src="../js/script.js"></script>
    
</body>
</html>