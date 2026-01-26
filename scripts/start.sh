#!/bin/bash
set -e

if [ "$RENDER" = "true" ]; then
    echo "Running in Render mode with public/"

    # Make public dir if missing
    mkdir -p /var/www/html/public

    # Copy index.php into public
    cp /var/www/html/app/index.php /var/www/html/public/index.php

    # Symlink all PHP files
    for f in /var/www/html/app/*.php; do
        ln -sf "$f" /var/www/html/public/
    done

    # Symlink all directories from app/ to public/
    for d in /var/www/html/app/*/; do
        dir_name=$(basename "$d")
        ln -sf "$d" /var/www/html/public/$dir_name
    done

    echo "Symlinks created for all folders in app/"

    # Start PHP built-in server on Render's $PORT
    php -S 0.0.0.0:$PORT -t /var/www/html/public

else
    echo "Running in dev mode in root/"
    php -S 0.0.0.0:8000 -t /var/www/html/app
fi
