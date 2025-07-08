<?php
require_once('../../includes/conexao.php');

$id = $_GET['id_atividade'] ?? null;
if (!$id || !is_numeric($id)) {
    exit('<p>ID inválido.</p>');
}

$stmt = $conexao->prepare("SELECT * FROM fotos_atividades WHERE atividade_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<p>Nenhuma imagem encontrada para esta atividade.</p>";
    exit;
}
?>

<?php while ($img = $resultado->fetch_assoc()): ?>
  <div class="img-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
    <img 
      src="../../<?= htmlspecialchars($img['caminho']) ?>" 
      alt="Imagem da Atividade" 
      style="width: 100px; border-radius: 6px; box-shadow: 0 0 5px rgba(0,0,0,0.2);"
    >
    <form 
      action="../../backend/crud_atividade/excluir_imagem.php" 
      method="POST"
    >
      <input type="hidden" name="id_imagem" value="<?= $img['id'] ?>">
      <button type="submit" style="background-color: #c0392b; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
        Excluir
      </button>
    </form>
  </div>
<?php endwhile; ?>
