.PHONY: start
start:
	docker run -p 8000:80 \
		-v ./html:/var/www/html \
		-v ./dev.db:/var/www/html/dev.db \
		php:apache
