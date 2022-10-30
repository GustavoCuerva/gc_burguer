# GC BURGUER

## Como usar

Antes de falarmos sobre o projeto é importante saber como utiliza-lo.

### Configurando o projeto
Ao baixarem o projeto teram de movelo para um servidor local ou remoto para rodar as páginas em php;

### Banco de dados
Na pasta SQL possui um backup do banco de dados em sql na qual você poderá importalo para utilizar: <br>
    . Dentro do banco de dados já tem alguns dados existentes para você conseguir vizualizar melhor o projeto;<br>
        . As senhas dos usuarios cadastrados são exatamente seu nome de usuario;<br>
    . Caso deseje limpar o banco de dados para começar do zero observe que na tabela usuario em permissao deverá mudar apenas do administrador de 0 para 1;<br>
    .Após criar o banco de dados vá até a pasta config e no arquivo conexao.php altere as constantes HOST, DB, USER e PASS para as respectivas de seu banco de dados.<br>

## Sobre o projeto
O projeto possui como proposta ser um site para um restaurante, no caso hamburgueiria, com sistema de cadastro de produtos, reservas e cardápio. Além disso foi incrementada diversas funções que dá mais possibilidades ao administrador fazer alterações sem a nescessidade de um programador.<br><br>

Além disso foi implementada funcionalidades como avaliação, favoritar produtos e pesquisa, para melhorar a experiencia do usuário.

### Como foi desenvolvido
Esse projeto foi desenvolvido no periodo de umas 2 a 3 semanas, sendo feito nas linguagens PHP, JavaScript, CSS e HTML.<br><br>

Foram implementados diversos conceitos nesse projeto, tanto na parte do front-end como em back-end. Como por exemplo a ultilização de uma biblioteca para o efeito de carrocel, responsividade e a implementação de classes para agilizar a programação.

### Observação:
As imagens utilizadas nesse projeto junto com os valores de descrição são meramente ilustrativas, a maioria das imagens não são de autoria própria, apenas um exemplo.

## Funcionalidades a implementar:
    . Carrocel de produtos
    . Reservas
        . Contato
        . Pré selecionar lanches
    . Pedir produtos
        . Sistema de frete
        . Sistema de pagamentos
    . Enviar informações por email
        . Dados da reserva
        . Recuperar senha
        . Confirmar conta
