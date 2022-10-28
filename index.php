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

    <!-- Arquivo das estrelas -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- SWIPER Carrocel -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

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

        <?php

            // AVALIAÇÃO DO USUARIO

            $check = array("","", "", "", "", "");
            $comentario = "";

            if (isset($_SESSION['usuario'])) {//Está logado
                $cons_minhaavaliacao = $conexao->query("SELECT * FROM avaliacoes WHERE id_usuario = ".$_SESSION['id']);

                if ($cons_minhaavaliacao->rowCount()>0) {
                    $minha_avaliacao = $cons_minhaavaliacao->fetch(PDO::FETCH_ASSOC);

                    $nota = $minha_avaliacao['nota'];
                    $check[$nota] = "checked";

                    $comentario = $minha_avaliacao['comentario'];
                }
            }

            // Todas as avaliacoes

            $cons_avaliacoes = $conexao->query("SELECT * FROM avaliacoes");
        ?>

            <h2>Avaliações</h2>

            <section class="secao_slide">
            <div style="max-width: 1200px;" class="swiper mySwiper container depoimentos lista-avaliacoes">
                <div class="swiper-wrapper content">
                <?php
                    while ($avaliacao = $cons_avaliacoes->fetch(PDO::FETCH_ASSOC)) {
                        // Percorrendo avaliacoes
                        $check_av = array("","", "", "", "", "");
                        $check_av[$avaliacao['nota']] = "checked";

                        // User
                        $consulta_user = $conexao->query("SELECT * FROM usuarios WHERE id = ".$avaliacao['id_usuario']);
                        $user = $consulta_user->fetch(PDO::FETCH_ASSOC);
                        ?>
                    <div class="swiper-slide card">
                        <div class="card-content">
                        <!-- ESTRLAS -->
                        <div class="estrelas" style="cursor: default;">
                            
                            <?php
                                for ($i=1; $i <= 5 ; $i++) { 
                                    if($i<= $avaliacao['nota']){
                                        $cor = "#FC0";
                                    }else{
                                        $cor = "#CCC";
                                    }
                                    ?>
                                <label><i class="fa" style="cursor: default; color: <?=$cor?>;"></i></label>
                                    <?php
                                }
                            ?>
                            <br><br>
                            
                        </div><!-- ESTRELAS -->

                        <p class="username"><strong><?=$user['nome']?></strong></p>
                        <p class="comentario"><?=$avaliacao['comentario']?></p>
                        </div>
                    </div>
                        <?php
                    }

                    
                ?>
                </div>
            </div><!--Avaliações-->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            </section>
        </section><!--Avaliações-->

        <section class="avaliar destaque" id="avaliar">
            <h2>Envie-nos sua opnião</h2>
            <form action="processos/proc_avaliacoes.php" method="post">
                
            <!-- ESTRLAS -->
                <div class="estrelas">
                    <input type="radio" id="vazio" name="estrela" value="" checked>
                    
                    <?php
                        for ($i=1; $i <= 5 ; $i++) { 
                            ?>
                        <label for="estrela_<?=$i?>"><i class="fa check"></i></label>
                        <input type="radio" id="estrela_<?=$i?>" name="estrela" value="<?=$i?>" <?=$check[$i]?>>
                            <?php
                        }
                    ?>
                    <br><br>
                    
                </div><!-- ESTRELAS -->

                <?php
                    include("processos/msg.php");
                ?>

                <textarea name="comentario" id="comentario" placeholder="Digite aqui seu comentário..." required><?=$comentario?></textarea>
                <input type="submit" value="ENVIAR" name="Enviar" class="enviar">
                <?php
                    if ($comentario != "") {
                        ?>
                    <input type="submit" value="EXCLUIR" name="Excluir" class="enviar excluir_av" style="background-color: #ff0001bd; display:none;">
                    <a style="cursor: pointer; color: red;" onclick="alerta_avaliacao()">Excluir avaliação</a>
                        <?php
                    }
                ?>
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
    <!-- SWIPER CARROCEL -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
        slidesPreview: 1,
        spaceBetween:30,
        slidesPerGroup: 1,
        loop: true,
        speed:1000,
        // autoplay: true,
        // autoplaySpeed: 3000,
        loopFillGroupWithBlank: true,
            pagination:{
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: "coverflow", 
            grabCursor: false,
            centeredSlides: true, 
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 0,
                modifier: 0,
                slideShadows: true
            },
        });
    </script>
</body>
</html>