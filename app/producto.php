<?php
require_once __DIR__ . '/Database.php';

class Producto
{
  public static function allWithCategoria(): array
  {
    // LEFT JOIN = aunque el producto no tenga categoría (categoria_id NULL), lo sigue mostrando.
    $sql = "
      SELECT
        p.id,
        p.nombre,
        p.precio,
        p.creado_en,
        p.categoria_id,
        c.nombre AS categoria_nombre
      FROM productos p
      LEFT JOIN categorias c ON c.id = p.categoria_id
      ORDER BY p.id DESC
    ";

    $stmt = Database::pdo()->query($sql);
    return $stmt->fetchAll();
  }

  public static function find(int $id): ?array
  {
    // Igual que el listado pero filtrando por id
    $sql = "
      SELECT
        p.id,
        p.nombre,
        p.precio,
        p.creado_en,
        p.categoria_id,
        c.nombre AS categoria_nombre
      FROM productos p
      LEFT JOIN categorias c ON c.id = p.categoria_id
      WHERE p.id = :id
    ";

    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);

    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(string $nombre, float $precio, $categoriaId): void
  {
    // $categoriaId puede ser un número (int) o null
    $nombre = trim($nombre);

    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($precio <= 0) {
      throw new Exception("El precio debe ser mayor que 0.");
    }

    // Si llega cadena vacía, lo convertimos a null
    if ($categoriaId === '' || $categoriaId === null) {
      $categoriaId = null;
    } else {
      $categoriaId = (int)$categoriaId;
      if ($categoriaId <= 0) {
        throw new Exception("Categoría inválida.");
      }
    }

    $sql = "INSERT INTO productos (nombre, precio, categoria_id) VALUES (:nombre, :precio, :categoria_id)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':nombre' => $nombre,
      ':precio' => $precio,
      ':categoria_id' => $categoriaId, // puede ser null, PDO lo acepta
    ]);
  }

  public static function update(int $id, string $nombre, float $precio, $categoriaId): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);

    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($precio <= 0) {
      throw new Exception("El precio debe ser mayor que 0.");
    }

    // Tratamos categoriaId igual que en create()
    if ($categoriaId === '' || $categoriaId === null) {
      $categoriaId = null;
    } else {
      $categoriaId = (int)$categoriaId;
      if ($categoriaId <= 0) {
        throw new Exception("Categoría inválida.");
      }
    }

    $sql = "
      UPDATE productos
      SET nombre = :nombre,
          precio = :precio,
          categoria_id = :categoria_id
      WHERE id = :id
    ";

    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':nombre' => $nombre,
      ':precio' => $precio,
      ':categoria_id' => $categoriaId,
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $sql = "DELETE FROM productos WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}