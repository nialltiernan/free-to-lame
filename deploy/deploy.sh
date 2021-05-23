#!/bin/sh

echo '#### Moving to project directory ####'
cd /home/niall/Projects/free-to-lame || return

echo '#### Clean up git ####'
git checkout -f

echo '#### Pulling code from git ####'
git pull

echo '#### Installing composer packages ####'
/usr/bin/php7.4 /usr/local/bin/composer install --optimize-autoloader --no-dev

echo '#### Running migrations ####'
/usr/bin/php7.4 vendor/bin/phinx migrate -e production -c config/phinx.php

echo '#### Installing NPM packages ####'
npm install

echo '#### Running build script ####'
npm run-script build

echo '#### Removing config cache ####'
rm -f data/cache/*.php

echo '#### Deployment successful ####'
