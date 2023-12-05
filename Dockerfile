FROM richarvey/nginx-php-fpm:3.1.0

# Install Node.js and npm
RUN apk update && \
    apk add --no-cache nodejs npm

# Set working directory
WORKDIR /var/www/html

# Copy only necessary files
COPY package.json package-lock.json ./

# Install dependencies
RUN npm install

# Copy the rest of your Laravel application
COPY . .

# Image config (the rest of your configuration remains unchanged)
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
