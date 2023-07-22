<?php
namespace A;

class Person {
    const LARAVEL = "LARAVEL A";
    
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
    public static function setCountry($country) {
        self::$country = $country;
     }
}
?>
