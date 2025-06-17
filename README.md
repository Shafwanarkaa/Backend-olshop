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

## 🌐 Temui Saya di Media Sosial

[![GitHub](https://img.shields.io/badge/GitHub-000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Shafwanarka)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/shafwanarka)
[![Instagram](https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://instagram.com/shafwanarkaa)

