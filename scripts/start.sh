#!/bin/bash
set -e

# If $RENDER is set, we are on Render
if [ "$RENDER" = "true" ]; then
    # Make public dir if missing
    mkdir -p /var/www/html/public
    # Copy index.php into public (Render чекає public)
    cp /var/www/html/app/index.php /var/www/html/public/index.php
    echo "Running in Render mode with public/"
    php -S 0.0.0.0:$PORT -t /var/www/html/public
else
    echo "Running in dev mode in root/"
    php -S 0.0.0.0:8000 -t /var/www/html/app
fi
