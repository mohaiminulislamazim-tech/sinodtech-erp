# API Documentation: SinodTech ERP

## 🔐 Authentication

SinodTech ERP uses **Laravel Sanctum** for API authentication. To access protected endpoints, you must provide a Bearer token in the `Authorization` header.

**Header:**
```text
Authorization: Bearer <your_access_token>
Accept: application/json
```

---

## 📦 Products API

### List Products
- **Endpoint:** `GET /api/v1/products`
- **Description:** Retrieve a paginated list of all products.
- **Example Request:** `curl -X GET http://localhost/api/v1/products`
- **Example Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Professional Laptop",
            "sku": "LAP-001",
            "price": 1200.00,
            "category": "Electronics"
        }
    ],
    "links": { ... },
    "meta": { ... }
}
```

### Get Product Details
- **Endpoint:** `GET /api/v1/products/{id}`
- **Description:** Retrieve details of a specific product.

---

## 👥 Customers API

### List Customers
- **Endpoint:** `GET /api/v1/customers`
- **Description:** Retrieve all customers.

### Create Customer
- **Endpoint:** `POST /api/v1/customers`
- **Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890"
}
```

---

## 🛒 Sales API

### Create Sale (POS)
- **Endpoint:** `POST /api/v1/sales`
- **Description:** Process a new sale.
- **Request Body:**
```json
{
    "customer_id": 1,
    "branch_id": 1,
    "items": [
        {
            "product_id": 1,
            "quantity": 2,
            "price": 1200.00
        }
    ],
    "total_amount": 2400.00,
    "payment_method": "cash"
}
```

---

## 📈 Inventory API

### List Inventory
- **Endpoint:** `GET /api/v1/inventories`
- **Description:** View stock levels across branches.

### Update Stock
- **Endpoint:** `PUT /api/v1/inventories/{id}`
- **Request Body:**
```json
{
    "quantity": 50,
    "type": "adjustment",
    "reason": "Restock"
}
```

---

## 🏁 Status Codes

| Code | Meaning |
|---|---|
| `200` | **OK:** Request successful. |
| `201` | **Created:** Resource successfully created. |
| `400` | **Bad Request:** Invalid parameters. |
| `401` | **Unauthorized:** Authentication failed. |
| `403` | **Forbidden:** Insufficient permissions. |
| `404` | **Not Found:** Resource not found. |
| `422` | **Unprocessable Entity:** Validation error. |
| `500` | **Server Error:** Something went wrong on our end. |

---

## 👨‍💻 Author

**Mohaiminul Islam**
- GitHub: [@mohaiminulislamazim-tech](https://github.com/mohaiminulislamazim-tech)
- Project: SinodTech ERP
