## Requirements
- php 7.4 or higher
- composer
- nodejs
- npm
- Mysql
- apache2

## Make Sure
- inside php.ini >> memory_limit=256M or higher

## installation
- git clone https://github.com/amrfoley/chefaa-back.git
- cd chefaa-back
- composer install
- php artisan key:generate
- php artisan link:storage
- npm install
- npm run dev
- cp .env.example .env
- put your Mysql credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- if using another DBMS please follow Laravel Documentation
- php artisan migrate --seed
- php artisan serve

## CLI Command
- to return cheapest 5 prices
    - php artisan product:cheapest {product_id}
- Or cheapest x prices
    - php artisan product:cheapest {product_id} --limit={number}