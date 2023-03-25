[![Simple App](https://raw.githubusercontent.com/dikhimartin/simple-authentication-scaffolding/main/public/admin_assets/assets/images/logo-full.png)](https://streamingapp.binusassignment.tech)



Demo : [https://authscafollding.binusassignment.tech/](https://authscafollding.binusassignment.tech)

# Simple Authentification Scaffolding -  (Individual Assignment 2)



## Penjelasan

Saya membuat project ini, karena untuk melengkapi satu tugas individu di Universitas. Jadi saya diminta untuk  mengimplementasikan Authentification Scaffolding  fitur bawaan laravel dengan kriteria sebagai berikut :

```
Buatlah aplikasi login form dengan menggunakan Laravel dengan aturan sebagai berikut: 
• Form reset password.
• Register user dan password
• Password mempunyai kombinasi huruf kecil, huruf besar, angka, dan symbol.
• Jumlah password minimal 10 karakter.
• Jika kombinasi password tidak terpenuhi maka akan keluar alert agar user memenuhi kombinasi yang sudah ditetapkan.
Terdapat validasi user dan password, jika gagal 3 kali maka terdapat qounter waktu untuk diijinkan masuk kembali dalam waktu 30 detik selanjutnya.
• Pada form login terdapat validasi (kita dapat gunakan jenis captcha atau jenis lainnya)

Tech Stack Requirement : 
- Laravel Framework >= 5.6 

source : 20220629154906_TP2-W7-S11-R1
```



## Cara menjalankan aplikasi

**Tech Stack :**

- **Server Native :**

  - PHP >= 7.1.3

  - OpenSSL PHP Extension

  - PDO PHP Extension

  - Mbstring PHP Extension

  - Tokenizer PHP Extension

  - XML PHP Extension

  - Ctype PHP Extension

  - JSON PHP Extension
  - Composer - https://getcomposer.org

**Proses Instalasi Laravel 5.8 :** 

- Setting Environtment

  ```shell
  cp .env.example .env 
  ```

- Install Vendor

  ```shell
  composer install
  ```

- Persiapan

  ```shell
  php artisan key:generate
  ```

  ```shell
  php artisan config:cache
  ```

- Inisialisasi Database

  - SQL

    ```sql
    CREATE DATABASE db_simple_auth;
    ```

  - Terminal

    ```shell
    php artisan migrate
    ```

    ```shell
    php artisan db:seed
    ```

- Menjalankan Aplikasi

  ```shell
  php artisan serve
  ```

- Laravel development server started: <http://127.0.0.1:8000>

- Akses Login 

  - Username : binusian
  - Password : binusian

------



### Made with Laravel Framework  5.8

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>





#### Intro

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.