init: \
	docker-down-clear \
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
	app-composer-install \
	app-npm-install \
	app-init-files \
	app-wait-mysql \
	app-migrate \
	app-clear-cache

app-init-files:
	docker compose run --rm app php bin/init.php --env=Development --overwrite=n
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
