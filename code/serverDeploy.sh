#!/bin/bash
sudo mysqldump -u root -p bbb_live > ~/bbb_backup.sql
sudo chown -R bbb:bbb /var/www/html/
cd /var/www/html/bbbss/
git pull
composer install
composer vendor-exposer
sudo chown -R apache:apache /var/www/html/