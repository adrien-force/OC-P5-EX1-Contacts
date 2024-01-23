<?php

class DBConnect 
{
    
    public function getPDO()
    {
        try {
            $mysqlClient = new PDO(
                'mysql:host=127.0.0.1:8889;dbname=p5-ex1',
                'admin',
                ''
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $mysqlClient;
    }
}