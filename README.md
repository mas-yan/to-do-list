## Tentang
Aplikasi To Do List sederhana yang dibuat dengan laravel 8 dan vue js 3.

## Cara Install

### Kebutuhan Server

Aplikasi ini dapat dipasang pada server lokal dan online dengan spesifikasi berikut:

1. PHP 7.3 (dan mengikuti [server requirements Laravel 8.x](https://laravel.com/docs/8.x/deployment#server-requirements) lainnya),
2. Database MySQL atau MariaDB.

### Langkah Instalasi

1. Clone Repo, pada terminal : `https://github.com/mas-yan/to-do-list.git`
2. `cd to-do-list`
3. `composer install`
4. `cp .env.example .env`
5. `php artisan key:generate`
6. Buat **database pada mysql** untuk aplikasi ini
7. **Setting database** pada file `.env`
8. `php artisan migrate`
10. `php artisan serve`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
