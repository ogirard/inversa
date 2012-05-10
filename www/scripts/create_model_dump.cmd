cd /D %1
php app/console doctrine:schema:update --complete --dump-sql > %1\model.sql
pause
