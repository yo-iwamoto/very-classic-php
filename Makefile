.PHONY: start
start:
	docker run -p 8000:80 \
		-v ./html:/var/www/html \
		php:apache
