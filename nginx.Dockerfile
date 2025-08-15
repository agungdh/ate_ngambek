# syntax=docker/dockerfile:1.7
FROM debian:trixie

ENV DEBIAN_FRONTEND=noninteractive TZ=Asia/Jakarta

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip zip 7zip wget git bash nano; \
  rm -rf /var/lib/apt/lists/*

# ---- Nginx
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    nginx; \
  rm -rf /var/lib/apt/lists/*

COPY docker/nginx.conf /etc/nginx/sites-available/default

USER www-data

WORKDIR /var/www/html

USER root
EXPOSE 80
CMD ["nginx","-g","daemon off;"]

