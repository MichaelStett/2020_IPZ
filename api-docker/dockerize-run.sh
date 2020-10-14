# !/bin/sh

docker-compose down

docker-compose up --force-recreate --abort-on-container-exit --build api
