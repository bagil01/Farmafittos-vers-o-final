<?php
require_once('../../includes/conexao.php');

$id = $_GET['id_noticia'] ?? null;
if (!$id) exit('<p>ID inválido.</p>');

$stmt = $conexao->prepare("SELECT * FROM fotos_noticias WHERE noticia_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<p>Nenhuma imagem encontrada.</p>";
    exit;
}
?>

<?php while ($img = $resultado->fetch_assoc()): ?>
  <div class="img-item" style="margin-bottom: 15px;">
    <img src="../../<?php echo $img['caminho']; ?>" alt="Imagem da Notícia" style="width: 100px;">
    <form action="../../backend/crud_noticia/excluir_imagem.php" method="POST" style="display:inline;">
      <input type="hidden" name="id_imagem" value="<?= $img['id'] ?>">
      <button type="submit">Excluir</button>
    </form>
  </div>
<?php endwhile; ?>
