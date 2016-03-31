FROM php:7.0-cli
COPY . /usr/src/
WORKDIR /usr/src/
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

CMD [ "vendor/bin/phpspec", "run"]


