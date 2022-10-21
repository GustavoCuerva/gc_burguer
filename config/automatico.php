<?php
    // DEFININDO RESERVAS VENCIDAS
    $data = date("Y-m-d");
    $hora = date("H:i");
    $update = $conexao->query("UPDATE reservas SET status = 2, mesa = 'Reserva vencida' WHERE data_reserva < '$data' AND status < 2");
    $upadte = $conexao->query("UPDATE reservas SET status = 2, mesa = 'Reserva vencida' WHERE data_reserva = '$data' AND horario < '$hora' AND status < 2");
?>