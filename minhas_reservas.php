<?php
    include_once("config/conexao.php");
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
    
    <header class="cabecalho" style="border-radius: 0;">
        <nav class="menu">
            
            <img src="img/Logo2.png" class="logo">
            <ul>
                <a href="index.php"><li>INICIO</li></a>
                <a href="reservas.php"><li>RESERVAS</li></a>
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
                <a href="login.php"><img src="icons/user-svgrepo-com.svg" alt=""></a>
                <a href="minhas_reservas.php"><img src="icons/menu-svgrepo-com.svg" alt=""></a>
            </div>
        </div><!--Menu inferior-->
    </header><!--Cabeçalho-->
    
    <main class="corpo">
        <section class="filtrar">
            <div class="busca_data">
                <form action="#" method="post">
                    
                    <label for="data_inicial">Data inicial: </label>
                    <input type="date" name="data_inicial" required>
                    
                    <label for="data_final">Data final: </label>
                    <input type="date" name="data_final" required>

                    <input type="submit" value="Buscar">
                </form>
            </div>
        </section><!--Filtrar-->

        <section class="proximas">
            <h2>Próximas Reservas</h2>
            <div class="proxima_reservas">
                
                <h3>11/10 - 22:00</h3>

                <div class="informacoes_reserva">
                    <div class="info">
                        <p><strong>Status:</strong> <span class="status">Confirmada</span></p>
                        <p><strong>Detalhes:</strong> <span class="detalhes">Mesa 2</span> | <span class="detalhes">6 Pessoas</span></p>
                    </div>

                    <div class="btns">
                        <button style="background-color: rgba(2, 2, 203, 0.685);">Reenviar informarções por email</button>
                        <button style="background-color: rgba(209, 7, 7, 0.836);">Cancelar</button>
                    </div>
                </div>
            </div>
        </section><!--Próximas Reservas-->

        <section class="historico proximas">
            <h2>Histórico</h2>
            <div class="historico_reservas proxima_reservas">
                
                <h3>11/10 - 22:00</h3>

                <div class="informacoes_reserva">
                    <div class="info">
                        <p><strong>Status:</strong> <span class="status">Cancelada</span></p>
                        <p><strong>Detalhes:</strong> <span class="detalhes">Mesa 2</span> | <span class="detalhes">6 Pessoas</span></p>
                    </div>
                </div>
            </div>
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