.PHONY: help


help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)


up: ## levantar
	docker-compose up -d --build
start: ## iniciar
	docker-compose start
stop: ## parar
	docker-compose stop
down: ## bajar
	docker-compose down
ps: ## estado
	docker-compose ps
log: ## log
	docker-compose -f docker-compose.yml logs --tail=100 -f


composer-install: ## instala dependencias de composer
	docker run --rm --interactive --tty --volume $(PWD):/app composer install
composer-update: ## actualiza dependencias de composer
	docker run --rm --interactive --tty --volume $(PWD):/app composer update
composer-dump: ## actualiza autoload
	docker run --rm --interactive --tty --volume $(PWD):/app composer dump-autoload


phpstan: ## PHPStan
	docker run --rm -v $(PWD):/app ghcr.io/phpstan/phpstan analyse --level 6 /app/src
phpcs: ## PHP_CodeSniffer
	docker run --rm -v $(PWD):/app cytopia/phpcs --standard=PSR12 /app/src
phpcbf: ## PHP_CodeSniffer Fixer
	docker run --rm -v $(PWD):/app cytopia/phpcbf --standard=PSR12 /app/src


test-unit: ## test unitarios
	docker exec -it bookstore_php vendor/bin/phpunit --no-coverage --testsuite Unit
test-acceptance: ## test de aceptación
	docker exec -it bookstore_php vendor/bin/phpunit --no-coverage --testsuite Acceptance
test-coverage: ## test de covertura
	docker exec -it bookstore_php vendor/bin/phpunit --testsuite Unit,Acceptance
test-dead-code: ## test de covertura
	docker exec -it bookstore_php vendor/bin/phpunit --testsuite Acceptance

