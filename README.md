Membsite
--------

## Specs

- Symfony 4.1.9
- Vue 2.5.22

## Setup

###Backend

Install php dependencies 

```$xslt
composer install
```

Configure database environment in .env

```$xslt
DATABASE_URL=mysql://db_user:db_password@db_host:db_port/db_name
```

Migrate database schema

```$xslt
php bin/console doctrine:migrations:migrate
```

###Frontend

Install js dependencies

```$xslt
yarn install
```

## Run

```$xslt
php bin/console server:run
```

For frontend changes run 

```$xslt
yarn encore dev --hot
```

Enjoy.
