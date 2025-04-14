FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y zip unzip git curl libzip-dev \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all files into the container
COPY . .

# Install PHP dependencies
RUN composer install

# Default command (overridable in docker-compose)
ENTRYPOINT ["php", "index.php"]