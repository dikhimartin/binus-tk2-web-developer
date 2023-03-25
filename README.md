[![Laravel Logo](https://laravel.com/assets/img/components/logo-laravel.svg)](https://tk2.binusassignment.tech)



Demo : [https://tk2.binusassignment.tech](https://tk2.binusassignment.tech/)

# Grade App -  (Team Assignment 2)



## Penjelasan

Kami membuat project ini, karena untuk melengkapi satu tugas kelompok ke -2 dalam mata kuliah Web Developer. Jadi kita diminta untuk membuat suatu website dengan kriteria sebagai berikut :

```
Buatlah aplikasi perhitungan nilai menggunakan laravel untuk 
menghitung grade setiap mahasiswa dengan komposisi inputan sebagai berikut:
• Nilai Quiz
• Nilai Tugas
• Nilai Absensi
• Nilai praktek
• Nilai UAS

Ketentuan penilaian grade:
• Nilai <= 65 = D
• Nilai <= 75 = C
• Nilai <= 85 = B
• Nilai <=100 = A

Lakukan penginputan nilai tersebut untuk masing – masing mahasiswa (minimal 4 orang) 
Buatlah output dalam bentuk grafik untuk setiap grade yang didapatkan.

Tech Stack Requirement : 
- Laravel Framework >= 5.8 

source : 20220629155011_TK2-W4-S5-R1
```



## Cara menjalankan aplikasi

**Tech Stack :**

- **Server Container :**
  - Docker Engine https://docs.docker.com/engine/install2.

  - Docker Compose https://docs.docker.com/compose/install
    
    

**Proses Instalasi laravel 5.8:**

- Install Docker Engine & Docker Compose.

- Cloning aplikasi source

  ```shell
  git clone https://github.com/dikhimartin/compro-driving-courses.git
  ```

- Masuk ke aplikasi source

  ```shell
  cd compro-driving-courses
  ```

- copy file environtment

  ```shell
  cp ./project/.env.example ./project/.env
  ```

- Build Dockerfile

  ```shell
  docker build -t myapp .
  ```

- Jalankan framework Laravel 5.8  menggunakan command 

  ```shell
  docker-compose up -d
  ```

- Inisialisasi Database

  ```shell
  docker-compose exec myapp php artisan migrate  
  ```

  ```shell
  docker-compose exec myapp  php artisan db:seed
  ```

- buka browser pada URL  http://localhost:8000, untuk mengakses aplikasi.

- buka browser pada URL  http://localhost:8080, untuk mengakses PHPmyadmin (Database Management).



**Note :** 
Apabila URL belum bisa di akses, coba restart kembali container image nya dengan menggunakan command sebagai berikut

```shell
docker-compose up -d --force-recreate myapp
```



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