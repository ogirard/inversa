cd /D %1
php app/console cache:clear
php app/console assets:install web