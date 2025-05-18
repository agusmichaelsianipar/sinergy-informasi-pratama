<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to install the app

-   Make sure you've download [Composer](https://getcomposer.org/download/), and meet all the minimum requirements of Laravel 12.
-   Use the git clone a command followed by the repository [URL](https://github.com/agusmichaelsianipar/sinergy-informasi-pratama.git) to clone the project to your local machine.
    `git clone https://github.com/agusmichaelsianipar/sinergy-informasi-pratama.git`
-   Navigate to the project Directory.
    `cd sinergy-informasi-pratama`
-   Install all the dependencies
    `composer install`
-   Install all the dependencies
    `npm install`
-   Duplicate the .env.example file and save it as .env
    `cp .env.example .env`
-   Generate the application key using the following command:
    `php artisan key:generate`
-   Create an empty database for the application
-   In the .env file, add database information to allow Laravel to connect to the database

```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sinergy_informasi_pratama
    DB_USERNAME=root
    DB_PASSWORD=
```

-   Execute the following command to run the database migrations:
    `php artisan migrate`
-   Execute the following command to link the storage with public folder:
    `php artisan storage:link`
-   Serve the application by the following command:
    `php artisan serve`

### Tech Stack

-   **[PHP 8.4.5](https://www.php.net/releases/8.4/en.php)**
-   **[Laravel 12](https://laravel.com/docs/12.x/releases)**
-   **[MySQL 8.0.30](https://dev.mysql.com/doc/relnotes/mysql/8.0/en/)**
-   **[Bootstrap 5.3](https://getbootstrap.com/docs/5.3/getting-started/introduction/)**
-   **[Yajra Laravel Datatable 12](https://yajrabox.com/docs/laravel-datatables/12.0/)**
-   **[Font Awesome 6.7.2](https://docs.fontawesome.com/)**
-   **[SweetAlert 2](https://sweetalert2.github.io/)**
-   **[JQuery 3.7.1](https://releases.jquery.com/)**
