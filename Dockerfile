# Instance image
FROM php:8.1-fpm-alpine

# Setup working directory
WORKDIR /app

# Install php library dependencies
RUN apk update && apk upgrade && apk add --update libzip-dev \
    curl \
    bash \
    git \
    libpng-dev \
    libxml2-dev \
    openssl \
    unzip \
    zip

# Install php extensions
RUN apk add composer npm tzdata \
    php8-bcmath \
    php8-common \
    php8-cli \
    php8-ctype \
    php8-curl \
    php8-dom  \
    php8-fileinfo  \
    php8-fpm \
    php8-gd \
    php8-iconv \
    php8-intl \
    php8-json  \
    php8-mbstring \
    php8-mysqli \
    php8-opcache \
    php8-openssl \
    php8-pdo \
    php8-pdo_mysql  \
    php8-pecl-swoole \
    php8-pcntl \
    php8-phar \
    php8-posix \
    php8-session \
    php8-sockets  \
    php8-tokenizer \
    php8-xml  \
    php8-zip

# Install and enable php extensions
RUN docker-php-ext-install bcmath gd mysqli pdo_mysql sockets xml zip

# Download composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project into workdir
COPY . /app

# Run composer install
RUN composer install --ignore-platform-reqs

# Create env file
COPY .env.example .env

# Compile assets
RUN npm install && npm run prod

# Start server
CMD php8 artisan serve --host 0.0.0.0 --port 8080
