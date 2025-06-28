<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador</title>
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

        <div class="container-gerenciador">
            <h1>Gerenciador das Notícias</h1>
            <div class="opcao">
                <h2>Título Notícia 1</h2>
                <div class="incons">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            <div class="opcao">
                <h2>Título Notícia 2</h2>
                <div class="incons">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            <div class="opcao">
                <h2>Título Notícia 3</h2>
                <div class="incons">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            <div class="opcao">
                <h2>Título Notícia 4</h2>
                <div class="incons">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            <div class="opcao">
                <h2>Título Notícia 5</h2>
                <div class="incons">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
            
        </div>
    </div>

<!-- Modal -->
<div class="modal-overlay" id="modalCadastro">
  <div class="modal">
    <span class="fechar-modal" id="fecharModal">&times;</span>
    <h2>Cadastrar Nova Notícia</h2>
    <form id="formCadastro">
      <label for="titulo">Título da Notícia:</label>
      <input type="text" id="titulo" name="titulo" required>

      <label for="data">Data de Publicação:</label>
      <input type="date" id="data" name="data" required>

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
</body>
<script src="/Farmafittos-vers-o-final/admin/js/gerenciador.js"></script>

</html>
