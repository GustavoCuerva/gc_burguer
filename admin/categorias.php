<?php
include_once("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    // SELECIONANDO CATEGORIAS

    $consulta = $conexao->query("SELECT * FROM categoria");
    $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Padrão
    $botao = "Adicionar";
    $cor = "#ff9a00";
    $input_categoria = "";
    $url = "";
    $required = "required";

    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

    if (isset($get['d'])) {
        //Editar categoria
        
        $botao = "Editar";
        $cor = "rgb(17, 17, 185)";
        
        foreach ($cat as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id_categoria']);

            if ($md5 == $get['d']) {
                // Encontrando a categoria

                $input_file = "../".$value['img'];
                $input_categoria = $value['categoria'];

                $url = "?d=".$get['d'];

                break;
            }

        }
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

    <?php
        if (isset($get['x'])) {

            //Excluir categoria
        
            $botao = "Excluir";
            $cor = "red";
            
            foreach ($cat as $i => $value) {
                // DESCRIPTOGRAFANDO
                $md5 = md5($value['id_categoria']);

                if ($md5 == $get['x']) {
                    // Encontrando a categoria

                    $input_categoria = $value['categoria'];

                    $url = "?x=".$get['x'];

                    $required = "disabled";
                    
                    break;
                }

            }

            // ALERTA SOBRE EXCLUIR
    ?>
        <div class="modal_alerta">
            <div>
                <h2>Tem certeza que deseja excluir a categoria <?=$input_categoria?>?</h2>
                <p>Essa ação não poderá ser desfeita e todos os itens dessa categoria também serão excluidos de forma permanente.</p>
                <p>Se desejar continuar clique em continuar e depois em excluir.</p>
                <button style="background-color: blue;" onclick="alerta_excluir(0)">Cancelar</button>
                <button style="background-color: red;" onclick="alerta_excluir(1)">Continuar</button>
            </div>
        </div>
    <?php
        }
    ?>

    <a href="painel.php"><img src="../icons/backward-svgrepo-com.svg" style="margin-top: 30px; margin-left:30px;" width="25px"></a>
    <section class="add_categoria">
        <form action="../processos/proc_categoria.php<?=$url?>" method="post" enctype="multipart/form-data">

            <div class="itens_form_categoria">
                <label for="categoria">Categoria: </label>
                <input type="text" name="categoria" placeholder="Categoria" value="<?=$input_categoria?>" <?=$required?>>
            </div>

            <?php
                // Verificando possivel edição

                if (isset($input_file)) {
                    ?>
                    <div class="itens_form_categoria">
                        <label for="img" style="cursor:pointer;"> <img src="<?=$input_file?>" style="width: 150px; margin-right: 10px;"> Alterar a imagem: </label>
                        <input type="file" name="img" id="img">
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="itens_form_categoria">
                        <label for="img">Adicione uma imagem: </label>
                        <input type="file" name="img" id="img" <?=$required?>>
                    </div>
                    <?php
                }
            ?>

            <input type="submit" name="add" style="background-color: <?=$cor?>;" value="<?=$botao?>" class="itens_form_categoria">
        </form>
    </section>

    <section class="produtos categorias">
        <?php
            include("../processos/msg.php");

            foreach ($cat as $i => $categoria) {
                // Percorrendo categoria

                $id = md5($categoria['id_categoria']);
                ?>
                <div class="categoria" style="background-image: url('../<?=$categoria['img']?>');">
            
                    <div class="botoes">
                        <a href="categorias.php?d=<?=$id?>" class="botao editar">Editar</a>
                        <a href="categorias.php?x=<?=$id?>" class="botao excluir">Excluir</a>
                    </div>

                    <div>
                        <h2><?=$categoria['categoria']?></h2>
                    </div>
                </div>
                <?php
            }
        ?>
    </section>

    <script src="../js/script.js"></script>
</body>

</html>