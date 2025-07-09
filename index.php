<?php
require_once(__DIR__ . '/includes/conexao.php');

// Destaques das notícias
$sqlDestaquesNoticias = "SELECT id, titulo, capa, 'noticia' AS tipo FROM noticias WHERE deletado = 0 AND destaque = 'sim' ORDER BY data_publicacao DESC LIMIT 3";
$destaquesNoticias = $conexao->query($sqlDestaquesNoticias);

// Destaques das atividades
$sqlDestaquesAtividades = "SELECT id, titulo, capa, 'atividade' AS tipo FROM atividades WHERE deletado = 0 AND destaque = 'sim' ORDER BY data_publicacao DESC LIMIT 2";
$destaquesAtividades = $conexao->query($sqlDestaquesAtividades);

// Unir os dois tipos de destaques
$destaques = [];
while ($row = $destaquesNoticias->fetch_assoc()) {
  $destaques[] = $row;
}
while ($row = $destaquesAtividades->fetch_assoc()) {
  $destaques[] = $row;
}

// Notícias recentes
$sqlNoticias = "SELECT id, titulo, capa, conteudo FROM noticias WHERE deletado = 0 ORDER BY data_publicacao DESC LIMIT 3";
$noticias = $conexao->query($sqlNoticias);

// Parceiros
$sqlParceiros = "SELECT logo, referencia FROM parceiros ORDER BY id DESC LIMIT 6";
$parceiros = $conexao->query($sqlParceiros);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Inicial</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./assets/css/index.css">
  <link rel="stylesheet" href="./assets/icons/fontawesome-free-6.5.2-web/css/all.css">
  <?php include 'includes/header.php'; ?>
</head>

<body>
  <div class="container">
    <div class="swiper destaque">
      <h2>Destaques</h2>
      <div class="swiper-wrapper">
        <?php foreach ($destaques as $d): ?>
          <div class="swiper-slide">
            <a href="./pages/<?= $d['tipo'] ?>.php?id=<?= $d['id'] ?>">
              <img src="./<?= htmlspecialchars($d['capa']) ?>" alt="<?= htmlspecialchars($d['titulo']) ?>">
              <h3><?= htmlspecialchars($d['titulo']) ?></h3>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>

    <!-- Notícias Recentes -->
    <section class="noticias">
      <h2>Notícias Recentes</h2>
      <div class="noticias-container">
        <?php while ($n = $noticias->fetch_assoc()): ?>
          <div class="noticia">
            <a href="./pages/noticia.php?id=<?= $n['id'] ?>">
              <img src="./<?= htmlspecialchars($n['capa']) ?>" alt="Notícia">
              <h3><?= htmlspecialchars($n['titulo']) ?></h3>
              <p><?= nl2br(htmlspecialchars(mb_strimwidth($n['conteudo'], 0, 300, '...'))) ?></p>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <!-- Parceiros -->
    <div class="container-colaboradores">
      <h2>Parceiros</h2>
      <div class="carousel">
        <?php while ($p = $parceiros->fetch_assoc()): ?>
          <div class="card-parceiros">
            <a href="<?= htmlspecialchars($p['referencia']) ?>" target="_blank">
              <img src="./<?= htmlspecialchars($p['logo']) ?>" alt="Parceiro">
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="assets/js/index/carrosel_destaque.js"></script>
  <script src="assets/js/index/carrosel_parceiros.js"></script>

  <?php include 'includes/footer.php'; ?>
</body>

</html>
