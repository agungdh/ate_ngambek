# syntax=docker/dockerfile:1.7
FROM debian:trixie

ENV DEBIAN_FRONTEND=noninteractive TZ=UTC
WORKDIR /var/www/html

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip git bash; \
  rm -rf /var/lib/apt/lists/*

# ---- Node.js 24 (NodeSource) ----
RUN set -eux; \
  mkdir -p /etc/apt/keyrings; \
  curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key \
    | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg; \
  echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_24.x nodistro main" \
    > /etc/apt/sources.list.d/nodesource.list; \
  apt-get update; \
  apt-get install -y --no-install-recommends nodejs; \
  rm -rf /var/lib/apt/lists/*

# ---- PHP 8.4 FPM + extensions (dari repo Debian trixie) ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    php8.4-fpm php8.4-cli php8.4-common \
    php8.4-mysql php8.4-bcmath php8.4-intl php8.4-gd php8.4-zip \
    php8.4-opcache php8.4-mbstring php8.4-xml php8.4-curl php8.4-redis; \
  rm -rf /var/lib/apt/lists/*

# FPM listen di TCP:9000 (bukan unix socket) biar gampang dipasang di nginx
RUN set -eux; \
  sed -ri 's|^listen = .*$|listen = 0.0.0.0:9000|' /etc/php/8.4/fpm/pool.d/www.conf; \
  mkdir -p /etc/php/8.4/fpm/conf.d; \
  { \
    echo 'opcache.enable=1'; \
    echo 'opcache.validate_timestamps=0'; \
    echo 'opcache.max_accelerated_files=20000'; \
    echo 'opcache.memory_consumption=192'; \
    echo 'opcache.interned_strings_buffer=16'; \
  } > /etc/php/8.4/fpm/conf.d/99-opcache.ini

# ---- Composer (latest) ----
RUN set -eux; \
  curl -fsSL https://getcomposer.org/installer -o /tmp/composer-setup.php; \
  php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
  rm -f /tmp/composer-setup.php

# ---- cache layer composer ----
COPY composer.json composer.lock ./
RUN set -eux; \
  composer install --no-dev --prefer-dist --no-interaction --no-progress \
                   --no-autoloader --no-scripts

# ---- cache layer npm/pnpm/yarn (opsional) ----
COPY package.json package-lock.json* pnpm-lock.yaml* yarn.lock* ./
RUN set -eux; \
  if [ -f pnpm-lock.yaml ]; then npm i -g pnpm && pnpm i --frozen-lockfile; \
  elif [ -f yarn.lock ]; then npm i -g corepack && corepack enable && yarn --frozen-lockfile; \
  elif [ -f package-lock.json ]; then npm ci; \
