# IteNlearning Symfony Api Template V1

## Features & tools

This project template was bootstrapped with [Composer CLI](https://getcomposer.org/doc/03-cli.md):

- symfony 5.4.*

This project template was customized with following tools and configurations:

- [Doctrine](https://www.doctrine-project.org).
- [Uuid](https://symfony.com/doc/5.4/components/uid.html) generation support.
- [PHP CS Fixer](https://cs.symfony.com/) (PHP Coding Standards Fixer).
- [PHPUnit](https://phpunit.de/).
- [CORS](https://enable-cors.org/) specification support.
- [Monolog](https://symfony.com/doc/5.4/logging.html) logger.
- [JSON:API](https://jsonapi.org) specification support.
- [IteNlearning Feature First Maker Bundle](https://bitbucket.org/bheducation/feature-first-maker-bundle).
- [Symfony Profiler](https://symfony.com/doc/5.4/profiler.html).
- [Xdebug](https://xdebug.org/) configuration for Visual Studio Code.
- Custom types support.
- [Composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) - Git hooks (pre-commit & pre-push).
- Bitbucket pipelines and Docker setup for Google Cloud Platform deployments in Cloud Run services.

## Folders structure and architecture

This project template uses a modularized **Feature First** approach and a **controller-service-repository** architecture.

```
src
├── _common // common elements module
|   ├── Adapters
|   ├── Constants
|   ├── Contracts
|   ├── Helpers
|   ├── Listeners
|   ├── Services
|   └── Types
└── Example // specific feature/entity example module
|   ├── __tests__
|   ├── Controllers
|   |   └── ... // use cases controllers
|   ├── Services
|   |   └── ... // use cases services
|   ├── Example.php
|   ├── ExampleRepository.php
|   └── ExampleResourceType.php
└── ...
```

## Available Scripts

In the project directory, you can run:

### `symfony server:start`

Runs the app in the development mode. \
Open http://localhost:8012 to view it in the browser. (requires [Symfony CLI](https://symfony.com/download)).

### `composer run auto-scripts`

Manages the special @auto-scripts section by adding commands and scripts defined in recipes. \
Those are automatically run on composer install and composer update.

### `composer run post-install-cmd`

Occurs after the install command has been executed with a lock file present.

### `composer run post-update-cmd`

Occurs before the update command is executed, or before the install command is executed without a lock file present.

### `composer run cghooks-add`

Adds all the valid git hooks that have been specified in the composer config.

### `composer run cghooks-update`

Updates all the valid git hooks that have been specified in the composer config.

### `composer run lint-fix`

Fix PHP code bases on style guide and rules defined in **.php-cs-fixer.dist.php** file.

### `composer run test-environment-setup`

Setup testing environment including test database creation, migration execution and fixtures load.

### `composer run test`

Launches the PHPUnit test runner.

## Learn More

You can learn more about Composer CLI in the [Composer documentation](https://getcomposer.org/doc/).

To learn Symfony, check out the [Symfony documentation](https://symfony.com/).

---

# Brand new project setup

[IteNlearning Symfony Api Template V1](#itenlearning-symfony-api-template-v1) is fully set up. \
Includes a set of pre-installed dependencies and related configurations.

If you want to configure a brand new project from scratch with same tool chain follow next steps.

## Create a new Symfony api project

```
composer create-project symfony/skeleton <API NAME> ^5.4.0
```

## Access to project folder

```
cd <API NAME>
```

## Install project dependencies

- [sensio/framework-extra-bundle](https://symfony.com/bundles/SensioFrameworkExtraBundle/current/index.html)
- [symfony/orm-pack](https://symfony.com/doc/5.4/doctrine.html#installing-doctrine)
- [doctrine/annotations](https://www.doctrine-project.org/projects/doctrine-annotations/en/1.13/index.html)
- [stof/doctrine-extensions-bundle](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)
- [symfony/uid](https://github.com/symfony/uid).
- [symfony/apache-pack](https://symfony.com/doc/5.4/setup/web_server_configuration.html)
- [symfony/psr-http-message-bridge](https://symfony.com/doc/5.4/components/psr7.html)
- [symfony/monolog-bundle](https://github.com/symfony/monolog-bundle)
- [cors](https://github.com/nelmio/NelmioCorsBundle)
- [tobyz/json-api-server](https://github.com/tobyzerner/json-api-server)

```
composer require sensio/framework-extra-bundle symfony/orm-pack doctrine/annotations stof/doctrine-extensions-bundle symfony/uid symfony/apache-pack symfony/psr-http-message-bridge symfony/monolog-bundle cors
composer require --with-all-dependencies tobyz/json-api-server:v0.2.0-beta.5
```

## Install PHP CS Fixer (PHP Coding Standards Fixer)

- [PHP CS Fixer](https://cs.symfony.com/)
```
mkdir --parents tools/php-cs-fixer
composer require --working-dir=tools/php-cs-fixer friendsofphp/php-cs-fixer
```

## Install project development dependencies

- [phpunit/phpunit](https://symfony.com/doc/5.4/testing.html)
- [symfony/test-pack](https://symfony.com/doc/5.4/testing.html)
- [dama/doctrine-test-bundle](https://symfony.com/doc/5.4/testing.html#resetting-the-database-automatically-before-each-test)
- [symfony/var-dumper](https://symfony.com/doc/5.4/components/var_dumper.html)
- [symfony/maker-bundle](https://symfony.com/bundles/SymfonyMakerBundle/current/index.html)
- [symfony/profiler-pack](https://symfony.com/doc/5.4/profiler.html)
- [orm-fixtures](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)
- [brainmaestro/composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks)
- [itenlearning/feature-first-maker-bundle](https://bitbucket.org/bheducation/feature-first-maker-bundle).

```
composer require --dev phpunit/phpunit symfony/test-pack dama/doctrine-test-bundle symfony/var-dumper symfony/maker-bundle symfony/profiler-pack orm-fixtures brainmaestro/composer-git-hooks itenlearning/feature-first-maker-bundle
```

## Create configuration files

Each project feature/tool must be configured through following config files:

```
symfony-api-template-v1
├── ...
├── config
|   ├── packages
|   |   ├── doctrine.yaml
|   |   ├── stof_doctrine_extensions.yaml
|   |   └── web_profiler.yaml
|   ├── routes
|   |   ├── annotations.yaml
|   |   └── web_profiler.yaml
|   └── services.yaml
├── .php-cs-fixer.dist.php
├── phpunit.xml.dist
└── ...
```

#### config/packages/doctrine.yaml

```
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'
        charset: utf8
        default_table_options:
            charset: utf8
            collate: utf8_general_ci
        mapping_types:
            enum: string
        # IMPORTANT: You MUST configure your server version,
        # either here or in the DATABASE_URL env var (see .env file)
        #server_version: '13'
    orm:
        auto_generate_proxy_classes: true
        naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
        auto_mapping: true
        mappings:
            Example:
                is_bundle: false
                type: annotation
                dir: '%kernel.project_dir%/src/Example'
                prefix: App\Example
                alias: Example
        filters:
            softdeleteable:
                class: Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter
                enabled: true
```

#### config/packages/stof_doctrine_extensions.yaml

```
# Read the documentation: https://symfony.com/doc/current/bundles/StofDoctrineExtensionsBundle/index.html
# See the official DoctrineExtensions documentation for more details: https://github.com/Atlantic18/DoctrineExtensions/tree/master/doc/
stof_doctrine_extensions:
    default_locale: en_US
    orm:
        default:
            softdeleteable: true
            timestampable: true
```

#### config/packages/web_profiler.yaml

```
when@dev:
    web_profiler:
        toolbar: true
        intercept_redirects: false

    framework:
        profiler: { only_exceptions: false }

when@test:
    web_profiler:
        toolbar: false
        intercept_redirects: false

    framework:
        profiler: { collect: false }

when@staging:
    web_profiler:
        toolbar: true
        intercept_redirects: false

    framework:
        profiler: { only_exceptions: false }
```

#### config/routes/annotations.yaml

```
controllers:
    resource: ../../src/
    type: annotation

kernel:
    resource: ../../src/Kernel.php
    type: annotation
```

#### config/routes/web_profiler.yaml

```
when@dev:
    web_profiler_wdt:
        resource: '@WebProfilerBundle/Resources/config/routing/wdt.xml'
        prefix: /_wdt

    web_profiler_profiler:
        resource: '@WebProfilerBundle/Resources/config/routing/profiler.xml'
        prefix: /_profiler

when@staging:
    web_profiler_wdt:
        resource: '@WebProfilerBundle/Resources/config/routing/wdt.xml'
        prefix: /_wdt

    web_profiler_profiler:
        resource: '@WebProfilerBundle/Resources/config/routing/profiler.xml'
        prefix: /_profiler
```

#### config/services.yaml

```
# This file is the entry point to configure your own services.
# Files in the packages/ subdirectory configure your dependencies.

# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/5.4/best_practices.html#use-parameters-for-application-configuration
services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true      # Automatically injects dependencies in your services.
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.

    # makes classes in src/ available to be used as services
    # this creates a service per class whose id is the fully-qualified class name
    App\:
        resource: '../src/'
        exclude:
            - '../src/Kernel.php'
            - '../src/**/__tests__/'
            - '../src/_common/'
            - '../src/**/{ExampleEntity.php}'

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones

    App\Fixtures\:
        resource: '../fixtures/'

    App\Common\Services\JsonApiServerService: ~

    App\Common\Listeners\ExceptionListener:
        tags:
            - { name: kernel.event_listener, event: kernel.exception }

    App\Common\Listeners\ResponseListener:
        tags:
            - { name: kernel.event_listener, event: kernel.response }

    feature_first_maker.entity_class_generator:
        class: IteNlearning\FeatureFirstMakerBundle\Doctrine\EntityClassGenerator
        arguments:
            - '@maker.generator'
            - '@maker.doctrine_helper'

    IteNlearning\FeatureFirstMakerBundle\Maker\MakeEntity:
        arguments:
            - '@maker.file_manager'
            - '@maker.doctrine_helper'
            - '@feature_first_maker.entity_class_generator'
        tags: ['maker.command']
```

#### .php-cs-fixer.dist.php

```
<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PhpCsFixer'            => true,
    'full_opening_tag'       => false,
    'binary_operator_spaces' => [
        'operators' => [
            '=>' => 'align_single_space_minimal',
            '='  => 'align_single_space_minimal',
        ],
    ],
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'case',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield',
            'yield_from',
        ],
    ],
])
    ->setFinder($finder)
;
```

#### phpunit.xml.dist

```
<?xml version="1.0" encoding="UTF-8"?>

<!-- https://phpunit.readthedocs.io/en/latest/configuration.html -->
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         backupGlobals="false"
         colors="true"
         bootstrap="tests/bootstrap.php"
         convertDeprecationsToExceptions="false"
>
    <php>
        <ini name="display_errors" value="1" />
        <ini name="error_reporting" value="-1" />
        <env name="APP_ENV" value="test" force="true" />
        <env name="SYMFONY_DEPRECATIONS_HELPER" value="disabled" />
        <server name="SHELL_VERBOSITY" value="-1" />
        <server name="SYMFONY_PHPUNIT_REMOVE" value="" />
        <server name="SYMFONY_PHPUNIT_VERSION" value="9.5" />
    </php>

    <testsuites>
        <testsuite name="Project Test Suite">
            <directory>src/Example/__tests__</directory>
        </testsuite>
    </testsuites>

    <coverage processUncoveredFiles="true">
        <include>
            <directory suffix=".php">src</directory>
        </include>
    </coverage>

    <listeners>
        <listener class="Symfony\Bridge\PhpUnit\SymfonyTestsListener" />
    </listeners>

    <extensions>
        <extension class="DAMA\DoctrineTestBundle\PHPUnit\PHPUnitExtension"/>
    </extensions>

    <!-- Run `composer require symfony/panther` before enabling this extension -->
    <!--
    <extensions>
        <extension class="Symfony\Component\Panther\ServerExtension" />
    </extensions>
    -->
</phpunit>
```

## Edit composer.json file

Add **repositories** attribute before **require** attribute:

```
"repositories":[
    {
        "type": "vcs",
        "url" : "git@bitbucket.org:bheducation/feature-first-maker-bundle.git"
    }
],
```

Replace **config** attribute with following code:
```
"config": {
    "optimize-autoloader": true,
    "preferred-install": {
        "*": "dist"
    },
    "sort-packages": true,
    "allow-plugins": {
        "symfony/flex": true,
        "symfony/runtime": true
    }
},
```

Replace **"autoload"** attribute with following code:

```
"autoload": {
    "psr-4": {
        "App\\": "src/",
        "App\\Common\\": "src/_common/",
        "App\\Fixtures\\": "fixtures/"
    }
},
```

Replace **"autoload-dev"** attribute with following code:

```
"autoload-dev": {
    "psr-4": {
        "IteNlearning\\FeatureFirstMakerBundle\\": "vendor/itenlearning/feature-first-maker-bundle/src/"
    }
},
```

Replace **"scripts"** attribute with following code:

```
"scripts": {
    "auto-scripts": {
        "cache:clear": "symfony-cmd",
        "assets:install %PUBLIC_DIR%": "symfony-cmd"
    },
    "post-install-cmd": [
        "@auto-scripts"
    ],
    "post-update-cmd": [
        "@auto-scripts"
    ],
    "cghooks-add": "vendor/bin/cghooks add",
    "cghooks-update": "vendor/bin/cghooks update",
    "lint-fix": [
        "tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src"
    ],
    "test-environment-setup": [
        "php bin/console cache:clear --env=test",
        "php bin/console doctrine:database:create --if-not-exists --env=test",
        "php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction --env=test"
    ],
    "test" : [
        "vendor/bin/phpunit --verbose"
    ]
},
```

Replace **"extra"** attribute with following code:

```
"extra": {
    "symfony": {
        "allow-contrib": false,
        "require": "5.4.*"
    },
    "hooks": {
        "pre-commit": [
            "composer lint-fix"
        ],
        "pre-push": [
            "composer lint-fix",
            "composer test-environment-setup",
            "composer test"
        ]
    }
}
```

Update autoloaded classes:

```
composer dump-autoload
```

## Create Git Hooks

```
composer run cghooks-add
```

## Run commands

Run commands in order to format any code issue and fix manually any issue which couldn't be fixed automatically.

```
composer run lint-fix
```

## Setup Bitbucket pipelines and Docker container for Google Cloud Platform deployments in Cloud Run services

**Important:** In order to trigger Bitbucket pipelines and deploy to Google Cloud Platform a Bitbucket repository, a Google Cloud Platform project and Cloud Run services must be created and configured.

```
symfony-api-template-v1
├── ...
├── docker
|   ├── fpm-pool.conf
|   ├── nginx.conf
|   ├── php.ini
|   └── supervisord.conf
├── .dockerignore
├── .gcloudignore
├── .gitignore
├── .env.test.pipelines
├── Dockerfile
└── bitbucket-pipelines.yml
```

#### docker/fpm-pool.conf

```
[global]
; Log to stderr
error_log = /dev/stderr

[www]
; The address on which to accept FastCGI requests.
; Valid syntaxes are:
;   'ip.add.re.ss:port'    - to listen on a TCP socket to a specific IPv4 address on
;                            a specific port;
;   '[ip:6:addr:ess]:port' - to listen on a TCP socket to a specific IPv6 address on
;                            a specific port;
;   'port'                 - to listen on a TCP socket to all addresses
;                            (IPv6 and IPv4-mapped) on a specific port;
;   '/path/to/unix/socket' - to listen on a unix socket.
; Note: This value is mandatory.
listen = 127.0.0.1:9000
;listen = unix:/var/run/php/php7-fpm.sock;
;listen.owner = nginx
;listen.group = nginx
;listen.mode = 0666

; Enable status page
pm.status_path = /fpm-status

; Choose how the process manager will control the number of child processes.
; Possible values: static, ondemand, dynamic.
pm = static

; The number of child processes to be created when pm is set to 'static' and the
; maximum number of child processes when pm is set to 'dynamic' or 'ondemand'.
; This value sets the limit on the number of simultaneous requests that will be
; served. Equivalent to the ApacheMaxClients directive with mpm_prefork.
; Equivalent to the PHP_FCGI_CHILDREN environment variable in the original PHP
; CGI. The below defaults are based on a server without much resources. Don't
; forget to tweak pm.* to fit your needs.
; Note: Used when pm is set to 'static', 'dynamic' or 'ondemand'
; Note: This value is mandatory.
pm.max_children = 80

; The number of seconds after which an idle process will be killed.
; Note: Used only when pm is set to 'ondemand'
; Default Value: 10s
pm.process_idle_timeout = 10s;

; The number of requests each child process should execute before respawning.
; This can be useful to work around memory leaks in 3rd party libraries. For
; endless request processing specify '0'. Equivalent to PHP_FCGI_MAX_REQUESTS.
; Default Value: 0
pm.max_requests = 1000

; Make sure the FPM workers can reach the environment variables for configuration
clear_env = no

; Catch output from PHP
catch_workers_output = yes

; Remove the 'child 10 said into stderr' prefix in the log and only show the actual message
decorate_workers_output = no

; Enable ping page to use in healthcheck
ping.path = /fpm-ping
```

#### docker/nginx.conf

```
worker_processes auto;
error_log stderr warn;
pid /run/nginx.pid;

events {
    worker_connections 1024;
    multi_accept on;
}

http {
    include mime.types;
    default_type application/octet-stream;

    # Set the path, format, and configuration for a buffered log write
    log_format main_timed '$remote_addr - $remote_user [$time_local] "$request" '
                          '$status $body_bytes_sent "$http_referer" '
                          '"$http_user_agent" "$http_x_forwarded_for" '
                          '$request_time $upstream_response_time $pipe $upstream_cache_status';

    access_log /dev/stdout main_timed;
    error_log /dev/stderr notice;

    keepalive_timeout 65;
    proxy_connect_timeout 300s;
    proxy_send_timeout 300s;
    proxy_read_timeout 300s;
    fastcgi_connect_timeout 300s;
    fastcgi_send_timeout 300s;
    fastcgi_read_timeout 300s;

    # Write temporary files to /tmp so they can be created as a non-privileged user
    client_body_temp_path /tmp/client_temp;
    proxy_temp_path /tmp/proxy_temp_path;
    fastcgi_temp_path /tmp/fastcgi_temp;
    uwsgi_temp_path /tmp/uwsgi_temp;
    scgi_temp_path /tmp/scgi_temp;

    large_client_header_buffers 4 2048k;	
    client_body_buffer_size 2048k;

    # Default server definition
    server {
        listen [::]:8080 default_server;
        listen 8080 default_server;
        server_name $hostname;

        sendfile off;
        client_max_body_size 5m;

        root /var/www/html/public;
        index index.php index.html;

        location / {
            # First attempt to serve request as file, then
            # as directory, then fall back to index.php
            try_files $uri $uri/ /index.php$is_args$args;
        }

        # Redirect server error pages to the static page /50x.html
        error_page 500 502 503 504 /50x.html;
        location = /50x.html {
            root /var/lib/nginx/html;
        }

        # Pass the PHP scripts to PHP-FPM listening on 127.0.0.1:9000
        location ~ \.php$ {
            try_files $uri =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param SCRIPT_NAME $fastcgi_script_name;
            fastcgi_index index.php;
            include fastcgi_params;
            fastcgi_buffer_size 1024k;
            fastcgi_buffers 4 1024k;
        }

        location ~* \.(jpg|jpeg|gif|png|css|js|ico|xml)$ {
            expires 7d;
        }

        # Deny access to . files, for security
        location ~ /\. {
            log_not_found off;
            deny all;
        }

        # Allow fpm ping and status from localhost
        location ~ ^/(fpm-status|fpm-ping)$ {
            access_log off;
            allow 127.0.0.1;
            deny all;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
            fastcgi_pass 127.0.0.1:5000;
        }
    }
    
    gzip on;
    gzip_proxied any;
    gzip_types text/plain application/xml text/css text/js text/xml application/x-javascript text/javascript application/json application/xml+rss;
    gzip_vary on;
    gzip_disable "msie6";
    
    # Include other server configs
    include /etc/nginx/conf.d/*.conf;
}
```

#### docker/php.ini

```
[PHP]
variables_order="EGPCS"
memory_limit=1G
max_execution_time=300
opcache.enable=1
opcache.jit_buffer_size=128M
opcache.jit = 1255

[Date]
date.timezone="Europe/Madrid"
```

#### docker/supervisord.conf

```
[supervisord]
nodaemon=true
logfile=/dev/null
logfile_maxbytes=0
pidfile=/run/supervisord.pid

[program:php-fpm]
command=php-fpm8 -F
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0

[program:nginx]
command=nginx -g 'daemon off;'
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0
```

#### .dockerignore

```
# The .dockerignore file excludes files from the container build process.
#
# https://docs.docker.com/engine/reference/builder/#dockerignore-file

# Exclude locally vendored dependencies.
vendor/
tools/php-cs-fixer/vendor/

# Exclude "build-time" ignore files.
.dockerignore
.gcloudignore

# Exclude git history and configuration.
.gitignore
```

#### .gcloudignore

```
# The .gcloudignore file excludes file from upload to Cloud Build.
# If this file is deleted, gcloud will default to .gitignore.
#
# https://cloud.google.com/cloud-build/docs/speeding-up-builds#gcloudignore
# https://cloud.google.com/sdk/gcloud/reference/topic/gcloudignore

# Exclude locally vendored dependencies.
vendor/
tools/php-cs-fixer/vendor/

# Exclude git history and configuration.
.git/
.gitignore
```

#### .gitignore

```
###> symfony/framework-bundle ###
/.env.local
/.env.local.php
/.env.*.local
/config/secrets/prod/prod.decrypt.private.php
/public/bundles/
/var/
/vendor/
###< symfony/framework-bundle ###

###> phpunit/phpunit ###
/phpunit.xml
.phpunit.result.cache
###< phpunit/phpunit ###

###> friendsofphp/php-cs-fixer ###
/tools/php-cs-fixer/vendor
.php-cs-fixer.cache
###> friendsofphp/php-cs-fixer ###
```

#### .env.test.pipelines

```
# define your env variables for the test env here
KERNEL_CLASS='App\Kernel'
APP_SECRET='$ecretf0rt3st'
SYMFONY_DEPRECATIONS_HELPER=999999
PANTHER_APP_ENV=panther
PANTHER_ERROR_SCREENSHOT_DIR=./var/error-screenshots
DATABASE_URL="mysql://test_user:test_user_password@127.0.0.1:3306/pipelines?serverVersion=5.7"
```

#### Dockerfile

```
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

# Create a symbolic link from /usr/bin/php8 into /usr/bin/php
RUN ln -s /usr/bin/php8 /usr/bin/php

# Configure nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY docker/fpm-pool.conf /etc/php8/php-fpm.d/www.conf
COPY docker/php.ini /etc/php8/conf.d/custom.ini

# Configure supervisord
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Add access key to docker container in order to access and install itenlearning packages
ARG SSH_PRIVATE_KEY
RUN mkdir /root/.ssh/
RUN "$SSH_PRIVATE_KEY" >/root/.ssh/id_rsa
RUN chmod 600 /root/.ssh/id_rsa

# Register domain as known host
RUN touch /root/.ssh/known_hosts
RUN ssh-keyscan bitbucket.org >>/root/.ssh/known_hosts

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

# Setup document root
RUN mkdir -p /var/www/html

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /run
RUN chown -R nobody.nobody /var/www/html
RUN chown -R nobody.nobody /var/lib/nginx
RUN chown -R nobody.nobody /var/log/nginx

# Add application
WORKDIR /var/www/html
COPY --chown=nobody . /var/www/html/

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Run composer install to install the dependencies
RUN composer install --optimize-autoloader --no-interaction --no-progress

# Clear Symfony cache
RUN php bin/console cache:clear

# Create database, run migrations and fixtures
RUN php bin/console doctrine:database:create --if-not-exists
RUN php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction
# RUN php bin/console doctrine:fixtures:load --append --group=${APP_ENV} --no-interaction

# Switch to use a non-root user from here on
USER nobody

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
```

#### bitbucket-pipelines.yml

```
definitions:
  services: 
    mysql: 
      image: mysql:5.7 
      environment: 
        MYSQL_DATABASE: 'pipelines_test'
        MYSQL_RANDOM_ROOT_PASSWORD: 'yes' 
        MYSQL_USER: 'test_user'
        MYSQL_PASSWORD: 'test_user_password'
  steps:
    - step: &lintAndTest
        name: Dependencies install, Lint and Test
        image: php:8.0-fpm
        caches:
          - composer
        script:
          # Install Bitbucket Docker container dependencies
          - apt-get update && apt-get install -qy git curl libpng-dev zlib1g-dev libmcrypt-dev zip unzip mariadb-client
          - docker-php-ext-install pdo_mysql gd
          - curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

          # Install project dependencies
          - composer install
          - composer install --working-dir=tools/php-cs-fixer

          # Lint
          - composer lint-fix

          # Use pipelines environmet variables for bitbucket mysql service database
          - ln -f -s .env.test.pipelines .env.test

          # Run migrations and fixtures on bitbucket mysql service database
          - php bin/console cache:clear --env=test
          - php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction --env=test
          # - php bin/console doctrine:fixtures:load --group=test --no-interaction --env=test

          # Test
          - composer test
        services: 
          - mysql

    - step: &buildAndDeploy
        name: Build and Deploy to Google Cloud Run
        image: google/cloud-sdk:latest
        caches:
          - docker
        script:
          # Export Bitbucket deployment environment variables (Repository settings > Pipelines > Deployments)
          - export HOSTNAME=$GCR_HOSTNAME
          - export REGION=$GCR_REGION
          - export SERVICE_NAME=$GCR_SERVICE_NAME

          # Export Bitbucket repository environment variables (Repository settings > Pipelines > Repository variables)
          - export PROJECT_ID=$GCR_PROJECT_ID
          - export PLATFORM=$GCR_PLATFORM
          - export SERVICE_ACCOUNT=$GCP_SERVICE_ACCOUNT

          # Decode GCP service account key and activate GCP service account
          - echo $GCP_SERVICE_ACCOUNT_KEY | base64 -di > /tmp/key-file.json # Decode and save service account key
          - gcloud auth activate-service-account $SERVICE_ACCOUNT --key-file=/tmp/key-file.json

          # Decode docker container key and configure image registry with gcloud helper
          - echo $DOCKER_CONTAINER_KEY | base64 -di > /tmp/docker-container-key-file # Decode and save docker container key
          - gcloud auth configure-docker -q

          # Build and push docker image to google container registry
          - export IMAGE_NAME=$HOSTNAME/$PROJECT_ID/$SERVICE_NAME
          - >-
            docker build
            --build-arg SSH_PRIVATE_KEY="$(cat /tmp/docker-container-key-file)"
            --build-arg CONTAINER_ENV_VAR_APP_ENV=$APP_ENV
            --build-arg CONTAINER_ENV_VAR_APP_SECRET=$APP_SECRET
            --build-arg CONTAINER_ENV_VAR_DATABASE_URL=$DATABASE_URL
            --build-arg CONTAINER_ENV_VAR_KERNEL_CLASS=$KERNEL_CLASS
            --build-arg CONTAINER_ENV_VAR_SYMFONY_DEPRECATIONS_HELPER=$SYMFONY_DEPRECATIONS_HELPER
            --build-arg CONTAINER_ENV_VAR_PANTHER_APP_ENV=$PANTHER_APP_ENV
            --build-arg CONTAINER_ENV_VAR_PANTHER_ERROR_SCREENSHOT_DIR=$PANTHER_ERROR_SCREENSHOT_DIR
            -t $IMAGE_NAME .
          - docker push $IMAGE_NAME

          # Deploy to Google Cloud Run services
          - gcloud beta run deploy $SERVICE_NAME --image $IMAGE_NAME --platform $PLATFORM --region $REGION --project $PROJECT_ID
        services:
          - docker

pipelines:
  pull-requests:
    '**': # Run on each pull-request
      - step: *lintAndTest
  branches: # Branch specific pipelines definitions
    develop:
      - step: *lintAndTest
      - step:
          <<: *buildAndDeploy
          deployment: Staging
    master:
      - step: *lintAndTest
  custom: # Manually executed pipelines definitions
    deploy-2-staging:
      - step:
          <<: *buildAndDeploy
          deployment: Staging # Bitbucket repository "Staging" environment (Repository settings > Pipelines > Deployments)
    deploy-2-production:
      - step:
          <<: *buildAndDeploy
          deployment: Production # Bitbucket repository "Production" environment (Repository settings > Pipelines > Deployments)
```

## Edit environment variables files

Edit **.env** file as follow:

**Important:** You MUST set your local database name and proxy server suffix for the api.

- Replace **DATABASE_URL** variable:

```
DATABASE_URL="mysql://root:secret@itenlearning-database:3306/<DATABASE NAME>?serverVersion=5.7"
```

Edit **.env.test** file as follow:

**Important:** You MUST set your local database name.

- Add **DATABASE_URL** variable:

```
DATABASE_URL="mysql://root:secret@127.0.0.1:33068/<DATABASE NAME>?serverVersion=5.7"
```
