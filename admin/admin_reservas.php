<?php
    include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
      }
  
      if ($_SESSION['permissao'] != 1) {
          header("Location: ../index.php");
      }


    $filtro = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
    $hoje = date("Y-m-d");
    $select = array("", "", "", "");
    // CONSULTA RESERVAS
    if (!isset($filtro['f']) || $filtro['f'] <= 0 || $filtro['f'] > 3) {//Consulta padrão

        $consulta_reservas = $conexao->query("SELECT * FROM reservas ORDER BY status ASC");
        $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);

    }else if ($filtro['f'] == 1) {//Filtrando para mostrar reservas de hoje

        $consulta_reservas = $conexao->prepare("SELECT * FROM reservas WHERE data_reserva = ? ORDER BY status ASC");
        $consulta_reservas->execute(array($hoje));
        $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);
        $select[$filtro['f']] = "Selected";

    }else if ($filtro['f'] == 2) {//Filtrando para mostrar reservas da semana

        $sete_dias = date("Y-m-d", strtotime($hoje) + (7*24*60*60));

        $consulta_reservas = $conexao->prepare("SELECT * FROM reservas WHERE data_reserva BETWEEN ? AND ? ORDER BY status ASC");
        $consulta_reservas->execute(array($hoje, $sete_dias));
        $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);
        $select[$filtro['f']] = "Selected";

    }else if ($filtro['f'] == 3) {//Filtrando para mostrar reservas do mes

        $mes = date("Y-m-d", strtotime($hoje) + (30*24*60*60));

        $consulta_reservas = $conexao->prepare("SELECT * FROM reservas WHERE data_reserva BETWEEN ? AND ? ORDER BY status ASC");
        $consulta_reservas->execute(array($hoje, $mes));
        $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);
        $select[$filtro['f']] = "Selected";

    }
    

    $status = array("Confirmada", "Aguardando Confirmação", "Vencida", "Cancelada");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/painel.css">

    <title>Hamburgueria GC</title>
</head>
<body>
    
    <main class="corpo">

        <form action="#" method="post" class="filtro">
            <select name="filtro" id="filtro" onchange="filtro_reservas(this.value)">
                <option value="0" <?=$select[0]?>>Tudo</option>
                <option value="1" <?=$select[1]?>>Hoje</option>
                <option value="2" <?=$select[2]?>>Essa Semana</option>
                <option value="3" <?=$select[3]?>>Esse Mês</option>
            </select>
        </form>

        <section class="secao_reservas">
            <h2 class="h2-reservas">Reservas</h2>
            <?php
          foreach ($reservas as $key => $value) {
            $consulta_usuario = $conexao->query("SELECT * FROM usuarios WHERE id = ".$value['id_usuario']);
            $usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="reservas">
              <div class="box-reserva">
                          <h2><?=$value['data_reserva']?> - <?=$value['horario']?></h2>
                          <p><strong>Status:</strong> <span class="status"><?=$status[$value['status']]?></span></p>
                          <p><strong>Detalhes:</strong> <span class="detalhes"><?=$value['mesa']?></span> | <span class="detalhes"><?=$value['quantidade']?> Pessoas</span></p>
                          <p><strong>Nome:</strong> <span class="detalhes"><?=$usuario['nome']?></span></p>
                  </div>
              </div>
            </div>
            <?php
          }
        ?>
        </section><!--Reservas-->

        </main>

    <script src="../js/script.js"></script>
</body>
</html>