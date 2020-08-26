FROM php:7.4.9-apache
RUN a2enmod rewrite
RUN service apache2 restart
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update && apt-get -y install sudo vim
COPY --chown=www-data:www-data www/ /var/www/html
RUN chown -R www-data:www-data /var/www/html

# sendmail config
############################################

# RUN apt-get install -q -y ssmtp mailutils

# RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthUser=your@gmail.com" >> /etc/ssmtp/ssmtp.conf
# RUN echo "AuthPass=yourGmailPass" >> /etc/ssmtp/ssmtp.conf

# RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
# RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf

# RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini