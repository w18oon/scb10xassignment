# scb10xassignment

## How to run

### Start DB by docker-compose
```bash
docker-compose up -d
```

### Start App
```bash
#1 Database: Migrations
php artisan migrate
#2 Run Server
php artisan serve
```

### Browse App on http://127.0.0.1:8000/

## Remark

### Frontend is VueJS
> location in resources/js/

### Backend is Laravel
> location api in app/Http/Controllers/API