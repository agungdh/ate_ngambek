# syntax=docker/dockerfile:1.7
FROM debian:trixie

ENV DEBIAN_FRONTEND=noninteractive TZ=Asia/Jakarta

# ---- base tools ----
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    ca-certificates curl gnupg tzdata unzip zip 7zip wget git bash; \
  rm -rf /var/lib/apt/lists/*

# ---- Nginx
RUN set -eux; \
  apt-get update; \
  apt-get install -y --no-install-recommends \
    nginx; \
  rm -rf /var/lib/apt/lists/*

USER www-data

WORKDIR /var/www/html

USER root
EXPOSE 80
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
CMD ["nginx", "-g", "daemon off;"]
