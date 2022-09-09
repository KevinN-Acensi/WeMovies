SHELL = /bin/bash

######## DOCKER ########

build: ## Build all images
	docker-compose build

create: build ## Create containers
	docker-compose up --no-start

start: ## Start containers
	docker-compose up -d --remove-orphans

stop: ## Stop containers
	docker-compose stop

logs: ## Open logs containers
	docker-compose logs -f

pull: ## Get docker images
	docker-compose pull

down: ## Stop and delete containers
	docker-compose down --remove-orphans

ps: ## Show containers
	docker-compose ps

create_start: down create start ## Create and start containers

######## OUTILS ########

debug: ## Add docker role to your own user
	sudo usermod -aG docker ${USER}

permissions: ## Update permissions to files
	sudo chown -R ${USER}:${USER} ../web
	sudo chown -R ${USER}:www-data ../web/WeMovies/public
	sudo chmod -R 775 ../web/WeMovies/public

######## AUTOMATISATION #######

init: debug create_start permissions ## Initialisation for docker and permission

php_sh: ## Connection to php container
	docker exec -it -u `id -u ${USER}` wemovies_php bash

