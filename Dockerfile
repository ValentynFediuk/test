FROM php:8.2-cli

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

RUN chmod +x scripts/start.sh

CMD ["scripts/start.sh"]
