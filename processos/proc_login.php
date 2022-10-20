<?php
    include("../config/conexao.php");

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    if(isset($post['logar'])){
        $email = $post['email'];
        $senha = md5($post['senha']);

        $consulta = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? and senha = ? ");
        $consulta->execute(array($email, $senha));

        if($consulta->rowCount()>0){
            // Email e senha corretos

            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

            $_SESSION["id"] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['permissao'] = $usuario['permissao'];

            if (isset($post['lembrar-me'])) {//Se deseja lembrar o login

                setcookie("email", $email, time()+(60*60*24*365), "/");
                setcookie("senha", $post['senha'], time()+(60*60*24*365), "/");

            }else{
                // Destruindo cookies existentes

                setcookie("email", $email, time()-(60*60*24*300), "/");
                setcookie("senha", $post['senha'], time()-(60*60*24*300), "/");

            }

            if ($_SESSION['permissao'] == 1) {
                header("location: ../admin/");
            }else{
                header("location: ../login.php");
            }
            
        }else{
            // Email e senha incorretos

            $_SESSION['msg'] = "<p style='color:red'>Email ou senha incorretos</p>";
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }
?>