# API Battleship

### Installation

This API requires [PHP](http://www.php.net/) v7.0+ to run.

Clone the project:
```sh
$ git clone https://github.com/ricardohenrique/battleship-php.git
```

Go to folder:
```sh
$ cd battleship-php
```

Install the dependencies:
```sh
$ composer install
```

Create your .env:
```sh
$ cp .env.example .env
```

Configure your .env:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={YOUR_NAME_DATABASE}
DB_USERNAME={YOUR_USERNAME}
DB_PASSWORD={YOUR_PASSWORD}
```

Run the migrates and seed:
```sh
$ php artisan migrate && php artisan db:seed
```


### API Resources


| Method | URI | Description |
| ------ | ------ | ------ |
| GET | [/api/boards] | Get all boards |
| GET | [/api/boards/{board_id}] | Get a board |
| POST | [/api/boards/] | Create a new empty board |
| POST | [/api/games] | Create a new game with ships |
| POST | [/api/games/{game_id}/shots] | Attack |
| GET | [/api/ships] | Get all ships |
| GET | [/api/ships/{ship_id}] | Get a ship |
| POST | [/api/boards/{board_id}/ships/{ship_id}] | Set a ship on the board |
