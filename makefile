run:
	php app/console server:run

all: install db run

db: dbcreate smacreate

install:
	composer install

dbcreate:
	php app/console doctrine:database:create

dbdrop:
	php app/console doctrine:database:drop --force

smacreate:
	php app/console doctrine:schema:create

smaupdate:
	php app/console doctrine:schema:update --force

smadump:
	php app/console doctrine:schema:update --dump-sql
