<?php
    include("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    $categoria = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    if ($categoria['add']) {

        // DESCRIPTOGRAFANDO O ID

        $consulta = $conexao->query("SELECT * FROM categoria");
        $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cat as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id_categoria']);

            if ($md5 == $get['x']) {
                // Encontrando a categoria

                $id_categoria = $value['id_categoria'];
                $file = $value['img'];
                break;
            }

        }

        // EXCLUINDO

        if (file_exists($file)) {
            unlink($file);
        }

        $delete_categoria = $conexao->prepare("DELETE FROM categoria WHERE id_categoria = ?");
        $delete_categoria->execute(array($id_categoria));

        // Excluindo produtos
        $consulta_produtos = $conexao->prepare("SELECT * FROM produtos WHERE id_categoria = ?");
        $consulta_produtos->execute(array($id_categoria));

        $prod = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prod as $key => $value) {

            $file2 = "../".$value['imagem'];

            if (file_exists($file2)) {
                unlink($file2);
            }

            $delete_produtos = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
            $delete_produtos->execute(array($value['id']));   
        }

        $_SESSION["msg"] = "<p style='color: green'>Categoria excluida com sucesso!</p>";
        header("location: ../admin/categorias.php");

    }else{
        header("location: ../admin/categorias.php");
    }
?>