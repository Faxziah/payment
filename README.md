## API методы

### POST /api/login - авторизация

Request example
```
{
    "email": "admin@admin.com",
    "password": "12345678"
}
```

Response example
```
{
    "url": "http://127.0.0.1:8000/admin/dashboard",
    "api_token": "htHchrkllH442nL9CV5h1VPXZCqrwNRu9d9zXfuALPYcMuup3JnDQy6ZlB2A"
}
```

### GET /api/payment - получение данных о платеже

Request example
```
{
user_login: admin,
outer_payment_id: 44
}
```


Response example
```
{
    "status": "success",
    "code": "200",
    "data": [
        {
            "id": 12,
            "outer_payment_id": "44",
            "type": "withdrawal",
            "user_login": "admin",
            "requisites": "Unde dignissimos voluptate.",
            "sum": 9086,
            "currency": "USD",
            "status": 1
        }
    ]
}
```


### POST /api/payment - добавление платежа

Request example
```
{
	"outer_payment_id": "55",
	"type": "deposit",
    "user_login": "admin",
	"requisites": "реквизиты реквизиты реквизиты реквизиты реквизиты ",
    "sum": "1000",
	"currency": "RUB",
    "status": "0"
}
```


Response example
```
{
    "status": "success",
    "code": "201",
    "text": "Запись успешно создана"
}
```
