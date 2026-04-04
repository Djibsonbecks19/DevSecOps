FROM php:8.2-alpine

RUN addgroup -S appgroup && adduser -S appuser -G appgroup

WORKDIR /var/www/html

COPY app/ .

RUN chown -R appuser:appgroup /var/www/html

USER appuser

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]