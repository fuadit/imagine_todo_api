# imagine_todo_api
## Laravel App with Sanctum
.

## Prerequisites

Before you begin, ensure you have the following installed:

- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) or any other database of your choice

## Installation

1. Clone the repository:

```bash
git clone https://github.com/fuad-works/imagine_todo_api.git
```
   
2. Install PHP dependencies using Composer:

```bash
composer install
```

3. Copy the .env.example file and rename it to .env. Update the database connection settings in the .env file:

```bash
cp .env.example .env
```

4. Generate the application key:
```bash
php artisan key:generate
```

6. Create the database tables (make sure you created the database in mysql and set the configrations in .env file)
```bash
php artisan serve
```
7. Access the app in your browser at http://localhost:8000.

## Usage 
- Register a new user through the /api/register endpoint.
- Log in with the registered user credentials using the /api/login endpoint. This will return an authentication token.
- Use the token to access protected routes that require authentication.

there is a PostMan Exapmle file in this reposotory 


### Functionalities 
1. Register
   URL: http://localhost:8000/api/signup
   Method: POST
   Request Data:
   {
   
   }
   
3. Login

#### all of the following urls you should be loged in, using the tokin as Barer Token
3. Tasks List

4. Add Task

   
5. Edit Task


6. Delete Task


7. Show Task 

 
