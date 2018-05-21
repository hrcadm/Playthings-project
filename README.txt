SETTING UP THE PROJECT AND DATABASE
-----------------------------------

** DB schema and Seeders are inverted from existing database

1. composer install
2. npm install
3. mv .env.example .env
4. edit .env DB connection and optionally add parameter APP_OWNER=DMG
5. php artisan migrate --seed
6. composer dump-autoload