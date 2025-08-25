<div class="card shadow p-4">
  <h2 class="mb-3">Nova Matrícula</h2>

  <?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro); ?></div>
  <?php endif; ?>

  <form method="POST" action="/matricula/cadastrar">
    <div class="mb-3">
      <label for="aluno_id" class="form-label">Aluno</label>
      <select class="form-select" id="aluno_id" name="aluno_id" required>
        <option value="">Selecione um aluno</option>
        <?php foreach ($alunos as $a): ?>
          <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nome']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="turma_id" class="form-label">Turma</label>
      <select class="form-select" id="turma_id" name="turma_id" required>
        <option value="">Selecione uma turma</option>
        <?php foreach ($turmas as $t): ?>
          <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['nome']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-dark">Salvar</button>
    <a href="/matricula/index" class="btn btn-secondary">Voltar</a>
  </form>
</div>
