<?php

require 'DBConnect.php';

class ContactManager extends DBConnect
{
    private $mysqlClient;

    private function getMysqlClient()
    {
        if ($this->mysqlClient === null) {
            $this->mysqlClient = $this->getPDO();
        }

        return $this->mysqlClient;
    }
    function create($contact)
    {
        $mysqlClient = $this->getMysqlClient();
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
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'DELETE FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
    }
    function findAll()
    {
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'SELECT * FROM contact';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute();
        $contacts = $contactstatement->fetchAll(PDO::FETCH_ASSOC);

        
        return $contacts;
    }

    function findById($id)
    {
        
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'SELECT * FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
        $contact = $contactstatement->fetch(PDO::FETCH_ASSOC);

        return $contact;
    }

    function modify($contact)
    {
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'UPDATE contact SET name = :name, email = :email, phone_number = :phone_number WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute([
            'id' => $contact->getId(),
            'name' => $contact->getName(),
            'email' => $contact->getEmail(),
            'phone_number' => $contact->getPhoneNumber()
        ]);
    }
}
