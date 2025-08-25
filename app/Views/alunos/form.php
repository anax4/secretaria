<?php if (!empty($erro)): ?>
  <div class="alert alert-danger">
    <?php echo htmlspecialchars($erro); ?>
  </div>
<?php endif; ?>

<div class="card shadow p-4">
  <h2 class="mb-3"><?php echo isset($aluno) ? "Editar Aluno" : "Cadastrar Aluno" ?></h2>

  <form id="alunoForm" method="POST" action="">

    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome"
             value="<?php echo htmlspecialchars($aluno['nome'] ?? '') ?>" required>
      <div class="invalid-feedback">
      <i class="bi bi-check-circle-fill text-danger"></i>
      O nome deve ter no mínimo 3 caracteres.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Data de Nascimento</label>
      <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
             placeholder="DD/MM/AAAA" maxlength="10" 
             value="<?php echo htmlspecialchars($aluno['data_nascimento'] ?? '') ?>" required>
      <div class="invalid-feedback">Informe a data no formato DD/MM/AAAA.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">CPF</label>
      <input type="tel" class="form-control" id="cpf" name="cpf"
             value="<?php echo htmlspecialchars($aluno['cpf'] ?? '') ?>" maxlength="14" required>
      <div class="invalid-feedback">
         <i class="bi bi-x-circle-fill text-danger"></i>
        Informe um CPF válido (000.000.000-00).
      
    </div>

    <div class="mb-3">
      <label class="form-label">E-mail</label>
      <input type="email" class="form-control" id="email" name="email"
             value="<?php echo htmlspecialchars($aluno['email'] ?? '') ?>" required>
      <div class="invalid-feedback">
      <i class="bi bi-x-circle-fill text-danger"></i>
      Digite um e-mail válido.</div>
      <div class="valid-feedback">
        <i class="bi bi-check-circle-fill text-success"></i>
        E-mail válido

      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" placeholder="••••••"                                                                                                           <?php echo isset($aluno) ? '' : 'required' ?>>
      <div class="form-text">Senha precisa ter 8 caracteres, incluindo maiúscula, minúscula, número e símbolo.</div>
      <div class="invalid-feedback">
          <i class="bi bi-x-circle-fill text-danger"></i>Senha fraca
      </div>
      <div class="valid-feedback">
        <i class="bi bi-check-circle-fill text-success"></i>Senha forte
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Salvar</button>
    <a href="/aluno/index" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
