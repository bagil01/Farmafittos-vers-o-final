<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/admin/css/index.css" />
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css">
</head>

<body>
    <div class="admin-container">
        <div class="voltar">
            <a href="/Farmafittos-vers-o-final/">
                <i class="fa-solid fa-house"></i>
                INICIO
            </a>
        </div>
        <main class="main-content">
            <h1>Bem-vindo ao Painel de administração</h1>
            <p>Selecione uma das opções no menu para gerenciar o conteúdo.</p>

            <div class="painel-wrapper">
                <!-- Blocos de administração à esquerda -->
                <div class="container-controle">
                    <div class="card-grid">
                        <a href="/Farmafittos-vers-o-final/admin/pages/gerenciar_admin.php">
                            <div class="card">
                                <i class="fa-solid fa-users-gear"></i>
                                <h3>Gerenciar ADMs</h3>
                            </div>
                        </a>
                        <a href="/Farmafittos-vers-o-final/admin/pages/gerenciador.php">
                            <div class="card">
                                <i class="fa-solid fa-newspaper"></i>
                                <h3>Gerenciar Notícia</h3>
                            </div>
                        </a>
                        <div class="card">
                            <i class="fas fa-plus-circle"></i>
                            <h3>Gerenciar Atividades</h3>
                        </div>
                        <div class="card">
                            <i class="fa-solid fa-sun-plant-wilt"></i>
                            <h3>Gerenciar Plantas</h3>
                        </div>
                        <div class="card">
                            <i class="fa-solid fa-calendar-days"></i>
                            <h3>Gerenciar Eventos</h3>
                        </div>
                        <a href="/Farmafittos-vers-o-final/admin/pages/gerenciador_parceiros.php">
                        <div class="card">
                            <i class="fa-solid fa-handshake"></i>
                            <h3>Gerenciar Parceiros</h3>
                        </div>
                        </a>
                        <div class="card">
                            <i class="fa-solid fa-handshake-angle"></i>
                            <h3>Gerenciar Colaboradores</h3>
                        </div>
                        <a href="/Farmafittos-vers-o-final/admin/pages/gerenciador_referencias.php">
                        <div class="card">
                            <i class="fa-solid fa-star-of-life"></i>
                            <h3>Gerenciar Referências</h3>
                        </div>
                        </a>
                    </div>
                </div>


            </div>
        </main>
    </div>
</body>

</html>