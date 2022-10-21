<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");

    $id_categoria = 1;

    $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRIPPED);

    if (isset($get['f'])) {
        // Existe filtro
        // Consultas
        $cons_categorias = $conexao->query("SELECT * FROM categoria");
        $resultado = $cons_categorias->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultado as $key => $value) {
            // Descriptografando
            $md5 = md5($value['id_categoria']);
            if($md5 == $get['f']){
                $id_cat = $value['id_categoria'];
                $id_categoria = $get['f'];
                break;
            }
        }
    }
    
    
    // Consultas sem filtro
    $consulta_categorias = $conexao->query("SELECT * FROM categoria");
    $cat = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);
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
            <select name="filtro" id="filtro" onchange="filtro_menu(this.value)">
                    <option value="1">Tudo</option>
                    <?php
                    foreach ($cat as $key => $categorias) {

                        $selected = "";

                        if ($id_categoria == md5($categorias['id_categoria'])) {
                            $selected = "selected";
                        }

                    ?>
                        <option value="<?=md5($categorias['id_categoria'])?>" <?=$selected?>><?=$categorias['categoria']?></option>
                    <?php
                    }
                    ?>
            </select>
        </form>

        <?php
            // Aplicando filtro

            if ($id_categoria != 1) {
                // Consulta com filtro
                $consulta_categorias = $conexao->query("SELECT * FROM categoria WHERE id_categoria = $id_cat");
                $cat = $consulta_categorias->fetchAll(PDO::FETCH_ASSOC);
            }

            foreach ($cat as $key => $categorias) {

                // Buscando produtos

                $consulta_produtos = $conexao->query("SELECT * FROM produtos WHERE id_categoria = ".$categorias['id_categoria']);
                $produtos = $consulta_produtos->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <section class="destaque destaque_menu">
                        <h2><?=$categorias['categoria']?></h2>

                        <div class="produtos produtos_menu ">
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
                    
                    <p class="mostrar_mais" style="width: 100%; text-align:center; margin: 30px auto;"><span onclick="mostrar(<?=$key?>)">Mostrar Mais</span></p>
                        
                    <hr>
                <?php
            }
        ?>
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