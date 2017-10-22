# Mulligan - MTG Deckbuilding made easy

## Run locally

- clone the repo and cd into it
- `npm install`
- `composer install`
- create new .env in the project root:

```
APP_ENV=local
APP_KEY=base64:qFMNLz18bPglu3HJtizdbEjvwIFeyoXVlrhl8G3Tn0o=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mulligan
DB_USERNAME=root
DB_PASSWORD=
```

- start your local mysql server and create new DB called mulligan
- `php artisan migrate`
- `php artisan serve`
- `npm run watch`
- `php artisan queue:work` in separat terminal (send emails)