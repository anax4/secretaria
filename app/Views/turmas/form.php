<div class="card shadow p-4">
  <h2 class="mb-3"><?php echo isset($turma) ? "Editar Turma" : "Cadastrar Turma"?></h2>

  <?php if (! empty($erro)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($erro);?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome"
             value="<?php echo $turma['nome'] ?? ''?>" required>
    </div>

    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea class="form-control" id="descricao" name="descricao"><?php echo $turma['descricao'] ?? ''?></textarea>
    </div>

    <button type="submit" class="btn btn-dark">Salvar</button>
    <?php if (isset($turma)): ?>
      <button type="submit" name="excluir" value="1" class="btn btn-danger"
              onclick="return confirm('Tem certeza que deseja excluir esta turma?');">
        Excluir
      </button>
    <?php endif; ?>
    <a href="/turma/index" class="btn btn-secondary">Voltar</a>
  </form>
</div>
