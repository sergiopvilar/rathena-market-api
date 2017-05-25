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

2 - Copy `.env.sample` to `.env` and fill with credentials to your emulator's database.

3 - Run the API:

    php -S localhost:8000

## Endpoints

#### [GET] /
Retrieve all vending and buying stores on the server.

#### [GET] /item/:item_id
Retrieve all stores in the server that are buying or selling the item.

#### [GET] /selling
Retrieve all vendings in the server

#### [GET] /selling/:item_id
Retrieve all vendings who were selling the respective item.

#### [GET] /buying
Retrieve all Buying Stores in the server

#### [GET] /buying/:item_id
Retrieve all Buying Stores who were buying the respective item.

#### [GET] /merchant/:character
Retrieve the current store for the character, vending or buying store.

Example buying output:

/merchant/MyMerchant

```json
{
  "type": "buying",
  "data": {
    "id": 1,
    "map": "alberta",
    "x": 50,
    "y": 44,
    "title": "Compro evra",
    "limit": 500000,
    "autotrade": 0,
    "char": {
      "name": "MyMerchant",
      "class": 4011,
      "base_level": 1,
      "job_level": 1
    },
    "items": [{
      "index": 0,
      "amount": 50,
      "price": 900,
      "attributes": {
        "item_id": 509,
        "refine": 0,
        "strong": 0,
        "cards": [],
        "elemental": ""
      }
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
    "id": 2,
    "map": "izlude",
    "x": 130,
    "y": 128,
    "title": "Armas",
    "autotrade": 0,
    "char": {
      "name": "SellingMerchant",
      "class": 4011,
      "base_level": 1,
      "job_level": 1
    },
    "items": [{
      "index": 0,
      "amount": 1,
      "price": 20000,
      "attributes": {
        "refine": 0,
        "item_id": 1110,
        "strong": 2,
        "cards": [],
        "elemental": "wind"
      }
    }, {
      "index": 1,
      "amount": 1,
      "price": 3000000,
      "attributes": {
        "refine": 0,
        "item_id": 1220,
        "strong": 0,
        "cards": [4035, 4035, 4035],
        "elemental": ""
      }
    }]
  }
}
```
