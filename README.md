🏪 SISTEMA DE GESTIÓN PARA TIENDA DEPORTIVA
Aplicación web desarrollada en CodeIgniter 4 para la administración integral de una tienda de artículos deportivos.
Permite gestionar productos, tipos de productos, usuarios, clientes y ventas desde una interfaz moderna y organizada.

🧭 Descripción General
El Sistema de Gestión para Tienda Deportiva tiene como objetivo optimizar el manejo interno de una tienda deportiva, brindando herramientas para registrar, actualizar y consultar datos de inventario, clientes y transacciones comerciales.

Incluye módulos de:

Gestión de productos y categorías (tipos).
Control de clientes y ventas.
Administración de usuarios y acceso.
Panel general (Dashboard) con resumen de la información.
⚙️ Características Principales
🔹 Gestión de Productos
CRUD completo (crear, leer, actualizar, eliminar).
Asociación con un tipo de producto (categoría).
Control de precios y stock.
Exportación a Excel, PDF, CSV con DataTables.
Filtros avanzados por nombre, precio, stock, tipo.
🔹 Tipos de Productos
Clasificación de productos por categorías (ropa, calzado, fitness, etc.).
CRUD completo para administrar los tipos.
🔹 Ventas
Registro y control de ventas con relación a clientes y productos.
Descuento automático del stock tras cada venta.
Listado de ventas con totales y detalles.
🔹 Clientes
Registro de clientes frecuentes.
Consulta de historial de compras por cliente.
🔹 Usuarios
Administración de usuarios del sistema.
Control de login y logout.
Protección de acceso a rutas específicas.
🔹 Dashboard
Vista principal con resumen de inventario, ventas y estadísticas básicas.
🧰 Tecnologías Utilizadas
Categoría	Tecnologías
Backend	PHP 8.1+, CodeIgniter 4.6
Frontend	HTML5, CSS3, Bootstrap 5, JavaScript, jQuery
Base de Datos	MySQL / MariaDB
Servidor Local	XAMPP
Librerías Externas	DataTables, Bootstrap Icons, FontAwesome
Gestor de Dependencias	Composer
Control de Versiones	Git / GitHub
🗂️ Estructura del Proyecto
La estructura real del proyecto es la siguiente:

app/
│
├── Config/ # Configuración general del sistema
├── Controllers/ # Controladores del MVC (Productos, Ventas, Usuarios, Clientes, etc.)
├── Database/
│ ├── Migrations/ # Estructura de tablas (migraciones)
│ └── Seeds/ # Datos iniciales (semillas)
├── Filters/ # Filtros de autenticación y permisos
├── Helpers/ # Funciones auxiliares
├── Language/ # Archivos de idioma (traducciones)
├── Libraries/ # Clases adicionales personalizadas
├── Models/ # Modelos de base de datos
├── ThirdParty/ # Librerías externas opcionales
└── Views/ # Vistas HTML + PHP (interfaz de usuario)
├── layout/ # Plantilla base (main.php)
├── productos/ # CRUD de productos
├── tipos/ # CRUD de tipos de productos
├── usuarios/ # CRUD de usuarios
├── clientes/ # CRUD de clientes
└── ventas/ # Módulo de ventas
