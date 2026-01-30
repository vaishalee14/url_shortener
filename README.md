# 🔗 URL Shortener Service

A **URL Shortener Service** built with **Laravel (10 / 11 / 12)**.  
This application supports a **multi-company architecture**, **role-based access control**, and **strict URL visibility rules** as defined in the assignment.

---

## ✨ Features

- Multi-company support
- Role-based access control (RBAC)
- Restricted URL visibility
- Secure URL redirection flow
- Fully tested with feature and unit tests

---

## 👥 Company & Users

- The system supports **multiple companies**
- Each company can have **multiple users**
- Each user belongs to **exactly one company**

---

## 🔐 Roles & Permissions

### Supported Roles
- SuperAdmin
- Admin
- Member
- Sales
- Manager

### Role-Based Access Rules

#### SuperAdmin
- Created via **Database Seeder (raw SQL)**
- Cannot create short URLs
- Can invite **Admins** to create a new company

#### Admin
- Can create short URLs
- Can view short URLs **not created within their own company**
- Can invite **Admins** or **Members** within their own company

#### Member
- Can create short URLs
- Can view **only the short URLs created by themselves**

---

## 🔗 URL Shortener Rules

- Short URLs are **not publicly accessible**
- Short URLs resolve and redirect **only through an authorized flow**
- URL visibility strictly follows **role-based access rules**

---

## 🧪 Test Coverage

- Admin and Member can create short URLs
- SuperAdmin cannot create short URLs
- Admin can view URLs not created within their own company
- Admin can invite Members within their own company
- Member can view only URLs created by themselves

---

## 🛠️ Tech Stack

- **Framework:** Laravel 10 / 11 / 12
- **Language:** PHP 8+
- **Database:** MySQL
- **Authentication:** Laravel Auth / Sanctum
- **ORM:** Eloquent
- **Testing:** Laravel Feature & Unit Tests

---

## 🚀 Local Setup Instructions

1️⃣ Clone the Repository

git clone https://github.com/your-username/url-shortener.git
cd url-shortener

2️⃣ Install Dependencies
composer install

3️⃣ Environment Setup
cp .env.example .env
php artisan key:generate


Update database credentials in the .env file.

4️⃣ Run Migrations & Seeders
php artisan migrate --seed


The SuperAdmin user is created via a database seeder.

5️⃣ Start the Application
php artisan serve

## Acceptable AI Usage Declaration

I confirm that AI tools were used in a limited, ethical, and supportive capacity during the
completion of this assignment. Their use was restricted to syntax reference, debugging
assistance, and clarification of framework-specific concepts.

**AI tools used and purpose:**
- **ChatGPT** – Referenced for Laravel syntax verification, understanding Eloquent
  relationship concepts, and resolving isolated implementation issues.

All core logic, architectural decisions, workflow design, and final implementation were
independently developed by me. The submitted work represents my own technical
understanding, reasoning ability, and problem-solving skills, with AI tools serving solely
as a productivity and learning aid, not as a replacement for original effort.
