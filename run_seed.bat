@echo off
cd /d c:\xampp\htdocs\film-app
php artisan migrate:refresh --seed
pause
