# syntax=docker/dockerfile:1.7

############################
# STAGE 1: Build (Debian)
############################
FROM debian:trixie AS builder

ENV DEBIAN_FRONTEND=noninteractive TZ=Asia/Jakarta

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip zip 7zip wget git bash; \
  rm -rf /var/lib/apt/lists/*

# ---- PHP 8.4 FPM + extensions (dari repo Debian trixie) ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    php8.4-cli php8.4-common php8.4-xml \
    php8.4-pgsql php8.4-bcmath php8.4-intl php8.4-gd php8.4-zip \
    php8.4-opcache php8.4-mbstring php8.4-xml php8.4-curl php8.4-redis; \
  rm -rf /var/lib/apt/lists/*

# ---- Composer (latest) ----
RUN set -eux; \
  curl -fsSL https://getcomposer.org/installer -o /tmp/composer-setup.php; \
  php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer; \
  rm -f /tmp/composer-setup.php

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

USER www-data

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN composer install

RUN npm ci

RUN npm run build

RUN php artisan storage:link

############################
# STAGE 2: Runtime (Alpine)
############################
FROM alpine AS runtime

ENV TZ=Asia/Jakarta

# install lighttpd & config minimal
RUN set -eux; \
  apk add --no-cache lighttpd tzdata; \
  mkdir -p /run/lighttpd /var/log/lighttpd; \
  cat > /etc/lighttpd/lighttpd.conf <<'EOF'
server.document-root = "/var/www/dummy"
server.port = 80
server.username = "lighttpd"
server.groupname = "lighttpd"
dir-listing.activate = "disable"
index-file.names = ( "index.html" )
EOF

RUN mkdir /var/www/dummy
RUN chown lighttpd:lighttpd /var/www/dummy
RUN echo "eyyow" > index.html

WORKDIR /var/www/html

COPY --from=builder --chown=www-data:www-data /var/www/html /var/www/html

EXPOSE 80
CMD ["lighttpd","-D","-f","/etc/lighttpd/lighttpd.conf"]
