FROM php:8.2-fpm

ARG user
ARG uid

RUN apt-get update && \
    apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Copiamos de la última imagen de node en nuestro proyecto las librerías de los módulos y de node
COPY --from=node:latest /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:latest /usr/local/bin/node /usr/local/bin/node
# Creamos un enlace virtual para poder utilizar directamente npm dentro de la máquina Docker:
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - 
# RUN apt-get install -y nodejs

RUN chmod +x /home

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/ .composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www

USER $user
