# Use PHP 8.1 FPM as base image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html

# Set correct permissions for project files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Switch to non-root user for better security
USER www-data

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port for PHP-FPM
EXPOSE 9000

# Start PHP-FPM service
CMD ["php-fpm"]
