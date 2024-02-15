# MPSTATS test assignment

## Установка проекта
Последовательно запустить следующие команды:
- `cp docker-compose.override.example.yml docker-compose.override.yml` # Копирование файл example. Далее в файле override прописать свой uid и user
- `cp .env.example .env` # Копирование файл env.example в .env
- `docker compose up --build -d` # Сборка и старт приложения
- `docker compose exec app composer install` # Становка зависимостей
- `docker compose exec app php artisan migrate` # Запуск миграций