<?php
// Llega $productos del controlador
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Productos</title>
</head>
<body>

<h1>Listado de productos</h1>

<p><a href="index.php?action=create">Crear producto</a></p>

<?php if (count($productos) === 0): ?>
  <p>No hay productos.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Categoría</th>
      <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
      <tr>
        <td><?php echo (int)$p['id']; ?></td>
        <td><?php echo $p['nombre']; ?></td>
        <td><?php echo number_format((float)$p['precio'], 2); ?> €</td>
        <td><?php echo $p['categoria_nombre'] ? $p['categoria_nombre'] : '(Sin categoría)'; ?></td>
        <td>
          <a href="index.php?action=edit&id=<?php echo (int)$p['id']; ?>">Editar</a>

          <form method="post" action="index.php?action=delete" style="display:inline">
            <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>
<?php endif; ?>

</body>
</html>