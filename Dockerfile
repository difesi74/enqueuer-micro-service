FROM alpine:3.14

# Install packages and remove default server definition
RUN apk --no-cache add \
  git \
  openssh-client \
  curl \
  nginx \
  php8 \
  php8-ctype \
  php8-curl \
  php8-dom \
  php8-fpm \
  php8-gd \
  php8-intl \
  php8-mbstring \
  php8-mysqli \
  php8-opcache \
  php8-openssl \
  php8-phar \
  php8-session \
  php8-xml \
  php8-xmlreader \
  php8-xmlwriter \
  php8-simplexml \
  php8-tokenizer \
  php8-pdo_mysql \
  php8-bcmath \
  php8-iconv \
  supervisor \
  freetype-dev \
  icu-dev \
  libjpeg-turbo-dev \
  libpng-dev \
  libxml2-dev

# Get docker build arguments from pipeline and set container environment variables
ARG CONTAINER_ENV_VAR_APP_ENV
ARG CONTAINER_ENV_VAR_APP_SECRET
ARG CONTAINER_ENV_VAR_DATABASE_URL
ARG CONTAINER_ENV_VAR_KERNEL_CLASS
ARG CONTAINER_ENV_VAR_SYMFONY_DEPRECATIONS_HELPER
ARG CONTAINER_ENV_VAR_PANTHER_APP_ENV
ARG CONTAINER_ENV_VAR_PANTHER_ERROR_SCREENSHOT_DIR

ENV APP_ENV ${CONTAINER_ENV_VAR_APP_ENV}
ENV APP_SECRET ${CONTAINER_ENV_VAR_APP_SECRET}
ENV DATABASE_URL ${CONTAINER_ENV_VAR_DATABASE_URL}
ENV KERNEL_CLASS ${CONTAINER_ENV_VAR_KERNEL_CLASS}
ENV SYMFONY_DEPRECATIONS_HELPER ${CONTAINER_ENV_VAR_SYMFONY_DEPRECATIONS_HELPER}
ENV PANTHER_APP_ENV ${CONTAINER_ENV_VAR_PANTHER_APP_ENV}
ENV PANTHER_ERROR_SCREENSHOT_DIR ${CONTAINER_ENV_VAR_PANTHER_ERROR_SCREENSHOT_DIR}

# Add access key to docker container in order to access and install itenlearning packages
ARG SSH_PRIVATE_KEY
RUN mkdir /root/.ssh/
RUN echo "$SSH_PRIVATE_KEY" >/root/.ssh/id_rsa
RUN chmod 600 /root/.ssh/id_rsa

# Register Bitbucket domain as known host
RUN touch /root/.ssh/known_hosts
RUN ssh-keyscan bitbucket.org >>/root/.ssh/known_hosts

# Create a symbolic link from /usr/bin/php8 into /usr/bin/php
RUN ln -s /usr/bin/php8 /usr/bin/php

# Set capabilities for nobody user in order to run cronjobs
RUN chown nobody:nobody /usr/sbin/crond
RUN setcap cap_setgid=ep /usr/sbin/crond

# Clear files
RUN rm -rf /tmp/* \
  /var/{cache,log}/* \
  /etc/crontabs/*

# Copy configurations
COPY rootfs /

# Create api root
RUN mkdir -p /var/www/html

# Add application
WORKDIR /var/www/html
COPY --chown=nobody:nobody . /var/www/html/

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody:nobody /run
RUN chown -R nobody:nobody /var/lib
RUN chown -R nobody:nobody /var/lib/nginx
RUN chown -R nobody:nobody /var/log/nginx
RUN chown -R nobody:nobody /etc/crontabs

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Run composer install to install the dependencies
RUN composer install --optimize-autoloader --no-interaction --no-progress

# Clear Symfony cache
RUN php bin/console cache:clear

# Create database, run migrations and fixtures
RUN php bin/console doctrine:database:create --if-not-exists
RUN php bin/console doctrine:migrations:migrate --no-interaction
# RUN php bin/console doctrine:fixtures:load --append --group=${APP_ENV} --no-interaction

# Switch to use a non-root user from here on
USER nobody

# Expose the port nginx is reachable on
EXPOSE 8080

# Set container entrypoint
ENTRYPOINT ["/sbin/tini", "--", "/usr/bin/docker-entrypoint.sh"]

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
