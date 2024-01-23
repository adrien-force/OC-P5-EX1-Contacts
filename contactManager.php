<?php

require_once 'db.php';

class ContactManager extends DBConnect
{

    function create($contact)
    {
        $mysqlClient = $this->getPDO();
        $sqlQuery = 'INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute([
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone_number' => $contact->getPhoneNumber()
        ]);
    }

    function delete($id)
    {
        $mysqlClient = $this->getPDO();
        $sqlQuery = 'DELETE FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
    }
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
