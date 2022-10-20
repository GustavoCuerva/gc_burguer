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
        $nome = $categoria['categoria'];
        $nome_categoria = $processos->renomeia($nome);
        
        if (isset($_FILES['img'])){//Verificando se arquivo foi enviado

            $img = $_FILES['img']['name'];
            $extensao = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            if($extensao == 'jpg' || $extensao == 'JPG' || $extensao == 'png' || $extensao == 'PNG'){//Verificando extensão aceitavel

                $nome_img = $nome_categoria.'.'.$extensao;
                $diretorio = "../img/categoria/";

                // VERIFICANDO SE A CATEGORIA JÁ NÃO FOI CADASTRADA
                $consulta = $conexao->prepare("SELECT * FROM categoria WHERE nome_categoria = ?");
                $consulta->execute(array($nome_categoria));

                if ($consulta->rowCount()>0) {//Categoria já existe
                    
                    $_SESSION["msg"] = "<p style='color: red'>Categoria já existente</p>";
                    header("location: ../admin/categorias.php");
                
                }else{

                    if(move_uploaded_file($_FILES['img']['tmp_name'], $diretorio.$nome_img)){//Movendo arquivo para pasta
                        
                        $diretorio = "img/categoria/";
                        $img = $diretorio.$nome_img;
                        $data = date("Y-m-d");

                        $cadastro = $conexao->prepare("INSERT INTO categoria (categoria, nome_categoria, img, data_cadastro) values (?, ?, ?, ?)");
                        $cadastro->execute(array($nome, $nome_categoria, $img, $data));

                        $_SESSION["msg"] = "<p style='color: green'>Categoria criada com sucesso!</p>";
                        header("location: ../admin/categorias.php");
                    
                    }else{
                        $_SESSION["msg"] = "<p style='color: red'>Falha ao enviar o arquivo</p>";
                        header("location: ../admin/categorias.php");
                    }

                }

            }else{
                $_SESSION["msg"] = "<p style='color: red'>Selecione um arquivo png ou jpg</p>";
                header("location: ../admin/categorias.php");
            }
        }else{//Arquivo não enviado
            $_SESSION["msg"] = "<p style='color: red'>Envie uma imagem</p>";
            header("location: ../admin/categorias.php");
        }

    }else{
        header("location: ../admin/categorias.php");
    }
?>