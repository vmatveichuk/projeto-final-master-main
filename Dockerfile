FROM php:7.2-fpm

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
  && docker-php-ext-install -j$(nproc) iconv mysqli exif pcntl shmop sysvmsg sysvsem sysvshm \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

ENV APP /app
ENV APP_HOME /app/grade

RUN mkdir $APP
RUN mkdir $APP_HOME

WORKDIR $APP_HOME

COPY . $APP_HOME

EXPOSE 8080


