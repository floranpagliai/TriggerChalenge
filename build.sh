#!/bin/bash

composer update --optimize-autoloader --prefer-dist
php bin/console cache:clear --env=prod --no-debug
php bin/console assetic:dump --env=prod --no-debug
php bin/console doctrine:database:create