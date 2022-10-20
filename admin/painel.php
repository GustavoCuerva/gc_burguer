<?php
    include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
      header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    // CONSULTA DAS CATEGORIAS
    $consulta = $conexao->query("SELECT * FROM categoria");
    $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // CONSULTA DAS INFORMACOES
    $consulta_info = $conexao->query("SELECT * FROM informacoes_hamburgueiria");
    $info = $consulta_info->fetch(PDO::FETCH_ASSOC);

    $aberto = date("H:i", strtotime($info['horario_inicio']));
    $fechado = date("H:i", strtotime($info['horario_fim']));

    // CONSULTA RESERVAS
    $consulta_reservas = $conexao->query("SELECT * FROM reservas ORDER BY status ASC");
    $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);

    $status = array("Confirmada", "Aguardando Confirmação", "Vencida", "Cancelada");

    // CONSULTA RESERVAS DE HOJE
    $hoje = date("Y-m-d");
    $consulta_reservas_hoje = $conexao->query("SELECT * FROM reservas WHERE data_reserva = ".$hoje." AND status = 0");
    $reservas_hoje = $consulta_reservas_hoje->fetchAll(PDO::FETCH_ASSOC);

    $quantidade_hoje = 0;

    foreach ($reservas_hoje as $key => $value) {
      $quantidade_hoje += $value['quantidade'];
    }
?>
<!DOCTYPE html>
<html lang="pt  ">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/painel.css" />
    <title>Hamburgueria GC</title>
  </head>
  <body>
    
    <a href="../index.php"><img src="../icons/home-svgrepo-com.svg" width="20px" style="margin: 10px 0 0 10px;"></a>

    <!--Dados principais-->
    <section class="dados_principais">
      <div>
        <h3><?php echo $consulta_reservas->rowCount();?></h3>
        <p>Reservas Totais</p>
      </div>

      <div>
        <h3><?=$quantidade_hoje?>/<?=$info['capacidade']?></h3>
        <p>Capacidade esperada para hoje</p>
      </div>
    </section>
    <!--Dados principais-->

    <!--Produtos-->
    <section class="produtos">

    <?php
        foreach ($cat as $i => $categoria) {
          $id = md5($categoria['id_categoria']);
    ?>
      <a href="admin_produtos.php?c=<?=$id?>" style="background-image: url('../<?=$categoria['img']?>');">
        <div>
          <h2><?=$categoria['categoria']?></h2>
        </div>
      </a>
    <?php
        }
    ?>

      <a href="categorias.php" style="background-image: url('../img/template_hamburguer1.png');">
        <div>
          <h2>Categorias</h2>
        </div>
      </a>
    </section>
    <!--Produtos-->

    <!--Informações da empresa-->
    <section class="informacoes_empresa">
      <div>
        <p><strong>Horário:</strong> <?=$aberto?> ás <?=$fechado?></p>

        <p><strong>Localização: </strong></p>
        <p><?=$info['endereco']?></p>

        <p><strong>Capacidade: </strong> <?=$info['capacidade']?> Pessoas</p>

        <p><strong>Mesas:</strong> <?=$info['mesas']?></p>
      </div>

      <div>
        <a href="admin_info.php">Editar</a>
      </div>
    </section>
    <!--Informações da empresa-->

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

        <div class="reservas">
            <div class="box-reserva">
                        <h2>14/10 - 18:00</h2>
                        <p><strong>Status:</strong> <span class="status">Confirmada</span></p>
                        <p><strong>Detalhes:</strong> <span class="detalhes">Mesa 2</span> | <span class="detalhes">6 Pessoas</span></p>
                        <p><strong>Nome:</strong> <span class="detalhes">Gustavo Candido Cuerva</span></p>
                </div>
            </div>
        </div>
        <a href="admin_reservas.php">Ver mais</a>
    </section><!--Reservas-->
    <script src="../js/script.js"></script>
  </body>
</html>
