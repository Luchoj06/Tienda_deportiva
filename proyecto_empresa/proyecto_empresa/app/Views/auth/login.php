<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Login - Sistema de Inventario</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilo personalizado -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

  <div class="card shadow p-4" style="width: 400px;">
    <div class="text-center mb-4">
      <i class="bi bi-box-seam" style="font-size: 2.5rem; color: #667eea;"></i>
      <h3 class="mt-2">Inventario</h3>
      <p class="text-muted">Inicia sesión para continuar</p>
    </div>

    <!-- Mensaje de error -->
    <?php if(session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Formulario de login -->
    <form method="post" action="<?= site_url('login/doLogin') ?>">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button class="btn btn-primary w-100">Ingresar</button>
    </form>
  </div>

  <!-- Bootstrap JS (opcional, para componentes interactivos como modales) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
