# Find University

## Installation

### Run terminal clone from GitHub repository
```bash
git clone https://github.com/MunyRoth/find-university-server.git
cd find-university-server
composer install
cp .env.example .env
```

### Configuration .env
In .env please replace:
```
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="munyphunita@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```
(and make sure you are replace your database in .env)

### Run terminal
```bash
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan serve
```
