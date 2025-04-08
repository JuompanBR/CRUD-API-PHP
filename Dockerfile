FROM php:8.2-cli

# Install required system packages and PHP extensions
RUN apt-get update && \
    apt-get install -y unzip && \
    docker-php-ext-install pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Set the working directory
WORKDIR /app

# Copy the application code
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Expose the correct port (matching the PHP server port)
EXPOSE 8000

# Start PHP's built-in development server
CMD ["php", "-S", "0.0.0.0:8000"]
