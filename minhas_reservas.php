<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");
    include_once("config/classes.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: login.php");
    }

    $mask = new Processos;
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);

    $data_final = "";
    $data_inicial = "";

    /* CONSULTAS */
    if (!isset($post['buscar'])) {
        // Consulta padrão
        $consulta = $conexao->query("SELECT * FROM reservas WHERE id_usuario = ".$_SESSION['id']);
        $tudo = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $consulta_proximas = $conexao->query("SELECT * FROM reservas WHERE status < 2 and id_usuario = ".$_SESSION['id']);
        $proximas = $consulta_proximas->fetchAll(PDO::FETCH_ASSOC);

        $consulta_hitorico = $conexao->query("SELECT * FROM reservas WHERE status > 1 and id_usuario = ".$_SESSION['id']);
        $historico = $consulta_hitorico->fetchAll(PDO::FETCH_ASSOC);
    }else{
        // Consulta com pesquisa

        $data_inicial = date("Y-m-d", strtotime($post['data_inicial']));
        $data_final = date("Y-m-d", strtotime($post['data_final']));

        $consulta = $conexao->prepare("SELECT * FROM reservas WHERE id_usuario = ".$_SESSION['id']." AND data_reserva BETWEEN ? and ?");
        $consulta->execute(array($data_inicial, $data_final));
        $tudo = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $consulta_proximas = $conexao->prepare("SELECT * FROM reservas WHERE status < 2 and id_usuario = ".$_SESSION['id']." AND data_reserva BETWEEN ? and ?");
        $consulta_proximas->execute(array($data_inicial, $data_final));
        $proximas = $consulta_proximas->fetchAll(PDO::FETCH_ASSOC);

        $consulta_hitorico = $conexao->prepare("SELECT * FROM reservas WHERE status > 1 and id_usuario = ".$_SESSION['id']." AND data_reserva BETWEEN ? and ?");
        $consulta_hitorico->execute(array($data_inicial, $data_final));
        $historico = $consulta_hitorico->fetchAll(PDO::FETCH_ASSOC);
    }

    $status = array("Confirmada", "Aguardando Confirmação", "Vencida", "Cancelada");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reservas.css">
    <title>Hamburgueria GC</title>
