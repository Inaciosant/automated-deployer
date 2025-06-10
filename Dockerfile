FROM php:8.2-fpm

# Instala dependências do sistema e Node.js
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    curl \
    build-essential \
    && docker-php-ext-install pdo pdo_pgsql

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Instala Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install

# Limpa cache do npm e faz o build do Vite
RUN npm cache clean --force && npm install && npm run build

CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000