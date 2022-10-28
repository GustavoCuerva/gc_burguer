<?php
    include("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        $_SESSION['msg'] = "<p style='color:red'>Login nescessário</p>";
        header("location: ../index.php#avaliar");
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
    
    if(isset($post['Enviar'])){
        // Ouve um envio do formulário
        if (!empty($post['estrela'])) {
        // Foi enviado as estrelas

            $estrelas = $post['estrela'];
            $comentario = $post['comentario'];
            $id_usuario = $_SESSION['id'];
            $data = date("Y-m-d");

            $teste = $conexao->query("SELECT * FROM avaliacoes WHERE id_usuario = $id_usuario");

            if ($teste->rowCount()>0) {
                // Editar

                $id_avaliacao = $teste->fetch(PDO::FETCH_ASSOC);

                $editar = $conexao->prepare("UPDATE avaliacoes SET id_usuario = ?, nota = ?, comentario = ?, data_avaliacao = ? WHERE id = ?");

                if($editar->execute(array($id_usuario, $estrelas, $comentario, $data, $id_avaliacao['id']))){
                    $_SESSION['msg'] = "<p style='color:green'>Avaliação cadastrada com sucessso</p>";
                    header("location: ../index.php#avaliar");
                }else{
                    $_SESSION['msg'] = "<p style='color:red'>Erro contate o suporte ou tente novamente</p>";
                    header("location: ../index.php#avaliar");
                }
            }else{
                // Cadastrar

                $upload = $conexao->prepare("INSERT INTO avaliacoes (id_usuario, nota, comentario, data_avaliacao) VALUES (?,?,?,?)");
                
                if($upload->execute(array($id_usuario, $estrelas, $comentario, $data))){
                    $_SESSION['msg'] = "<p style='color:green'>Avaliação cadastrada com sucessso</p>";
                    header("location: ../index.php#avaliar");
                }else{
                    $_SESSION['msg'] = "<p style='color:red'>Erro contate o suporte ou tente novamente</p>";
                    header("location: ../index.php#avaliar");
                }
            }

        }else{
            // Não foi selecionada nenhuma estrela
            $_SESSION['msg'] = "<p style='color:red'>Selecione pelo menos uma estrela</p>";
            header("Location: ../index.php#avaliar");
        }
    }else if (isset($post['Excluir'])) {
        // Excluir

        $conexao->query("DELETE FROM avaliacoes WHERE id_usuario = ".$_SESSION['id']);

        $_SESSION['msg'] = "<p style='color:green'>Avaliação excluida com sucessso</p>";
        header("location: ../index.php#avaliar");
    }
?>