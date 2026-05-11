/*
* Author: Sean Boa
* Date: April 2026
*/

<?php



require_once(__DIR__ . '/../../../dbconfig.php');

class DatabaseHandler
{
    protected function connect() {
        try {
            $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}