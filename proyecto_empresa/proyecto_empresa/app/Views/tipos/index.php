<h1>Tipos de productos</h1>
<a href="/tipoproducto/create">Nuevo tipo</a>

<ul>
<?php foreach ($tipos as $tipo): ?>
    <li><?= esc($tipo['nombre']) ?> - <?= esc($tipo['descripcion']) ?></li>
<?php endforeach; ?>
</ul>
