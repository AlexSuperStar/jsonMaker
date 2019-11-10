# jsonMaker
Create JSON easy

*Read this in other languages: [English](README.en.md).*

PHP класс для создания и модификации текстовой строки в формате JSON

# Установка 

```
composer require alexsuperstar/jsonmaker
```

# Создание JSON

```php
$a = new \alexstar\JsonMaker();
$cc='xyz';
$a->{$cc}->bbb->cccc[0]->xxx=5;
$a->{$cc}->zz='qq';
$a->xyz->zf='qq';
$a->xx->zz='qq';
# Устанавливаем значение по пути
$a('/zz/name','AlexStar');
$a('/zz/groups',['Admin'])[1]="Super user";
$a('/zz/address',['City'=>"Moscow"])->Streen="Bulvar";
# запрос значения, вернет объект JsonMaker или null
$street=$a('/zz/address/City');// Moscow
$group0=$a('/zz/groups/0');// Admin
$group1=$a('/zz/groups/1');// Super user
var_dump($a('/zz/not_set')); // return null
$a('/zz')->groups[0]; //Admin
```

Результат
```
{"xyz":{"bbb":{"cccc":[{"xxx":5}]},"zz":"qq","zf":"qq"},"xx":{"zz":"qq"},"zz":{"name":"AlexStar","groups":["Admin","Super user"],"address":{"City":"Moscow","Streen":"Bulvar"}}}
 ```
 
# Редактирование JSON
 
Исходный JSON
```
{
  "firstName": "Иван",
  "lastName": "Иванов",
  "address": {
    "streetAddress": "Московское ш., 101, кв.101",
    "city": "Ленинград",
    "postalCode": 101101
  },
  "phoneNumbers": [
    "812 123-1234",
    "916 123-4567"
  ]
}
```

PHP код

```php
<?php 
$loader = require_once __DIR__ . '/vendor/autoload.php';
$json = new \alexstar\JsonMaker('{"firstName":"Иван","lastName":"Иванов","address":{"streetAddress":"Московское ш., 101, кв.101","city":"Ленинград","postalCode":101101},"phoneNumbers":["812 123-1234","916 123-4567"]}');
$json->firstName='Алексей';
$dom='дом';
$json->address->{$dom}=6;
$json->address->code[]='123';
$json->address->code[]='456';
$json->phoneNumbers[2]='+7(123)1233-45-67';
unset($json->address->city,$json->phoneNumbers[0]);
echo $json;
echo 'code count: ',count($json->address->code);
```

Результат

```
{
  "firstName": "Алексей",
  "lastName": "Иванов",
  "address": {
    "streetAddress": "Московское ш., 101, кв.101",
    "postalCode": 101101,
    "дом": 6,
    "code": [
      "123",
      "456"
    ]
  },
  "phoneNumbers": {
    "1": "916 123-4567",
    "2": "+7(123)1233-45-67"
  }
}
code count: 2
```


PS: по поводу расходования памяти ничего сказать не могу, вроде все передается по ссылкам но я не уверен.
