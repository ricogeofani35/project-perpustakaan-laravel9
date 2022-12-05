php artisan make:model Book -m = akan dibuatkan modal beserta migrationya
php artisan make:seed BookSeeder = akan dibuatkan seeder Book
php artisan migrate:fresh = akan di hapus file migration di database dan akan dirender ulang otomatis
php artisan db:seed = semua seeder akan dieksekusi
php artisan make:controller BookController = akan dibuatkan BookController yang polosan
php artisan make:controller BookController --model=Book = akan dibuatkan BookController beserta model crutnya
