<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <title>Hamburgueria GC</title>
</head>
<body>
    <div class="fechar" onclick="mostrar_opc_usuario()" style="display: none;"></div>
    <header class="cabecalho">
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
        <div class="banner">
                <h2>COMBOS A PARTIR  <br>R$28,00</h2>
                <hr>
                <img src="icons/hamburger-svgrepo-com.svg" alt="">
        </div><!--Banner--> 
    </header><!--Cabeçalho-->
    
    <main class="corpo">

        <section class="destaque populares">
            <h2>Nosso lanches favoritos</h2>
            <div class="produtos_populares produtos">

                <?php
                    // FAVORITOS
                    $consulta_favoritos = $conexao->query("SELECT * FROM salvos GROUP BY id_produto ORDER BY COUNT(ID_PRODUTO) DESC LIMIT 4");
                    $favoritos = $consulta_favoritos->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($favoritos as $key => $value) {

                        // Consultando o produto

                        $consulta_produto = $conexao->query("SELECT * FROM produtos WHERE id = ".$value['id_produto']);
                        $prod = $consulta_produto->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a href="produto.php?p=<?=md5($prod['id'])?>">
                        <div class="produto produto_popular">
                            <img src="<?=$prod['imagem']?>" alt="">
                            <h3><?=$prod['nome']?></h3>
                            <p class="preco">R$ <?=$prod['valor']?></p>
                        </div>
                        </a>
                        <?php
                    }

                ?>
            </div>
        </section><!--Itens mais populares-->

        <hr>

        <section class="destaque promoções">
            <h2>Aproveite nossos melhores preços</h2>
            <div class="produtos_populares produtos">
            <?php

                // Consultando o produto
                $consulta_preco = $conexao->query("SELECT * FROM produtos ORDER BY valor LIMIT 4");
                $preco = $consulta_preco->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($preco as $key => $prod) {

                        

                        
                        ?>
                        <a href="produto.php?p=<?=md5($prod['id'])?>">
                        <div class="produto produto_promocao">
                            <img src="<?=$prod['imagem']?>" alt="">
                            <h3><?=$prod['nome']?></h3>
                            <p class="preco">R$ <?=$prod['valor']?></p>
                        </div>
                        </a>
                        <?php
                    }

                ?>
            </div>
        </section><!--Itens Em promoção-->

        <section class="reserva">
            <div>
                <h2>Faça sua reserva</h2>
                <p>Terça a Domingo</p>
                <p>18:00 ás 00:00</p>
            </div>
            <a href="reservas.php">RESERVAR</a>
        </section><!--Baner do meio Reserva-->

        <section class="novidades destaque">

        <?php
            // Novidades

            $consulta_novidades = $conexao->query('SELECT * FROM produtos ORDER BY data_cadastro, id ASC LIMIT 2');
            $novidades = $consulta_novidades->fetchAll(PDO::FETCH_ASSOC);
        ?>

            <h2>Novidades</h2>
            <div class="produtos_novos produtos">

            <?php
            foreach ($novidades as $key => $value) {
                ?>
                <a href="produto.php?p=<?=md5($value['id'])?>">
                    <div class="produto produto_novo">
                        <img src="<?=$value['imagem']?>" alt="">
                        <h3><?=$value['nome']?></h3>
                        <p class="preco">R$ <?=$value['valor']?></p>
                    </div>
                </a>
                <?php
            }
            ?>
            </div>
        </section><!--Novidades-->

        <section class="avaliacoes destaque">
            <h2>Avaliações</h2>
            <div class="lista-avaliacoes">
                <div class="avaliacao">
                    <img src="icons/stars-svgrepo-com.svg" alt="">
                    <p class="username"><strong>User 1</strong></p>
                    <p class="comentario">O hambúrguer é bom, a batata poderia ser mais crocante. Tempo de espera é de aproximadamente 15 minutos. Não verifiquei se existe estacionamento, mas na rua tem bastante espaço para parar o carro.</p>
                </div>

                <div class="avaliacao">
                    <img src="icons/stars-svgrepo-com.svg" alt="">
                    <p class="username"><strong>User 2</strong></p>
                    <p class="comentario">O hambúrguer é bom, a batata poderia ser mais crocante. Tempo de espera é de aproximadamente 15 minutos. Não verifiquei se existe estacionamento, mas na rua tem bastante espaço para parar o carro.</p>
                </div>

                <div class="avaliacao">
                    <img src="icons/stars-svgrepo-com.svg" alt="">
                    <p class="username"><strong>User 3</strong></p>
                    <p class="comentario">Uma dica: o segundo(se acontecer) pedido poderia ser feito na mesa sentado, pois já estamos lá msm, mas não.. tem q sair da mesa, pegar fila e fazer o pedido, dá um máquininha na mão do Garçon e já adiantaria o lado do Cliente... mas super recomendo!</p>
                </div>

                <div class="avaliacao">
                    <img src="icons/stars-svgrepo-com.svg" alt="">
                    <p class="username"><strong>User 4</strong></p>
                    <p class="comentario">Lugar lindo e rústico, ótimo atendimento, e os lanches caprichados e deliciosos! Super recomendo!</p>
                </div>
            </div><!--Avaliações-->
        </section><!--Avaliações-->

        <section class="avaliar destaque">
            <h2>Envie-nos sua opnião</h2>
            <form action="#" method="post">
                <input type="range" class="range" name="avaliacao">
                <textarea name="comentario" id="comentario" placeholder="Digite aqui seu comentário..."></textarea>
                <input type="button" value="ENVIAR" class="enviar">
            </form>
        </section><!--Avaliar-->
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