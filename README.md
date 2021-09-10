## Steps to run the project

1. clone the project from the repository https://github.com/IgorOleniuk/test-car-models
2. run composer install
3. run php artisan ui vue --auth && npm install && npm run dev
4. create .env and copy .env.example
5. run php artisan migrate --seed
6. run php artisan queue:work (sending mail to admin email for confirmation of deleting the brand)
7. run php artisan schedule:work (deleting unused token for brand deleting)
