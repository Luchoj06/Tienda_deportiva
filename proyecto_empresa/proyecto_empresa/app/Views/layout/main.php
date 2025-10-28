<?php
$rol = session()->get('rol');
$nombre = session()->get('nombre');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Panel') ?></title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- CSS personalizado -->
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <aside class="sidebar p-3">
    <div class="d-flex align-items-center gap-2 mb-3">
      <i class="bi bi-box-seam-fill fs-4 text-primary"></i>
      <span class="brand">Inventario</span>
    </div>

    <nav class="nav flex-column gap-1">
      <!-- Dashboard -->
      <a class="nav-link <?= (url_is('dashboard')) ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
        <i class="bi bi-speedometer2 me-2"></i> Inicio
      </a>

      <!-- Usuarios (solo admin) -->
      <?php if ($rol === 'admin'): ?>
        <a class="nav-link <?= (url_is('usuarios*')) ? 'active' : '' ?>" href="<?= site_url('usuarios') ?>">
          <i class="bi bi-people me-2"></i> Usuarios
        </a>
      <?php endif; ?>

      <!-- Productos -->
      <?php if (in_array($rol, ['admin', 'vendedor', 'cajero'])): ?>
        <a class="nav-link <?= (url_is('productos*')) ? 'active' : '' ?>" href="<?= site_url('productos') ?>">
          <i class="bi bi-boxes me-2"></i> Productos
        </a>
      <?php endif; ?>

      <!-- Ventas -->
      <?php if (in_array($rol, ['admin', 'vendedor', 'cajero'])): ?>
        <a class="nav-link <?= (url_is('ventas*')) ? 'active' : '' ?>" href="<?= site_url('ventas') ?>">
          <i class="bi bi-receipt me-2"></i> Ventas
        </a>
      <?php endif; ?>

      <!-- Clientes -->
      <?php if (in_array($rol, ['admin', 'vendedor'])): ?>
        <a class="nav-link <?= (url_is('clientes*')) ? 'active' : '' ?>" href="<?= site_url('clientes') ?>">
          <i class="bi bi-person-badge me-2"></i> Clientes
        </a>
      <?php endif; ?>

      <hr>
      <!-- Logout -->
      <a class="nav-link" href="<?= site_url('logout') ?>">
        <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
      </a>
    </nav>
  </aside>

  <!-- Main -->
  <div class="flex-grow-1">
    <header class="topbar d-flex align-items-center justify-content-between px-3 py-2">
      <div></div>
      <div class="d-flex align-items-center gap-2">
        <span class="text-muted small"><?= esc($rol ?? '') ?></span>
        <div class="avatar" title="<?= esc($nombre ?? '') ?>">
          <?= strtoupper(mb_substr($nombre ?? 'U', 0, 1)) ?>
        </div>
      </div>
    </header>

    <main class="content">
      <?= $this->renderSection('content') ?>
    </main>
  </div>
</div>

<!-- jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Botones Exportación -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
