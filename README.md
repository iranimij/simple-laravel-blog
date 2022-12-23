## How to install

Please just clone the project and run the below command : 

```php
npm run build
```


### Connecting the database

After that you need to connect your database to the project. you can do it by changing the .env.example file.

```php
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

after that you need to rename the `.env.example` file to `.env` file.


### Creating the tables

Now you can create the tables by below command :

```php
php artisan migrate
```