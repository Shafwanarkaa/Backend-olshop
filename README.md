# 🛒 Backend Olshop - Laravel 11
Proyek backend toko online modul UBSI yang dibangun menggunakan Laravel 11. <br>
<b>Requirement : </b>
| Software               | Versi Minimum   | Cek dengan perintah |
| ---------------------- | --------------- | ------------------- |
| PHP                    | 8.3             | `php -v`            |
| Composer               | 2.8.6 / Terbaru | `composer -V`       |
| Laravel                | 11              | `laravel --version` |
| Git                    | Terinstall      | `git --version`     |
| Database               | MySQL / MariaDB | -                   |

## 🛠️ Installation Guide

### 🔹 Step 1: Pastikan software terinstall sesuai requirement!
```bash
composer global require laravel/installer
```
### 🔹 Step 2: Clone Proyek dari GitHub
```bash
git clone https://github.com/Shafwanarkaa/Backend-olshop.git
cd Backend-olshop
```
### 🔹 Step 3: Install Dependencies
```bash
composer install
npm install
```
### 🔹 Step 3: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
Lalu edit .env dan sesuaikan konfigurasi database di phpmyadmin kamu.
```
### 🔹 Step 4: Database Configuration
```bash
php artisan migrate --seed
```
### 🔹 Step 5: Setup Storage
```bash
php artisan storage:link
```
### 🔹 Step 6: Run the Application
```bash
php artisan serve
```

🔗 **Open** [`http://localhost:8000`](http://localhost:8000)

## 🔐 Admin Login Credentials:

- 🆔 **Email**: `admin@gmail.com`  
- 🔑 **Password**: `12345`
