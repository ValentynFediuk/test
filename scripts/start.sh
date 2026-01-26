#!/bin/bash
set -e

# Determine if we are on Render
if [ "$RENDER" = "true" ]; then
    echo "Running in Render mode with public/"

    # Make public dir if missing
    mkdir -p /var/www/html/public

    # Copy index.php into public
    cp /var/www/html/app/index.php /var/www/html/public/index.php

    # Symlink all PHP files needed from app to public
    # This way require('db.php') and інші require спрацюють
    for f in /var/www/html/app/*.php; do
        ln -sf "$f" /var/www/html/public/
    done

    # Start PHP built-in server on Render's $PORT
    php -S 0.0.0.0:$PORT -t /var/www/html/public

else
    echo "Running in dev mode in root/"
    # Local dev: use app/ as root
    php -S 0.0.0.0:8000 -t /var/www/html/app
fi
