<?php
/**
 * Author Alexey Starikov <alexsuperstar@mail.ru>
 * Date: 10.11.2019
 * Time: 17:30
 */
include 'src/alexstar/JsonMaker.php';
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

echo $a;