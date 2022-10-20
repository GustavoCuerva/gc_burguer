<?php
    include("../config/conexao.php");
    include("../config/classes.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    if ($_SESSION['permissao'] != 1) {
        header("Location: ../index.php");
    }

    $produto = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    $processos = new Processos;

    if ($produto['enviar']) {

        // DESCRIPTOGRAFANDO O ID Produto

        $consulta = $conexao->query("SELECT * FROM produtos");
        $prod = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($prod as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id']);

            if ($md5 == $get['d']) {
                // Encontrando o produto

                $id_produto = $value['id'];
                $file = "../".$value['imagem'];

                break;
            }
        }

        // Resgatando valores do post
        $nome = $produto['nome'];
        $nome_produto = $processos->renomeia($nome);
        $id_categoria_md5 = $produto['categoria'];
        $valor = $produto['valor'];
        $descricao = $produto['descricao'];
        $data = date("Y-m-d");

        // DESCRIPTOGRAFANDO CATEGORIA

        $consulta = $conexao->query("SELECT * FROM categoria");
        $cat = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cat as $i => $value) {
            // DESCRIPTOGRAFANDO
            $md5 = md5($value['id_categoria']);

            if ($md5 == $id_categoria_md5) {
                // Encontrando o produto

                $id_categoria = $value['id_categoria'];
                $nome_categoria = $value['categoria'];

                break;
            }
        }

        // VERIFICANDO SE A PRODUTO JÁ NÃO FOI CADASTRADA
        $consulta = $conexao->prepare("SELECT * FROM produtos WHERE id <> ? and nome_produto = ?");
        $consulta->execute(array($id_produto, $nome_produto));

        if ($consulta->rowCount()>0) {
            //Produto já existe
            
            $_SESSION["msg"] = "<p style='color: red'>Produto já existente</p>";
            header("location: ../admin/admin_produto.php?p=".$get['d']);
        
        }else{
        // Não existe nenhuma produto com esse nome

            if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['name'] != ""){//Verificando se arquivo foi enviado

                $img = $_FILES['imagem']['name'];
                $extensao = strtolower(pathinfo($img, PATHINFO_EXTENSION));

                if($extensao == 'jpg' || $extensao == 'JPG' || $extensao == 'png' || $extensao == 'PNG'){// Verificando extensão aceitavel

                    $nome_img = $nome_produto.'.'.$extensao;
                    $diretorio = "../img/produtos/";

                        // Excluindo arquivo antigo

                        if (file_exists($file)) {//Verificando se existe arquivo antigo
                            unlink($file);
                        }

                        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nome_img)){//Movendo arquivo para pasta
                            
                            $diretorio = "img/produtos/";
                            $img = $diretorio.$nome_img;

                            $editar = $conexao->prepare("UPDATE produtos SET id_categoria = ?, categoria = ?, nome = ?, nome_produto = ?, descricao = ?, imagem = ?, valor = ?,  data_cadastro = ? WHERE id = ?");
                            $editar->execute(array($id_categoria, $nome_categoria, $nome ,$nome_produto, $descricao, $img, $valor, $data, $id_produto));

                            $_SESSION["msg"] = "<p style='color: green'>Produto editada com sucesso!</p>";
                            header("location: ../admin/admin_produto.php?p=".$get['d']);
                        
                        }else{
                            $_SESSION["msg"] = "<p style='color: red'>Falha ao enviar o arquivo, por favor o reenvie</p>";
                            header("location: ../admin/admin_produto.php?p=".$get['d']);
                        }

                }else{
                    $_SESSION["msg"] = "<p style='color: red'>Selecione um arquivo png ou jpg</p>";
                    header("location: ../admin/admin_produto.php?p=".$get['d']);
                }
            }else{
                //Não editar arquivo

                // Renomeando arquivo existente para evitar conflito
                $extensao = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                $img = "../img/produtos/".$nome_produto.".".$extensao;
                
                if (file_exists($file)) {//Verificando se existe arquivo antigo
                    rename($file, $img);   
                }

                $img = "img/produtos/".$nome_produto.".".$extensao;

                $editar = $conexao->prepare("UPDATE produtos SET id_categoria = ?, categoria = ?, nome = ?, nome_produto = ?, descricao = ?, imagem = ?, valor = ?,  data_cadastro = ? WHERE id = ?");
                $editar->execute(array($id_categoria, $nome_categoria, $nome ,$nome_produto, $descricao, $img, $valor, $data, $id_produto));

                $_SESSION["msg"] = "<p style='color: green'>Produto editado com sucesso!</p>";
                header("location: ../admin/admin_produto.php?p=".$get['d']);
            }
        }

    }else{
        header("location: ../admin/admin_produto.php?c=1");
    }
?>