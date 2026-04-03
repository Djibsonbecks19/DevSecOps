FROM php:8.2-apache

# Copier le code
COPY . /var/www/html/

# Sécurité : utilisateur non-root
RUN useradd -m appuser
USER appuser

EXPOSE 80