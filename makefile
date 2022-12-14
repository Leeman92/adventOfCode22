.PHONY: dump
dump:
	composer dump-autoload
.PHONY: install
install:
	composer install
.PHONY: setup
setup: install dump

.PHONY: test
test:
	vendor/bin/phpstan analyse src --level=max