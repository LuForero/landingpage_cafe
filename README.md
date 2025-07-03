# Landing Page - Café Montañero

Este repositorio contiene el desarrollo de una landing page interactiva para el emprendimiento **Café Montañero**. Incluye funcionalidades de compra en línea, registro de caficultores, historial de ventas, autenticación y exportación de datos. Diseñada en un entorno MVC con base de datos MySQL y migrada a Infinity Free.

---

##  Índice

1. [Análisis de Requerimientos](#1-análisis-de-requerimientos)
2. [Tecnologías Utilizadas](#2-tecnologías-utilizadas)
3. [Estructura del Proyecto](#3-estructura-del-proyecto)
4. [Diagramas del Sistema](#4-diagramas-del-sistema)
5. [Funcionalidades Principales](#5-funcionalidades-principales)
6. [Proceso de Migración a InfinityFree](#6-proceso-de-migración-a-infinityfree)
7. [Pruebas Realizadas](#7-pruebas-realizadas)
8. [Instalación Local](#8-instalación-local)
9. [Mockups de Interfaz Figma](#9-mockups-de-interfaz---figma)

---

## 1. Análisis de Requerimientos

* Registro y visualización de productos.
* Carrito de compras con simulación de pago.
* Registro de caficultores.
* Panel de administración y editor con roles.
* Lista de registro de caficultores y exportación del documento.
* Historial y exportación de ventas.
* Diseño responsive e intuitivo para usuarios.

---

## 2. Tecnologías Utilizadas

* **Frontend:** HTML5, Bootstrap 5
* **Backend:** PHP con patrón MVC
* **Base de Datos:** MySQL (localhost:8889)
* **Control de versiones:** Git + GitHub
* **Servidor de despliegue:** [InfinityFree]

---

## 3. Estructura del Proyecto

```
/config
/controllers
/models
/public
/views
/docs
```

---

## 4. Diagramas del Sistema

### Diagrama de Casos de Uso (Actores)

![Casos de Uso](../Landingpage-cafe/Docs/img/Diagrama%20Landing%20Page%20-%20Página%201.jpeg)

### Diagrama de Clases

![Clases](../Landingpage-cafe/Docs/img/Diagrama%20Landing%20Page%20-%20Página%202.jpeg)

---

## 5. Funcionalidades Principales

### 🧖‍♂️ Registro de Caficultores

* Formulario con datos personales y zona cafetera.
* Tabla con registros en el panel de administración.

### 🛒 Gestión de Productos

* Registro de productos.
* Imagen, categoría, descripción y stock de los productos en venta.

### 💳 Proceso de Compra

* Carrito interactivo.
* Simulación de pago.
* Almacenamiento de orden y estado.

### 📈 Historial de Ventas

* Visualización detallada por fecha.
* Exportación CSV de ventas.

---

## 6. Proceso de Migración a InfinityFree

* Creación de cuenta en InfinityFree.
* Exportación de la base de datos desde MAMP.
* Subida de archivos del proyecto por FTP (FileZilla).
* Configuración de `.htaccess` para rutas amigables.
* Ajuste de `config/database.php` con credenciales remotas.
* Verificación de funcionamiento en línea.

---

## 7. Pruebas Realizadas

* ✅ Registro de caficultores (validación de formulario).
* ✅ Agregado de productos y verificación en el listado.
* ✅ Flujo completo de carrito y confirmación de compra.
* ✅ Simulación de estado (pagado).
* ✅ Exportación funcional del historial a CSV.

---

## 8. Instalación Local

```bash
Correo: admin@hotmail.com
contraseña: 12345
git clone https://github.com/LuForero/landingpage_cafe.git
```

* Importa la base de datos `landingpage.sql` en phpMyAdmin.
* Configura las credenciales en `config/database.php`.
* Abre el proyecto desde tu servidor local (MAMP).
* Accede a `http://localhost/Landingpage-cafe/public`.

---

## 9. Mockups de Interfaz - Figma
Mockups del diseño de la Landing Page realizados en Figma. 
Estos ayudaron a visualizar la estructura de la página y validar la experiencia del usuario antes del desarrollo:


| Página de Inicio                                  | Vista de Registro Caficultores                            | Vista Inicio de Sesión                             | Vista Finalizar compra                                |
| --------------------------------------------------| ----------------------------------------------------------| ---------------------------------------------------|-------------------------------------------------------|
| ![](../Landingpage-cafe/Docs/img/DiseñoFigma.png) | ![](../Landingpage-cafe/Docs/img/Registrocaficultores.png) | ![](../Landingpage-cafe/Docs/img/InicioSesion.png) | ![](../Landingpage-cafe/Docs/img/Finalizarcompra.png) |

URL: https://www.figma.com/design/rJbwy9zfwjDA5fzHOwBJlP/Untitled?node-id=0-1&p=f&t=2LcjENMRBY10YKIg-0