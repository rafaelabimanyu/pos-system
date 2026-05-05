# 🛒 POS Rico

![License](https://img.shields.io/badge/License-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20.svg?logo=laravel)
![Tailwind](https://img.shields.io/badge/TailwindCSS-v4-06B6D4.svg?logo=tailwindcss)
![AlpineJS](https://img.shields.io/badge/Alpine.js-8BC0D0.svg?logo=alpine.js&logoColor=white)

**POS Rico** is a modern, high-performance Point of Sale (POS) application built with Laravel and Tailwind CSS v4. Designed for speed and aesthetics, POS Rico features a beautiful, responsive Sky Blue (#82C8E5) theme, a functional dark mode, and a robust role-based access control system.

Developed as a professional business solution for managing sales, inventory, and analytics smoothly on both desktop and mobile devices.

---

## ✨ Key Features

- **Modern UI/UX**: Premium interface heavily utilizing glassmorphism, soft shadows, and clean typography (*Plus Jakarta Sans*).
- **Brand Identity**: Consistent *Sky Blue* theme (`#82C8E5`) across the entire platform.
- **Dark Mode**: Fully functional, persistent Dark Mode using modern CSS variables and `localStorage`.
- **Responsive Mobile-First Design**: 
  - Dynamic off-canvas *Sidebar Drawer* for mobile users.
  - Responsive *Product Grid* mapping from 2 columns on mobile up to 5 on large desktops.
  - Interactive *Mobile Cart Modal* vs *Sticky Desktop Cart*.
- **Role-Based Access Control (RBAC)**: Secure access handling distinguishing **Admin** (full access) and **Cashier** (restricted access to sales tools and personal stats only).
- **Interactive POS Interface**: Lightning-fast, reload-free product filtering and cart calculation powered by **Alpine.js**.
- **Reporting & Analytics**: Comprehensive dashboard statistics and exportable PDF transaction reports.

---

## 🛠️ Technology Stack

- **Backend**: Laravel 11/13, PHP 8.2+
- **Frontend**: Blade Components, Tailwind CSS v4, Alpine.js
- **Database**: SQLite / MySQL
- **Icons**: Lucide Icons
- **Bundler**: Vite

---

## 🚀 Installation & Setup

Follow these steps to get POS Rico up and running on your local environment (e.g., Laragon / XAMPP):

### 1. Clone & Install Dependencies
First, install the PHP and Node.js dependencies:
```bash
composer install
npm install
```

### 2. Environment Setup
Copy the `.env.example` file to create your `.env` configuration:
```bash
cp .env.example .env
```
Make sure `APP_NAME` is set to `POS_Rico`, and configure your database settings (SQLite is configured by default).

Generate the application key:
```bash
php artisan key:generate
```

### 3. Database Migration & Seeding
Run the migrations and seed the database with initial data (Products, Categories, and Default Users):
```bash
php artisan migrate:fresh --seed
```
*Note: This will generate default Admin and Cashier accounts.*

### 4. Build Assets
Compile the Tailwind CSS v4 utilities and JavaScript assets:
```bash
npm run build
```
*(For development, run `npm run dev` to enable Vite's Hot Module Replacement)*

### 5. Start Server
Finally, start the local development server:
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

---

## 🔐 Default Credentials

After running the database seeders, you can log in using:

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@pos.com` | `password` |
| **Cashier** | `cashier@pos.com` | `password` |

---

## 👨‍💻 Author

**Rafael Abimanyu**  
*Lead Developer & UI/UX Architect*

---
*© {{ date('Y') }} POS Rico. All rights reserved.*
