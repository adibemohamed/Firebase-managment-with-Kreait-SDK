<?php


require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class Country {

    protected $database;
    protected $dbname = 'countries';

    public function __construct() {
        $account = (new Factory)->withServiceAccount(__DIR__.'/secret/fir-php-a5f3d-2209614f8194.json'); 
        $this->database =   $account->createDatabase(); 
    }

    public function get(int $countryId = NULL){
        if (empty($countryId) || !isset($countryId)) { return FALSE; }

        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($countryId)){
            return $this->database->getReference($this->dbname)->getChild($countryId)->getValue();
        } else {
            return FALSE;
        }
    }

    public function insert(array $data) {
        if (empty($data) || !isset($data)) { return FALSE; }

        foreach ($data as $key => $value){
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }

        return TRUE;
    }

    public function delete(int $countryId) {
        if (empty($countryId) || !isset($countryId)) { return FALSE; }

        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($countryId)){
            $this->database->getReference($this->dbname)->getChild($countryId)->remove();
            return TRUE;
        } else {
            return FALSE;
        }
    }
}


$countries = new Country();

var_dump($countries->insert([
   'id' => 'MA',
   'country_name' => 'Morocco',
   'currebcy_name' => 'MAD'
]));

//var_dump($users->get(1));

//var_dump($users->delete(2));

// var_dump($users->insert([
//     '1' => 'John Doe',
// ]));