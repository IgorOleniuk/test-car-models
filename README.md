## Steps to run the project

1. clone the project from the repository - git clone https://github.com/IgorOleniuk/test-car-models
2. enter the project folder - cd test-car-models
3. run composer install
4. run php artisan ui vue --auth
5. run npm install && npm run dev
6. create .env and copy .env.example
7. run php artisan key:generate
8. run php artisan migrate --seed 
 - migrate all DB tables
 - fill them with the data from json file (Car and Models with relationship)
 - create Admin user (Email: test@gmail.com, password: 12345)
9. run php artisan queue:work (needs for sending an email to admin for confirmation of deleting the brand)
10. run php artisan schedule:work (deleting unused token for brand deleting)


Bonus questions / points: 
1. Create 2 models and 2 migrations, one is going to be the brand and the other the model.
 - Answer: php artisan make:model Brand -mc && php artisan make:model CarModel -mc

2. BONUS POINTS if you schedule a task that deletes unused tokens for brand deletion
 - Answer: Done. You can check it in the app\Console\Kernel.php 
