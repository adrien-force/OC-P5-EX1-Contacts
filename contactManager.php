<?php

/**
 * Class ContactManager
 * 
 * This class is responsible for managing contacts in the database.
 * It extends the DBConnect class to establish a connection with the database.
 */


require 'DBConnect.php';

class ContactManager extends DBConnect
{
    /**
     * @var PDO|null The MySQL client instance.
     */
    private $mysqlClient;

    /**
     * Get the MySQL client instance.
     * If the instance is not already created, it creates a new instance.
     * 
     * @return PDO The MySQL client instance.
     */
    private function getMysqlClient()
    {
        if ($this->mysqlClient === null) {
            $this->mysqlClient = $this->getPDO();
        }

        return $this->mysqlClient;
    }

    /**
     * Create a new contact in the database.
     * 
     * @param Contact $contact The contact object to be created.
     * @return void
     */
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

    /**
     * Delete a contact from the database by its ID.
     * 
     * @param int $id The ID of the contact to be deleted.
     * @return void
     */
    function delete($id)
    {
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'DELETE FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
    }

    /**
     * Retrieve all contacts from the database.
     * 
     * @return array An array of contacts.
     */
    function findAll()
    {
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'SELECT * FROM contact';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute();
        $contacts = $contactstatement->fetchAll(PDO::FETCH_ASSOC);

        return $contacts;
    }

    /**
     * Retrieve a contact from the database by its ID.
     * 
     * @param int $id The ID of the contact to be retrieved.
     * @return array|null The contact details as an associative array, or null if not found.
     */
    function findById($id)
    {
        $mysqlClient = $this->getMysqlClient();
        $sqlQuery = 'SELECT * FROM contact WHERE id = :id';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute(['id' => $id]);
        $contact = $contactstatement->fetch(PDO::FETCH_ASSOC);

        return $contact;
    }

    /**
     * Modify an existing contact in the database.
     * 
     * @param Contact $contact The contact object to be modified.
     * @return void
     */
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
