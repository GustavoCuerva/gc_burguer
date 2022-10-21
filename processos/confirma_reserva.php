<?php
    include("../config/conexao.php");
    include("../config/classes.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    $consulta = $conexao->query("SELECT * FROM reservas");
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Descriptografando id
    foreach ($resultado as $key => $value) {
        $md5 = md5($value['id']);

        if ($md5 == $get['confirma']) {
            if ($value['id_usuario'] == $_SESSION['id']) {
                // Verificando o usuario q está confirmando  
                if ($value['status'] == 1) {
                    // Verificando se está aguardando confirmação
                    $id = $value['id'];
                    $data = $value['data_reserva'];
                }else{
                    $_SESSION['msg'] = "<p style='color: red;'>Não é possivel confirmar essa reserva, ela já pode ter sido confirmada, cancelada ou vencida</p>";
                    header("location: ../minhas_reservas.php");
                }
            }
            break;
        }
    }

    if (!isset($id)) {
        $_SESSION['msg'] = "<p style='color: red;'>Reserva não encontrada</p>";
        header("location: ../minhas_reservas.php");
    }else{
        // Encontrou o id da reserva

        // Definindo a mesa
        $consulta_mesa = $conexao->query("SELECT * FROM reservas WHERE data_reserva = '$data' AND status = 0");
        $mesa_resultado = $consulta_mesa->fetchAll(PDO::FETCH_ASSOC);
        $mesa = 1;

        foreach ($mesa_resultado as $key => $value) {
            
            if ($value['mesa'] == "$mesa") {
                $mesa++;
            }
        }

        $update = $conexao->query("UPDATE reservas SET status = 0, mesa = '$mesa' WHERE id = $id");
        $_SESSION['msg'] = "<p style='color: green;'>Reserva Confirmada</p>";
        header("location: ../minhas_reservas.php");
    }

?>