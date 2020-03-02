FROM alpine:latest

RUN apk add --update php php-bcmath php-ctype php-json php-mbstring php-openssl php-pdo php-tokenizer php-xml php-phar php-dom php-xmlwriter
RUN addgroup -g 1000 -S user
RUN adduser user -h /home/user -g "" -s /bin/sh -G user -S -D -u 1000 user
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir /usr/bin --filename composer
RUN php -r "unlink('composer-setup.php');"
