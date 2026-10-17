<?php 
    include "./includes/conexao.php";
    include "./includes/logado.php"; // Garante que a sessão está iniciada e o usuário está logado
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Voz da Infância | Trabalho Infantil</title>

    <link rel="stylesheet" href="pagina_inicial.css">
</head>

<body>

<header>

    <div class="topo">

        <div>
            <div class="logo">
                VOZ <span>DA INFÂNCIA</span>
            </div>

            <div class="data">
                Jornalismo, informação e direitos
            </div>
        </div>

        <div class="usuario">
            <span>@<?php echo htmlspecialchars($_SESSION['nome_user'] ?? ''); ?></span>
            <a id="sair" href="./actions/logoff.php">Sair</a>
        </div>

    </div>

    <nav>
        <ul>

            <li>
                <a href="#inicio">INÍCIO</a>
            </li>

            <li>
                <a href="../projeto_de_pi/index.php">FÓRUM</a>
            </li>

            <li>
                <a href="#historia">HISTÓRIA</a>
            </li>

            <li>
                <a href="#dados">DADOS</a>
            </li>

            <li>
                <a href="#legislacao">LEGISLAÇÃO</a>
            </li>

            <li>
                <a href="#consequencias">CONSEQUÊNCIAS</a>
            </li>

            <li>
                <a href="#relatos">RELATOS</a>
            </li>

        </ul>
    </nav>

</header>


