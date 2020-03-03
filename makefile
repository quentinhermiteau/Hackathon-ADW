.PHONY: init build install start stop mrproper migrations restart

# Install the PHP dependencies
# Generate a new environment configuration file
# Generate a Laravel application key
init:
	docker-compose run --rm composer install
	cp .env.example .env
	docker-compose run --rm artisan key:generate

# Build the Dockerfile
build:
	docker-compose build

# Install the PHP dependencies
install:
	docker-compose run --rm composer install

# Start the web server at http://localhost
start:
	docker-compose up --detach fpm nginx postgresql

# Remove the Docker artifacts
stop:
	docker-compose down --remove-orphans --volumes

# Alias for make stop start
restart: stop start

# Remove the Docker artifacts and images
# Remove the environment configuration file
# Remove the PHP dependencies
mrproper:
	docker-compose down --rmi all --remove-orphans --volumes
	rm -rf vendor .env

# Run the laravel migrations
migrations:
	docker-compose run --rm artisan migrate
