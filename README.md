######### How to install the project #########

1. clone the project from https://github.com/BasharDlaleh/Giphy.git

2. run this in your terminal "cd /your_project_path/" 

3. run this in your terminal "composer install"  (use a proxy if you are in Syria)

4. run this in your terminal "npm install"

5. inside the project open .env file and change the "DB_DATABASE" to the absolute path to the database file in your machine "/your_project_path/database/database.sqlite"

6. run this in your terminal "php artisan migrate"

7. run this in your terminal "php artisan serve"

8. you can now access the app in the browser at "http://localhost:8000"

######### How does it work #########

1. after you open the browser hit the Register link at the top right corner and add a new user.

2. you will be redirected to the Home page where you see random trending GIFs .  

3. write some search pattern in the search box and hit search , the results will be paginated (go to the bottom to see how many pages are there for your search) and switch between pages .

4. please wait for the GIFs to load it might be slow depending on your network connection .

5. hit the Logout button at the top and try to login again . 

6. php unit tests have been added for :
                                        -login
                                        -register
                                        -browse gifs
                                        -search gifs

    - the tests are in tests/Feature/Auth/LoginTest.php & tests/Feature/Gifs/GifTest.php

    - you can run the tests by running this command "./vendor/bin/phpunit" inside the project path.

######### About the project #########

- the project was built as a SPA using Laravel, Vue and Bootstrap frameworks.

- the used GIF API is https://api.giphy.com .

- the main controller for the GIFs is "/your_project_path/app/Http/Controllers/API/GifsController.php" .

- "/your_project_path/app/Services/GifsService.php" is a Service class which includes all the calls to the external GIFs API so that if we wanna change the API provider we need to make changes to this class only ( of course for more complex design we could use interfaces ) .

- For the front-end , we have one Vue component "/your_project_path/resources/js/components/GifsComponent.vue"

- The Auth system is the well known Laravel ui system .

- There are two endpoints in the project , you can find them in "/your_project_path/routes/api.php" .

- I haven't set an API authentication mechanism (token, JWT,..) because i didn't see it necessary . 
