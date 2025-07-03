<?php
require_once('../../includes/conexao.php');

// Seleciona todas as notícias que NÃO estão na lixeira
$query = "SELECT * FROM noticias WHERE deletado = 0 ORDER BY data_publicacao DESC";
$resultado = $conexao->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gerenciador de Notícias</title>
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/assets/icons/fontawesome-free-6.5.2-web/css/all.css" />
    <link rel="stylesheet" href="/Farmafittos-vers-o-final/admin/css/gerenciador.css" />
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
            <a href="/Farmafittos-vers-o-final/admin/pages/lixeira_noticias.php">
                <div class="lixeira">
                    <i class="fa-solid fa-trash"></i>
                    <p>Lixeira</p>

                </div>
            </a>

        </div>

        <div class="container-gerenciador">
            <h1>Gerenciador de Notícias</h1>

            <?php while ($noticia = $resultado->fetch_assoc()): ?>
                <div class="opcao">
                    <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
                    <div class="incons">
                        <i class="fa-solid fa-images" title="Gerenciar Imagens"></i>
                        <i class="fa-solid fa-pen-to-square"
                            onclick='abrirModalEdicaoNoticia(<?= json_encode($noticia) ?>)'></i>
                        <i class="fa-solid fa-trash" title="Excluir"
                            onclick="abrirModalExclusao(<?= $noticia['id'] ?>)"></i>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Modal Cadastro -->
    <div class="modal-overlay" id="modalCadastro">
        <div class="modal">
            <span class="fechar-modal" id="fecharModal">&times;</span>
            <h2>Cadastrar Nova Notícia</h2>
            <form id="formCadastro" action="/Farmafittos-vers-o-final/backend/crud_noticia/processa_noticia.php"
                method="POST" enctype="multipart/form-data">
                <label for="titulo">Título da Notícia:</label>
                <input type="text" id="titulo" name="titulo" required />

                <label for="data">Data de Publicação:</label>
                <input type="date" id="data" name="data" required />

                <label for="destaque">É destaque?</label>
                <select id="destaque" name="destaque">
                    <option value="nao">Não</option>
                    <option value="sim">Sim</option>
                </select>

                <label for="conteudo">Conteúdo:</label>
                <textarea id="conteudo" name="conteudo" rows="5" required></textarea>

                <button type="submit" class="botao-salvar">Salvar</button>
            </form>
        </div>
    </div>


    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal-overlay" id="modalExcluirNoticia" style="display: none;">
        <div class="modal">
            <span class="fechar-modal" id="fecharModalExcluir">&times;</span>
            <h2>Confirmar Exclusão</h2>
            <p>Digite seu login e senha para confirmar a exclusão do noticia:</p>

            <form action="/Farmafittos-vers-o-final/backend/crud_noticia/processa_excluir_noticia.php" method="POST">
                <input type="hidden" name="id_noticia" id="idNoticiaExcluir">

                <label for="loginExcluir">Login:</label>
                <input type="text" name="login" id="loginExcluir" required>

                <label for="senhaExcluir">Senha:</label>
                <div style="position: relative;">
                    <input type="password" name="senha" id="senhaExcluir" required>
                    <i class="fa-solid fa-eye toggle-password" data-target="senhaExcluir"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                </div>

                <button type="submit" class="botao-salvar" style="margin-top: 15px;">Confirmar Exclusão</button>
            </form>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div class="modal-overlay" id="modalEditarNoticia" style="display: none;">
        <div class="modal">
            <span class="fechar-modal" id="fecharModalEditarNoticia">&times;</span>
            <h2>Editar Notícia</h2>

            <form id="formEdicaoNoticia"
                action="/Farmafittos-vers-o-final/backend/crud_noticia/processa_edicao_noticia.php" method="POST">
                <input type="hidden" id="id_noticia" name="id_noticia">

                <label for="titulo_editar">Título da Notícia:</label>
                <input type="text" id="titulo_editar" name="titulo" required>

                <label for="data_editar">Data de Publicação:</label>
                <input type="datetime-local" id="data_editar" name="data" required>

                <label for="destaque_editar">É destaque?</label>
                <select id="destaque_editar" name="destaque">
                    <option value="nao">Não</option>
                    <option value="sim">Sim</option>
                </select>

                <label for="conteudo_editar">Conteúdo:</label>
                <textarea id="conteudo_editar" name="conteudo" rows="5" required></textarea>

                <button type="submit" class="botao-salvar">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('modalEditarNoticia');
        if (!modal) return;

        document.getElementById('id_noticia').value = noticia.id || '';
        document.getElementById('titulo_editar').value = noticia.titulo || '';

        // Converte a data para o formato datetime-local (YYYY-MM-DDTHH:MM)
        const dataFormatada = new Date(noticia.data_publicacao).toISOString().slice(0, 16);
        document.getElementById('data_editar').value = dataFormatada;

        document.getElementById('destaque_editar').value = noticia.destaque || 'nao';
        document.getElementById('conteudo_editar').value = noticia.conteudo || '';

        modal.style.display = 'flex';
}

        document.addEventListener('DOMContentLoaded', () => {
            const fecharModal = document.getElementById('fecharModalEditarNoticia');
            const modal = document.getElementById('modalEditarNoticia');

            if (fecharModal && modal) {
                fecharModal.addEventListener('click', () => {
                    modal.style.display = 'none';
                });

                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
        });

    </script>


    <script src="/Farmafittos-vers-o-final/admin/js/gerenciador.js"></script>
    <script src="/Farmafittos-vers-o-final/admin/js/noticias/modal_editar.js"></script>
    <script src="/Farmafittos-vers-o-final/admin/js/noticias/modal_cadastro.js"></script>
    <script src="/Farmafittos-vers-o-final/admin/js/noticias/modal_excluir.js"></script>
    <script src="/Farmafittos-vers-o-final/admin/js/view_password.js"></script>
</body>

</html>