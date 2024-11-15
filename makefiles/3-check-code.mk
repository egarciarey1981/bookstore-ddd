phpstan: ## Run PHPStan
	docker compose exec api vendor/bin/phpstan analyse || true

phpcs: ## Run PHP Code Sniffer
	docker compose exec api vendor/bin/phpcs || true

phpcbf: ## Run PHP Code Beautifier and Fixer
	docker compose exec api vendor/bin/phpcbf || true