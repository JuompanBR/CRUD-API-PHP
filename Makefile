PROJECT_NAME = php-app

build:
	docker-compose --project-name $(PROJECT_NAME) build

start:
	docker-compose --project-name $(PROJECT_NAME) up -d

restart:
	docker-compose --project-name ${PROJECT_NAME} down -v
	docker-compose --project-name ${PROJECT_NAME} up --build

stop:
	docker-compose --project-name ${PROJECT_NAME} stop