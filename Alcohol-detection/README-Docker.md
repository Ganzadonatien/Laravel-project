# Docker Setup for Alcohol Detection Laravel App

## Prerequisites
- Docker and Docker Compose installed on Ubuntu
- Git (to clone the repository)

## Setup Instructions

1. **Clone/Copy the project to Ubuntu:**
   ```bash
   # If using git
   git clone <your-repo-url>
   cd Alcohol-detection
   
   # Or copy the project folder to Ubuntu
   ```

2. **Copy environment file:**
   ```bash
   cp .env.docker .env
   ```

3. **Build and start containers:**
   ```bash
   docker-compose up -d --build
   ```

4. **Generate application key (if not done automatically):**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   docker-compose exec app php artisan migrate
   ```

## Access Points

- **Application:** http://localhost:8080
- **phpMyAdmin:** http://localhost:8081
- **Database:** localhost:3306

## Useful Commands

```bash
# View logs
docker-compose logs -f

# Access app container
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan <command>

# Stop containers
docker-compose down

# Rebuild containers
docker-compose up -d --build

# Reset database
docker-compose exec app php artisan migrate:fresh --seed
```

## Database Credentials
- **Host:** db (internal) / localhost (external)
- **Database:** alcohol_detection
- **Username:** alcohol_user
- **Password:** secret
- **Root Password:** rootsecret

## Troubleshooting

1. **Permission issues:**
   ```bash
   sudo chown -R $USER:$USER storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

2. **Clear all caches:**
   ```bash
   docker-compose exec app php artisan optimize:clear
   ```

3. **Rebuild from scratch:**
   ```bash
   docker-compose down -v
   docker-compose up -d --build
   ```