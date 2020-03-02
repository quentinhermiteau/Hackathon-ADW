# Using Alpine for this image
FROM alpine:latest

# Adding NGINX from the Alpine packages
RUN apk add --update nginx

# Creating the PID folder for NGINX
RUN mkdir /run/nginx

# Creating the PID file for NGINX
RUN touch /run/nginx/nginx.pid

# Adding a new group
RUN addgroup -g 1000 -S user

# Adding a new user
RUN adduser -h /home/user -g "" -s /bin/sh -G user -S -D -u 1000 user
