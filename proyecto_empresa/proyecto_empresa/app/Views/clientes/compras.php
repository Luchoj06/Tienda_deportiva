<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Compras de <?= esc($cliente['nombre']) ?></h3>

<table id="tablaCompras" class="table table-striped">
  <thead>
    <tr>
      <th>ID Venta</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Total</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($ventas)): ?>
      <?php foreach ($ventas as $v): ?>
        <tr>
          <td><?= $v['id'] ?></td>
          <td><?= isset($v['producto']) ? $v['producto'] : $v['producto_id'] ?></td>
          <td><?= $v['cantidad'] ?></td>
          <td>$<?= number_format($v['total'], 2) ?></td>
          <td><?= $v['fecha'] ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="5">No hay compras registradas</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<a href="<?= site_url('clientes') ?>" class="btn btn-secondary">⬅ Volver</a>

<script>
$(document).ready(function() {
    $('#tablaCompras').DataTable({
        dom: 'Bfrtip',
        buttons: ['excelHtml5', 'pdfHtml5']
    });
});
</script>

<?= $this->endSection() ?>
