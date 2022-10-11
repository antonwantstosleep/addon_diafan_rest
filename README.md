# addon_diafan_rest
Модуль REST API для Diafan.CMS

Модуль на основе `abstract class Api extends Diafan`.

## Установка

Стандартная.

1. Загрузить в Темы и дизайн.
2. Активировать в Модули и БД.

## Настройка

TODO:

## Использование

### Авторизация

У родительского класса `Api` есть `public function auth($user_id = false)`, которая, делает именно это.

1. Добавить запись в таблицу users_token:
```
POST https://site.ru/api/registration/auth_code/ с данными формы name и pass, см. файл registration.api.php
```
2. Проверить токен:
```
GET https://site.ru/api/registration/auth_code_info/ c заголовком Authorization: OAuth token
```

### Работа

Все эндпоинты вызываются с заголовком Authorization: OAuth token.

Получить товары:
```
GET https://site.ru/api/rest/shop/elements/
- c параметрами из таблицы shop для фильтра
- возвращаются все данные из таблицы
```

Получить категории товаров:
```
GET https://site.ru/api/rest/shop/categories/
- c параметрами из таблицы shop_category для фильтра
- возвращаются все данные из таблицы
```

Создать товар:
```
POST/PUT/PATCH https://site.ru/api/rest/shop/elements/
- c параметрами из таблицы shop
- возвращается id
```

Удалить товар:
```
DELETE https://site.ru/api/rest/shop/elements/{id}
- c параметром id
- возвращается id
```

Получить новости:
```
GET https://site.ru/api/rest/news/elements/
- c параметрами из таблицы news для фильтра
- возвращаются все данные из таблицы
```
