<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");

    
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
    
    if (!isset($post['pesquisa'])) {
        header("location: menu.php");
    }
    
    $pesquisa = "%".$post['pesquisa']."%";

    // Consultas produtos
    $consulta_produtos = $conexao->prepare("SELECT * FROM produtos WHERE categoria LIKE ? OR nome LIKE ? OR descricao LIKE ? OR nome_produto LIKE ? OR valor LIKE ?");
    $consulta_produtos->execute(array($pesquisa, $pesquisa, $pesquisa, $pesquisa, $pesquisa));
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
    
    <main class="corpo" style="min-height: 500px;">

        <?php
            // Aplicando filtro

                $produtos = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <section class="destaque destaque_menu">

                        <div class="produtos">
                            <?php
                            // Produtos

                        if ($consulta_produtos->rowCount()>0) {
                            foreach ($produtos as $i => $prod) {
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
                
                        }else{
                           ?>
                                <h1 style="color:#ccc;">Sem resultados</h1>
                            
                           <?php
                        }
                            ?>
                    </section>
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