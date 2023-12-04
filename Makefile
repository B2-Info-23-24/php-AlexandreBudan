run:
	docker-compose up -d --build
	chmod 777 src/public/img
	docker-compose exec web php -r "require 'public/db.php'; createDb();"

initData:
	docker-compose exec web php -r "require 'public/db.php'; createDataFixtures();"

stop:
	docker-compose down

initP:
	cd src/ && composer require "vlucas/phpdotenv:^5.0" "twig/twig:^3.0" "fakerphp/faker:^1.9"
