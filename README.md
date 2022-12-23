## How to install

After cloning the project you need to first run the below command for installing JS required packages: 

```php
npm install
```

after that we need to install PHP packages by the below command : 

```php
composer install
```

After that we can build the project by below command.
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

At last we need to create the App Key be the below command : 

```php
php artisan key:generate
```