# binus-tk2-web-developer
BINUS - Team Assignment 2 - Web Developer

Langkah-langkah menjalankan aplikasi web di lokal:

1. Jalankan `docker-compose up -d` dan kunjungi `http://localhost:8000`.
2. Jika `http://localhost:8000` belum bisa dikunjungi jalankan `docker-compose restart myapp`.
3. Jalankan `docker-compose exec myapp php artisan migrate` untuk melakukan migrasi skema basis data.

Langkah pengerjaan:
1. `docker-compose exec myapp composer require jeroennoten/laravel-adminlte` untuk untuk framework laravel-adminlte
1. `docker-compose exec myapp php artisan adminlte:install` untuk install framework laravel-adminlte
1. `docker-compose exec myapp php artisan adminlte:plugins install --plugin=datatables --plugin=datatablesPlugins` enable adminlte datatables

<!-- Proses Pengerjaan -->
composer require jeroennoten/laravel-adminlte
php artisan adminlte:install
php artisan adminlte:plugins install --plugin=datatables --plugin=datatablesPlugins

php artisan make:model Student -m
php artisan make:model Grade -m

php artisan make:controller StudentController
php artisan make:controller GradeController