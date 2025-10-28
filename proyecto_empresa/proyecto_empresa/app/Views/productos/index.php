<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Gestión de Productos</h3>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProductoNuevo">
  <i class="bi bi-box"></i> Nuevo Producto
</button>

<table id="tablaProductos" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Stock</th>
      <th>Tipo</th>
      <th>Acciones</th>
    </tr>
    <!-- Filtros -->
    <tr>
      <th><input type="text" placeholder="🔎 ID" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Nombre" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Descripción" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Precio" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Stock" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Tipo" class="form-control form-control-sm"></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($productos)): ?>
      <?php foreach ($productos as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= esc($p['nombre']) ?></td>
          <td><?= esc($p['descripcion']) ?></td>
          <td>$<?= number_format($p['precio'], 2) ?></td>
          <td><?= esc($p['stock']) ?></td>
          <td><?= esc($p['tipo_nombre'] ?? 'Sin tipo') ?></td>
          <td>
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalProductoEditar<?= $p['id'] ?>">
              <i class="bi bi-pencil"></i>
            </button>
            <a href="<?= site_url('productos/delete/'.$p['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="7">No hay productos registrados</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<!-- Modal Nuevo Producto -->
<div class="modal fade" id="modalProductoNuevo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= site_url('productos/store') ?>" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Descripción</label>
          <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <div class="mb-3">
          <label>Precio</label>
          <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Stock</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tipo de Producto</label>
          <select name="tipo_producto_id" class="form-control">
            <option value="">-- Selecciona un tipo --</option>
            <?php foreach ($tipos as $t): ?>
              <option value="<?= esc($t['id']) ?>"><?= esc($t['nombre']) ?></option>
            <?php endforeach; ?>
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

<!-- Modales Editar Producto -->
<?php if (!empty($productos)): ?>
  <?php foreach ($productos as $p): ?>
    <div class="modal fade" id="modalProductoEditar<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="<?= site_url('productos/update/'.$p['id']) ?>" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" value="<?= esc($p['nombre']) ?>" required>
            </div>
            <div class="mb-3">
              <label>Descripción</label>
              <textarea name="descripcion" class="form-control"><?= esc($p['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
              <label>Precio</label>
              <input type="number" step="0.01" name="precio" class="form-control" value="<?= esc($p['precio']) ?>" required>
            </div>
            <div class="mb-3">
              <label>Stock</label>
              <input type="number" name="stock" class="form-control" value="<?= esc($p['stock']) ?>" required>
            </div>
            <div class="mb-3">
              <label>Tipo de Producto</label>
              <select name="tipo_producto_id" class="form-control">
                <option value="">-- Selecciona un tipo --</option>
                <?php foreach ($tipos as $t): ?>
                  <option value="<?= esc($t['id']) ?>"
                    <?= ($p['tipo_producto_id'] == $t['id']) ? 'selected' : '' ?>>
                    <?= esc($t['nombre']) ?>
                  </option>
                <?php endforeach; ?>
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
  const table = $('#tablaProductos').DataTable({
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

  $('#tablaProductos thead tr:eq(1) th').each(function(i) {
    $('input, select', this).on('keyup change', function() {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });
});
</script>
<?= $this->endSection() ?>
