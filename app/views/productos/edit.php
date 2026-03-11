<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar producto</title>
</head>
<body>

<h1>Editar producto</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=update">
  <input type="hidden" name="id" value="<?php echo (int)$producto['id']; ?>">

  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php
      echo isset($_POST['nombre']) ? $_POST['nombre'] : $producto['nombre'];
    ?>">
  </p>

  <p>
    Precio:<br>
    <input type="number" step="0.01" name="precio" value="<?php
      echo isset($_POST['precio']) ? $_POST['precio'] : $producto['precio'];
    ?>">
  </p>

  <p>
    Categoría:<br>
    <select name="categoria_id">
      <option value="">(Sin categoría)</option>

      <?php
        // Elegimos el valor actual:
        // - Si venimos de un POST (falló), usamos $_POST
        // - Si no, usamos el valor de la BD ($producto['categoria_id'])
        $current = isset($_POST['categoria_id'])
          ? (string)$_POST['categoria_id']
          : (string)($producto['categoria_id'] ?? '');
      ?>

      <?php foreach ($categorias as $c): ?>
        <?php
          $selected = '';
          if ($current !== '' && $current === (string)$c['id']) {
            $selected = 'selected';
          }
        ?>
        <option value="<?php echo (int)$c['id']; ?>" <?php echo $selected; ?>>
          <?php echo $c['nombre']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </p>

  <button type="submit">Actualizar</button>
</form>

<p><a href="index.php?action=index">Volver</a></p>

</body>
</html>