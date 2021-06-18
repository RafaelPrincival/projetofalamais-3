FROM  php:7.1-fpm

MAINTAINER Rafael Silveira <rsilveiracc@gmail.com>

RUN apt-get update && apt-get install -y --no-install-recommends \
  vim \
  git \
  unzip \
  libcurl3-dev \
  zlib1g-dev \
  libicu-dev \
  && apt-get clean; rm -rf /var/lib/apt/lists/* \
  ## Install php extensions
  && docker-php-ext-install curl intl json mbstring pdo pdo_mysql opcache zip bcmath \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug


ARG CODE_ENV
ARG UID=1000

# Set timezone to Europe/Berlin
RUN rm /etc/localtime \
  && ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime

# Copy .ini config file
COPY ./symfony.ini /usr/local/etc/php/conf.d/

# Create a user
RUN useradd --uid ${UID:-1000} --no-user-group -g www-data \
    --create-home --shell /bin/false rsilveira

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/local/bin --filename=composer

ENV HOME=/home/rsilveira
ENV APP=/home/rsilveira/application


# Create the application folder
RUN mkdir -p $APP

# Copy Composer files to application folder
COPY ./application/composer.json $APP/

# Update ownership of home folder with the correct user and group
RUN chown -R rsilveira:www-data $HOME/*

USER rsilveira
WORKDIR $APP

# Run composer install with the correct options if GITHUB_OAUTH is set or not
RUN if [ -z "$GITHUB_OAUTH" ]; then \
        composer install --no-scripts --no-progress --no-autoloader --no-suggest --prefer-source; \
    else \
        composer config --global github-oauth.github.com "$GITHUB_OAUTH"; \
        composer install --no-scripts --no-progress --no-autoloader --no-suggest --prefer-dist; \
    fi;

USER root

# Copy application folder and set up its permissions
COPY ./application/ $APP/
RUN chown -R rsilveira:www-data $APP/* \
    && chmod -R 775 $APP/var $APP/web

# Copy entrypoint file
COPY ./entrypoint-$CODE_ENV.sh /tmp/entrypoint.sh
RUN chmod 0777 /tmp/entrypoint.sh

USER rsilveira
WORKDIR $APP

# Run composer dump-autoload
RUN composer dump-autoload --optimize
VOLUME $APP

ENTRYPOINT ["/tmp/entrypoint.sh"]