.PHONY: help

USER_ID=$(shell id -u)
GROUP_ID=$(shell id -g)

IMAGE_PHPUNIT=jitesoft/phpunit:8.1

DOCKER_PHP=docker exec -it -u $(USER_ID):$(GROUP_ID) bookstore_php 
DOCKER_PHPUNIT=docker run --rm -i -v $(PWD):/app -w /app jitesoft/phpunit phpunit


help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-22s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)


docker-compose-down: ## docker-compose down
	docker-compose down
docker-compose-exec: ## docker-compose exec
	$(DOCKER_PHP) sh
docker-compose-logs: ## docker-compose -f docker-compose.yml logs --tail=100 -f
	docker-compose -f docker-compose.yml logs --tail=100 -f
docker-compose-ps: ## docker-compose ps
	docker-compose ps
docker-compose-up: ## docker-compose up -d --build
	docker-compose up -d --build


composer-install: ## composer install
	$(DOCKER_PHP) composer install
composer-down: ## composer dump-autoload
	$(DOCKER_PHP) composer dump-autoload
composer-update: ## composer update 
	$(DOCKER_PHP) composer update


check-phpcbf: ## phpcbf
	$(DOCKER_PHP) ./vendor/bin/phpcbf --standard=PSR12 ./src ./tests --ignore=/app/tests/reports
check-phpcs: ## phpcs
	$(DOCKER_PHP) ./vendor/bin/phpcs --standard=PSR12 ./src ./tests --ignore=/app/tests/reports
check-phpstan: ## phpstan
	$(DOCKER_PHP) ./vendor/bin/phpstan analyse --xdebug --level 6 ./src ./tests


test-phpunit-cover: ## test de covertura
	$(DOCKER_PHP) vendor/bin/phpunit --testsuite Unit
test-phpunit-unit: ## test unitarios
	$(DOCKER_PHP) vendor/bin/phpunit --no-coverage --testsuite Unit
test-infection: ## test mutantes
	$(DOCKER_PHP) vendor/bin/infection --filter=src

