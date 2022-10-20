<?php
    include("../config/conexao.php");
    include("../config/classes.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    $categoria = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    $processos = new Processos;

    if ($categoria['add']) {

        // DESCRIPTOGRAFANDO O ID

        $consulta = $conexao->query("SELECT * FROM categoria");
        $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cat as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id_categoria']);

            if ($md5 == $get['d']) {
                // Encontrando a categoria

                $id_categoria = $value['id_categoria'];
                $file = "../".$value['img'];
                $input_categoria = $value['categoria'];

                break;
            }

        }

        $nome = $categoria['categoria'];
        $nome_categoria = $processos->renomeia($nome);
        $data = date("Y-m-d");

        // VERIFICANDO SE A CATEGORIA JÁ NÃO FOI CADASTRADA
        $consulta = $conexao->prepare("SELECT * FROM categoria WHERE id_categoria <> ? and nome_categoria = ?");
        $consulta->execute(array($id_categoria, $nome_categoria));

        if ($consulta->rowCount()>0) {
            //Categoria já existe
            
            $_SESSION["msg"] = "<p style='color: red'>Categoria já existente</p>";
            header("location: ../admin/categorias.php?d=".$get['d']);
        
        }else{
        // Não existe nenhuma categoria com esse nome

            if (isset($_FILES['img']['name']) && $_FILES['img']['name'] != ""){//Verificando se arquivo foi enviado

                $img = $_FILES['img']['name'];
                $extensao = strtolower(pathinfo($img, PATHINFO_EXTENSION));

                if($extensao == 'jpg' || $extensao == 'JPG' || $extensao == 'png' || $extensao == 'PNG'){// Verificando extensão aceitavel

                    $nome_img = $nome_categoria.'.'.$extensao;
                    $diretorio = "../img/categoria/";

                        // Excluindo arquivo antigo

                        if (file_exists($file)) {//Verificando se existe arquivo antigo
                            unlink($file);
                        }

                        if(move_uploaded_file($_FILES['img']['tmp_name'], $diretorio.$nome_img)){//Movendo arquivo para pasta
                            
                            $diretorio = "img/categoria/";
                            $img = $diretorio.$nome_img;

                            $editar = $conexao->prepare("UPDATE categoria SET categoria = ?, nome_categoria = ?, img = ? , data_cadastro = ? WHERE id_categoria = ?");
                            $editar->execute(array($nome, $nome_categoria, $img, $data, $id_categoria));

                            $_SESSION["msg"] = "<p style='color: green'>Categoria editada com sucesso!</p>";
                            header("location: ../admin/categorias.php");
                        
                        }else{
                            $_SESSION["msg"] = "<p style='color: red'>Falha ao enviar o arquivo, por favor o reenvie</p>";
                            header("location: ../admin/categorias.php?d=".$get['d']);
                        }

                }else{
                    $_SESSION["msg"] = "<p style='color: red'>Selecione um arquivo png ou jpg</p>";
                    header("location: ../admin/categorias.php?d=".$get['d']);
                }
            }else{
                //Não editar arquivo

                // Renomeando arquivo existente para evitar conflito
                $extensao = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                $img = "../img/categoria/".$nome_categoria.".".$extensao;
                
                rename($file, $img);

                $img = "img/categoria/".$nome_categoria.".".$extensao;

                $editar = $conexao->prepare("UPDATE categoria SET categoria = ?, nome_categoria = ?, img = ?, data_cadastro = ? WHERE id_categoria = ?");
                $editar->execute(array($nome, $nome_categoria,$img, $data, $id_categoria));
                $_SESSION["msg"] = "<p style='color: green'>Categoria editada com sucesso!</p>";
                header("location: ../admin/categorias.php");
            }
        }

    }else{
        header("location: ../admin/categorias.php");
    }
?>