<?php
    include_once("config/conexao.php");

    if (isset($_SESSION['usuario'])) {
        header("location: index.php");
    }

    if (isset($_COOKIE['senha'])) {
        $lembrar_senha = $_COOKIE['senha'];
        $lembrar_email = $_COOKIE['email'];
        $lembrar = "checked";
    }else{
        $lembrar_senha = "";
        $lembrar_email = "";
        $lembrar = "";
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Hamburgueria GC</title>
</head>
<body class="body_login"">
    
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
                <a href="login.php"><img src="icons/user-svgrepo-com.svg" alt=""></a>
                <a href="minhas_reservas.php"><img src="icons/menu-svgrepo-com.svg" alt=""></a>
            </div>
        </div><!--Menu inferior-->
    </header><!--Cabeçalho-->
    
    <main class="corpo">
        <section class="login">
            <h2>Login</h2>
            <?php
                include("processos/msg.php");
            ?>
            <form action="processos/proc_login.php" method="post">
                <input type="email" placeholder="exemplo@email.com" name="email" value="<?=$lembrar_email?>">
                <input type="password" placeholder="Senha" name="senha" value="<?=$lembrar_senha?>">
                <div>
                    <input type="checkbox" name="lembrar-me" id="lembrar-me" <?=$lembrar?>>
                    <label for="lembrar-me">Lembrar-me</label>
                </div>
                <input type="submit" name="logar" value="Logar">
            </form>
            <div class="links_login">
                <a href="">Esqueceu a senha</a>
                <a href="cadastro.php">Cadastrar-se</a>
            </div>
        </section>
    </main><!--Corpor-->
    <footer class="footer_login">
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