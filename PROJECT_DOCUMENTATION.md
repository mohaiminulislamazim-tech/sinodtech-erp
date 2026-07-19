# Project Documentation: SinodTech ERP

## 🏛 Architecture Overview

SinodTech ERP is built using the **Laravel 11** framework, following the **Model-View-Controller (MVC)** architectural pattern. Additionally, it implements the **Repository Pattern** to decouple the data access layer from the business logic, ensuring easier maintainability and testability.

### Key Architectural Layers:
- **Presentation Layer:** Blade Templates, Tailwind CSS, Alpine.js (for interactivity).
- **Business Logic Layer:** Controllers & Services.
- **Data Access Layer:** Repositories & Eloquent Models.
- **Communication Layer:** RESTful API & Transactional/Promotional Mailing.

---

## 📂 Folder Structure

```text
├── app/
│   ├── Console/            # Custom Artisan Commands
│   ├── Http/
│   │   ├── Controllers/    # Application Controllers
│   │   ├── Middleware/     # Route Middleware
│   │   ├── Requests/       # Form Request Validations
│   │   └── Resources/      # API Transformation Logic
│   ├── Models/             # Eloquent Models
│   ├── Observers/          # Model Observers (e.g., Inventory Updates)
│   ├── Providers/          # Service Providers
│   ├── Repositories/       # Data Access Layer (Repository Pattern)
│   └── Services/           # Complex Business Logic
├── config/                 # Application Configuration Files
├── database/
│   ├── migrations/         # Database Schema
│   └── seeders/            # Database Seeding
├── resources/
│   ├── css/                # Tailwind CSS Configuration
│   ├── js/                 # Javascript (Alpine.js)
│   └── views/              # Blade Templates
├── routes/
│   ├── api.php             # REST API Routes
│   └── web.php             # Web Routes
└── storage/                # Logs & Framework Cache
```

---

## 🗄 Database Design

The system uses a relational database structure designed for integrity and performance.

### Core Tables:
- **`users`**: System users (Admins, Managers, etc.)
- **`branches`**: Multi-location support.
- **`categories`**: Product classification.
- **`products`**: Core item data (SKU, Price, etc.)
- **`inventories`**: Stock tracking per branch.
- **`customers`**: CRM data.
- **`sales`**: Order headers.
- **`sale_items`**: Detailed line items for each sale.
- **`transactions`**: Financial ledger tracking.
- **`employees`**: Staff profiles and assignments.

---

## 🔄 Module Flow

### 1. Sales & POS Flow
- Select Branch -> Select Customer -> Scan/Search Products -> Apply Discounts -> Process Payment -> Update Inventory -> Generate Invoice.

### 2. Inventory Management Flow
- Add Product -> Assign Initial Stock to Branch -> Stock Adjustments (Loss/Found) -> Stock Transfers between Branches -> Low Stock Alerts.

### 3. CRM & Promotion Flow
- Customer Interaction -> Track Last Purchase -> System Identifies "Lost Customers" -> Automated/Manual Promotion Emails.

---

## 🔐 Authentication & Authorization

- **Authentication:** Managed via **Laravel Breeze** (Session-based for Web) and **Laravel Sanctum** (Token-based for API).
- **Authorization:** Implementation of **Role-Based Access Control (RBAC)** using Policies and Middleware to restrict access based on user roles (Admin, Branch Manager, Staff).

---

## 🚀 Deployment Guide

### Local Deployment
1. Install PHP 8.2+ and Composer.
2. Clone repo and run `composer install`.
3. Set up `.env` from `.env.example`.
4. Run `php artisan migrate --seed`.
5. Start server with `php artisan serve`.

### VPS/Shared Hosting
- Use Nginx/Apache with PHP-FPM.
- Point the document root to the `public/` folder.
- Run `php artisan optimize` for production performance.
- Set up a Cron Job for Laravel Scheduler: `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`.

---

## 🗺 Future Roadmap

- [ ] Mobile App (Flutter/React Native) integration via API.
- [ ] Multi-currency support.
- [ ] Supplier & Purchase Order (PO) Management.
- [ ] Advanced AI-driven Sales Forecasting.
- [ ] Integration with popular payment gateways (Stripe/PayPal).

---

## 👨‍💻 Author

**Mohaiminul Islam**
- GitHub: [@mohaiminulislamazim-tech](https://github.com/mohaiminulislamazim-tech)
- Project: SinodTech ERP
