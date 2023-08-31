#!/bin/sh

echo '#### Deploying app ####'

echo '## Local web app'
echo '# Removing previous assets'
rm -r ~/Projects/free-to-lame-app/public/css
rm -r ~/Projects/free-to-lame-app/public/js
rm -r ~/Projects/free-to-lame-app/public/dist

echo '# Copying new assets'
cp -r ~/Projects/free-to-lame/public/css ~/Projects/free-to-lame-app/public
cp -r ~/Projects/free-to-lame/public/js ~/Projects/free-to-lame-app/public
cp -r ~/Projects/free-to-lame/public/dist ~/Projects/free-to-lame-app/public

echo '## Cordova app'
echo '# Removing previous assets'
rm -r ~/Projects/free-to-cordova/www/css
rm -r ~/Projects/free-to-cordova/www/js
rm -r ~/Projects/free-to-cordova/www/dist

echo '# Copying new assets'
cp -r ~/Projects/free-to-lame/public/css ~/Projects/free-to-cordova/www
cp -r ~/Projects/free-to-lame/public/js ~/Projects/free-to-cordova/www
cp -r ~/Projects/free-to-lame/public/dist ~/Projects/free-to-cordova/www

echo '#### Deployment successful ####'