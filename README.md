# DPOSS Admin

## Setup

Install php dependencies
```bash
composer install && composer update
```

Install npm packages
```bash
npm install
```

Compile assets at least once
```bash
npm run compile
```

Duplicate .env.example in **.env**. Then edit **.env** to adjust your enviroment
```bash
cp .env.example .env
```

Migrate and seed
```bash
php artisan migrate --seed
```

## Utilities

### npm scripts
```bash
#compile
npm run compile

#compile and watch
npm run compile
```
