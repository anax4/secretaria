<div class="d-flex justify-content-between align-items-center mb-4">
  <h2>Alunos</h2>
  <a href="/aluno/cadastrar" class="btn btn-primary">+ Cadastrar Aluno</a>
</div>

<?php if (! empty($alunos)): ?>
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>CPF</th>
        <th>E-mail</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($alunos as $aluno): ?>
        <tr>
          <td><?php echo htmlspecialchars($aluno['nome']);?></td>
          <td><?php echo htmlspecialchars($aluno['data_nascimento']);?></td>
          <td><?php echo htmlspecialchars($aluno['cpf']);?></td>
          <td><?php echo htmlspecialchars($aluno['email']);?></td>
          <td>
            <a href="/aluno/editar/<?php echo $aluno['id']?>" class="btn btn-sm btn-outline-primary">
              <i class="bi bi-pencil">Editar</i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <div class="alert alert-info text-center">
    Ainda não existe alunos cadastrados.
    <a href="/aluno/cadastrar" class="btn btn-link">Cadastrar agora</a>
  </div>
<?php endif; ?>
