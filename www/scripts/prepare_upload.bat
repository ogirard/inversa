cd /D %1
php app/console cache:clear
php app/console cache:clear --env=prod
php app/console doctrine:generate:entities OGInversaBundle --no-backup
php app/console doctrine:schema:update --force
rem php app/console assets:install web
rmdir /S /Q app\cache\dev
rmdir /S /Q app\cache\prod
del /F app\logs\*.log
pause