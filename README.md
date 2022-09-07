## Simple Blog Api

## Setup

* run `composer install`
* prepare .env file
* run migrations with seeds `php artisan migrate --seed`
* run `php artisan jwt:secret`
* if wanted certs can be generated using `php artisan jwt:generate-certs` - example usage: `php artisan jwt:generate-certs --force --algo=rsa --bits=4096 --sha=512`
