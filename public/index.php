<?php
require_once __DIR__ . '/../app/ProductoController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller = new ProductoController();

if (!method_exists($controller, $action)) {
  echo "Acción no encontrada";
  exit;
}

$controller->$action();