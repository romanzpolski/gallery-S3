To see this application working follow these steps:
Clone and enter this project,
You need to have composer, docker and npm installed

1. Navigate to: ```cd images/php/app``` and run ```composer install```, paste here provided .env file.
2. From root of the project navigate to: 
```cd images/static/app/``` and run ```npm install```, to see code change run: ```npm run-script build```
3. Build and run Docker containers, from root of the project run ```docker-compose up --build -d``` or to stop running: ```docker-compose down```
4. Feed DB, from root of the project navigate to: ``` cd images/php/app``` and run ```php artisan migrate:refresh --seed```
5. Open browser and navigate to: ```http://localhost:4000```


- Application accepts files up to 10MB
- Accepted file extensions: only jpg, png
- Image size restricted to 1000/1000 px
- Number of downloads/views refreshing every 10 secs: Click on image to view it (this triggers views increment call), click 'Download' button inside modal to call API for AWS S3 download link.
- Pagination
- Images stored in AWS S3
- API : [http://localhost/api/images/0](http://localhost/api/images/0)


Backend Appliication: https://lumen.laravel.com/docs/5.7
Lives in ```images/php/app```

Frontend Application: https://github.com/facebook/create-react-app
Lives in ```images/static/app```

TODO: Users and authentication

TODO: Separate FrontEnd from Backend, put them into other repos and clone them in Docker build process

TODO: Fix Images slow loading / switching issue

TODO: Probably make views/downloads API calls for whole page so not 9 calls but only 1

