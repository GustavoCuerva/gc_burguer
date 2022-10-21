<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");

    // Verificando se existe algum produto
    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

    if (!isset($get['p'])) {
        header("location: menu.php");
    }

    // Descriptografando
    $consulta = $conexao->query("SELECT * FROM produtos");
    $produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as $key => $prod) {
        $md5 = md5($prod['id']);
        if ($md5 == $get['p']) {
            // Resgatando valores
            $id = $prod['id'];
            $nome = $prod['nome'];
            $categoria = $prod['categoria'];
            $id_categoria = $prod['id_categoria'];
            $valor = $prod['valor'];
            $descricao = $prod['descricao'];
            $img = $prod['imagem'];
            break;
        }
    }

    if (!isset($id)) {
        // Nenhum produto encontrado
        header("location: menu.php");
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/produto.css">
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

        <section class="box-produto">
            <div class="info-produto">
                <div class="img">
                    <img src="<?=$img?>" alt="">
                </div>
                <div class="descricao">
                    <h2><?=$nome?></h2>
                    <p><?=$descricao?></p>
                </div>
                <div class="comprar">
                    <p class="valor">R$<?=$valor?></p>
                    <?php
                        include("processos/msg.php");

                        // VERIFICAR SE JÁ NÃO ESTÁ SALVO
                        $consulta = $conexao->prepare("SELECT * FROM salvos WHERE id_usuario = ".$_SESSION['id']." AND id_produto = ?");
                        $consulta->execute(array($id));
                        if ($consulta->rowCount()>0) {
                            // Produto já salvo
                            ?>
                        <a href="processos/proc_salvar.php?r=<?=$get['p']?>"><button class="salvar">Remover dos Salvos</button></a>
                            <?php
                        }else{
                            ?>
                        <a href="processos/proc_salvar.php?s=<?=$get['p']?>"><button class="salvar">Salvar</button></a>
                            <?php
                        }
                    ?>
                    
                    <button class="pedir" onclick="alerta();">Pedir</button>
                </div>
            </div>
        </section><!--Informações do produto-->

        <section class="itens_semelhantes destaque">
            <h2>Semelhantes</h2>

            <?php
                $consulta_produtos = $conexao->query("SELECT * FROM produtos WHERE id_categoria = ".$id_categoria);
                $produtos = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="produtos produtos_menu sugestoes">
                <?php
                    foreach ($produtos as $key => $prod) {
                    ?>
                    <a href="produto.php?p=<?=md5($prod['id'])?>">
                            <div class="produto produto_menu ">
                            <img src="<?=$prod['imagem']?>" alt="">
                            <h3><?=$prod['nome']?></h3>
                            <p class="preco">R$ <?=$prod['valor']?></p>
                        </div>
                    </a>
                    <?php
                    }
                ?>
            </div>

        </section><!--Semelhantes-->

        <!-- <section class="para_voce destaque">
            <h2>Sugestões para você</h2>

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

        </section>Para você -->
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