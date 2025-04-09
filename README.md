# Laravel Tasks Manager Application
This is a simple Laravel Tasks manager application with useful features, built using MySQL, Sanctum authentication, repository and service patterns and more.

## Features
- **Sanctum Authentication** for secure API access.
- **Tasks Management** with search and pagination features.
- **Pagination, Search** functionality for Todos.
- **API Documentation** available to (Postman).
- **Repositories and Services** for writing clean code.
- **Laravel Requests** custom request for APIs.
- **Exceptions** custom exceptions for handling errors.
- **Resources** For handling API responses.
- **API Response Trait** for handling success, error and validation responses for APIs.
- **JSON Langs Files** for translating API responses.

## Prerequisites
Before running the project, ensure you have the following installed:
- PHP 8.x
- MySQL
- Composer
- Postman
- VS Code Or PHPStorm

## Getting Started & Installation Steps
1. Clone the repository:
   - git clone https://github.com/devahmedsaber/task-manager-app.git
   - cd task-manager-app
2. Install dependencies:
   - composer install
3. Set up environment variables:
      - Copy `.env.example` to `.env` (cp .env.example .env)
      - Update database configuration:
          - DB_CONNECTION=mysql
          - DB_HOST=127.0.0.1
          - DB_PORT=3306
          - DB_DATABASE=your_database_name => like (tasks_manager_app)
          - DB_USERNAME=your_database_user => like (root)
          - DB_PASSWORD=your_database_password
4. Generate the application key by running this command bash:
    - php artisan key:generate
5. Run the database migrations by running this command bash:
    - php artisan migrate
6. Start the development server by running this command bash:
    - php artisan serve
7. Access the application by running this command bash:
    - Open your browser and navigate to `http://localhost:8000`.

## Some Guidelines
1. API Documentation:
    - You can view the API documentation (Postman) by visiting the following link:
        https://documenter.getpostman.com/view/27286122/2sB2cX9M1b
    - Or you can add the todo list app collection to your postman collections by importing it manually.
    - The todo list app collection exists in root directory with project files called (Tasks Manager App.postman_collection).
    - Change `local` variable value from variables tab of postman collection with your application serve link like `http://localhost:8000`.
    - Change `token` variable value from variables tab of postman collection with your login token via the `/api/auth/login` endpoint.
2. Sanctum Authentication:
    - All API requests are secured with Sanctum authentication. Make sure to authenticate by obtaining a token via the `/api/auth/login` endpoint and including it in your requests.
