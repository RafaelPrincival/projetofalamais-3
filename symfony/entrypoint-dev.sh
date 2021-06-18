#!/bin/bash
echo "Running entrypoint.sh in DEVELOPMENT mode"

echo "Going to application dir"
cd  '/home/rsilveira/application'

echo "Generating autoload"
/usr/local/bin/composer install

echo "Starting php-fpm daemon"
/usr/local/sbin/php-fpm --allow-to-run-as-root -c /etc/php/7.1/fpm

echo "Finishing entrypoint.sh"
tail -f /dev/null