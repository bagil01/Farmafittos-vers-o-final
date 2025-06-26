<?php
// Este é o cabeçalho do site Farmafittos
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Farmafittos</title>

    <!-- Estilos paginas -->
    <link rel="stylesheet" href="./assets/css/header.css" />
    <link rel="stylesheet" href="./assets/css/config.css" />
    <link rel="stylesheet" href="./assets/icons/fontawesome-free-6.5.2-web/css/all.css">
    <!---estilos header--->
    <link rel="stylesheet" href="../assets/css/header.css" />
    <link rel="stylesheet" href="../assets/css/config.css" />
    <link rel="stylesheet" href="../assets/icons/fontawesome-free-6.5.2-web/css/all.css">
</head>

<body>
    <header>
        <div class="painel">
            <div class="leaf-background"></div>
            <div class="incones">
                <a href="./index.php">
                    <img src="assents/Design sem nome (2).png" alt="Logo do projeto" class="logo" />
                </a>
                <ul class="icons-right">
                    <li>
                        <a id="abrirModal" href="#"><i class="fa-solid fa-gear"></i></a>
                    </li>
                </ul>
            </div>
            <div class="titulo">
                <h1>FARMAFITTOS</h1>
            </div>
        </div>

        <nav class="navbar">
            <div class="mobile-menu-icon" id="menuToggle">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="menu" id="menuMobile">
                <li><a href="./index.php">Página Inicial</a></li>

                <li class="dropdown">
                    <a href="#">Sobre Nós ▾</a>
                    <ul class="submenu">
                        <li><a href="./Apesentacao_Projeto.php">Apresentação do Projeto</a></li>
                        <li><a href="./Colobaradiores_e_voluntarios.php">Colaboradores e Voluntários</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#">Publicações ▾</a>
                    <ul class="submenu">
                        <li><a href="./prev-noticias.php">Notícias</a></li>
                        <li><a href="./prev-atividades.php">Atividades</a></li>
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
                    <a href="./admin/painel-admin.php">
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
</body>

</html>