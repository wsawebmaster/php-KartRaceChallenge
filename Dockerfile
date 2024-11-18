# Usando a imagem base do PHP com Apache
FROM php:8.3-apache

# Instalando dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    default-libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql

# Configuração do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Ativando o mod_rewrite do Apache
RUN a2enmod rewrite

# Criar a pasta php
RUN mkdir -p /var/www/html/php

# Copiando os arquivos PHP para o contêiner (produção)
COPY *.php /var/www/html/php

# Ajustando permissões para o diretório do Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
