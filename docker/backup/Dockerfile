FROM alpine

RUN apk add --no-cache bash aws-cli

RUN apk add --no-cache coreutils mariadb-client

COPY ./docker/scripts/wait-for-it.sh /usr/local/bin/wait-for-it
RUN chmod 555 /usr/local/bin/wait-for-it

COPY ./docker/backup/backup.sh /usr/local/bin/backup
RUN chmod 555 /usr/local/bin/backup

WORKDIR /app

CMD ["backup"]
