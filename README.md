**Install**
```shell script
git clone https://github.com/cetver/sionic-test-task -- /project/dir
cd /project/dir
composer install
```

**DB config (Postgres)**
```
/project/dir/config/packages/doctrine.yaml
```

**Usage**
```shell script
bin/console doctrine:migrations:migrate --no-interaction
bin/console app:insert-data -vv
```

**Document root**
```
# nginx example
root /project/dir/public;
```

http://some-virtual-host.loc - 1.2 Часть 2

**PS**

Вставку данных сделал через сущность (entity), т.к. в реальных проектах на них завязаны события