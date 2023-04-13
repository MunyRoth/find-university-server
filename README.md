# Find University

## Installation

### Run terminal clone from GitHub repository
```bash
git clone https://github.com/MunyRoth/find-university-server.git
composer install
cp .env.example .env
```

### Configuration .env
In .env please replace:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME="munyphunita@gmail.com"
MAIL_PASSWORD="ysilepsgxrzxkdor"
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="munyphunita@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```
(and make sure you are replace your database in .env)

### Run terminal
```bash
php artisan key:generate
php artisan migrate
php artisan serve
```
