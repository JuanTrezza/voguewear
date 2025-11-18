FROM php:8.1-apache

# Install extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    default-mysql-client \
 && docker-php-ext-install pdo pdo_mysql mysqli zip

# Enable apache rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
 && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
