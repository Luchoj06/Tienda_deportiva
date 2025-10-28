<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
  <div class="dashboard-header">
    <h3>Dashboard</h3>
    <p>Resumen del sistema de inventario</p>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card metric-card">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center">
            <span class="metric-label">Usuarios</span>
            <i class="bi bi-people metric-icon"></i>
          </div>
          <h4 class="metric-count"><?= esc($usuariosCount ?? 0) ?></h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card metric-card">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center">
            <span class="metric-label">Productos</span>
            <i class="bi bi-boxes metric-icon"></i>
          </div>
          <h4 class="metric-count"><?= esc($productosCount ?? 0) ?></h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card metric-card">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center">
            <span class="metric-label">Ventas</span>
            <i class="bi bi-receipt metric-icon"></i>
          </div>
          <h4 class="metric-count"><?= esc($ventasCount ?? 0) ?></h4>
        </div>
      </div>
    </div>
  </div>

<?= $this->endSection() ?>
