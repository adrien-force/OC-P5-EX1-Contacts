<?php

require 'config.php';

class DBConnect 
{
    
    public function getPDO()
    {
        $dbConfig = getConfig();

        try {
            $mysqlClient = new PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
                $dbConfig['user'],
                $dbConfig['password']
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $mysqlClient;
    }
}