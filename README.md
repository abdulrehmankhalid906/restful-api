Restful API Crud Using Laravel 11.

How to test Api in postman?

Route::get('/users',[UserController::class, 'index']);
Example: localhost:8000/api/users

Route::get('/user/{id}',[UserController::class, 'view']);
Example: localhost:8000/api/user/1
