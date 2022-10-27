<?php
    include_once("config/conexao.php");
    include_once("config/automatico.php");

    if (!isset($_SESSION['usuario'])) {
        header("location: login.php");
    }

    $consulta = $conexao->query('SELECT * FROM usuarios WHERE id = '.$_SESSION['id']);
    $user = $consulta->fetch(PDO::FETCH_ASSOC);
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
<body  class="body_login">
    
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

    <!-- Modal excluir -->
    <div class="div_excluir" style="display: none;">
        <div class="box-excluir">
            <form action="processos/proc_meus_dados.php" method="POST">
                <div>
                    <h3 style="color: red">Tem certeza que deseja excluir sua conta permanentemente?</h3>
                </div>

                <div>
                    <p style="color: red">ESSA AÇÃO NÃO PODERÁ SER DESFEITA</p>
                </div>

                <div>
                    <input type="password" placeholder="Digite sua senha para confirmar essa ação" name="senha" required>
                    <input type="hidden" name="config" value="<?=$user['senha']?>">
                </div>

                <div>
                    <a class="botoes_excluir" onclick="mostrar_excluir()" style="background-color: #0000ff9c;">Cancelar</a>
                    <input class="botoes_excluir" type="submit" value="Excluir" style="background-color: #ff0000d9;" name="excluir">
                </div>
            </form>
        </div>
    </div><!-- Modal excluir -->

    <section class="login meus_dados_box">
            <h2>MEUS DADOS</h2>
            <?php
                include("processos/msg.php");
            ?>
            <form action="processos/proc_meus_dados.php" method="post" class="meus_dados">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" placeholder="Nome" value="<?=$user['nome']?>" required>
                </div>

                <div>
                    <label for="telefone">Celular:</label>
                    <input type="tel" name="telefone" id="telefone" value="<?=$user['telefone']?>" placeholder="(11) 911111111" required>
                </div>

                <div>
                    <label for="email">Email: </label>
                    <input type="email" placeholder="exemplo@email.com" value="<?=$user['email']?>" name="email" required>
                </div>

                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" placeholder="Senha" name="senha" required>
                </div>

                <div>
                    <label for="nova_senha"> Nova senha:</label>
                    <input type="password" placeholder="Nova Senha" name="nova_senha">
                </div>

                <div>
                    <label for="conf_senha">Confirme a senha:</label>
                    <input type="password" placeholder="Confirme a senha" name="conf_senha">
                </div>
                <input type="hidden" name="config" value="<?=$user['senha']?>">
                <input type="submit" name="alterar" value="Alterar">
                <a onclick="mostrar_excluir()" style="cursor: pointer;">Excluir conta</a>
            </form>
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