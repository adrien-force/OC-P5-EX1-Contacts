<?php

require 'config.php';

/**
 * Class DBConnect
 * Represents a database connection.
 */
class DBConnect 
{
    
    /**
     * Get the PDO object for the database connection.
     *
     * @return PDO The PDO object.
     */
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