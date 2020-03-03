FROM archlinux:latest

RUN pacman -Sy --noconfirm tar

RUN useradd -G wheel -s /bin/sh -u 1000 -m user
RUN curl -LO https://nodejs.org/dist/v13.9.0/node-v13.9.0-linux-x64.tar.gz
RUN mkdir -p /usr/local/lib/nodejs
RUN tar xzvf node-v13.9.0-linux-x64.tar.gz -C /usr/local/lib/nodejs
RUN chmod -R +x /usr/local/lib/nodejs/node-v13.9.0-linux-x64/bin

ENV PATH=$PATH:/usr/local/lib/nodejs/node-v13.9.0-linux-x64/bin
