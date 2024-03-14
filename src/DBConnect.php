<?php

require 'config/config.php';

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

        // Get the database configuration settings
        $dbConfig = getConfig();

        // Create a new PDO object and return it
        try {
            $mysqlClient = new PDO(
                "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
                $dbConfig['user'],
                $dbConfig['password']
            );

        // If an error occurs, throw an Exception

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $mysqlClient;
    }
}