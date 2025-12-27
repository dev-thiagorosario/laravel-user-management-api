# Laravel User Management API – API Collection

This folder contains **API request collections** for the **Laravel User Management API**.
Requests are organized by feature to help developers **quickly test, explore, and understand** available endpoints without manually crafting HTTP calls.

All requests are **tool-agnostic** and based on standard **HTTP / cURL syntax**.

---

## 📁 Folder Structure

```txt
api-collection/
└── laravel-user-management-api/
    ├── auth.bru
    ├── CRUD users.bru
    └── README.md
```

Each file groups requests by responsibility:

- `auth.bru` → authentication and token-related endpoints
- `CRUD users.bru` → user management (CRUD, status, profile)

---

## ▶️ How to Use

### Option 1 – Bruno

Open this folder directly in Bruno and run the requests as needed.

### Option 2 – Postman or Insomnia

All requests can be exported or copied as cURL commands and imported into:

- Postman
- Insomnia
- Any HTTP client that supports cURL

---

## 🔧 Environment Variables

The collections assume the following variables are configured in your API client:

| Variable | Description            | Example                |
|---------:|------------------------|------------------------|
| BASE_URL | Base URL of the API    | http://localhost:8000  |
| TOKEN    | Bearer access token    | eyJhbGciOi...          |

---

## 🔐 Authentication Notes

Most endpoints require authentication using a Bearer Token.

Example cURL request:

```bash
curl -X GET "$BASE_URL/api/users" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Accept: application/json"
```

---

## ⚠️ Important Notes

- This folder contains API test requests only
- No secrets or credentials are stored
- Do not commit real tokens or sensitive data
- Requests are intended for development and testing environments
