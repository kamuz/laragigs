# Listings

Створюємо конфіг для Lando:

*.lando.yml*

```
name: lara
recipe: laravel
config:
  webroot: app/public
```

Створюємо новий застосунок на Laravel:

```
lando laravel new lara
```

Запускаємо сервер:

```
lando start
```

Створюємо нову міграцію:

```
lando artisan make:migration create_listings_table
```

Генеруємо тестові данні:

```
lando artisan db:seed
```

Перезапускаємо міграції + генеруємо данні:

```
lando artisan migrate:refresh --seed
```

Створимо новий контролер:

```
lando artisan make:controller ListingController
```

Ставимо розширення для Chrome Clockwork + пакет для Composer:

```
composer require itsgoingd/clockwork
```

Інколи для деяких локальних доменів, потрібно примусово активувати Clockwork в конфігі:

*.env*

```
CLOCKWORK_ENABLE=true
```

Опублікувати шаблон пагінації (Tailwind CSS за замовчуванням):

```
lando artisan vendor:publish
```

Далі потрібно зробити виріб, що саме треба опублікувати, для пагінації вибираємо `Provider: Illuminate\Pagination\PaginationServiceProvider`.

Робимо сиблінк на папку *storage/app/public/*:

```
lando artisan storage:link
```

Дамо ім'я роуту, щоб вирішити питання з middleware, після чого матимемо приблизно такий список роутів:

```
POST      listings .......................................... ListingController@store
GET|HEAD  listings/create .................................. ListingController@create
PUT       listings/{id} .................................... ListingController@update
DELETE    listings/{id} .................................... ListingController@delete
GET|HEAD  listings/{id} ...................................... ListingController@show
GET|HEAD  listings/{id}/edit ................................. ListingController@edit
GET|HEAD  login ........................................ login › UserController@login
POST      logout .............................................. UserController@logout
GET|HEAD  register ............................................ UserController@create
GET|HEAD  storage/{path} .............................................. storage.local
POST      users ................................................ UserController@store
POST      users/authenticate ............................ UserController@authenticate
```

Після внесених змін в міграції і моделі щодо відношення постів з відповідним користувачем, переходимо в tinker і шукаємо інформацію по посту і його користувачу:

```
lando artisan tinker
\App\Models\Listing::first()
\App\Models\Listing::find(3)
\App\Models\Listing::find(3)->user
$user = \App\Models\User::first()
$user->listings
```

Після переносу на хостинг:

```
rm -rf public/storage
php artisan storage:link
```

*.htaccess*

```
  <IfModule mod_rewrite.c>
RewriteEngine on
RewriteRule ^$ public/ [L]
RewriteRule ((?s).*) public/$1 [L]
</IfModule>
```

*public/.htaccess*

```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^((?s).*)$ index.php?_url=/$1 [QSA,L]
</IfModule>
```