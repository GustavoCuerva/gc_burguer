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
    <link rel="stylesheet" href="css/menu.css">
    <title>Hamburgueria GC</title>
</head>
<body>
    
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

        <form action="#" method="post" class="filtro">
            <select name="filtro" id="filtro">
                <option value="1">Tudo</option>
                <option value="2">Combos</option>
                <option value="3">Lanches</option>
                <option value="4">Bebidas</option>
                <option value="5">Sobremesas</option>
            </select>
        </form>

        <h2 style="text-align: center; font-size: 30px; color: #787878; font-weight: 900;">MEUS FAVORITOS</h2>

        <section class="destaque destaque_menu">
            <h2>Combos</h2>

            <div class="produtos produtos_menu ">
                <a href="produto.php">
                    <div class="produto produto_menu ">
                        <img src="img/produtos/2hambuguer.jpg" alt="">
                        <h3>Peça 1 Coma 2</h3>
                        <p class="preco">R$ 30,58</p>
                    </div>
                </a>

                <div class="produto produto_menu ">
                    <img src="img/produtos/combo.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/combo2.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/2hambuguer.jpg" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/2hambuguer.jpg" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/combo.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/combo2.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/2hambuguer.jpg" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>
            </div>
            <p class="mostrar_mais"><span onclick="mostrar(0)">Mostrar Mais</span></p>
        </section><!--Combos-->

        <hr>

        <section class="destaque destaque_menu">
            <h2>Lanches</h2>
            <div class="produtos produtos_menu ">
                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer1.png" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer2.png" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer3.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer4.png" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer1.png" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer2.png" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer3.jpg" alt="">
                    <h3>Combo Hambuguer + Batata + Refri</h3>
                    <p class="preco">R$ 30,58</p>
                </div>

                <div class="produto produto_menu ">
                    <img src="img/produtos/hamburguer4.png" alt="">
                    <h3>Peça 1 Coma 2</h3>
                    <p class="preco">R$ 30,58</p>
                </div>
                
            </div>
            <p class="mostrar_mais"><span onclick="mostrar(1)">Mostrar Mais</span></p>
        </section><!--Lanches-->
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