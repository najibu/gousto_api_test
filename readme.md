# GOUSTO API TEST

Version set of recipe operations

### Installation
``` bash
git clone
composer install
touch database/database.sqlite
cp .env.example .env
php artisan migrate
php artisan recipes:data
php artisan serve
```

### API Endpoints
``` bash
GET                  /api/v1/recipes/{id}                                   Fetch a recipe by id
GET                  /api/v1/recipes_by_cuisine/{cuisine}                   Fetch all recipes for a specific cuisine
GET                  /api/v1/recipes_by_cuisine/{cuisine}?page=2            Fetch all recipes for a specific cuisine by page
POST                 /api/v1/recipes/{id}/rate                              body: {"rate": 4} Rate an existing recipe between 1 and 5
PUT/PATCH            /api/v1/recipes/{id}                                   Update an existing recipe
POST                 /api/v1/recipes                                        Store a new recipe
GET                  /api/v1/recipes                                        Fetch all recipes
GET                  /api/v1/recipes?page=2                                 Fetch all recipes by page
```

### Reasons for choice of web application framework
- Laravel by default follows a RestFul architecture
- Laravel is a comprehensive framework suitable for api development as it is logically structured, and enjoys strong community support.
- Third party packages support
- Directory Structure
- DB Migrations & Eloquent

### How this solution would cater for different API consumers that require different recipe data e.g. a mobile app and the front-end of a website
- The API is not too complex for other developers to use.
- Error handling is well implemented.
- Supports return types that are relevant to other API consumers (JSON).
- It uses a REST protocol for easy data access.
- I have used HTTP headers for serialization formats which let both client and server to know which format is used the communication.

### Relevant to solution
The CSV is stored in resources/csv/recipe-data.csv

#### Thank you for checking out gousto api
