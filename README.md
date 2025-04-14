# Wawibox - Dental Product Price Comparison 

This PHP CLI application calculates the best total price for a customer's dental product order by comparing multiple suppliers. The goal is to determine which supplier can fulfill the entire order at the **lowest cost** — **without splitting the order** between multiple suppliers.

---

## Features

- Compare multiple suppliers for any given dental order
- CLI input in the format: `ProductName:Quantity`
- Uses **SOLID principles**
- Modular & testable OOP architecture
- PSR-4 autoloading with Composer
- Fully Dockerized (no local PHP needed)
- Unit tested with PHPUnit

## Clone the application locally
    git clone "https://github.com/shivakas/Wawibox.git"

## Run with Docker
#### Requirements
    Docker & Docker Compose

#### Build the container
    docker-compose build

#### Run the application
    docker-compose run --rm --remove-orphans app "Dental Floss:5,Ibuprofen:5"

#### Run unit tests
    docker-compose run --rm --remove-orphans test

## Run with Composer
#### Requirements
    PHP 8.0+ & Composer

#### Build the application
    composer install

#### Run the application
    php index.php "Dental Floss:5,Ibuprofen:12"

#### Run unit tests
    vendor/bin/phpunit tests

