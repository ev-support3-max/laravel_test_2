FROM mcr.microsoft.com/devcontainers/php:8.3-bullseye

USER root

# PHP 拡張ビルド用ライブラリ
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# PHP 拡張を有効化
RUN docker-php-ext-install \
    intl \
    zip \
    mbstring \
    xml \
    bcmath

# 権限を vscode ユーザーに戻す
USER vscode
