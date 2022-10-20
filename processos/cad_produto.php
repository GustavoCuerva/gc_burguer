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

    if (isset($produto['enviar'])) {
        $nome = $produto['nome'];
        $nome_produto = $processos->renomeia($nome);

        $id_categoria = $produto['categoria'];

        $valor = $produto['valor'];

        $descricao = $produto['descricao'];

        if (isset($_FILES['imagem']['name']) && $_FILES['imagem']['name'] != ""){//Verificando se arquivo foi enviado

            $img = $_FILES['imagem']['name'];
            $extensao = strtolower(pathinfo($img, PATHINFO_EXTENSION));

            if($extensao == 'jpg' || $extensao == 'JPG' || $extensao == 'png' || $extensao == 'PNG'){//Verificando extensão aceitavel

                $nome_img = $nome_produto.'.'.$extensao;
                $diretorio = "../img/produtos/";

                // VERIFICANDO SE O PRODUTO JÁ NÃO FOI CADASTRADO
                $consulta = $conexao->prepare("SELECT * FROM produtos WHERE nome_produto = ?");
                $consulta->execute(array($nome_produto));

                if ($consulta->rowCount()>0) {//Categoria já existe
                    
                    $_SESSION["msg"] = "<p style='color: red'>Produto já existente</p>";
                    header("location: ../admin/admin_produto.php?c=1");
                
                }else{

                    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$nome_img)){//Movendo arquivo para pasta

                        // Verificando categoria

                        $cons_categoria = $conexao->query("SELECT * FROM categoria");
                        $cat = $cons_categoria->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($cat as $key => $value) {

                            $md5 = md5($value['id_categoria']);

                            if ($id_categoria == $md5) {
                                $nome_categoria = $value['categoria'];
                                $id_categoria = $value['id_categoria'];

                                break;
                            }

                        }
                        
                        $diretorio = "img/produtos/";
                        $img = $diretorio.$nome_img;
                        $data = date("Y-m-d");

                        $cadastro = $conexao->prepare("INSERT INTO produtos (id_categoria, categoria, nome, nome_produto, descricao, imagem, valor, data_cadastro) values (?, ?, ?, ?, ?, ?, ?, ?)");
                        $cadastro->execute(array($id_categoria, $nome_categoria, $nome, $nome_produto, $descricao, $img, $valor, $data));

                        $_SESSION["msg"] = "<p style='color: green'>Produto criado com sucesso!</p>";
                        header("location: ../admin/admin_produto.php?c=1");
                    
                    }else{
                        $_SESSION["msg"] = "<p style='color: red'>Falha ao enviar o arquivo</p>";
                        header("location: ../admin/admin_produto.php?c=1");
                    }

                }

            }else{
                $_SESSION["msg"] = "<p style='color: red'>Selecione um arquivo png ou jpg</p>";
                header("location: ../admin/admin_produto.php?c=1");
            }
        }else{//Arquivo não enviado
            $_SESSION["msg"] = "<p style='color: red'>Envie uma imagem</p>";
            header("location: ../admin/admin_produto.php?c=1");
        }

    }else{
        header("location: ../admin/admin_produto.php?c=1");
    }
?>