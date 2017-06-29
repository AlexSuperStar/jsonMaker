# jsonMaker
Create JSON easy

Класс для создания и модификации текстовой JSON строки

# Создание JSON

```Пример работы:
$a = new \AS\jsonMaker();
$cc='xyz';
$a->{$cc}->bbb->cccc[0]->xxx=5;
$a->{$cc}->zz='qq';
$a->xyz->zf='qq';
$a->xx->zz='qq';
echo $a; 
```

Результат
```
{"xyz":{"bbb":{"cccc":[{"xxx":5}]},"zz":"qq","zf":"qq"},"xx":{"zz":"qq"}}
 ```
 
 # Редактирование JSON
 
```
$a = new \AS\jsonMaker('{"xyz":{"bbb":{"cccc":[{"xxx":5}]},"zz":"qq","zf":"qq"},"xx":{"zz":"qq"}}');
$a->xyz->zf='123';
$a->xyz->bbb->cccc[1]->yyy=6;
 ```
Результат
```
{"xyz":{"bbb":{"cccc":[{"xxx":5},{"yyy":6}]},"zz":"qq","zf":"123"},"xx":{"zz":"qq"}}
 ```
