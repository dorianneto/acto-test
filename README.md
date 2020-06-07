# acto-test
[![Build Status](https://travis-ci.org/dorianneto/acto-test.svg?branch=master)](https://travis-ci.org/dorianneto/acto-test)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/e0de566134684e74991c536f892692e2)](https://www.codacy.com/manual/dorianneto/acto-test?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=dorianneto/acto-test&amp;utm_campaign=Badge_Grade)

This application is hosted in Heroku and you can access it [here](https://acto-test.herokuapp.com/)

## Highlights

  * Interface developed in Vue.js
  * API Developed in Laravel 7
  * Fully unit tested

## System Requirements

This application was built on Laravel 7, so it's important to follow all the server requirements from this version.

Take a look on this link to see the full list: [https://laravel.com/docs/7.x#server-requirements](https://laravel.com/docs/7.x#server-requirements)

## Installation

Perform the following steps in order to run the application:

  1. `$ git clone https://github.com/dorianneto/acto-test.git && cd acto-test`
  2. `$ composer install`
  3. `$ cp .env.example .env`
  4. `$ php artisan key:generate`
  5. `$ php artisan migrate:install`
  6. `$ php artisan migrate:fresh`
  7. `$ php artisan serve`

_Don't forget to set the configurations (when it's needed) between the steps._

Enjoy it! :heart:

## API

Route | Description
------|------------
`GET` api/game/leadboard | Get matches leaderboard
`POST` api/game/play | Evaluate a match based on inputted data

### `GET` api/game/leadboard

Result:
```json
[
  {
    "name": "dorian neto",
    "total_matches": 1,
    "total_wins": 1
  },
  {
    "name": "beatriz",
    "total_matches": 1,
    "total_wins": 0
  }
]
```

### `POST` api/game/play

Payload:
```json
{
	"name": "dorian neto",
	"hand": [2, "A", 10, "Q", 6]
}
```

Result:
```json
{
  "name": "dorian neto",
  "scores": {
    "user": 3,
    "opponent": 2
  },
  "hands": {
    "user": ["2", "A", "10", "Q", "6"],
    "opponent": ["3", "8", "9", "J", "K"]
  },
  "userWin": true
}
```
