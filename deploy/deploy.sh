#!/bin/sh

echo '#### Moving to project directory ####'
cd /home/niall/Projects/free-to-lame || return

echo '#### Pulling code from git ####'
git pull

echo '#### Installing composer packages ####'
/usr/bin/php7.4 /usr/local/bin/composer install --optimize-autoloader --no-dev

echo '#### Removing config cache ####'
rm -f data/cache/*.php

echo '#### Deployment successful ####'
