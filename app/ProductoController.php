<?php
require_once __DIR__ . '/Producto.php';
require_once __DIR__ . '/Categoria.php';

class ProductoController
{
  public function index(): void
  {
    // Listado con nombre de categoría incluido
    $productos = Producto::allWithCategoria();

    require __DIR__ . '/views/productos/index.php';
  }

  public function create(): void
  {
    // Necesitamos categorías para el select
    $categorias = Categoria::all();

    // Mensaje de error vacío al entrar por primera vez
    $error = '';

    require __DIR__ . '/views/productos/create.php';
  }

  public function store(): void
  {
    try {
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : 0;

      // categoria_id puede venir vacío (sin categoría)
      $categoriaId = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;

      Producto::create($nombre, $precio, $categoriaId);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      // Si hay error, recargamos las categorías y mostramos el formulario
      $error = $e->getMessage();
      $categorias = Categoria::all();

      require __DIR__ . '/views/productos/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $producto = Producto::find($id);
    if ($producto === null) {
      echo "Producto no encontrado";
      return;
    }

    // Para el desplegable
    $categorias = Categoria::all();
    $error = '';

    require __DIR__ . '/views/productos/edit.php';
  }

  public function update(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : 0;

      $categoriaId = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;

      Producto::update($id, $nombre, $precio, $categoriaId);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      // Si hay error, recargamos datos para volver a mostrar el formulario
      $error = $e->getMessage();

      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $producto = Producto::find($id);
      if ($producto === null) {
        echo "Producto no encontrado";
        return;
      }

      $categorias = Categoria::all();
      require __DIR__ . '/views/productos/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Producto::delete($id);

      header("Location: index.php?action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}