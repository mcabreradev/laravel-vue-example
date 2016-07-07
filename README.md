## Requirements

- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)
- [Laravel requirements](https://laravel.com/docs/5.2/installation#server-requirements)

## Setup

Install php dependencies
```bash
composer install
```

Install npm packages
```bash
npm install
```

Compile assets at least once
```bash
npm run prod
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
npm run prod

#compile and watch
npm run drv
```