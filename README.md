# 📇 Sistema CRUD de Clientes (MVC PHP)

Este proyecto es una aplicación web básica para gestionar clientes utilizando una arquitectura **Modelo-Vista-Controlador (MVC)**, PHP puro (PDO) y MariaDB.

---

## 1. Configuración de la Base de Datos
Sigue estos pasos para preparar tu entorno de base de datos en MariaDB o MySQL:

### 🛠️ Scripts SQL
Ejecuta los siguientes comandos en tu gestor (phpMyAdmin, terminal, etc.):

```sql
-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS gestion_ventas;
USE gestion_ventas;

-- Crear la tabla clientes
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefono VARCHAR(15),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar registros iniciales para pruebas
INSERT INTO clientes (nombre, email, telefono) VALUES 
('Ana García', 'ana.garcia@email.com', '600111222'),
('Luis Pérez', 'luis.perez@email.com', '600333444'),
('María López', 'm.lopez@email.com', '600555666'),
('Carlos Ruiz', 'cruiz@email.com', '600777888'),
('Elena Sanz', 'esanz@email.com', '600999000');
