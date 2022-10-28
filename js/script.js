// MENU
var botao_menu = document.querySelector(".logo");
var menu = document.querySelector(".menu");

// Função para manter o menu configurado para computador
start();
window.onresize = start;

function start() {
  if (window.innerWidth > 768) {
    menu.style.height = "auto";
  } else {
    menu.style.height = "170px";
  }
}

// Mostrando menu, MOBILE
botao_menu.addEventListener("click", () => {
  if (window.innerWidth <= 768) {
    if (menu.style.height == "400px") {
      menu.style.height = "170px";
      botao_menu.style.animation = "none";
      setTimeout(function () {
        botao_menu.style.animation = "";
      }, 100);
    } else {
      menu.style.height = "400px";
      botao_menu.style.animation = "none";
      setTimeout(function () {
        botao_menu.style.animation = "";
      }, 100);
    }
  }
});

// MOSTRAR OPCOES DO MENU
function mostrar_opc_usuario() {
  var opc_usuario = document.querySelector(".opc_usuario");
  var fechar = document.querySelector(".fechar");

  if (opc_usuario.style.display == 'flex') {
    opc_usuario.style.display = 'none';
    fechar.style.display = 'none';
  }else if (opc_usuario.style.display == 'none') {
    opc_usuario.style.display = 'flex';
    fechar.style.display = 'block';
  }
}

// Mostrar pesquisar

var pesquisa = document.querySelector(".pesquisar");
var lupa = document.querySelector(".lupa");

lupa.addEventListener("click", () => {
  if (pesquisa.style.width == "230px") {
    pesquisa.style.width = "0px";
    pesquisa.style.padding = "0px";
  } else {
    pesquisa.style.width = "230px";
    pesquisa.style.padding = "5px";
  }
});

// MOSTAR MAIS MENU
function mostrar(i) {
  var div = document.querySelectorAll(".produtos_menu")[i];
  var btn = document.querySelectorAll(".mostrar_mais")[i];

  if (div.style.maxHeight == "100%") {
    div.style.maxHeight = "329px";
    btn.innerHTML = "<span onclick='mostrar(" + i + ")'>Mostrar Mais</span>";
  } else {
    div.style.maxHeight = "100%";
    btn.innerHTML = "<span onclick='mostrar(" + i + ")'>Mostrar Menos</span>";
  }
}

// Selecionando imagem ao criar um produto

function nova_preview() {
  var input = document.getElementById("imagem");
  if (input.files && input.files[0]) {
    var file = new FileReader();
    file.onload = function (e) {
      document.querySelector(".img_produto").src = e.target.result;
    };
    file.readAsDataURL(input.files[0]);
  }
}

// Alerta excluir

function alerta_excluir(i, m) {

  var modal = document.querySelector(".modal_alerta");

  if (i==0) {
    window.location.href = "categorias.php";
  }else if(i==1){
    modal.style.display = 'none';
  }else if (i==3) {
    modal.style.display = 'block';

    if (m !== undefined) {
      window.location.href = "../processos/proc_produto.php?x="+m;
    }
  }
}

// Filtro categorias

function filtro_categorias() {
  c = document.getElementById("filtro").value;
  window.location.href = "admin_produtos.php?c="+c;
}

// Filtro reservas

function filtro_reservas(i) {
  // c = document.getElementById("filtro").value;
  window.location.href = "admin_reservas.php?f="+i;
}

// Filtro salvos

function filtro_salvos(i) {
  window.location.href = "favoritos.php?f="+i;
}

// Filtro menu

function filtro_menu(i) {
  window.location.href = "menu.php?f="+i;
}

// FUNÇÃO INDISPONIVEL
function alerta(){
  alert("Função ainda indisponivel");
}

// Mostrar opção de excluir conta
function mostrar_excluir() {
  var del = document.querySelector(".div_excluir");
  if (del.style.display == 'none') {
    del.style.display = 'block';
  }else{
    del.style.display = 'none';
  }
}

function alerta_avaliacao() {
  var excluir = document.querySelector(".excluir_av");

  if (excluir.style.display == 'none') {
    alert("Essa ação não poderá ser desfeita, para prossegir clique em excluir");
    excluir.style.display = 'block';
  }else{
    excluir.style.display = 'none';  
  }
}