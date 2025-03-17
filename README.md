# Project Management API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the Project
This is a project management API built using Laravel 9, implementing authentication with Laravel Passport. The API supports flexible filtering on both standard and EAV attributes and includes comprehensive CRUD operations for users, projects, and timesheets.

## Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/shivaniwaghmare/project-management-api.git
   cd project-management-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Copy the environment file and update it:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your database connection in the `.env` file:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_task_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

7. Install Passport for authentication:
   ```bash
   php artisan passport:install
   ```

8. Start the development server:
   ```bash
   php artisan serve
   ```

## API Documentation
### Authentication
- **Register:** `POST /api/register`
- **Login:** `POST /api/login`
- **Logout:** `POST /api/logout`

### Users
- **List Users:** `GET /api/users`
- **Get User by ID:** `GET /api/users/{id}`
- **Create User:** `POST /api/users`
- **Update User:** `PUT /api/users/{id}`
- **Delete User:** `DELETE /api/users/{id}`

### Projects
- **List Projects:** `GET /api/projects`
- **Get Project by ID:** `GET /api/projects/{id}`
- **Create Project:** `POST /api/projects`
- **Update Project:** `PUT /api/projects/{id}`
- **Delete Project:** `DELETE /api/projects/{id}`

### Timesheets
- **List Timesheets:** `GET /api/timesheets`
- **Get Timesheet by ID:** `GET /api/timesheets/{id}`
- **Create Timesheet:** `POST /api/timesheets`
- **Update Timesheet:** `PUT /api/timesheets/{id}`
- **Delete Timesheet:** `DELETE /api/timesheets/{id}`

### Dynamic Attributes (EAV)
- **Create Attribute:** `POST /api/attributes`
- **Update Attribute:** `PUT /api/attributes/{id}`
- **List Attributes:** `GET /api/attributes`
- **Set Attribute Value:** `POST /api/projects/{id}/attributes`

## Filtering
- **Flexible Filtering:** Supports filtering on both regular and EAV attributes.
  Example: `GET /api/projects?filters[name]=ProjectA&filters[department]=IT`

## Example Requests/Responses
- Refer to the Postman collection in the repository.

## Test Credentials
- **Email:** `admin@example.com`
- **Password:** `password`

## SQL Dump
- The SQL dump file is located in the root directory as `project_task_db.sql`.
- To import the dump:
  ```bash
  mysql -u root -p project_task_db < project_task_db.sql
  ```

## License
This project is licensed under the MIT License.
