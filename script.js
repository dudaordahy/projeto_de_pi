/* =========================
   CARROSSEL
========================= */

let slideAtual = 0;

const slides = document.querySelector(".slides");
const dots = document.querySelectorAll(".dot");

function atualizarSlide() {

    slides.style.transform =
        `translateX(-${slideAtual * 100}%)`;

    dots.forEach((dot, index) => {

        dot.classList.toggle(
            "active",
            index === slideAtual
        );

    });

}


function mudarSlide(direcao) {

    slideAtual += direcao;

    if (slideAtual < 0) {
        slideAtual = 3;
    }

    if (slideAtual > 3) {
        slideAtual = 0;
    }

    atualizarSlide();

}


function irParaSlide(numero) {

    slideAtual = numero;

    atualizarSlide();

}


/* Troca automática */

setInterval(() => {

    mudarSlide(1);

}, 6000);


/* =========================
   ROLAGEM SUAVE
========================= */

document.querySelectorAll("nav a").forEach(link => {

    link.addEventListener("click", function(e) {

        const destino =
            document.querySelector(
                this.getAttribute("href")
            );

        if (destino) {

            e.preventDefault();

            destino.scrollIntoView({
                behavior: "smooth"
            });

        }

    });

});


/* =========================
   RELATOS ANÔNIMOS
========================= */

const formulario =
    document.getElementById("relatoForm");

const campoRelato =
    document.getElementById("relato");

const contador =
    document.getElementById("contador");

const listaRelatos =
    document.getElementById("listaRelatos");


/* Contador de caracteres */

campoRelato.addEventListener("input", function() {

    contador.textContent =
        campoRelato.value.length;

});


/* =========================
   CARREGAR RELATOS
========================= */

function carregarRelatos() {

    const relatos =
        JSON.parse(
            localStorage.getItem("relatosVozInfancia")
        ) || [];

    listaRelatos.innerHTML = "";


    if (relatos.length === 0) {

        listaRelatos.innerHTML = `
            <p class="sem-relatos">
                Ainda não há relatos publicados.
            </p>
        `;

        return;
    }


    relatos.forEach(relato => {

        criarCardRelato(relato);

    });

}


/* =========================
   CRIAR CARD
========================= */

function criarCardRelato(relato) {

    const card =
        document.createElement("div");

    card.className =
        "relato-card";


    const texto =
        document.createElement("p");

    texto.textContent =
        relato.texto;


    const data =
        document.createElement("div");

    data.className =
        "relato-data";

    data.textContent =
        "Relato anônimo • " +
        relato.data;


    card.appendChild(texto);

    card.appendChild(data);

    listaRelatos.prepend(card);

}


/* =========================
   PUBLICAR RELATO
========================= */

formulario.addEventListener(
    "submit",
    function(e) {

        e.preventDefault();


        const texto =
            campoRelato.value.trim();


        if (texto === "") {

            alert(
                "Escreva seu relato antes de publicar."
            );

            return;
        }


        const relatos =
            JSON.parse(
                localStorage.getItem(
                    "relatosVozInfancia"
                )
            ) || [];


        const novoRelato = {

            texto: texto,

            data:
                new Date().toLocaleDateString(
                    "pt-BR"
                )

        };


        relatos.push(novoRelato);


        localStorage.setItem(
            "relatosVozInfancia",
            JSON.stringify(relatos)
        );


        campoRelato.value = "";

        contador.textContent = "0";


        carregarRelatos();


        document
            .getElementById("relatos")
            .scrollIntoView({
                behavior: "smooth"
            });


        alert(
            "Seu relato foi publicado de forma anônima!"
        );

    }
);


/* =========================
   LIMPAR RELATOS
========================= */

function limparRelatos() {

    const confirmar =
        confirm(
            "Tem certeza que deseja apagar todos os relatos salvos neste navegador?"
        );


    if (!confirmar) {
        return;
    }


    localStorage.removeItem(
        "relatosVozInfancia"
    );


    carregarRelatos();

}


/* =========================
   INICIALIZAÇÃO
========================= */

carregarRelatos();