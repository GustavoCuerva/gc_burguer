<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: login.php");
    }
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
<body class="reserva_body">
    
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
                <form action="pesquisa.php" method="post" class="pesquisar">
                    <input type="search" placeholder="Pesquisar" name="pesquisa">
                    <button><img src="icons/search-svgrepo-com.svg" alt=""></button>
                </form>
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
        <section class="reservar">
            <h2>Reservar um horário</h2>
            <div class="box-reservar">
                <div>
                    <img src="img/Logo2.png" alt="">
                </div>
                <div>
                    <?php
                        include("processos/msg.php");
                    ?>
                    <form action="processos/proc_reservas.php" method="post" class="form_reserva">
                        <div>
                            <label for="unidade">Unidade:</label>
                            <input type="text" name="unidade" value="Avenida Paulista 2222 - São Paulo-SP" disabled>
                        </div>
                        <div>
                            <label for="pessoas">Pessoas:</label>
                            <select name="pessoas" id="pessoas" required>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>

                        <div>
                            <label for="data">Data:</label>
                            <input type="date" name="data" required>
                        </div>

                        <div>
                            <label for="hora">Hora:</label>
                            <input type="time" name="hora" required>
                        </div>

                        <div>
                            <input type="submit" name="reservar" value="Reservar">
                        </div>
                    </form>
                </div>
            </div>
        </section><!--Reservar-->
    </main><!--Corpor-->
    <footer>
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