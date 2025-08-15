# syntax=docker/dockerfile:1.7
FROM debian:trixie

ENV DEBIAN_FRONTEND=noninteractive TZ=Asia/Jakarta

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip zip 7zip wget git bash; \
  rm -rf /var/lib/apt/lists/*

# ---- PHP 8.4 + extensions (dari repo Debian trixie) ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    php8.4-cli php8.4-common php8.4-xml \
    php8.4-pgsql php8.4-bcmath php8.4-intl php8.4-gd php8.4-zip \
    php8.4-opcache php8.4-mbstring php8.4-xml php8.4-curl php8.4-redis; \
  rm -rf /var/lib/apt/lists/*

# ---- PHP 8.4 FPM
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    php8.4-fpm; \
  rm -rf /var/lib/apt/lists/*

USER www-data

WORKDIR /var/www/html

USER root
EXPOSE 9000
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
CMD php-fpm8.4 -t || exit 1
CMD ["php-fpm8.4","-F"]
