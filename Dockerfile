FROM debian:trixie

ENV DEBIAN_FRONTEND=noninteractive TZ=Asia/Jakarta
WORKDIR /var/www/html

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip git bash; \
  rm -rf /var/lib/apt/lists/*

# ---- PHP 8.4 FPM + extensions (dari repo Debian trixie) ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    php8.4-fpm php8.4-cli php8.4-common \
    php8.4-mysql php8.4-bcmath php8.4-intl php8.4-gd php8.4-zip \
    php8.4-opcache php8.4-mbstring php8.4-xml php8.4-curl php8.4-redis; \
  rm -rf /var/lib/apt/lists/*

# ---- Composer (latest) ----
RUN set -eux; \
  curl -fsSL https://getcomposer.org/installer -o /tmp/composer-setup.php; \
  php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
  rm -f /tmp/composer-setup.php

# ---- cache layer composer ----
COPY composer.json composer.lock ./
RUN set -eux; \
  composer install --prefer-dist --no-interaction --no-progress \
                   --no-autoloader --no-scripts

CMD ["bash"]
