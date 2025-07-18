setup:
	@make build
	@make up
	@make composer-update
	@make db-config


build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec laravel-docker bash -c "composer update"
data:
	docker exec laravel-docker bash -c "php artisan migrate"
	docker exec laravel-docker bash -c "php artisan db:seed"
db-config:
	docker exec laravel-docker bash -c "php artisan config:cache"



