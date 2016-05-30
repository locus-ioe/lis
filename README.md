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

### create database schema
```bash
mysql -u [mysql-username] -p[mysql-password]
create database LIS;
exit
php app/console doctrine:schema:update --force
```

### usage
```bash
php app/console server:run
firefox localhost:8000 &
```
