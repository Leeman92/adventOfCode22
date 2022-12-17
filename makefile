.PHONY: dump
dump:
	composer dump-autoload
.PHONY: install
install:
	composer install
.PHONY: setup
setup: install dump

.PHONY: analyse
analyse:
	vendor/bin/phpstan analyse src --level=max
.PHONY: fix
fix:
	PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer fix src --allow-risky=yes
.PHONY: test
test: fix analyse