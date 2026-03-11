<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Crear producto</title>
</head>
<body>

<h1>Crear producto</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=store">
  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
  </p>

  <p>
    Precio:<br>
    <input type="number" step="0.01" name="precio" value="<?php echo isset($_POST['precio']) ? $_POST['precio'] : ''; ?>">
  </p>

  <p>
    Categoría:<br>
    <select name="categoria_id">
      <option value="">(Sin categoría)</option>

      <?php foreach ($categorias as $c): ?>
        <?php
          // Si el usuario envió el formulario y falló, intentamos mantener lo elegido
          $selected = '';
          if (isset($_POST['categoria_id']) && (string)$_POST['categoria_id'] === (string)$c['id']) {
            $selected = 'selected';
          }
        ?>
        <option value="<?php echo (int)$c['id']; ?>" <?php echo $selected; ?>>
          <?php echo $c['nombre']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </p>

  <button type="submit">Guardar</button>
</form>

<p><a href="index.php?action=index">Volver</a></p>

</body>
</html>