<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Secretaria FIAP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #91A3AD;
    }
    .navbar {
      background-color: #000000 !important;
    }
    .navbar-brand, .nav-link {
      color: #ED145B !important;
      font-weight: bold;
    }
  </style>
</head>
<?php
    session_start();
    include '../app/Views/components/successModal.php';
?>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">Secretaria FIAP</a>
    </div>
  </nav>

  <div class="container mt-5">
    <?php
        if (isset($viewFile) && file_exists($viewFile)) {
            include $viewFile;
        }
    ?>
  </div>
</body>
</html>
