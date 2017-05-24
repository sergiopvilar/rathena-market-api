# Athena Market

A simple API to retrieve market data in ragnarok online servers powered by rAthena.

## Features

- Retrieve all vendings in the server
- Retrieve all buying vendings in the server with item amount and price
- Get items being sold by a character and his current position
- Identify elemental items, strong items and items with cards

## Runnig

1 - Download and [install Composer](https://getcomposer.org/) in your computer or webserver then run:

    composer install

2 - Copy `.env.sample` to `.env` and fill with database access data to your emulator's database.

3 - Run the API:

    php -S localhost:8000

## Endpoints

#### [GET] /vendings
Retrieve all vendings in the server

#### [GET] /vending/:character
Retrieve the current vending for a character
