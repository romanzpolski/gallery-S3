
Clone and enter this project,
You need to have composer and npm installed

1. Navigate to: ```cd images/php/app``` and run ```composer install```
2. From root of the project navigate to: 
```cd images/static/app/``` and run ```npm install```
3. Build and run Docker containers, from root of the project run ```docker-compose up --build -d``` or to stop running: ```docker-compose down```
4. Feed DB, from root of the project navigate to: ``` cd images/php/app``` and run ```php artisan migrate:refresh --seed```
5. Open browser and navigate to: ```http://localhost:4000```


Backend Appliication: https://lumen.laravel.com/docs/5.7
Frontend Application: https://github.com/facebook/create-react-app

TODO: Authorisation
TODO: Separate FrontEnd from Backend, put them into other repos and clone them in Docker build process
