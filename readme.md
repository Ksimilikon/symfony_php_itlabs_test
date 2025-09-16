# General
All commands call from root project.
Atribute of commands in (--atribute) is optional.

# Require utils/pragmas
- composer 
- php (unlock extension "iconv")
- mysql or mariadb server
- symfonycli (optional)

# Info 
- admin credentials: login (admin), password (foo)
- admin panel::url /admin
- login form::url /login

# Deploy

## Without docker
### Clone git 
- [ ] command: git clone "https://github.com/Ksimilikon/symfony_php_itlabs_test.git"

### Configure .env 
- [ ] copy .env.example to .env -> fill atributes

### Install dependencies
- [ ] commands: composer install

### Migrate database (after configure .env [DATABASE_URL])
- [ ] command: php bin/console doctrine:migrations:migrate

### After migration need insert user-admin (only dev mode in .env)
- [ ] command: php bin/console doctrine:fixtures:load (--append)
    --append: add rows to DB without truncate rows;

### Prodaction mode 
- [ ] set prod in .env file

### Run app 
- [ ] commands: choice one
    - php -S 127.0.0.1:8000 -t public 
    - symfony server:start
