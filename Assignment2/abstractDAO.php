<?php

class abstractDAO {
    protected static $DB_HOST = "localhost";

    protected static $DB_USERNAME = "root";

    protected static $DB_PASSWORD = "";

    protected static $DB_DATABASE = "assignment2";

    protected $mysqli;


function __construct() {
    try{
        $this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME, 
            self::$DB_PASSWORD, self::$DB_DATABASE);
            echo "connection successful";
    }catch(mysqli_sql_exception $e){
        throw $e;
    }
}

public function getMysqli(){
    return $this->mysqli;
    
}
}
?>