<?php

require_once 'db.php';

class ContactManager extends DBConnect
{
    function findAll()
    {
        $mysqlClient = $this->getPDO();
        $sqlQuery = 'SELECT * FROM contact';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute();
        $contacts = $contactstatement->fetchAll(PDO::FETCH_ASSOC);

        
        return $contacts;
    }

    function findById($id)
    {
        
        $mysqlClient = $this->getPDO();
        $sqlQuery = 'SELECT * FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
        $contact = $contactstatement->fetch(PDO::FETCH_ASSOC);

        return $contact;
    }
}
