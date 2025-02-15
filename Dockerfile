FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libjpeg62-turbo-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash -

RUN apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*
COPY ./development/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN docker-php-ext-install pdo_mysql mysqli mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN pecl install xdebug && docker-php-ext-enable xdebug


RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www
# Change current user to www
USER www

RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc
# DISABLES XDEBUG FOR COMPOSER
RUN echo 'alias composer="XDEBUG_MODE=off \\composer"' >> ~/.bashrc

# Expose port 9000
EXPOSE 9000
EXPOSE 9001

