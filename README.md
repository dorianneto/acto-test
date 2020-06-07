# acto-test
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7ca80d08811f46dd8a6943e4a6cbc1a4)](https://app.codacy.com/manual/dorianneto/acto-test?utm_source=github.com&utm_medium=referral&utm_content=dorianneto/acto-test&utm_campaign=Badge_Grade_Dashboard)
[![Build Status](https://travis-ci.org/dorianneto/acto-test.svg?branch=master)](https://travis-ci.org/dorianneto/acto-test)

You can access the application through this link https://acto-test.herokuapp.com/

## Highlights

* Interface developed in Vue.js
* API Developed in Laravel 7
* Fully unit tested

## System Requirements

This application was built on Laravel 7, so it's important to follow all the server requirements from this version.

Take a look on this link to see the full list: https://laravel.com/docs/7.x#server-requirements

## Installation

Perform the following steps in order to run the application:

1. `$ git clone https://github.com/dorianneto/acto-test.git && cd acto-test`
2. `$ composer install`
3. `$ cp .env.example .env`
4. `$ php artisan key:generate`
5. `$ php artisan migrate:install`
5. `$ php artisan migrate:fresh`
5. `$ php artisan serve`

*Don't forget to set the configurations (when it's needed) between the steps.*

Enjoy it! :heart:

## API

Route | Description
------|------------
`GET` api/game/leadboard | Get matches leaderboard
`POST` api/game/play | Evaluate a match based on inputted data

### `GET` api/game/leadboard

Result:
```
[
  {
    "name": "dorian neto",
    "total_matches": 1,
    "total_wins": 1
  },
  {
    "name": "asdasd",
    "total_matches": 1,
    "total_wins": 0
  }
]
```

### `POST` api/game/play

Payload:
```
{
	"name": "dorian neto",
	"hand": [2, "A", 10, "Q", 6]
}
```

Result:
```
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
