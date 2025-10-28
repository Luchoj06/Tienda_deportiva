<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Gestión de Ventas</h3>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalVentaNueva">
  <i class="bi bi-receipt"></i> Nueva Venta
</button>

<table id="tablaVentas" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Total</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
    <!-- Filtros -->
    <tr>
      <th><input type="text" placeholder="🔎 ID" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Cliente" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Producto" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Cantidad" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Total" class="form-control form-control-sm"></th>
      <th><input type="text" placeholder="🔎 Fecha" class="form-control form-control-sm"></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($ventas)): ?>
      <?php foreach ($ventas as $v): ?>
        <tr>
          <td><?= $v['id'] ?></td>
          <td><?= $v['cliente_id'] ?></td>
          <td><?= $v['producto_id'] ?></td>
          <td><?= $v['cantidad'] ?></td>
          <td>$<?= number_format($v['total'], 2) ?></td>
          <td><?= $v['fecha'] ?></td>
          <td>
            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalVentaEditar<?= $v['id'] ?>">
              <i class="bi bi-pencil"></i>
            </button>
            <a href="<?= site_url('ventas/delete/'.$v['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar venta?')">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="7">No hay ventas registradas</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<!-- Modal Nueva Venta (igual que lo tenías) -->
<div class="modal fade" id="modalVentaNueva" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="<?= site_url('ventas/store') ?>" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva Venta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Cliente</label>
          <select name="cliente_id" class="form-select" required>
            <?php foreach ($clientes as $c): ?>
              <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Producto</label>
          <select id="productoSelect" name="producto_id" class="form-select" required>
            <?php foreach ($productos as $p): ?>
              <option value="<?= $p['id'] ?>" data-precio="<?= $p['precio'] ?>">
                <?= $p['nombre'] ?> - $<?= $p['precio'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Cantidad</label>
          <input type="number" id="cantidadInput" name="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Total</label>
          <input type="number" step="0.01" id="totalInput" name="total" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label>Fecha</label>
          <input type="date" name="fecha" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- Modales Editar Venta (igual que los tenías) -->
<?php if (!empty($ventas)): ?>
  <?php foreach ($ventas as $v): ?>
    <div class="modal fade" id="modalVentaEditar<?= $v['id'] ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="<?= site_url('ventas/update/'.$v['id']) ?>" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Venta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Cliente</label>
              <select name="cliente_id" class="form-select" required>
                <?php foreach ($clientes as $c): ?>
                  <option value="<?= $c['id'] ?>" <?= $c['id'] == $v['cliente_id'] ? 'selected' : '' ?>>
                    <?= $c['nombre'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label>Producto</label>
              <select id="productoEdit<?= $v['id'] ?>" name="producto_id" class="form-select" required>
                <?php foreach ($productos as $p): ?>
                  <option value="<?= $p['id'] ?>" data-precio="<?= $p['precio'] ?>" <?= $p['id'] == $v['producto_id'] ? 'selected' : '' ?>>
                    <?= $p['nombre'] ?> - $<?= $p['precio'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label>Cantidad</label>
              <input type="number" id="cantidadEdit<?= $v['id'] ?>" name="cantidad" class="form-control" value="<?= $v['cantidad'] ?>" required>
            </div>
            <div class="mb-3">
              <label>Total</label>
              <input type="number" step="0.01" id="totalEdit<?= $v['id'] ?>" name="total" class="form-control" value="<?= $v['total'] ?>" readonly>
            </div>
            <div class="mb-3">
              <label>Fecha</label>
              <input type="date" name="fecha" class="form-control" value="<?= $v['fecha'] ?>" required>
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
// DataTable + filtros
$(function() {
  const table = $('#tablaVentas').DataTable({
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

  $('#tablaVentas thead tr:eq(1) th').each(function(i) {
    $('input, select', this).on('keyup change', function() {
      if (table.column(i).search() !== this.value) {
        table.column(i).search(this.value).draw();
      }
    });
  });
});

// Cálculo de total (igual que lo tenías)
function calcularTotal(productoSelectId, cantidadInputId, totalInputId) {
  const productoSelect = document.getElementById(productoSelectId);
  const cantidadInput  = document.getElementById(cantidadInputId);
  const totalInput     = document.getElementById(totalInputId);

  function updateTotal() {
    const precio   = parseFloat(productoSelect.selectedOptions[0]?.dataset.precio || 0);
    const cantidad = parseInt(cantidadInput.value) || 0;
    totalInput.value = (precio * cantidad).toFixed(2);
  }

  if (productoSelect && cantidadInput && totalInput) {
    productoSelect.addEventListener('change', updateTotal);
    cantidadInput.addEventListener('input', updateTotal);
    updateTotal();
  }
}

// Nueva venta
calcularTotal('productoSelect', 'cantidadInput', 'totalInput');

// Cada modal de edición
<?php if (!empty($ventas)): ?>
  <?php foreach ($ventas as $v): ?>
    calcularTotal('productoEdit<?= $v['id'] ?>', 'cantidadEdit<?= $v['id'] ?>', 'totalEdit<?= $v['id'] ?>');
  <?php endforeach; ?>
<?php endif; ?>
</script>
<?= $this->endSection() ?>
