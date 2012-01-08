cd /D %1
php app/console doctrine:generate:entities OGInversaBundle --no-backup
php app/console doctrine:schema:update --force
