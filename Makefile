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
	restart

check: app-check

docker-up:
	docker compose up -d
docker-down:
	docker compose down --remove-orphans
docker-shell:
	docker compose run --rm site-php-cli sh
docker-down-clear:
	docker compose down -v --volumes --remove-orphans
docker-pull:
	docker compose pull --ignore-pull-failures
docker-build:
	docker compose build --pull
docker-ps:
	docker compose ps

app-init: \
	app-permissions \
	app-composer-install \
	app-wait-mysql \
	app-migrate \
	app-clear-cache

app-check: \
	app-composer-validate \
	app-lint \
	app-analyze \
	app-tests \
	app-backup


app-fix: \
	app-lint-fix

app-clear:
	docker run --rm -v ${PWD}:/app -w /app alpine sh -c 'rm -rf var/* public/assets/* .env'
app-permissions:
	docker run --rm -v ${PWD}:/app -w /app alpine sh -c 'chmod 777 var public/assets'
app-init-env-file:
	docker run --rm -v ${PWD}:/app -w /app alpine sh -c 'cp .env.example .env'
app-composer-install:
	docker compose run --rm site-php-cli composer install
app-composer-update:
	docker compose run --rm site-php-cli composer update
app-composer-outdated:
	docker compose run --rm site-php-cli composer outdated --direct
app-wait-mysql:
	docker compose run --rm site-php-cli wait-for-it site-mysql:3306 -t 30
app-migrate:
	docker compose run --rm site-php-cli php bin/console migrate --interactive=0
app-clear-cache:
	docker compose run --rm site-php-cli php bin/console cache/flush-all

app-composer-validate:
	docker compose run --rm site-php-cli composer validate
app-lint:
	docker compose run --rm site-php-cli composer lint
	docker compose run --rm site-php-cli composer php-cs-fixer fix -- --dry-run --diff
app-analyze:
	docker compose run --rm site-php-cli composer analyze
app-tests:
	docker compose run --rm site-php-cli composer tests
app-lint-fix:
	docker compose run --rm site-php-cli composer php-cs-fixer fix

app-backup:
	docker compose run --rm site-backup
