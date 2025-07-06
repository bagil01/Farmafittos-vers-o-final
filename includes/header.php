<?php
// Este é o cabeçalho do site Farmafittos
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Farmafittos</title>

      <!---estilos header--->
    <link rel="icon" type="image/png"  href="/Farmafittos-vers-o-final/assets/favicons/favicon.png">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/css/header.css" />
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/css/config.css" />
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css">
</head>

<body>
    <header>
        <div class="painel">
            <div class="leaf-background"></div>
            <div class="incones">
                <a href="/Farmafittos-vers-o-final/">
                    <img src="/Farmafittos-vers-o-final/assets/photos/logo-preta.png" alt="Logo do projeto" class="logo" />
                </a>
                <ul class="icons-right">
                    <li>
                        <a id="abrirModal" href="#"><i class="fa-solid fa-gear"></i></a>
                    </li>
                </ul>
            </div>
            <div class="titulo_header">
                <h1>FARMAFITTOS</h1>
                <h2>AMAZÔNIA</h2>   
            </div>
        </div>

        <nav class="navbar">
            <div class="mobile-menu-icon" id="menuToggle">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="menu" id="menuMobile">
                <li><a href="/Farmafittos-vers-o-final/index.php">Página Inicial</a></li>

                <li class="dropdown">
                    <a href="#">Sobre Nós ▾</a>
                    <ul class="submenu">
                        <li><a href="/Farmafittos-vers-o-final/pages/Apresentacao_Projeto.php">Apresentação do Projeto</a></li>
                        <li><a href="/Farmafittos-vers-o-final/pages/colaboradores.php">Colaboradores e Voluntários</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#">Publicações ▾</a>
                    <ul class="submenu">
                        <li><a href="/Farmafittos-vers-o-final/pages/prev_noticias.php">Notícias</a></li>
                        <li><a href="/Farmafittos-vers-o-final/pages/prev_atividades.php">Atividades</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#">Plantas ▾</a>
                    <ul class="submenu">
                        <li><a href="./prev-plantas.php">Plantas</a></li>
                        <li><a href="./referencias.php">Referências</a></li>
                    </ul>
                </li>

                <li><a href="./eventos.php">Eventos</a></li>
            </ul>
        </nav>
    </header>

    <!-- Modal de Configurações -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="container-config">
                <span class="fechar" id="fecharModal">&times;</span>

                <div class="container-opcoes">
                    <a href="/Farmafittos-vers-o-final/admin/index.php">
                        <div class="opcao">
                            <i class="fa-solid fa-users-gear"></i>
                            <h4>Painel de administração</h4>
                        </div>
                    </a>

                    <div class="opcao">
                        <i class="fa-solid fa-lock"></i>
                        <h4>Privacidade e Termo de Uso</h4>
                    </div>

                    <div class="opcao">
                        <i class="fa-solid fa-circle-question"></i>
                        <h4>Ajuda e Suporte</h4>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="opcao">
                        <i class="fa-solid fa-moon"></i>
                        <h4>Tela e Acessibilidade</h4>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="opcao">
                        <i class="fa-solid fa-comment-dots"></i>
                        <h4>Dar Feedback</h4>
                    </div>

                    <div class="opcao sair">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <h4>Sair</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="./assets/js/config.js"></script>
    <script src="./assets/js/header.js"></script>
    <script src="./assets/js/animacao.js"></script>
    <!--Scripts-->
    <script src="/Farmafittos-vers-o-final/assets/js/config.js"></script>
    <script src="/Farmafittos-vers-o-final/assets/js/header.js"></script>
    <script src="/Farmafittos-vers-o-final/assets/js/animacao.js"></script>
</body>

</html>