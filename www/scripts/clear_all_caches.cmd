cd /D %1
if exist app\cache\dev rmdir /S /Q app\cache\dev
if exist app\cache\dev_new rmdir /S /Q app\cache\dev_new
if exist app\cache\prod rmdir /S /Q app\cache\prod
if exist app\cache\prod_new rmdir /S /Q app\cache\prod_new
php app/console cache:clear
php app/console cache:clear --env=prod
rem php app/console assets:install web
rem php app/console cache:warmup
pause