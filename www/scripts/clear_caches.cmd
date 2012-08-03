cd /D %1
if exist app\cache\dev rmdir /S /Q app\cache\dev
if exist app\cache\dev_new rmdir /S /Q app\cache\dev_new
php app/console cache:clear