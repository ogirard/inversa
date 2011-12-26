%1
cd %2
php app/console doctrine:schema:update --complete --dump-sql > %2\model.sql