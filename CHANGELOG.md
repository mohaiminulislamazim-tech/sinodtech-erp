# Changelog: SinodTech ERP

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.0.0] - 2026-07-20

### ✨ Added
- **Core Modules:** Branches, Categories, Products, Customers, Employees.
- **Sales & POS:**
    - Real-time POS interface.
    - Discount management.
    - Multiple payment methods support.
    - Professional PDF invoice generation.
- **Inventory System:**
    - Multi-branch stock management.
    - Stock adjustment and transfer capabilities.
    - Detailed inventory logs/history.
    - Low-stock visual indicators.
- **CRM & Marketing:**
    - "Lost Customer" detection logic.
    - Automated promotional email system.
    - Customer assignment tracking.
- **Reporting:**
    - Financial transaction ledger.
    - Export reports to PDF and Excel (planned).
    - Graphical dashboard with sales trends.
- **UI/UX:**
    - Fully responsive Tailwind CSS layout.
    - Native Dark Mode support.
    - Sidebar navigation with active state tracking.
- **Security:**
    - Role-Based Access Control (RBAC).
    - Laravel Sanctum for API security.
    - Model Observers for data integrity.

### 🛠 Fixed
- Handled edge cases in inventory transfers.
- Improved validation for all form requests.
- Optimized database queries using Repository pattern.

### 🔒 Security
- Implemented professional `.gitignore`.
- Removed all hardcoded secrets and environment variables.
- Standardized error handling to prevent sensitive data leaks.

---

## [0.5.0] - 2026-07-19
### Initial Beta Release
- Basic CRUD for Products and Customers.
- Simple Sales tracking.
- Initial database schema design.

---

## 👨‍💻 Author

**Mohaiminul Islam**
- GitHub: [@mohaiminulislamazim-tech](https://github.com/mohaiminulislamazim-tech)
- Project: SinodTech ERP
