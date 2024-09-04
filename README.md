# CELIAC Project

##  Usage

### Installation
1. Clone Project From Github
``` bash
git clone git@github.com:KIANAlRAQMIAH/celiac-backend.git
```

2. Copy .env.example as new file with name .env

3. Run Install Command:
``` bash
composer install --ignore-platform-reqs
```
4. You can create tables by running the migrations:
``` bash
php artisan migrate
```
5. run command to insert required data
``` bash
php artisan db:seed
```
6. run command 
``` bash
php artisan storage:link
```
