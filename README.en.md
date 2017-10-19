# jsonMaker
Create JSON easy

PHP class for creating and modifying a text string in JSON format
# Installation

```
composer require alexsuperstar/jsonmaker
```

# Creating JSON

```php
$a = new \alexstar\JsonMaker();
$cc='xyz';
$a->{$cc}->bbb->cccc[0]->xxx=5;
$a->{$cc}->zz='qq';
$a->xyz->zf='qq';
$a->xx->zz='qq';
echo $a; 
```

Result
```
{"xyz":{"bbb":{"cccc":[{"xxx":5}]},"zz":"qq","zf":"qq"},"xx":{"zz":"qq"}}
 ```
 
# Editing JSON
 
Original JSON
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

PHP code

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
```

Result

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
```

PS: about the use of memory, I can not say anything, like everything is transmitted by links, but I'm not sure.

Translated Google Translate
