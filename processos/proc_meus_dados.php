<?php
    include_once("../config/conexao.php");

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    if (isset($post['alterar'])) {
        // Alterar dados

        $nome = $post['nome'];
        $telefone = $post['telefone'];
        $email = $post['email'];
        $senha = $post['senha'];
        $md5 = $post['config'];

        if (md5($senha) == $md5) {
            // Senha correta
            if (isset($post['nova_senha']) && $post['nova_senha']!= "") {
                // Verificando se está alterando a senha
                if (isset($post['conf_senha']) && $post['nova_senha']!= "") {
                    // Campos nescessários preenchidos
                    $nova_senha = $post['nova_senha'];
                    $confirma = $post['conf_senha'];

                    if ($nova_senha == $confirma) {
                        // Nova senha confirmada
                        $update_senha = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, telefone = ? WHERE id = ?");
                        $update_senha->execute(array($nome, $email, md5($nova_senha), $telefone, $_SESSION['id']));

                        $_SESSION['msg'] = "<p style='color:green'>Dados e senha atualizados com sucesso</p>";

                        header('Location: ../meus_dados.php');
                    }else{
                        // Nova senha incorreta
                        $_SESSION['msg'] = "<p style='color:red'>Senhas diferentes, confirme a senha corretamente</p>";
                        header('Location: ../meus_dados.php');
                    }
                }else{
                    // Não confirmou a senha ao alterar
                    $_SESSION['msg'] = "<p style='color:red'>Se deseja alterar a senha, todos os campos relacionados tem de estrar preenchidos</p>";

                    header('Location: ../meus_dados.php');
                }
            }else{
                
                // NÃO ALTERA SENHA

                $update = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, telefone = ? WHERE id = ?");

                $update->execute(array($nome, $email, $telefone, $_SESSION['id']));

                $_SESSION['msg'] = "<p style='color:green'>Dados atualizados com sucesso</p>";

                header('Location: ../meus_dados.php');
            }
        }else{
            // Senha incorreta
            $_SESSION['msg'] = "<p style='color:red'>SENHA INCORRETA</p>";

            header('Location: ../meus_dados.php');
        }
    }else if(isset($post['excluir'])){
        // Excluir

        $senha = md5($post['senha']);
        $md5 = $post['config'];

        if ($senha == $md5) {
            // Senha confirmada
            $delete = $conexao->query("DELETE FROM usuarios WHERE id = ".$_SESSION['id']);
            $delete_produtos = $conexao->query("DELETE FROM salvos WHERE id_usuario = ".$_SESSION['id']);
            $delete_avaliacoes = $conexao->query("DELETE FROM avaliacoes WHERE id_usuario = ".$_SESSION['id']);
            $delete_reservas = $conexao->query("DELETE FROM reservas WHERE id_usuario = ".$_SESSION['id']);
            header("location: sair.php");
        }else{
            // Senha incorreta
            $_SESSION['msg'] = "<p style='color:red'>SENHA INCORRETA</p>";

            header('Location: ../meus_dados.php');
        }

    }else{//Nenhuma ação solicitada
        header("../meus_dados.php");
    }
?>