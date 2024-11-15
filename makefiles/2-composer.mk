composer-install: ## Install composer dependencies
	docker run --rm --interactive --tty --volume $(PWD):/app composer install

composer-update: ## Update composer dependencies
	docker run --rm --interactive --tty --volume $(PWD):/app composer update

composer-require: ## Require a package
	docker run --rm --interactive --tty --volume $(PWD):/app composer require $(package)

composer-require-dev: ## Require a package for development
	docker run --rm --interactive --tty --volume $(PWD):/app composer require --dev $(package)

composer-remove: ## Remove a package
	docker run --rm --interactive --tty --volume $(PWD):/app composer remove $(package)

composer-dump-autoload: ## Dump autoload
	docker run --rm --interactive --tty --volume $(PWD):/app composer dump-autoload