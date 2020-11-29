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


        // Test
        $countries = [
            ['id' => 'USA',
            'country_name' => 'United State',    
            'currebcy_name' => 'USD'],
            [ 'id' => 'MA',
            'country_name' => 'Morocco',
            'currency_name' => 'MAD']
        ];
        
        // print_r($countries);
        
        foreach ($countries as $key => $value){
            
        foreach($value as $keyy => $val) {
                printf("%s\n", $val);
                $this->database->getReference()->getChild($this->dbname)->getChild($key)->getChild($keyy)->set($val);
           }
        }
    }

    // Get country by id 
    public function get(String $countryId = NULL){
        if (empty($countryId) || !isset($countryId)) { return FALSE; }

        if ($this->database->getReference($this->dbname)->getSnapshot()->hasChild($countryId)){
            return $this->database->getReference($this->dbname)->getChild($countryId)->getValue();
        } else {
            return FALSE;
        }
    }

    // Insert new country into firestore
    public function insert(array $data) {
        if (empty($data) || !isset($data)) { return FALSE; }

    
        foreach ($data as $key => $value){
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }

        return TRUE;
    }

    public function delete(string $countryId) {
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



// var_dump($countries->insert([
//    'id' => 'MA',
//    'country_name' => 'Morocco',
//    'currency_name' => 'MAD'
// ]));


$countries = [
    ['id' => 'USA',
    'country_name' => 'United State',    
    'currebcy_name' => 'USD'],
    [ 'id' => 'MA',
    'country_name' => 'Morocco',
    'currency_name' => 'MAD']
];



// var_dump($countries->insert($countries));

// var_dump($countries->get("MA"));

//var_dump($users->delete(2));

// var_dump($users->insert([
//     '1' => 'John Doe',
// ]));