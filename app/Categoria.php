<?php
require_once __DIR__ . '/Database.php';

class Categoria
{
  public static function all(): array
  {
    // Traemos categorías ordenadas por nombre
    $sql = "SELECT id, nombre FROM categorias ORDER BY nombre ASC";
    $stmt = Database::pdo()->query($sql);
    return $stmt->fetchAll();
  }

  public static function find(int $id): ?array
  {
    // Consulta con parámetro
    $sql = "SELECT id, nombre FROM categorias WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);

    $row = $stmt->fetch();
    return $row ? $row : null;
  }
}