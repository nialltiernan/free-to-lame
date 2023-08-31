#!/bin/sh

echo '#### Deploying app ####'

echo '## Removing previous assets'
rm -r ~/Projects/free-to-lame-app/public/css
rm -r ~/Projects/free-to-lame-app/public/js
rm -r ~/Projects/free-to-lame-app/public/dist

echo '## Copying new assets'
cp -r ~/Projects/free-to-lame/public/css ~/Projects/free-to-lame-app/public
cp -r ~/Projects/free-to-lame/public/js ~/Projects/free-to-lame-app/public
cp -r ~/Projects/free-to-lame/public/dist ~/Projects/free-to-lame-app/public

echo '#### Deployment successful ####'