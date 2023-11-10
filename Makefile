run:
	docker-compose up -d --build
	docker-compose exec web php ./app/Model/database.php

stop:
	docker-compose down

initP:
	cd src/ && composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0"

getIp:
	ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'
