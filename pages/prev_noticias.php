<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prévia das Notícias</title>
    <link rel="icon" type="image/jpg" href="/Farmafittos-vers-o-final/assets/">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/css/filtro.css">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/css/prev_noticias.css">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css">

    
    <?php include '../includes/header.php'; ?>
</head>

<body>
    <?php
    require_once(__DIR__ . '/../includes/conexao.php');

    $buscar = trim($_GET['buscar'] ?? '');

    $sql = "SELECT id, titulo, capa, data_publicacao, conteudo 
        FROM noticias 
        WHERE deletado = 0";

    if (!empty($buscar)) {
        $sql .= " AND titulo LIKE ?";
        $stmt = $conexao->prepare($sql);
        $param = '%' . $buscar . '%';
        $stmt->bind_param('s', $param);
    } else {
        $sql .= " ORDER BY data_publicacao DESC";
        $stmt = $conexao->prepare($sql);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();
    ?>

    <div class="container">
        <div class="mobile-buttons">
            <button onclick="openModal('modalSearch')"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button onclick="openModal('modalFilter')"><i class="fa-solid fa-compass"></i></button>
        </div>
        <div class="container-left">
            <?php if ($resultado->num_rows === 0): ?>
                <p style="text-align:center;">Nenhuma notícia encontrada.</p>
            <?php endif; ?>

            <?php while ($noticia = $resultado->fetch_assoc()): ?>
                <div class="container-noticias">
                    <div class="container-img">
                        <img src="/Farmafittos-vers-o-final/<?= htmlspecialchars($noticia['capa']) ?>"
                            alt="Capa da Notícia">
                    </div>
                    <div class="container-text">
                        <h1 class="titulo"><?= htmlspecialchars($noticia['titulo']) ?></h1>
                        <h2 class="data">
                            <i class="fa-solid fa-calendar-days"></i>
                            <?= date('d/m/Y', strtotime($noticia['data_publicacao'])) ?>
                        </h2>
                        <p class="previa-conteudo">
                            <?= nl2br(htmlspecialchars(mb_strimwidth($noticia['conteudo'], 0, 300, '...'))) ?>
                        </p>
                        <a href="noticia.php?id=<?= $noticia['id'] ?>" class="btn-ver-mais">Ver Mais</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="container-right">
            <div class="container-seach">
                <h1>Pesquisar</h1>
                <form method="GET" action="prev_noticias.php">
                    <div class="input-seach">
                        <input type="search" name="buscar" placeholder="Pesquisa por título"
                            value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
                        <button type="submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="container-filter">
                <h1>Filtrar</h1>
                <div class="card-filter">
                    <h2>Recentes</h2>
                    <h2>Antigas</h2>
                    <h2>Relevantes</h2>
                    <h2>Mais pesquisado</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pesquisa -->
    <div id="modalSearch" class="modalPesquisa">
        <div class="modal-content-pesquisa">
            <span class="close" onclick="closeModal('modalSearch')">&times;</span>
            <div class="container-seach-modal">
                <h1>Pesquisar Notícia</h1>
                <form method="GET" action="prev_noticias.php">
                    <div class="input-seach-modal">
                        <input type="text" name="buscar" placeholder="Digite para buscar...">
                        <button type="submit">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Filtros -->
    <div id="modalFilter" class="modalFiltro">
        <div class="modal-content-filtro">
            <span class="close" onclick="closeModal('modalFilter')">&times;</span>
            <div class="container-filter-modal">
                <h1>Filtros</h1>
                <div class="card-filter-modal">
                    <h2>ANTI-INFLAMATÓRIA</h2>
                    <h2>ANTIMICROBIANA</h2>
                    <h2>ANTISSÉPTICA</h2>
                    <h2>ANTIALÉRGICA</h2>
                </div>
            </div>
        </div>
    </div>

    <script src="/Farmafittos-vers-o-final/assets/js/filtro.js"></script>
    <script>
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "block";

        // Foca automaticamente no input se existir
        const input = modal.querySelector('input[type="text"], input[type="search"]');
        if (input) {
            input.focus();
        }
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.style.display = "none";
    }
}

// Fecha o modal se clicar fora do conteúdo
window.onclick = function (event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
};

// Fecha o modal ao pressionar ESC
document.addEventListener('keydown', function (event) {
    if (event.key === "Escape") {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.style.display = "none";
        });
    }
});

// Envia o formulário de pesquisa ao pressionar Enter dentro do input
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('#modalSearch input[type="text"], #modalSearch input[type="search"]');
    if (searchInput) {
        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                const form = this.closest('form');
                if (form) {
                    form.submit();
                } else {
                    // Alternativa: redirecionar manualmente com GET
                    const query = this.value.trim();
                    if (query) {
                        window.location.href = `prev_noticias.php?busca=${encodeURIComponent(query)}`;
                    }
                }
            }
        });
    }
});
    </script>

<?php include '../includes/footer.php'; ?>
</body>

</html>