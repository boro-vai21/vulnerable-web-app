FROM php:8.1-apache
WORKDIR /var/www/html
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/uploads
RUN chmod -R 775 /var/www/html/uploads
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]