<main class="container" id="inicio">

    <div class="breaking">

        <strong>EM DESTAQUE</strong>

        Trabalho infantil continua sendo um dos principais desafios
        para a garantia dos direitos de crianças e adolescentes.

    </div>


    <!-- CARROSSEL -->

    <section class="carousel-section">

        <div class="carousel">

            <div class="slides">

                <div class="slide">

                    <div class="slide-content">

                        <span class="tag">
                            Brasil
                        </span>

                        <h2>
                            1,65 milhão de crianças e adolescentes estavam em situação de trabalho infantil em 2024
                        </h2>

                        <p>
                            O número representa 4,3% da população brasileira de 5 a 17 anos.
                        </p>

                    </div>

                </div>


                <div class="slide">

                    <div class="slide-content">

                        <span class="tag">
                            Direitos
                        </span>

                        <h2>
                            No Brasil, trabalho antes dos 16 anos é proibido, salvo na condição de aprendiz
                        </h2>

                        <p>
                            A aprendizagem profissional pode começar a partir dos 14 anos,
                            seguindo regras específicas.
                        </p>

                    </div>

                </div>


                <div class="slide">

                    <div class="slide-content">

                        <span class="tag">
                            Educação
                        </span>

                        <h2>
                            Trabalho infantil pode interferir na escola e no desenvolvimento de crianças e adolescentes
                        </h2>

                        <p>
                            Jornada excessiva, atividades perigosas e abandono escolar
                            estão entre os riscos.
                        </p>

                    </div>

                </div>


                <div class="slide">

                    <div class="slide-content">

                        <span class="tag">
                            Sociedade
                        </span>

                        <h2>
                            Combater o trabalho infantil exige participação do Estado e de toda a sociedade
                        </h2>

                        <p>
                            Políticas públicas, fiscalização, educação e proteção social
                            são fundamentais.
                        </p>

                    </div>

                </div>

            </div>


            <button class="arrow prev" onclick="mudarSlide(-1)">
                ‹
            </button>

            <button class="arrow next" onclick="mudarSlide(1)">
                ›
            </button>


            <div class="dots">

                <span class="dot active" onclick="irParaSlide(0)"></span>

                <span class="dot" onclick="irParaSlide(1)"></span>

                <span class="dot" onclick="irParaSlide(2)"></span>

                <span class="dot" onclick="irParaSlide(3)"></span>

            </div>

        </div>

    </section>


    <!-- CONTEÚDO PRINCIPAL -->

    <div class="layout">

        <article>

            <span class="categoria">
                Especial • Trabalho Infantil
            </span>

            <h1>
                Trabalho infantil: uma realidade que ainda faz parte do Brasil
            </h1>

            <p class="subtitulo">
                Entenda como o problema surgiu, quais fatores contribuem para sua permanência,
                o que diz a legislação brasileira e quais são os impactos sobre crianças e adolescentes.
            </p>

            <div class="autor">
                Por Voz da Infância • Especial de Direitos Humanos
            </div>


            <h2 id="historia">
                O que é trabalho infantil?
            </h2>

            <p>
                Trabalho infantil é aquele realizado por crianças e adolescentes em
                condições que não são permitidas pela legislação ou que prejudicam seu
                desenvolvimento, sua saúde, sua segurança ou sua educação.
            </p>

            <p>
                A Organização Internacional do Trabalho (OIT) destaca que nem toda
                atividade realizada por uma pessoa menor de 18 anos é automaticamente
                classificada como trabalho infantil. A idade, o tipo de atividade,
                a quantidade de horas trabalhadas e as condições em que ela acontece
                precisam ser considerados.
            </p>


            <div class="destaque">

                “Criança deve ter acesso à educação, proteção, convivência familiar,
                lazer e desenvolvimento. O trabalho não pode retirar esses direitos.”

            </div>


            <h2>
                Uma questão histórica
            </h2>

            <p>
                O trabalho infantil não é um fenômeno recente. Durante séculos,
                crianças participaram de atividades agrícolas, artesanais e domésticas.
                Com a Revolução Industrial, porém, o problema ganhou novas dimensões.
            </p>

            <p>
                Nos séculos XVIII e XIX, crianças passaram a ser empregadas em fábricas,
                minas e outras atividades em condições extremamente difíceis. As longas
                jornadas e os baixos salários tornavam a mão de obra infantil atraente
                para alguns empregadores.
            </p>

            <p>
                A partir das transformações sociais e das lutas por direitos trabalhistas,
                diferentes países começaram a estabelecer limites de idade, jornada e
                condições de trabalho.
            </p>


            <h2>
                O trabalho infantil no Brasil
            </h2>

            <p>
                No Brasil, a história do trabalho infantil está relacionada à própria
                formação econômica e social do país.
            </p>

            <p>
                A Constituição Federal de 1988 estabeleceu importantes garantias para
                crianças e adolescentes.
            </p>


            <h2 id="dados">
                Os números mais recentes
            </h2>

            <p>
                Segundo dados da PNAD Contínua divulgados pelo IBGE, em 2024 o Brasil
                tinha aproximadamente 1,65 milhão de crianças e adolescentes de 5 a 17
                anos em situação de trabalho infantil.
            </p>


            <div class="dados">

                <div class="dado">

                    <strong>1,65 mi</strong>

                    <span>
                        em situação de trabalho infantil
                    </span>

                </div>


                <div class="dado">

                    <strong>4,3%</strong>

                    <span>
                        da população de 5 a 17 anos
                    </span>

                </div>


                <div class="dado">

                    <strong>5–17</strong>

                    <span>
                        faixa etária analisada
                    </span>

                </div>

            </div>


            <p>
                O número mostra que, apesar dos avanços registrados nas últimas décadas,
                o problema ainda atinge uma parcela significativa da população infantil
                e adolescente brasileira.
            </p>


            <h2>
                Onde o problema aparece?
            </h2>

            <p>
                O trabalho infantil pode ocorrer em diferentes contextos. Entre eles
                estão atividades agrícolas, comércio, serviços, trabalho doméstico,
                atividades informais e outras ocupações.
            </p>


            <h2 id="consequencias">
                Quais são as consequências?
            </h2>

            <p>
                O trabalho infantil pode afetar diferentes áreas da vida de crianças
                e adolescentes. Jornadas extensas podem dificultar a frequência e o
                rendimento escolar, enquanto atividades perigosas podem colocar a
                saúde e a segurança em risco.
            </p>

            <p>
                Além disso, quando uma criança precisa assumir responsabilidades
                incompatíveis com sua idade, ela pode ter menos oportunidades de
                brincar, estudar e conviver com outras pessoas.
            </p>


            <h2>
                Trabalho infantil e desigualdade
            </h2>

            <p>
                A pobreza e a desigualdade social estão entre os fatores relacionados
                à permanência do trabalho infantil.
            </p>

            <p>
                Porém, essa situação pode criar um ciclo difícil de romper: a entrada
                precoce no trabalho pode prejudicar a educação e limitar oportunidades
                futuras.
            </p>


            <h2 id="legislacao">
                O que diz a legislação brasileira?
            </h2>

            <p>
                A Constituição Federal estabelece a proteção dos direitos de crianças
                e adolescentes. A legislação brasileira também conta com o Estatuto
                da Criança e do Adolescente (ECA) e normas trabalhistas específicas.
            </p>

            <p>
                A regra geral é: antes dos 16 anos, o trabalho é proibido, com exceção
                da condição de aprendiz a partir dos 14 anos.
            </p>


            <div class="destaque">

                A aprendizagem profissional é diferente do trabalho infantil:
                ela possui regras específicas, contrato, direitos e objetivo de
                formação profissional.

            </div>


            <h2>
                Uma linha do tempo
            </h2>


            <div class="timeline">

                <div class="timeline-item">

                    <strong>
                        Revolução Industrial
                    </strong>

                    <p>
                        A utilização de crianças em fábricas e minas torna-se um
                        importante problema social.
                    </p>

                </div>


                <div class="timeline-item">

                    <strong>
                        1919 — criação da OIT
                    </strong>

                    <p>
                        A Organização Internacional do Trabalho passa a atuar na
                        construção de normas internacionais relacionadas ao trabalho.
                    </p>

                </div>


                <div class="timeline-item">

                    <strong>
                        1988 — Constituição Federal
                    </strong>

                    <p>
                        O Brasil amplia a proteção constitucional de crianças e
                        adolescentes.
                    </p>

                </div>


                <div class="timeline-item">

                    <strong>
                        1990 — ECA
                    </strong>

                    <p>
                        O Estatuto da Criança e do Adolescente fortalece a proteção
                        integral e a garantia de direitos.
                    </p>

                </div>


                <div class="timeline-item">

                    <strong>
                        2002 — Dia Mundial
                    </strong>

                    <p>
                        A OIT estabelece 12 de junho como Dia Mundial contra o
                        Trabalho Infantil.
                    </p>

                </div>


                <div class="timeline-item">

                    <strong>
                        2024 — dados mais recentes
                    </strong>

                    <p>
                        O IBGE estima 1,65 milhão de crianças e adolescentes
                        em situação de trabalho infantil no Brasil.
                    </p>

                </div>

            </div>


            <h2>
                Como combater?
            </h2>

            <p>
                O combate ao trabalho infantil depende de ações articuladas entre
                governo, escolas, famílias, empresas e sociedade civil.
            </p>

            <p>
                Entre as medidas importantes estão a ampliação do acesso à educação,
                políticas de transferência de renda e proteção social, fiscalização
                das condições de trabalho, fortalecimento da aprendizagem profissional
                e conscientização da população.
            </p>


            <!-- FÓRUM / RELATOS -->

            <section class="forum" id="forum">

                <span class="categoria">
                    Fórum • Voz da Infância
                </span>

                <h2>
                    Espaço para relatos
                </h2>

                <p>
                    Você pode compartilhar uma experiência, opinião ou situação
                    relacionada ao trabalho infantil.
                </p>

                <p class="aviso-anonimo">
                    🔒 Seu relato será publicado de forma anônima.
                    Não informe nome, telefone, endereço ou outros dados pessoais.
                </p>


                <form id="relatoForm">

                    <label for="relato">
                        Escreva seu relato:
                    </label>

                    <textarea
                        id="relato"
                        name="relato"
                        rows="7"
                        maxlength="1000"
                        placeholder="Conte sua experiência ou opinião..."
                        required
                    ></textarea>


                    <div class="contador">
                        <span id="contador">0</span>/1000 caracteres
                    </div>


                    <button type="submit" class="btn-relato">
                        PUBLICAR RELATO ANÔNIMO
                    </button>

                </form>

            </section>


            <!-- RELATOS PUBLICADOS -->

            <section class="relatos" id="relatos">

                <div class="relatos-titulo">

                    <div>

                        <span class="categoria">
                            Comunidade
                        </span>

                        <h2>
                            Relatos publicados
                        </h2>

                    </div>

                    <button
                        type="button"
                        class="btn-limpar"
                        onclick="limparRelatos()"
                    >
                        Limpar relatos
                    </button>

                </div>


                <div id="listaRelatos">

                    <p class="sem-relatos">
                        Ainda não há relatos publicados.
                    </p>

                </div>

            </section>


        </article>


        <!-- SIDEBAR -->

        <aside>

            <div class="box">

                <h3>
                    Mais lidas
                </h3>

                <ul>

                    <li>
                        <span class="numero">01</span>
                        O que caracteriza o trabalho infantil?
                    </li>

                    <li>
                        <span class="numero">02</span>
                        Entenda a idade mínima para trabalhar
                    </li>

                    <li>
                        <span class="numero">03</span>
                        Trabalho infantil e desigualdade social
                    </li>

                    <li>
                        <span class="numero">04</span>
                        Os números do IBGE
                    </li>

                    <li>
                        <span class="numero">05</span>
                        Como combater o trabalho infantil?
                    </li>

                </ul>

            </div>


            <div class="box">

                <h3>
                    Você sabia?
                </h3>

                <p>
                    O dia 12 de junho é reconhecido internacionalmente como
                    o Dia Mundial contra o Trabalho Infantil.
                </p>

                <br>

                <p>
                    No Brasil, a data também é utilizada para mobilizar a
                    sociedade em torno da prevenção e do combate ao problema.
                </p>

            </div>


            <div class="box">

                <h3>
                    Idade mínima
                </h3>

                <ul>

                    <li>
                        <strong>Até 13 anos</strong><br>
                        Trabalho não permitido.
                    </li>

                    <li>
                        <strong>14 e 15 anos</strong><br>
                        Permitido como aprendiz.
                    </li>

                    <li>
                        <strong>16 e 17 anos</strong><br>
                        Trabalho permitido com restrições.
                    </li>

                    <li>
                        <strong>Menores de 18</strong><br>
                        Proibido trabalho noturno, perigoso ou insalubre.
                    </li>

                </ul>

            </div>


            <div class="box forum-box">

                <h3>
                    Fórum
                </h3>

                <p>
                    Quer compartilhar uma experiência ou opinião?
                </p>

                <a href="#forum" class="btn-forum">
                    DEIXAR UM RELATO
                </a>

            </div>

        </aside>

    </div>

</main>


<footer>

    <div class="footer-content">

        <div>

            <div class="logo">
                VOZ <span>DA INFÂNCIA</span>
            </div>

            <p>
                Informação, educação e defesa dos direitos da criança.
            </p>

        </div>

        <p>
            Projeto escolar • Especial sobre Trabalho Infantil
        </p>

    </div>

</footer>


<script src="script.js"></script>

</body>
</html>