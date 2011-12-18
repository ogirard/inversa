O:
cd "O:\Documents\Work\04_Web\EnsembleInversa\www"
php app/console doctrine:generate:entities OGInversaBundle
php app/console doctrine:schema:update --force
