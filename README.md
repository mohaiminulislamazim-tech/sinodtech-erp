# SinodTech ERP

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

Professional Enterprise Resource Planning (ERP) system built with Laravel 11, Tailwind CSS, and Alpine.js. Designed for scalability, performance, and ease of use.

---

## 📸 Screenshots

### Dashboard & Analytics
| ![Dashboard Dark](./screenshots/dashboard_dark) | ![Charts](./screenshots/charts) |
|:---:|:---:|
| *Real-time Analytics (Dark Mode)* | *Performance Charts* |

### Sales & POS
| ![POS System](./screenshots/pos) | ![Login](./screenshots/login.png) |
|:---:|:---:|
| *Point of Sale Interface* | *Secure Login* |

### Operations
| ![Inventory](./screenshots/inventory) | ![Reports](./screenshots/reports) |
|:---:|:---:|
| *Inventory Tracking* | *Detailed Reporting* |

---

## ✨ Features

- **📊 Advanced Dashboard:** Real-time analytics, sales trends, and KPI monitoring.
- **🛒 POS System:** Streamlined point-of-sale interface with barcode support and quick checkout.
- **📦 Inventory Management:** Multi-branch stock tracking, automated low-stock alerts, and stock transfers.
- **👥 CRM & Customer Management:** Track customer behavior, identify lost customers, and automated promotion mailing.
- **👔 Employee Management:** Role-based access control (RBAC), performance tracking, and branch assignments.
- **📈 Comprehensive Reporting:** Generate PDF/Excel reports for sales, transactions, and inventory.
- **🌓 Native Dark Mode:** System-wide dark/light theme toggle.
- **📱 Fully Responsive:** Optimized for all devices (Mobile, Tablet, Desktop).

---

## 🛠 Technology Stack

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Tailwind CSS, Alpine.js, Blade Components
- **Database:** SQLite (Default), MySQL/PostgreSQL compatible
- **API:** RESTful API with Laravel Sanctum
- **Bundler:** Vite

---

## 📂 Project Structure

```text
app/
├── Http/           # Controllers, Middleware, Requests, Resources
├── Models/         # Eloquent Models & Relationships
├── Repositories/   # Data Access Layer (Repository Pattern)
├── Services/       # Business Logic Layer
├── Observers/      # Model Observers (Inventory tracking)
├── Mail/           # Transactional & Promotional Emails
database/
├── migrations/     # Database Schema
├── seeders/        # Initial Data & Demo Content
resources/
├── views/          # Blade Templates & Components
├── css/            # Tailwind CSS Configurations
├── js/             # Alpine.js & Custom Logic
routes/
├── web.php         # Web Routes
├── api.php         # REST API Routes
```

---

## 🚀 Installation Guide

### Requirements
- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite (or preferred database)

### Step-by-Step Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/mohaiminulislamazim-tech/sinodtech-erp.git
   cd sinodtech-erp
   ```

2. **Install dependencies:**
   ```bash
   composer install --no-dev
   npm install
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration:**
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Build Production Assets:**
   ```bash
   npm run build
   ```

6. **Optimize for Performance:**
   ```bash
   php artisan optimize
   ```

7. **Start Server:**
   ```bash
   php artisan serve
   ```

---

## 🔐 Default Credentials

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@sinodtech.com` | `password` |

*(Note: Change these immediately after first login in production environments)*

---

## 📄 API Documentation

Full API documentation is available in [API_DOCUMENTATION.md](./API_DOCUMENTATION.md).

---

## 🗺 Future Roadmap
- [ ] Mobile Application (Flutter/React Native)
- [ ] Multi-currency and Global Tax support
- [ ] Supplier & Purchase Order Management
- [ ] AI-driven Inventory Forecasting
- [ ] Stripe/PayPal Integration

---

## 📜 License

This project is licensed under the [MIT License](LICENSE).

---

## 👨‍💻 Developed By

**Mohaiminul Islam**
- GitHub: [@mohaiminulislamazim-tech](https://github.com/mohaiminulislamazim-tech)
- Project: SinodTech ERP

© 2026 SinodTech ERP. All rights reserved.
