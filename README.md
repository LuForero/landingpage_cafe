# Landing Page - Café Montañero

This repository contains the development of an interactive landing page for the **Café Montañero** venture. It includes features such as online purchasing, coffee grower registration, sales history, user authentication, and data export. Built using an MVC architecture with a MySQL database and deployed to Infinity Free.

---

## 📋 Index

1. [Requirements Analysis](#1-requirements-analysis)
2. [Technologies Used](#2-technologies-used)
3. [Project Structure](#3-project-structure)
4. [System Diagrams](#4-system-diagrams)
5. [Main Features](#5-main-features)
6. [Migration Process to InfinityFree](#6-migration-process-to-infinityfree)
7. [Tests Performed](#7-tests-performed)
8. [Local Installation](#8-local-installation)
9. [Figma Interface Mockups](#9-figma-interface-mockups)

---

## 1. Requirements Analysis

* Product registration and display
* Shopping cart with payment simulation
* Coffee grower registration
* Admin and editor panel with role-based access
* Coffee grower records and document export
* Sales history and CSV export
* Responsive and user-friendly design

---

## 2. Technologies Used

* **Frontend:** HTML5, Bootstrap 5
* **Backend:** PHP with MVC pattern
* **Database:** MySQL (localhost:8889)
* **Version Control:** Git + GitHub
* **Hosting Server:** \[InfinityFree]

---

## 3. Project Structure

```
/config  
/controllers  
/models  
/public  
/views  
/docs  
```

---

## 4. System Diagrams

### Use Case Diagram (Actors)

![Use Case Diagram](/Docs/actores.jpeg)

### Class Diagram

![Class Diagram](/Docs/clases.jpeg)

---

## 5. Main Features

### 🧖‍♂️ Coffee Grower Registration

* Form with personal and location information
* List of registrations available in the admin panel

### 🛒 Product Management

* Product creation and management
* Includes image, category, description, and stock

### 💳 Purchase Flow

* Interactive shopping cart
* Payment simulation
* Order and status saving

### 📈 Sales History

* Detailed view by date
* CSV export option available

---

## 6. Migration Process to InfinityFree

* Create an account on InfinityFree
* Export database from MAMP
* Upload project files via FTP (FileZilla)
* Configure `.htaccess` for friendly URLs
* Update `config/database.php` with remote credentials
* Verify functionality online

---

## 7. Tests Performed

* ✅ Coffee grower registration (form validation)
* ✅ Product creation and list verification
* ✅ Full cart and purchase confirmation flow
* ✅ Payment status simulation
* ✅ Functional CSV export of sales history

---

## 8. Local Installation

```bash
Email: admin@hotmail.com
Password: 12345
git clone https://github.com/LuForero/landingpage_cafe.git
```

* Import the `landingpage.sql` database via phpMyAdmin
* Configure credentials in `config/database.php`
* Run the project on your local server (MAMP)
* Access via `http://localhost/Landingpage-cafe/public`

---

## 9. Figma Interface Mockups

Mockups designed in Figma to visualize page structure and validate user experience before development:

| Home Page                  | Coffee Grower Registration View     | Login View                  | Checkout View                  |
| ---------------------------| ------------------------------------| ----------------------------| -------------------------------|
| ![](/Docs/DiseñoFigma.png) | ![](/Docs/Registrocaficultores.png) | ![](/Docs/InicioSesion.png) | ![](/Docs/Finalizarcompra.png) |

URL: [Figma Design Link](https://www.figma.com/design/rJbwy9zfwjDA5fzHOwBJlP/Untitled?node-id=0-1&p=f&t=2LcjENMRBY10YKIg-0)
