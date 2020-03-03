.PHONY: init install start clean

# Install the PHP dependencies
# Generate a new environment configuration file
# Generate a Laravel application key
init:
	docker-compose run --rm composer install
	cp .env.example .env
	docker-compose run --rm artisan key:generate

# Install the PHP dependencies
install:
	docker-compose run --rm composer install

# Start the web server at http://localhost
start:
	docker-compose up fpm nginx

# Remove the Docker artifacts
clean:
	docker-compose down --remove-orphans --volumes

# Remove the Docker artifacts and images
# Remove the environment configuration file
# Remove the PHP dependencies
mrproper:
	docker-compose down --rmi all --remove-orphans --volumes
	rm -rf vendor .env
