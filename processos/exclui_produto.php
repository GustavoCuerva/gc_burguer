<?php
    include("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    $produto = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    if ($produto['excluir']) {

        // DESCRIPTOGRAFANDO O ID

        $consulta = $conexao->query("SELECT * FROM produtos");
        $prod = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prod as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id']);

            if ($md5 == $get['x']) {
                // Encontrando a produto

                $id_produto = $value['id'];
                $file = "../".$value['imagem'];
                break;
            }

        }

        // EXCLUINDO

        if (file_exists($file)) {
            unlink($file);
        }

        $delete_produtos = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
        $delete_produtos->execute(array($id_produto));

        $delete_salvos = $conexao->prepare("DELETE FROM salvos WHERE id_produto = ?");
        $delete_salvos->execute(array($id_produto));

        $_SESSION["msg"] = "<p style='color: green'>Produto excluido com sucesso!</p>";
        header("location: ../admin/admin_produtos.php?c=1");

    }else{
        header("location: ../admin/admin_produtos.php?c=1");
    }
?>