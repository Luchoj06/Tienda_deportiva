<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Gestión de Clientes</h3>

<!-- Botón para abrir modal de nuevo cliente -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalClienteNuevo">
  <i class="bi bi-person-plus"></i> Nuevo Cliente
</button>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($clientes)): ?>
      <?php foreach ($clientes as $c): ?>
        <tr>
          <td><?= $c['id'] ?></td>
          <td><?= $c['nombre'] ?></td>
          <td><?= $c['email'] ?></td>
          <td><?= $c['telefono'] ?></td>
          <td><?= $c['direccion'] ?></td>
          <td>
            <!-- Botón editar -->
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalClienteEditar<?= $c['id'] ?>">
              <i class="bi bi-pencil"></i>
            </button>

            <!-- Botón eliminar -->
            <a href="<?= site_url('clientes/delete/'.$c['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar cliente?')">
              <i class="bi bi-trash"></i>
            </a>

            <!-- Botón ver compras -->
            <a href="<?= site_url('clientes/compras/'.$c['id']) ?>" class="btn btn-sm btn-info">
              <i class="bi bi-cart"></i> Compras
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="6">No hay clientes registrados</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<!-- Modal Nuevo Cliente -->
<div class="modal fade" id="modalClienteNuevo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= site_url('clientes/store') ?>" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3"><label>Nombre</label><input type="text" name="nombre" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control"></div>
        <div class="mb-3"><label>Teléfono</label><input type="text" name="telefono" class="form-control"></div>
        <div class="mb-3"><label>Dirección</label><input type="text" name="direccion" class="form-control"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modales Editar Cliente -->
<?php if (!empty($clientes)): ?>
  <?php foreach ($clientes as $c): ?>
    <div class="modal fade" id="modalClienteEditar<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="<?= site_url('clientes/update/'.$c['id']) ?>" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3"><label>Nombre</label><input type="text" name="nombre" class="form-control" value="<?= $c['nombre'] ?>" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="<?= $c['email'] ?>"></div>
            <div class="mb-3"><label>Teléfono</label><input type="text" name="telefono" class="form-control" value="<?= $c['telefono'] ?>"></div>
            <div class="mb-3"><label>Dirección</label><input type="text" name="direccion" class="form-control" value="<?= $c['direccion'] ?>"></div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
