LIS - Locus Information System
===

## Requirements

* Symfony 2.8+
* See also the `require` section of [composer.json](composer.json)

### clone:
```bash
git clone https://github.com/locus-ioe/lis.git
```

### install composer globally
```bash
sudo apt-get install composer
```

## Documentation

### manual commands

- install composer to the project
```bash
cd <path to project>
composer install
```

- create database and schema
```bash
php app/console doctrine:database:create
php app/console doctrine:schema:create
```

- update database schema (if previously created)
```bash
php app/console doctrine:schema:update --force
```

- usage
```bash
php app/console server:run
firefox localhost:8000 &
```
### use makefile

- install composer to the project
```bash
make install
```

- create database and schema
```bash
make db
```

- update schema (if previously created)
```bash
make smaupdate
```

- usage
```bash
make run
```
