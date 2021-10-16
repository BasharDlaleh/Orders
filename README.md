## a CRUD app for managing orders and products

######### How to install the project #########

1. clone the project from https://github.com/BasharDlaleh/Orders.git

2. got to your project path in terminal "cd /your_project_path/" 

3. run this in terminal "composer install"

4. run this in terminal "npm install"

5. inside the project open .env file and change the "DB_DATABASE" to the absolute path to the database file in your machine "/your_project_path/database/database.sqlite" or use whatever sql database you want

6. run this in terminal "php artisan migrate --seed"

7. run this in terminal "php artisan serve"

8. you can now access the app in the browser at "http://localhost:8000"


######### About the project #########

1. For quick testing , i added 3 customers, 6 orders, 6 products and linked them togother randomly

2. after you open the browser login with the default admin (email : admin@gmail.com , password : password ) or hit the Register link and add a new user  

3. you can check ERD diagram in docs/ERD.PNG

4. you can check UML diagram in "http://localhost:8000/uml"

5. the project was built as a SPA using Laravel, Vue and Bootstrap frameworks.

6. I have set an API authentication mechanism using tokens . 

