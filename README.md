# Install
`docker run --rm --interactive --tty --volume $PWD:/app composer install`

`docker-compose exec mad-libs-php php artisan migrate`

# Run

`docker-compose up -d`

You can also find a Postman collection in this repo. You most likely want to use a {{url}} of `localhost/api/`.