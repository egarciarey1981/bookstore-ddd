.PHONY: help

UID := $(shell id -u)
GID := $(shell id -g)

DOCKER_PHP=docker exec -it -u $(UID):$(GID) bookstore_php 

help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-22s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)


down: ## docker-compose down
	docker-compose down
exec: ## docker-compose exec
	$(DOCKER_PHP) sh
logs: ## docker-compose -f docker-compose.yml logs --tail=100 -f
	docker-compose -f docker-compose.yml logs --tail=100 -f
ps: ## docker-compose ps
	docker-compose ps
up: ## docker-compose up -d --build
	docker-compose up -d --build


composer-install: ## composer install
	$(DOCKER_PHP) composer install -vvv docker-compose
composer-down: ## composer dump-autoload
	$(DOCKER_PHP) composer dump-autoload
composer-update: ## composer update 
	$(DOCKER_PHP) composer update


phpcbf: ## php code beautifier and fixer
	$(DOCKER_PHP) ./vendor/bin/phpcbf --standard=PSR12 src tests
phpcs: ## php code sniffer
	$(DOCKER_PHP) ./vendor/bin/phpcs --standard=PSR12 src tests
phpmd: ## php mess detector
	$(DOCKER_PHP) ./vendor/bin/phpmd ./src text cleancode,codesize,controversial,design,naming,unusedcode
phpstan: ## phpstan
	$(DOCKER_PHP) ./vendor/bin/phpstan analyse --xdebug --level 6 ./src ./tests
	
test-all: ## todos los test
	$(DOCKER_PHP) vendor/bin/phpunit --no-coverage --testsuite Unit,Integration
test-unit: ## test unitarios
	$(DOCKER_PHP) vendor/bin/phpunit --no-coverage --testsuite Unit
test-integration: ## test de integración
	$(DOCKER_PHP) vendor/bin/phpunit --no-coverage --testsuite Integration
test-cover: ## test de covertura
	$(DOCKER_PHP) vendor/bin/phpunit --testsuite Unit,Integration
	echo "body{font-size:1em;}" >> reports/coverage/html/_css/custom.css
test-mutants: ## test mutantes
	$(DOCKER_PHP) vendor/bin/infection
