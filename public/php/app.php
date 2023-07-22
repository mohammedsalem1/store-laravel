<?php
namespace A;

include __DIR__ .'/autoload.php';
//use B\person;
// echo LARAVEL;
//use B\Person;
$person  = new Person;
$person2 = new \B\Person;

$person-> name  = "mohammed";
$person2-> name = "ahmed";

$person::$country  = "palestine";
$person2::$country  = "Jorden";

var_dump($person);

echo \B\Person::$country;

?>
