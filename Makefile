run:
	docker-compose up -d --build

stop:
	docker-compose down

initP:
	cd src/ && composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fzaninotto/faker:^1.0"

initDb:
	docker-compose exec web php ./app/Model/database.php

getIp:
	ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'
