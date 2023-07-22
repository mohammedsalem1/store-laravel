<?php
namespace B;

use A\Person as personA;

class Person extends personA{
    const LARAVEL = "LARAVEL B";

    public $name;
    protected $gender;
    private $age;

    public static $country;

    public function __construct() {
       echo __CLASS__;
    }

    public function setName($name) {
        $this->name = $name;
        return name;
    }
    public function setGender($gender) {
        $this->gender = $gender;
        return gender;
    }
    public function setAge($age) {
        $this->age = $age;
        return age;
    }

}
?>
