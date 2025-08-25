<div class="d-flex justify-content-between align-items-center mb-4">
  <h2>Matrículas</h2>
  <a href="/matricula/cadastrar" class="btn btn-primary">+ Nova Matrícula</a>
</div>

<?php if (!empty($matriculas)): ?>
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Aluno</th>
        <th>Turma</th>
        <th>Data da Matrícula</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($matriculas as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= htmlspecialchars($m['aluno']) ?></td>
          <td><?= htmlspecialchars($m['turma']) ?></td>
          <td><?= $m['data_matricula'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info text-center">
    Nenhuma matrícula encontrada.  
    <a href="/matricula/cadastrar" class="btn btn-link">Matricular agora</a>
  </div>
<?php endif; ?>
