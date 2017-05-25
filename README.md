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

#### [GET] /selling
Retrieve all vendings in the server

#### [GET] /buying
Retrieve all Buying Stores in the server

#### [GET] /merchant/:character
Retrieve the current store for the character, vending or buying store.

Example buying output:

/merchant/MyMerchant

```json
{
  "type": "buying",
  "data": {
    "char": {
      "name": "MyMerchant",
      "class": 4011,
      "base_level": 1,
      "job_level": 1
    },
    "map": "alberta",
    "x": 50,
    "y": 44,
    "title": "Compro evra",
    "autotrade": false,
    "items": [{
      "index": 0,
      "item_id": 509,
      "amount": 50,
      "price": 900
    }]
  }
}
```

Example selling output:

/merchant/SellingMerchant

```json
{
  "type": "vending",
  "data": {
    "char": {
      "name": "SellingMerchant",
      "class": 4011,
      "base_level": 1,
      "job_level": 1
    },
    "map": "izlude",
    "x": 130,
    "y": 128,
    "title": "Armas",
    "autotrade": false,
    "items": [{
      "item_id": 1110,
      "amount": 1,
      "price": 20000,
      "refine": 0,
      "created_by": "",
      "strong": 2,
      "element": "wind",
      "cards": []
    }, {
      "item_id": 1220,
      "amount": 1,
      "price": 3000000,
      "refine": 0,
      "created_by": "",
      "strong": 0,
      "element": "",
      "cards": [4035, 4035, 4035]
    }]
  }
}
```
