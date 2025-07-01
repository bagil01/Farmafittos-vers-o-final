<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Parceiros </title>
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css">
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/admin/css/gerenciador.css">
</head>

<body>
    <div class="voltar">
        <a href="/Farmafittos-vers-o-final/admin/">
            <i class="fa-solid fa-circle-arrow-left"></i>
            VOLTAR
        </a>
    </div>
    <div class="container">
        <div class="container-controle">
            <div class="adicionar-noticia" id="abrirModalNoticia">
                <span>＋</span>
                <p>Adicionar Notícia</p>
            </div>

            <div class="lixeira">
                <i class="fa-solid fa-trash"></i>
                <h2>Lixeira</h2>
            </div>
        </div>
        <?php
        require_once('../../includes/conexao.php');

        $query = "SELECT * FROM parceiros";
        $resultado = $conexao->query($query);
        ?>

        <div class="container-gerenciador">
            <h1>Gerenciador de Parceiros</h1>

            <?php while ($parceiro = $resultado->fetch_assoc()): ?>
                <div class="opcao">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <img src="/Farmafittos-vers-o-final/<?php echo htmlspecialchars($parceiro['logo']); ?>" alt="Logo"
                            style="width: 60px; height: 60px; object-fit: contain; border-radius: 8px;">

                        <div>
                            <h2 style="margin: 0;"><?php echo htmlspecialchars($parceiro['nome']); ?></h2>
                            <p style="margin: 0;"><a href="<?php echo htmlspecialchars($parceiro['referencia']); ?>"
                                    target="_blank" style="color: #007bff;">Visitar site</a></p>
                        </div>
                    </div>

                    <div class="incons">
                        <i class="fa-solid fa-pen-to-square" onclick='abrirModalEdicao(<?= json_encode($parceiro) ?>)'></i>
                        <i class="fa-solid fa-trash" onclick="abrirModalExclusao(<?= $parceiro['id'] ?>)"></i>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    </div>

    <!-- Modal Cadastro -->
    <div class="modal-overlay" id="modalCadastro">
        <div class="modal">
            <span class="fechar-modal" id="fecharModalCadastro">&times;</span>
            <h2>Cadastrar Novo Parceiro</h2>
            <form id="formCadastro" action="/Farmafittos-vers-o-final/backend/processa_parceiro.php" method="POST"
                enctype="multipart/form-data">
                <label for="nome">Nome do Parceiro:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="referencia">Link do site:</label>
                <input type="text" id="referencia" name="referencia" required>

                <label for="logo">Adicionar logo:</label>
                <input type="file" name="logo" id="logo" accept="image/*" required>

                <button type="submit" class="botao-salvar">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal-overlay" id="modalEditar">
        <div class="modal">
            <span class="fechar-modal" id="fecharModalEditar">&times;</span>
            <h2>Editar Parceiro</h2>
            <form id="formEdicao" action="/Farmafittos-vers-o-final/backend/processa_edicao_parceiro.php" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="id_parceiro" id="id_parceiro">

                <label for="nome_editar">Nome:</label>
                <input type="text" id="nome_editar" name="nome" required>

                <label for="referencia_editar">Link do site:</label>
                <input type="text" id="referencia_editar" name="referencia" required>

                <label for="logo_editar">Alterar logo:</label>
                <input type="file" name="logo" id="logo_editar">

                <button type="submit">Salvar alterações</button>
            </form>
        </div>
    </div>


</body>
<script src="/Farmafittos-vers-o-final/admin/js/gerenciador.js"></script>
<script src="/Farmafittos-vers-o-final/admin/js/parceiros/editar_parceiros.js"></script>
<script src="/Farmafittos-vers-o-final/admin/js/parceiros/modal_cadastro"></script>

</html>