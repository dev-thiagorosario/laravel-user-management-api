# Laravel User Management API

API-only project built with Laravel, focused on user identity, authentication, and access management.  
The application provides a complete user lifecycle with secure authentication mechanisms, following clean code principles and a well-structured backend architecture.

This project is intended for backend usage only and does not include any frontend interface.

---

## 🚀 Features

- Full User CRUD (Create, Read, Update, Delete)
- Authentication (Login / Logout)
- Password reset and recovery
- Credential management
- User status control (active, blocked, etc.)
- Token-based authentication
- API-first design (no frontend)

---

## 🧱 Architecture & Practices

- API-only Laravel application
- Clear separation of concerns
- Request validation
- Service / Use Case oriented logic
- Clean and readable codebase
- Ready to be consumed by any frontend (Web, Mobile, SPA)

---

## 🐳 Build & Run (Docker)

### Prerequisites

- Docker
- Docker Compose

### Setup Steps

1. Build and start the containers:

```bash
docker-compose up --build -d
```

2. Install PHP dependencies:

```bash
docker-compose exec app composer install
```

3. Copy environment file and set the app key:

```bash
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan key:generate
```

4. Run migrations:

```bash
docker-compose exec app php artisan migrate
```

The API will be available after the containers are up.

## 🌱 Database Seeders (Test Users)

To speed up API testing and avoid manual user registration, the project includes a user seeder.

### Available Seeder

- `database/seeders/UsersTableSeeder.php`

This seeder creates multiple users with predefined credentials and status fields (`first_login`, `is_active`, `last_login`, etc.).

### Run the Seeder (Docker)

```bash
docker compose exec app php artisan db:seed --class=UsersTableSeeder
```

This will populate the database with test users, allowing immediate authentication and endpoint testing.

## 🧪 API Tests & Request Collections

API request collections are stored separately from the application code.

### Location

```
api-collection/
└── laravel-user-management-api/
```

This folder contains API request definitions used to test and explore the available endpoints.
Each collection is organized by feature (authentication, users, health checks, etc.) and includes its own `README.md` with usage instructions.

⚠️ This folder contains test requests only. No secrets or credentials are stored.

The collections are tool-agnostic and can be used with clients such as Bruno, Insomnia, or Postman.

## Notes

- This is an API-only project. There is no frontend UI.
