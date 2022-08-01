# Install
`docker run --rm --interactive --tty --volume $PWD:/app composer install`

`docker-compose exec mad-lib-php php artisan key:generate --ansi`

`docker-compose exec mad-libs-php php artisan migrate`

# Run
