<?php 

namespace app\dao;

class Connect {


    private static $instance;
    private $pdo;

    private function __construct() {
        $this->pdo = new \PDO('mysql:host=localhost;dbname=hbouaffar_db','hbouaffar','root');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
    }

    public static function getInstance():\PDO {
        if (Connect::$instance == null) {
            Connect::$instance = new Connect();
        }
        return Connect::$instance->pdo;
    }
}

?>