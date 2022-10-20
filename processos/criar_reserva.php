<?php
    include("../config/conexao.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
    }

    $reserva = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    if (isset($reserva['reservar'])) {
        
        // RESGATANDO VALORES
        $quantidade = $reserva['pessoas'];
        $data = date("Y-m-d", strtotime($reserva['data']));
        $hora = $reserva['hora'];
        $data_cadastro = date("Y-m-d");
        
        // Verificando disponibilidade

        $quantidade_pessoas = 0;

        $consulta_reservas = $conexao->prepare("SELECT * FROM reservas where data_reserva = ?");
        $consulta_reservas->execute(array($data));
        $reservas = $consulta_reservas->fetchAll(PDO::FETCH_ASSOC);

        foreach ($reservas as $key => $value) {
            $quantidade_pessoas += $value['quantidade'];
        }

        $consulta_informacoes = $conexao->query("SELECT * FROM informacoes_hamburgueiria");
        $informacoes = $consulta_informacoes->fetch(PDO::FETCH_ASSOC);

        $restante = $informacoes['capacidade'] - $quantidade_pessoas;
        $quantidade_pessoas += $quantidade;

        $hora_fim = date("H:i", strtotime($informacoes['horario_fim']) - (60*60));
        $dia_semana = date("w" , strtotime($data));
        $hora_agora = date("H:i");

        if ($quantidade_pessoas > $informacoes['capacidade']) {
            
            // Atingiu o limite da capacidade
            $_SESSION['msg'] = "<p style='color: red'>Sem disponibilidade para esse dia e essa quantidade, restao $restante lugares</p>";
            header("location: ../reservas.php");
            

        }else if (($hora < $informacoes['horario_inicio']) || ($hora > $hora_fim)) {

            // FORA DO HORARIO DE FUNCIONAMENTO
            $_SESSION['msg'] = "<p style='color: red'>Estamos abertos apenas das 18:00 as 00:00</p>";
            header("location: ../reservas.php");

        }else if($dia_semana == 1){

            // Não trabalhamos de segunda
            $_SESSION['msg'] = "<p style='color: red'>Desculpe mas não abrimos as segundas</p>";
            header("location: ../reservas.php");

        }else if($data<$data_cadastro){

            // Data já passou
            $_SESSION['msg'] = "<p style='color: red'>Essa data já passou</p>";
            header("location: ../reservas.php");

        }else if ($data == $data_cadastro && $hora_agora>=$hora) {
            
            // Data já passou
            $_SESSION['msg'] = "<p style='color: red'>Essa data e hora já pasaram</p>";
            header("location: ../reservas.php");

        }else{

            // Tudo certo com a reserva
            $reservar = $conexao->prepare("INSERT INTO reservas (id_usuario, data_reserva, horario, quantidade, data_cadastro) VALUES (?, ?, ?, ?, ?)");
            
            if ($reservar->execute(array($_SESSION['id'], $data, $hora, $quantidade, $data_cadastro))) {
                
                // Sucesso
                $_SESSION['msg'] = "<p style='color: green'>Reserva efetuada, você tem até 24hrs para confirma-la</p>";
                header("location: ../reservas.php");
            }else{

                // Erro
                $_SESSION['msg'] = "<p style='color: red'>Desculpe ocorreu um erro, tente denovo</p>";
                header("location: ../reservas.php");

            }

        }
    }else{
        header("location: ../reservas.php");
    }
?>