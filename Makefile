.PHONY: help

USER_ID=$(shell id -u)
GROUP_ID=$(shell id -g)

IMAGE_PHPUNIT=jitesoft/phpunit:8.1

DOCKER_PHP=docker exec -it -u $(USER_ID):$(GROUP_ID) bookstore_php 
DOCKER_PHPUNIT=docker run --rm -i -v $(PWD):/app -w /app jitesoft/phpunit phpunit


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


composer-install: up ## instala dependencias de composer
	docker run --rm --interactive --tty --volume $(PWD):/app composer install
composer-update: up ## actualiza dependencias de composer
	docker run --rm --interactive --tty --volume $(PWD):/app composer update
composer-dump: up ## actualiza autoload
	docker run --rm --interactive --tty --volume $(PWD):/app composer dump-autoload


phpstan: ## PHPStan
	docker run --rm -v $(PWD):/app ghcr.io/phpstan/phpstan analyse --level 6 /app/src /app/tests
phpcs: ## PHP_CodeSniffer
	docker run --rm -v $(PWD):/app cytopia/phpcs --standard=PSR12 /app/src /app/tests --ignore=/app/tests/reports
phpcbf: ## PHP_CodeSniffer Fixer
	docker run --rm -v $(PWD):/app cytopia/phpcbf --standard=PSR12 /app/src /app/tests --ignore=/app/tests/reports


test-unit: up ## test unitarios
	$(DOCKER_PHPUNIT) --no-coverage --testsuite Unit
test-coverage: up ## test de covertura
	$(DOCKER_PHPUNIT) --testsuite Unit
test-mutant: up ## test mutantes
	$(DOCKER_PHP) vendor/bin/infection --filter=src

