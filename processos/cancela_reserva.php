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

        if ($md5 == $get['cancela']) {
            if ($value['id_usuario'] == $_SESSION['id']) {
                // Verificando o usuario q está cancelando 
                $id = $value['id'];
            }
            break;
        }
    }

    if (!isset($id)) {
        $_SESSION['msg'] = "<p style='color: red;'>Reserva não encontrada</p>";
        header("location: ../minhas_reservas.php");
    }else{
        // Encontrou o id da reserva

        $mesa = "Reserva cancelada";

        $update = $conexao->query("UPDATE reservas SET status = 3, mesa = '$mesa' WHERE id = $id");
        $_SESSION['msg'] = "<p style='color: green;'>Reserva Cancelada</p>";
        header("location: ../minhas_reservas.php");
    }

?>