PHP >= 7.2
curl required
DB sqlite /database/database.sqlite

1) git clone https://github.com/vladimir-karlov/RSS-Reader.git

2) In the project directory run commands

composer install
cp .env.example .env
php artisan key:generate

3) sudo chmod -R 755 laravel

4) chmod -R o+w laravel/storage
where laravel is the project directory (RSS-Reader)

5) In the project directory run "php artisan serve"

6) In your browser go to http://127.0.0.1:8000 and click Login https://monosnap.com/file/9O05v4UOofst2a3P8BgeiFcdSSqB65.png (Credentials: test@test.com/12345678)

7) Result - https://monosnap.com/file/k711vzM2dJQe2TieH94iCkcSMtgP1q.png
