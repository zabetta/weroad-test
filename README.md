<p align="center"><a href="https://weroad.it" target="_blank"><img src="https://image.spreadshirtmedia.net/image-server/v1/compositions/T56A2PA4115PT17X0Y116D173645987FS2026/views/1,width=650,height=650,appearanceId=2.jpg" width="400"></a></p>

# Hiring test

This is an example of weroad structure homemade

## Goals

At the end, the project should have:

1. A private (admin) endpoint to create new users. If you want, this could also be an artisan command, as you like;
2. A private (admin) endpoint to create new travels;
3. A private (admin) endpoint to create new tours for a travel;
4. A private (editor) endpoint to update a travel;
5. A public (no auth) endpoint to get a list of paginated travels;
6. A public (no auth) endpoint to get a list of paginated tours by the travel `slug` (e.g. all the tours of the travel `foo-bar`). Users can filter (search) the results by `priceFrom`, `priceTo`, `startingDate`, `endingDate`. User can sort the list by `price` asc and desc. They will always be sorted, after every user-provided filter, by `startingDate` asc;
7. A public (no auth) endpoint to get a single tour by its `id`. It will also return the travel data.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation

- ** Clone the project in your local folder
- ** Install vendor with "composer install" command
- ** Rename .env.example in .env and use "php artisan key:generate" to generate laravel APP_KEY
- ** Set up all DB_* env variables to your mysql server 
    ( IF YOU NEED IT YOU CAN USE A MYSQL CONTAINER with this command:
     "docker run -p 127.0.0.1:3333:3306  --name my-mariadb -e MARIADB_ROOT_PASSWORD=t00r -d mariadb:latest" )
     and create a DB. I called mine weroad_db

- ** run php artisan migrate to create DB
- ** run php artisan migrate db:seed travels
- ** run php artisan migrate db:seed tours
- ** run php artisan migrate db:seed roles
- ** run php artisan migrate db:seed create_admin

and then...

- ** run php artisan serve to launch server to play

From now you can login into the reserved area with the created user 
- ** username admin@weroad.it
- ** password password

and create users, travels and tours

goals are commented also in route file (routes/web.php), but you can use them navigate the website

