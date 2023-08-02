# Accredify Assessment for Backend Developer Intern

## Set-up

1. Clone the repository using `git clone`
2. Navigate to repository using `cd accredify-assessment`
3. Create environment file using `cp .env.example .env`
4. Initialise database using `php artisan migrate:refresh`
5. Start server using `php artisan serve`


## Running Unit Tests

1. Install `xdebug` using this [link](https://xdebug.org/download)
2. Navigate to base directory and run `./vendor/bin/phpunit` to run unit tests
3. Check code coverage using `./vendor/bin/phpunit --coverage-html tests/coverage` and access the report by running `tests/coverage/index.html` in any supported browser

## Manual Testing

1. Install `Postman` using this [link](https://www.postman.com/)
2. Initialise a POST request to `/api/v1/validate`
3. Under `Body -> form-data`, create a new parameter with the `key` having a value of `file` and `value` the file to be submitted. Do remember to change the parameter type to file
4. Click `Send` to submit the POST request

### Example

![Example Postman Image](/public/Postman.png)

## Design choices

1. SQLite database was chosen as it is easy to set up
2. No external libraries were installed to minimise complications when setting up
3. Docker was not used due to limited time
