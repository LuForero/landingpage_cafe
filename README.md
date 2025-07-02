# Landing Page - Café Montañero

Este repositorio contiene el desarrollo de una landing page interactiva para el emprendimiento **Café Montañero**. Incluye funcionalidades de compra en línea, registro de caficultores, historial de ventas, autenticación y exportación de datos. Diseñada en un entorno MVC con base de datos MySQL y migrada exitosamente a InfinityFree.

---

## 📌 Índice

1. [Análisis de Requerimientos](#1-análisis-de-requerimientos)
2. [Tecnologías Utilizadas](#2-tecnologías-utilizadas)
3. [Estructura del Proyecto](#3-estructura-del-proyecto)
4. [Diagramas del Sistema](#4-diagramas-del-sistema)
5. [Funcionalidades Principales](#5-funcionalidades-principales)
6. [Proceso de Migración a InfinityFree](#6-proceso-de-migración-a-infinityfree)
7. [Pruebas Realizadas](#7-pruebas-realizadas)
8. [Instalación Local](#8-instalación-local)

---

## 1. 📋 Análisis de Requerimientos

* Registro y visualización de productos.
* Carrito de compras con simulación de pago.
* Registro de caficultores.
* Panel de administración y editor con roles.
* Historial y exportación de ventas.
* Diseño responsive e intuitivo para usuarios.

---

## 2. 🛠️ Tecnologías Utilizadas

* **Frontend:** HTML5, Bootstrap 5
* **Backend:** PHP con patrón MVC
* **Base de Datos:** MySQL (localhost:8889)
* **Control de versiones:** Git + GitHub
* **Servidor de despliegue:** [InfinityFree](https://infinityfree.net)

---

## 3. 📁 Estructura del Proyecto

```
/controllers
/models
/views
/config
/public
/docs
```

---

## 4. 🧹 Diagramas del Sistema

### Diagrama de Casos de Uso (Actores)

![Casos de Uso](./docs/img/diagrama-actores.jpg)

### Diagrama de Clases

![Clases](./docs/img/diagrama-clases.jpg)

---

## 5. 🔑 Funcionalidades Principales

### 🧖‍♂️ Registro de Caficultores

* Formulario con datos personales y zona cafetera.
* Tabla con registros en el panel de administración.

### 🛒 Gestión de Productos

* Alta, edición y baja de productos.
* Imagen, categoría, descripción y stock.

### 💳 Proceso de Compra

* Carrito interactivo.
* Simulación de pago.
* Almacenamiento de orden y estado.

### 📈 Historial de Ventas

* Visualización detallada por fecha.
* Exportación CSV de ventas.

---

## 6. 🌐 Proceso de Migración a InfinityFree

* Creación de cuenta en InfinityFree.
* Exportación de la base de datos desde MAMP.
* Subida de archivos del proyecto por FTP (FileZilla).
* Configuración de `.htaccess` para rutas amigables.
* Ajuste de `config/database.php` con credenciales remotas.
* Verificación de funcionamiento en línea.

---

## 7. 🧪 Pruebas Realizadas

* ✅ Registro de caficultores (validación de formulario).
* ✅ Agregado de productos y verificación en el listado.
* ✅ Flujo completo de carrito y confirmación de compra.
* ✅ Simulación de estados (pendiente, pagado, cancelado).
* ✅ Exportación funcional del historial a CSV.

---

## 8. 💻 Instalación Local

```bash
git clone https://github.com/LuForero/landingpage_cafe.git
```

* Importa la base de datos `landingpage.sql` en phpMyAdmin.
* Configura las credenciales en `config/database.php`.
* Abre el proyecto desde tu servidor local (MAMP/XAMPP).
* Accede a `http://localhost/Landingpage-cafe/public`.

---

👉 **Autor:** Luisa Forero
🗓️ **Última actualización:** Julio 2025
