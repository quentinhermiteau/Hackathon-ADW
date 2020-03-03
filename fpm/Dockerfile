# Using the latest version of Alpine
FROM alpine:latest

# Add PHP-FPM from the Alpine package
RUN apk add --update php-fpm

# Add a new group
RUN addgroup -g 1000 -S user

# Add a new user
RUN adduser -h /home/user -g "" -s /bin/sh -G user -S -D -u 1000 user

# Expose the port that is listening by the PHP-FPM process
EXPOSE 9000
