<?php
    include_once("../config/conexao.php");

    if(!isset($_SESSION['usuario'])){
        header("location: ../login.php");
    }

    // Resgatando get
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

    function desciptografar($var, $conexao){
        $consulta = $conexao->query("SELECT * FROM produtos");
        $produto = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($produto as $key => $prod) {
            $md5 = md5($prod['id']);
            if ($md5 == $var) {
                // Resgatando valores
                $id = $prod['id'];
                break;
            }
        }
        if (isset($id)) {
            return $id;
        }else{
            header("location: ../menu.php");
        }
    }

    if (isset($get['s'])) {
        // Salvar
        $id = desciptografar($get['s'], $conexao);

        // VERIFICAR SE JÁ NÃO ESTÁ SALVO
        $consulta = $conexao->prepare("SELECT * FROM salvos WHERE id_usuario = ".$_SESSION['id']." AND id_produto = ?");
        $consulta->execute(array($id));

        if ($consulta->rowCount()>0) {
            // Produto Já salvo
            $_SESSION['msg'] = "<p style='color: red;'>Produto já salvo</p>";
            header("Location: ../produto.php?p=".$get['s']);
        }else{
            // SALVANDO
            $salvar = $conexao->prepare("INSERT INTO salvos (id_usuario, id_produto, data) values (?,?,?)");
            $salvar->execute(array($_SESSION['id'], $id, date("Y-m-d")));

            $_SESSION['msg'] = "<p style='color: green;'>Salvo com sucesso</p>";
            header("Location: ../produto.php?p=".$get['s']);
        }
        
    }else if (isset($get['r'])) {
        // Remover dos salvos
        $id = desciptografar($get['r'], $conexao);

        // Buscando
        $consulta = $conexao->prepare("SELECT * FROM salvos WHERE id_usuario = ".$_SESSION['id']." AND id_produto = ?");
        $consulta->execute(array($id));

        if ($consulta->rowCount()>0) {
            // Produto Já salvo

            $salvo = $consulta->fetch(PDO::FETCH_ASSOC);

            $delete = $conexao->prepare("DELETE FROM salvos WHERE id_salvo = ?");
            $delete->execute(array($salvo['id_salvo']));

            $_SESSION['msg'] = "<p style='color: green;'>Removido dos salvos com sucesso</p>";
            header("Location: ../produto.php?p=".$get['r']);
        }else{
            // ERRO
            $_SESSION['msg'] = "<p style='color: red;'>Produto não está salvo</p>";
            header("Location: ../produto.php?p=".$get['r']);
        }
    }else{
        header("location: ../menu.php");
    }
?>