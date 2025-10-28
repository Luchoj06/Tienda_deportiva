<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Gestión de Usuarios</h3>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalUsuarioNuevo">
  <i class="bi bi-person-plus"></i> Nuevo Usuario
</button>

<table id="tablaUsuarios" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Rol</th>
      <th>Acciones</th>
    </tr>
    <!-- Filtros por columna -->
    <tr>
      <th><input type="text" placeholder="🔎 ID" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Nombre" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Correo" class="form-control form-control-sm"></th>
      <th>
        <select class="form-select form-select-sm">
          <option value="">Todos</option>
          <option value="admin">Administrador</option>
          <option value="vendedor">Vendedor</option>
          <option value="cajero">Cajero</option>
        </select>
      </th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($usuarios)): ?>
      <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= $u['nombre'] ?></td>
          <td><?= $u['email'] ?></td>
          <td><?= $u['rol'] ?></td>
          <td>
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUsuarioEditar<?= $u['id'] ?>">
              <i class="bi bi-pencil"></i>
            </button>
            <a href="<?= site_url('usuarios/delete/'.$u['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="5">No hay usuarios registrados</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="modalUsuarioNuevo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= site_url('usuarios/store') ?>" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3"><label>Nombre</label><input type="text" name="nombre" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label>Contraseña</label><input type="password" name="password" class="form-control" required></div>
        <div class="mb-3"><label>Rol</label>
          <select name="rol" class="form-select" required>
            <option value="admin">Administrador</option>
            <option value="vendedor">Vendedor</option>
            <option value="cajero">Cajero</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modales Editar Usuario -->
<?php if (!empty($usuarios)): ?>
  <?php foreach ($usuarios as $u): ?>
    <div class="modal fade" id="modalUsuarioEditar<?= $u['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="<?= site_url('usuarios/update/'.$u['id']) ?>" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3"><label>Nombre</label><input type="text" name="nombre" class="form-control" value="<?= $u['nombre'] ?>" required></div>
            <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" value="<?= $u['email'] ?>" required></div>
            <div class="mb-3"><label>Rol</label>
              <select name="rol" class="form-select" required>
                <option value="admin" <?= $u['rol']=='admin'?'selected':'' ?>>Administrador</option>
                <option value="vendedor" <?= $u['rol']=='vendedor'?'selected':'' ?>>Vendedor</option>
                <option value="cajero" <?= $u['rol']=='cajero'?'selected':'' ?>>Cajero</option>
              </select>
            </div>
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

<?= $this->section('scripts') ?>
<script>
$(function() {
  const table = $('#tablaUsuarios').DataTable({
    dom: 'lBfrtip',
    buttons: [
      { extend: 'excelHtml5', text: '📊 Excel' },
      { extend: 'pdfHtml5',   text: '📄 PDF' },
      { extend: 'csvHtml5',   text: '🗂 CSV' },
      { extend: 'print',      text: '🖨️ Imprimir' }
    ],
    orderCellsTop: true,
    fixedHeader: true,
    language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' }
  });

  // Filtros por columna (segunda fila del thead)
  $('#tablaUsuarios thead tr:eq(1) th').each(function(i) {
    $('input, select', this).on('keyup change', function() {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
