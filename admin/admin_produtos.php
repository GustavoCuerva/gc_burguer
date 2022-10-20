<?php
    include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
      }
  
      if ($_SESSION['permissao'] != 1) {
          header("Location: ../index.php");
      }

      $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
      $id_categoria = 0;

      if (!isset($get['c'])) {
        header("location: painel.php");
      }
  
      // CONSULTA DAS CATEGORIAS
      $consulta = $conexao->query("SELECT * FROM categoria");
      $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">

    <title>Hamburgueria GC</title>
</head>
<body>
    
    <main class="corpo">

    <a href="painel.php"><img src="../icons/backward-svgrepo-com.svg" style="margin-top: 30px; margin-left:30px;" width="25px"></a>
        <div class="cabecalho_produtos">
            <a href="admin_produto.php?c=<?=$get['c']?>"><img src="../icons/add-svgrepo-com.svg" class="add_imagem"></a>

            <form class="filtro">
                <select name="filtro" id="filtro" onchange="filtro_categorias()">
                    <option value="1">Tudo</option>

                    <?php
                        foreach ($cat as $i => $categoria) {
                            $selected = "";
                            $id = md5($categoria['id_categoria']);

                            if ($id == $get['c']) {
                                $id_categoria = $categoria['id_categoria'];
                                $selected = "selected";
                            }
                    ?>

                        <option value="<?=$id?>" <?=$selected?>><?=$categoria['categoria']?></option>

                    <?php
                        }

                        //   CONSULTA DE PRODUTOS

                        $query_produtos = "SELECT * FROM produtos";

                        if ($get['c'] != 1) {
                            $query_produtos .= " WHERE id_categoria = $id_categoria";
                        }

                        $consulta_produtos = $conexao->prepare($query_produtos);
                        $consulta_produtos->execute();

                        $prod = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                </select>
            </form>
        </div>

        <section class="destaque populares">
        <?php
            include("../processos/msg.php");
        ?>
            <div class="produtos_populares produtos">

                <?php
                    foreach ($prod as $key => $produto) {
                        
                        $id_produto = md5($produto['id']);
                        $id_categoria = md5($produto['id_categoria']);

                        ?>
                        <a href="admin_produto.php?p=<?=$id_produto?>">
                            <div class="produto produto_popular">
                                <img src="../<?=$produto['imagem']?>" alt="">
                                <h3><?=$produto['nome']?></h3>
                                <p class="preco">R$ <?=$produto['valor']?></p>
                            </div>
                        </a>
                        <?php
                    }
                ?>
            </div>
        </section><!--Itens mais populares-->

        </main>

    <script src="../js/script.js"></script>
</body>
</html>