# SymfonyCon Brussels 2023

## From 0 to master the translation of your app

Mathieu Santostefano

> In this workshop you will learn how to properly implement the translation of the UI of your application, using the Translation component of Symfony. First we will create a demo app to overview simple cases of translation (static texts, input labels, error messages, etc). Then, we will improve the translation workflow to be able to work with translators, using Translation Providers. We will cover some particular cases for multiple locales and domains applications. The frontend won't be forgotten, we will see how to use Symfony UX Translation to bring translations into dymanic frontend pages. Finally, we will see the best practices to put all of it on production, with a near real-time synchronization of your translations.

## Installation

### Prerequisites

- PHP >= 8.2
- Docker >= 24

### Install dependencies

```bash
$ symfony composer install
```

### Start the containers and the server

```bash
$ docker compose up -d
$ symfony serve -d
```

### Initialize the database

```bash
$ symfony console doctrine:database:create
$ symfony console doctrine:migrations:migrate
$ symfony console doctrine:fixtures:load
```

### Watch Tailwind

```bash
$ symfony console tailwind:build -w
```
