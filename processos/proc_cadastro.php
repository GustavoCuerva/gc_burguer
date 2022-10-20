<?php
    include_once("../config/conexao.php");

    $resultados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    // Verificando se ouve uma ação
    if (isset($resultados['cadastrar'])) {
        $nome = $resultados['nome'];
        $celular = $resultados['telefone'];
        $email = $resultados['email'];
        $senha = $resultados['senha'];
        $confirma_senha = $resultados['conf_senha'];

        // Verificando se a senha está correta

        if ($senha == $confirma_senha) { //Senha Correta
        
            // Verificando se o email já não consta em nosso banco
            $consulta = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? ");

            $consulta->execute(array($email));

            if ($consulta->rowCount()>0) { //Email já cadastrado
                
                $_SESSION['msg'] = "<p style='color:red;'>Usuário já cadastrado</p>";
                header("location: ../cadastro.php");

            }else{ //Email ainda não cadastrado

                // Inserindo dados no banco

                $senha = md5($senha);

                $data = date("Y-m-d");

                $cadastro = $conexao->prepare("INSERT INTO usuarios (nome, email, telefone, senha, data_cadastro) VALUES ( ? , ? , ? , ? , ?)");

                if($cadastro->execute(array($nome, $email, $celular, $senha, $data))){
                
                    $_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso</p>";
                    header("location: ../login.php");
                
                }else{

                    $_SESSION['msg'] = "<p style='color:red;'>Erro ao cadastrar, tente novamente</p>";
                    header("location: ../cadastro.php");

                }
            }
        }else{//Senha incorreta
            $_SESSION['msg'] = "<p style='color:red;'>Senha incorreta</p>";
            header("location: ../cadastro.php");
        }
    }else{
        header("location: ../login.php");
    }
?>