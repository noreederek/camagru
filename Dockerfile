FROM php:7.2-apache
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 80
CMD ["php", "config/setup.php"]
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
