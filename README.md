# 📇 Sistema CRUD de Clientes (MVC PHP)

Este proyecto es una aplicación web básica para gestionar clientes utilizando una arquitectura **Modelo-Vista-Controlador (MVC)**, PHP puro (PDO) y MariaDB.

---

## 1. Configuración de la Base de Datos
Sigue estos pasos para preparar tu entorno de base de datos en MariaDB o MySQL:

### 🛠️ Scripts SQL
Ejecuta los siguientes comandos en tu gestor (phpMyAdmin, terminal, etc.):

```sql
-CREATE DATABASE IF NOT EXISTS crud_clientes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE crud_clientes;

CREATE TABLE IF NOT EXISTS clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  phone VARCHAR(30) NOT NULL
);

-- (Opcional) datos de ejemplo
INSERT INTO clients (name, email, phone) VALUES
('Ana López', 'ana@example.com', '600111222'),
('Juan Pérez', 'juan@example.com', '600333444');

------------------------
Multitabla

USE mvc_pdo;

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(60) NOT NULL UNIQUE
);

ALTER TABLE productos
  ADD categoria_id INT NULL,
  ADD CONSTRAINT fk_productos_categorias
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    ON UPDATE CASCADE
    ON DELETE SET NULL;

INSERT INTO categorias (nombre) VALUES ('Periféricos'), ('Audio');

UPDATE productos
SET categoria_id = 1
WHERE nombre IN ('Teclado','Ratón');
