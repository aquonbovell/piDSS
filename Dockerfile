# Use the official PHP 7.4 Apache base image
FROM php:8.1-apache

# Update package lists and install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_pgsql zip \
    && a2enmod rewrite

# Copy the application files into the container's web directory
COPY . /var/www/html

# Set appropriate permissions for the web server
RUN chown -R www-data:www-data /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache

# Set the working directory
WORKDIR /var/www/html

# Install Composer globally and run the application dependencies installation
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Expose port 80 for incoming web traffic
EXPOSE 80
