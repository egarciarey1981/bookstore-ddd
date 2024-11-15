phpstan: ## Run PHPStan
	docker compose exec api vendor/bin/phpstan analyse --level max src app || true

phpcs: ## Run PHP Code Sniffer
	docker compose exec api vendor/bin/phpcs --standard=PSR12 src || true

phpcbf: ## Run PHP Code Beautifier and Fixer
	docker compose exec api vendor/bin/phpcbf --standard=PSR12 src || true