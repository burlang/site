# Burlang.ru

## Requirements

- `docker`
- `docker-compose`

## Installation

### Init

```
make init
```

### Open `http://localhost:80`

Login: `admin`
Password: `admin`

## Commands

### Main Commands

- `make init` - Initialize the project (clear, build, start containers, and setup app)
- `make up` - Start containers
- `make down` - Stop containers
- `make restart` - Restart containers
- `make shell` - Access PHP CLI shell

### Development Commands

- `make check` - Run all checks (validation, linting, analysis, tests, backup)
- `make app-fix` - Fix code style issues
- `make update-deps` - Update composer dependencies and restart

### Docker Commands

- `make docker-build` - Build Docker images
- `make docker-ps` - Show container status
- `make docker-shell` - Access container shell

### App Commands

- `make app-migrate` - Run database migrations
- `make app-clear-cache` - Clear application cache
- `make app-test` - Run tests
- `make app-lint` - Run linting
- `make app-backup` - Create backup
