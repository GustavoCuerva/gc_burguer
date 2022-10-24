<?php
    include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
      }
  
      if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
      }

      $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);
  
      // CONSULTA DAS CATEGORIAS
      $consulta = $conexao->query("SELECT * FROM categoria");
      $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

    //   Padrão
    $required = "required";
    $imagem = $required;
    $url = "";
    $nome = "";
    $valor = "";
    $descricao = "";
    $img = "img/Logo2.png";

    if (isset($get['c'])) {
        // Foi passada uma categoria para cadastro
        $id_categoria = $get['c'];
    }else if (isset($get['p'])) {
        // Foi passado um produto para editar ou excluir

        $consulta_produtos = $conexao->query("SELECT * FROM produtos");

        $prods = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);

        $id_produto = null;

        foreach ($prods as $key => $value) {
            // Descripitografando id

            $md5 = md5($value['id']);

            if ($md5 == $get['p']) {
                $id_produto = $value['id'];
                break;
            }
        }

        if ($id_produto == null) {
            // Não encontrado o produto
            header("location: admin_produtos.php");
        }else{
            // Produto encontrado
            $consulta_produto = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
            $consulta_produto->execute(array($id_produto));

            $prod = $consulta_produto->fetch(PDO::FETCH_ASSOC);

            $imagem = "";
            $url = "?d=".$get['p'];
            $nome = $prod['nome'];
            $valor = $prod['valor'];
            $descricao = $prod['descricao'];
            $id_categoria = md5($prod['id_categoria']);
            $img = $prod['imagem'];
        }

    }else{
        header("location: admin_produtos.php");
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/painel.css" />

    <title>Hamburgueria GC</title>
</head>
<body>

    <div class="modal_alerta" style="display: none;">
            <div>
                <form action="../processos/proc_produto.php?x=<?=$get['p']?>" method="post">
                    <h2>Tem certeza que deseja excluir o produto?</h2>
                    <p>Essa ação não poderá ser desfeita.</p>
                    <p>Se desejar continuar clique em excluir.</p>
                    <input type="hidden" name="excluir" value="excluir">
                    <span style="background-color: blue;" onclick="alerta_excluir(1)">Cancelar</span>
                    <button style="background-color: red;">Excluir</button>
                </form>
            </div>
    </div>

    <section class="admin_produto">
        <div class="form_produto">
            <div style="display: flex; width:100%;">
                <a href="admin_produtos.php?c=1"><img src="../icons/backward-svgrepo-com.svg" width="25px"></a>
                <h2 style="flex: 1;">Novo produto</h2>
            </div>
            <form action="../processos/proc_produto.php<?=$url?>" method="post" enctype="multipart/form-data">
                
                <img src="../<?=$img?>" class="img_produto">

                <div class="container-form">
                    <?php
                        include("../processos/msg.php");
                    ?>
                    <div class="box-form">
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" id="nome" placeholder="Nome" value="<?=$nome?>" <?=$required?>>
                    </div>
                    <div class="box-form">
                        <label for="categoria">Categoria: </label>
                        <select name="categoria" id="categoria" <?=$required?>>
                            <option value=""></option>
                            
                            <?php
                                foreach ($cat as $i => $categoria) {
                                    $selected = "";
                                    $id = md5($categoria['id_categoria']);

                                    if ($id == $id_categoria) {
                                        $selected = "selected";
                                    }
                            ?>

                                <option value="<?=$id?>" <?=$selected?>><?=$categoria['categoria']?></option>

                            <?php
                                }
                            ?>

                        </select>
                    </div>
                    
                    <div class="box-form">
                        <label for="valor">Valor: R$</label>
                        <input type="text" name="valor" id="valor" placeholder="00,00" value="<?=$valor?>" <?=$required?>>
                    </div>

                    <div class="box-form">
                        <label for="descricao">Descrição: </label>
                        <textarea name="descricao" id="descricao" placeholder="Descrição" <?=$required?>><?=$descricao?></textarea>
                    </div>

                    <div class="box-form">
                        <label for="imagem">Adicione uma imagem</label>
                        <input type="file" name="imagem" id="imagem" style="display: none;" onchange="nova_preview();" <?=$imagem?>>
                    </div>
                                    
                    <div>
                        <input type="submit" name="enviar" value="Salvar" class="btn enviar" style="color: white;">
                    </div>

                    <?php
                        if (isset($get['p'])) {
                    ?>
                    <div>
                        <a onclick="alerta_excluir(3)" class="btn del" style="color: white; cursor: pointer; background-color: #ff0000d9;">Excluir</a>
                    </div>

                    <?php
                        }
                    ?>
                </div>
            </form>
        </div>
    </section>
        

    <script src="../js/script.js"></script>
</body>
</html>