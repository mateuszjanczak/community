# mateuszjanczak/community

An early version of the project inspired by the microblog at wykop.pl 

It's built on a Laravel framework! Mobile friendly by Bulma.css

## Laravel Documentation

Documentation for the framework can be found on the [Laravel website](https://laravel.com/docs/5.8).


## Requirements
PHP >= 7.2.0, BCMath PHP Extension, Ctype PHP Extension, JSON PHP Extension, Mbstring PHP Extension, OpenSSL PHP Extension, PDO PHP Extension, Tokenizer PHP Extension, XML PHP Extension

## Demo
https://mj-community.herokuapp.com/ (wait for heroku to get up)

## Installation

Clone the repository and set all important variables in ".env". An example settings file can be found in ".env.example"

Next use this to configure database

```bash
php artisan migrate
```

## Preview
### Login and registration page
![Demo1](docs/demo1.gif)

### Creating and managing new posts/comments
![Demo2](docs/demo2.gif)

### Tags, profiles and parsed links demonstration
![Demo3](docs/demo3.gif)

### Settings section and changing avatar
![Demo4](docs/demo4.gif)

### AJAX loading posts, custom pagination, users
![Demo5](docs/demo5.gif) 

### Last but not least -> mobile first
![Demo6](docs/demo6.jpg)
