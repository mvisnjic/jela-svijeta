# jela-svijeta task

-   laravel framework

## Run the project

1. Clone the project
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. `php artisan migrate --seed`
    - if error appear class "PDO" not found then run
        1. `sudo dnf install php-pdo` (fedora) or `sudo apt-get php-pdo`
6. `php artisan serve`

## Random delete rows

1. `cd bash-script`
2. `./delete-random-rows.sh`
