#!/bin/bash

set -o errexit
set -o pipefail

BACKUP_FILE="${BACKUP_NAME:?}_$(date +%Y-%m-%d_%H-%M).sql.gz"

echo "Dump $BACKUP_FILE"

mariadb-dump --host="${MYSQL_HOST:?}" --user="${MYSQL_USER:?}" --password="${MYSQL_PASSWORD:?}" \
  --ssl=0 --single-transaction "${MYSQL_DATABASE:?}" | gzip -9 > "$BACKUP_FILE"

echo "Upload to S3"

export AWS_ACCESS_KEY_ID="${AWS_ACCESS_KEY_ID:?}"
export AWS_SECRET_ACCESS_KEY="${AWS_SECRET_ACCESS_KEY:?}"
export AWS_DEFAULT_REGION="${AWS_DEFAULT_REGION:?}"

aws --endpoint-url="${S3_ENDPOINT:?}" s3 cp "$BACKUP_FILE" "s3://${S3_BUCKET:?}/$BACKUP_FILE"

unlink "$BACKUP_FILE"

echo -e "\e[32m✔ Backup completed successfully!\e[0m"
