11:21 PM
# Snack Vending Machine Using Laravel

This web application demostrates a snack vending machine. As the vending machine works, you can purchase one item per a time.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

1. Clone the project
2. Use IDE of your preference to open it.
3. open .env and add your database name and credentials 

Run these commands
- composer global require laravel/valet
- valet install
- valet link SnacksVendingMachine
- valet start
If you use valet , the path will be : snackvendingmachine.test

Alternatively, use can generate an application key and run it on localhost:

php artisan key:generate  


Creating database tables and seeding them:

php artisan migrate
php artisan db:seed


## Running the tests



APIs  :