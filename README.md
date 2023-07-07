# Challenge Bennu
# Laravel 9

### Environment
Commands
```shell
1) php artisan migrate
2) php artisan db:seed --class=UsersSeeder
3) php artisan db:seed --class=ClientsSeeder
4) php artisan db:seed --class=ServicesSeeder
```

### API
Commands
```shell
1) POST - /api/login
Se deberá pasar username y password y devolverá un token, que se deberá usar en todas 
las operaciones.

Request:
{
    "username": "test",
    "password": "password"
}
Response;
{
    "status": true,
    "message": "Se logeo con éxito.",
    "token": "TxkKyQE3TIEwNAQtjAMowsMVGEW70yA2JMSBOhEV"
}

2) PUT - /api/suscribe
Suscribe un usuario y un cliente a un servicio

Headers:
Token Bearer: {{ token }}

Request: 
{
    "number_client": "00002",
    "date": "2023-05-19",
    "service": "games" 
}

Response: 
{
    "status": true,
    "message": "Se suscribión con éxito."
}

3) PUT - /api/unsuscribe
Desuscribe o cancela un usuario y un cliente a un servicio

Headers:
Token Bearer: {{ token }}

Request: 
{
    "number_client": "00002",
    "service": "games" 
}

Response: 
{
    "status": true,
    "message": Se cancelo la suscripción con éxito."
}

```

--------------

### Reporte de suscripciones por artisan commands
```shell
php artisan report:suscriptions
php artisan report:suscriptions  --date=Y-m-d
```
