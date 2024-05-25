init: \
	docker-down-clear \
	app-clear \
	app-init-env-file \
	docker-pull \
	docker-build \
	docker-up \
	app-init

up: docker-up
down: docker-down
shell: docker-shell
restart: down up
ps: docker-ps
update-deps: \
	app-composer-update \
	app-npm-update \
	restart

docker-up:
	docker compose up -d
docker-down:
	docker compose down --remove-orphans
docker-shell:
	docker exec -it app /bin/bash
docker-down-clear:
	docker compose down -v --volumes --remove-orphans
docker-pull:
	docker compose pull
docker-build:
	docker compose build --pull
docker-ps:
	docker compose ps

app-init: \
	app-permissions \
	app-composer-install \
	app-npm-install \
	app-wait-mysql \
	app-migrate \
	app-clear-cache

app-check: \
	app-composer-validate \
	app-lint

app-fix: \
	app-lint-fix

app-clear:
	docker run --rm -v ${PWD}:/app -w /app php:8.1-fpm sh -c 'rm -rf var/* public/assets/* .env'
app-permissions:
	docker run --rm -v ${PWD}:/app -w /app php:8.1-fpm sh -c 'chmod 777 var public/assets'
app-init-env-file:
	docker run --rm -v ${PWD}:/app -w /app php:8.1-fpm sh -c 'cp .env.example .env'
app-composer-install:
	docker compose run --rm app composer install
app-composer-update:
	docker compose run --rm app composer update
app-wait-mysql:
	docker compose run --rm app wait-for-it mysql:3306 -t 30
app-migrate:
	docker compose run --rm app php bin/app.php migrate --interactive=0
app-clear-cache:
	docker compose run --rm app php bin/app.php cache/flush-all
app-npm-install:
	docker compose run --rm app npm install
app-npm-update:
	docker compose run --rm app npm update
app-assets-build:
	docker compose run --rm app npm run build

app-composer-validate:
	docker compose run --rm app composer validate
app-lint:
	docker compose run --rm app composer lint
	docker compose run --rm app composer php-cs-fixer fix -- --dry-run --diff

app-lint-fix:
	docker compose run --rm app composer php-cs-fixer fix

