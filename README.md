# Check DC Assessment

## Requirements

* A basic understanding of PHP, Laravel, MySQL, and Docker.
* Composer installed globally
* Git
* Access to a MySQL GUI client such as [DBeaver](https://dbeaver.io/) or [MySQL Workbench](https://www.mysql.com/products/workbench/).
* A Docker installation on your machine.
* Visual Studio Code or any other IDE of your choice.

## Installation

This project ships with Laravel Sail, a lightweight command-line interface for interacting with Laravel's default Docker development environment. Sail provides an excellent starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

To get started:

* Clone the repository
* Run the following commands in the root directory of the project:

```bash
# Create a .env file from the .env.example file
cp .env.example .env

# Set up the application and its dependencies
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

# Start the application
./vendor/bin/sail up -d

# Migrate the database
./vendor/bin/sail artisan migrate

# Start the queue worker
./vendor/bin/sail artisan queue:work
```

Learn more about Laravel Sail [here](https://laravel.com/docs/10.x/sail).

## Usage

To access the application, visit [http://localhost](http://localhost) in your browser.

## Testing

To run the tests, execute the following command in the root directory of the project:

```bash
# Copy the .env.testing file from the .env.testing.example file
cp .env.testing.example .env.testing

# Run the tests
./vendor/bin/sail artisan test
```

## Documentation and Development

### SOLID Principles

This project implements SOLID principles and uses the repository pattern to abstract the data layer from the application layer.

Dependencies are injected into the constructors of the classes that need them. This is done to make the classes more testable and the code more readable. However, these classes depend on interfaces rather than concrete classes and are managed by the Laravel service container.

> Laravel Service containers are used to manage class dependencies and perform dependency injection.

Check out the `HackerNewsServiceProvider` class to see how the `IHackerNewsService` interface is bound to the `HackerNewsService` class using the Laravel service container. 

*Subsequent providers must also be registered in the `config/app.php` file.*

The project uses interfaces to define contracts that classes must implement. This is done to enhance code readability and application security.

The project uses DTOs to transfer data between the application layer and the data layer. This is done to improve code readability and application security.

Run the following command in the root directory of the project to generate the following classes:

```bash
# Create an `interface`
./vendor/bin/sail artisan make:interface <InterfaceName>

# Create a `service`
./vendor/bin/sail artisan make:service <ServiceName>

# Create a `DTO`
./vendor/bin/sail artisan make:dto <DTOName>
```

## Notes