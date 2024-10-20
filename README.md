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