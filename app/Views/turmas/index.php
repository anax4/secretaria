<div class="d-flex justify-content-between align-items-center mb-4">
  <h2>Turmas</h2>
  <a href="/turma/cadastrar" class="btn btn-primary">+ Cadastrar Turma</a>
</div>

<?php if (! empty($turmasData['dados'])): ?>
  <table class="table table-striped table-hover">
<thead class="table-dark">
  <tr>
    <th>Nome</th>
    <th>Descrição</th>
    <th>Qtd. de Alunos</th>
    <th>Ações</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($turmasData['dados'] as $turma): ?>
    <tr>
      <td><?php echo htmlspecialchars($turma['nome']);?></td>
      <td><?php echo htmlspecialchars($turma['descricao']);?></td>
      <td><?php echo $turma['total_alunos']?></td>

      <td>
        <a href="/turma/editar/<?php echo $turma['id']?>" class="btn btn-sm btn-outline-primary">
          <i class="bi bi-pencil">Editar</i>
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>


  </table>

  <!-- Paginação -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $turmasData['totalPaginas']; $i++): ?>
        <li class="page-item<?php echo $i == $turmasData['pagina'] ? 'active' : '' ?>">
          <a class="page-link" href="/turma/index/<?php echo $i ?>"><?php echo $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

<?php else: ?>
  <div class="alert alert-info text-center">
    Nenhuma turma cadastrada.
  </div>
<?php endif; ?>
