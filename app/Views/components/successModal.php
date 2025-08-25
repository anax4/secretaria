<?php if (!empty($_SESSION['success'])): ?>
  <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Sucesso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var modal = new bootstrap.Modal(document.getElementById('successModal'));
      modal.show();
    });
  </script>

  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
