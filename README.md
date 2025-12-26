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

## Notes

- This is an API-only project. There is no frontend UI.
