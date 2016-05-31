lis
===

## Requirements

* Symfony 2.8+
* See also the `require` section of [composer.json](composer.json)

## Documentation

### clone:
```bash
git clone https://github.com/locus-ioe/lis.git
```

### create database and schema
```bash
php app/console doctrine:database:create
php app/console doctrine:schema:create
```

#### update database schema (if previously created)
```bash
php app/console doctrine:schema:update --force
```

### usage
```bash
php app/console server:run
firefox localhost:8000 &
```