</head>
<body>
    
    <div class="fechar" onclick="mostrar_opc_usuario()" style="display: none;"></div>
    <header class="cabecalho" style="border-radius: 0;">
        <nav class="menu">
            
            <img src="img/Logo2.png" class="logo">
            <ul>
                <a href="index.php"><li>INICIO</li></a>
                <a href="reservas.php"><li>RESERVAR</li></a>
            </ul>
            <ul>
                <a href="menu.php"><li>MENU</li></a>
                <a href="sobre.php"><li>SOBRE NÓS</li></a>
            </ul>
        </nav><!--Menu-->

        <div class="menu-inferior">
            <div class="endereco">
                <img src="icons/location-svgrepo-com.svg" class="localizacao_img">
                <div class="endereco_rua">
                    <p>Avenida Paulista 2222 </p>
                    <p>São Paulo-SP</p>
                    <p><strong>CEP:</strong> 00000000000</p>
                </div><!--Endereco-->
            </div>

            <div class="menu-usuario">
                <input type="search" placeholder="Pesquisar" name="pesquisa" class="pesquisar">
                <a><img src="icons/search-svgrepo-com.svg" class="lupa" alt=""></a>
                <a href="favoritos.php"><img src="icons/favorite-svgrepo-com.svg" alt=""></a>
                <?php
                    if (isset($_SESSION['usuario'])) {//Está logado
                        ?>
                    <a onclick="mostrar_opc_usuario()"><img src="icons/user-svgrepo-com.svg" alt=""></a>
                    <div class="opc_usuario" style="display: none;">
                    <?php
                        if ($_SESSION['permissao'] == 1) {
                            ?>
                        <a href="admin/painel.php">Painel admin</a>
                            <?php
                        }
                    ?>
                        <a href="meus_dados.php">Meus dados</a>
                        <a href="processos/sair.php">Sair</a>
                    </div>
                        <?php
                    }else{//Não está logado
                        ?>
                    <a href="login.php"><img src="icons/user-svgrepo-com.svg" alt=""></a>
                        <?php
                    }
                ?>
                <a href="minhas_reservas.php"><img src="icons/menu-svgrepo-com.svg" alt=""></a>
            </div>
        </div><!--Menu inferior-->
    </header><!--Cabeçalho-->
    
    <main class="corpo">
        <section class="filtrar">
            <div class="busca_data">
                <form action="#" method="post">
                    
                    <label for="data_inicial">Data inicial: </label>
                    <input type="date" name="data_inicial" value="<?=$data_inicial?>" required>
                    
                    <label for="data_final">Data final: </label>
                    <input type="date" name="data_final" value="<?=$data_final?>" required>

                    <input type="submit" name="buscar" value="Buscar">
                </form>
            </div>
        </section><!--Filtrar-->

        <section class="proximas">
            <?php
                include("processos/msg.php");
            ?>
            <h2>Próximas Reservas</h2>
            
                
                <?php

                    if ($consulta_proximas->rowCount() <= 0) {
                        echo "<div class='proxima_reservas'><h1 style='text-aling:center; color:#ccc; margin: 20px auto;'>Sem Reservas</h1></div>";
                    }else{
                        foreach ($proximas as $key => $value) {
                            ?>
                            <div class="proxima_reservas">
                            <h3><?=$mask->mask_data($value['data_reserva'])?> - <?=$mask->mask_hora($value['horario'])?></h3>
                                <div class="informacoes_reserva">
                                    <div class="info">
                                        <p><strong>Status:</strong> <span class="status"><?=$status[$value['status']]?></span></p>
                                        <p><strong>Detalhes:</strong> <span class="detalhes">Mesa <?=$value['mesa']?></span> | <span class="detalhes"><?=$value['quantidade']?> Pessoas</span></p>
                                    </div>

                                    <div class="btns">
                                        <?php
                                            if ($value['status'] == 0) {//Reserva confirmada
                                                ?>
                                                <button style="background-color: rgba(2, 2, 203, 0.685);" onclick="alerta();">Reenviar informarções por email</button>
                                                <?php
                                            }else if ($value['status'] == 1) {//Confirmar reserva
                                                ?>
                                                <a href="processos/proc_reservas.php?confirma=<?=md5($value['id'])?>"><button style="background-color: rgba(2, 2, 203, 0.685);">Confirmar</button></a>
                                                <?php
                                            }
                                        ?>
                                                <a href="processos/proc_reservas.php?cancela=<?=md5($value['id'])?>"><button style="background-color: rgba(209, 7, 7, 0.836);">Cancelar</button></a>
                                    </div>
                                </div>
                                </div>
                            <?php
                        }
                    }
                ?>
            
        </section><!--Próximas Reservas-->

        <section class="historico proximas">
            <h2>Histórico</h2>

            <?php
                if ($consulta_hitorico->rowCount() <= 0) {
                    echo "<div class='proxima_reservas'><h1 style='text-aling:center;  color:#ccc; margin: 20px auto;'>Sem histórico</h1></div>";
                }else{
                    foreach ($historico as $key => $value) {
                        ?>
                            <div class="historico_reservas proxima_reservas">
                    
                                <h3><?=$mask->mask_data($value['data_reserva'])?> - <?=$mask->mask_hora($value['horario'])?></h3>

                                <div class="informacoes_reserva">
                                    <div class="info">
                                        <p><strong>Status:</strong> <span class="status"><?=$status[$value['status']]?></span></p>
                                        <p><strong>Detalhes:</strong> <span class="detalhes">Mesa <?=$value['mesa']?></span> | <span class="detalhes"><?=$value['quantidade']?> Pessoas</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                }
            ?>
        </section><!--Histórico Reservas-->
    </main><!--Corpor-->
    <footer class="minhas_reservas_rodape">
        <div class="itens-rodape">
            <div class="endereco">
                <img src="icons/location-svgrepo-com.svg" class="localizacao_img">
                <div class="endereco_rua">
                    <p>Avenida Paulista 2222 </p>
                    <p>São Paulo-SP</p>
                    <p><strong>CEP:</strong> 00000000000</p>
                </div><!--Endereco-->
            </div>
                <div class="sobre-nos">
                    <a href="">Sobre Nós</a>
                    <div class="social-midia">
                        <a href=""><img src="icons/whatsapp-svgrepo-com.svg" alt=""></a>
                        <a href=""><img src="icons/facebook-svgrepo-com.svg" alt=""></a>
                        <a href=""><img src="icons/instagram-svgrepo-com.svg" alt=""></a>
                        <a href=""><img src="icons/email-svgrepo-com.svg" alt=""></a>
                    </div>
                </div>
        </div>
        <p class="copy">Gustavo Candido Cuerva &copy 2022</p>
    </footer>

    <script src="js/script.js"></script>
    
</body>
</html>