<?php
namespace App\Controllers;

use PDO;
use PDOException;

class BaseController
{
    private $connection = null;

    protected function getConnection() {
        if ($this->connection !== null) {
            return $this->connection;
        }
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=dbname', 'admin', 'admin');
            return $this->connection;
        } catch (PDOException $e) {
            print "Error !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /** @return mixed */
    protected function view($viewPath, $data = null) {
        if ($data != null) {
            extract($data);
        }
        ob_start();
        require_once __DIR__.'/../../views/'. $viewPath . '.php';
        $pageContent = ob_get_contents();
        ob_end_clean();
        require_once __DIR__.'/../../views/partials/layout.php';
    }
}