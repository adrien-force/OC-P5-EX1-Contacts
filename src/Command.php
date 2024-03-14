<?php

/**
 * The Command class represents a set of commands for managing contacts.
 */
class Command {

    /**
     * Lists all the contacts.
     */
    function list() {
        echo "Liste des contacts :\n";
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        
        foreach ($contacts as $contact) {
            $contact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            echo $contact->__toString() . "\n";
        }
    }

    /**
     * Displays the details of a contact with the given ID.
     *
     * @param int $id The ID of the contact.
     */
    function detail($id) {

        if (!is_numeric($id)) {
            echo "L'id doit être un nombre.\n";
            return;
        }

        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);

        if ($contact) {
            $detailedContact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            echo "Détail du contact :\n";
            echo $detailedContact->__toString() . "\n";
        } else {
            echo "Contact introuvable avec l'id : $id.\n";
        }
    }

    /**
     * Creates a new contact with the given name, email, and phone number.
     *
     * @param string $name The name of the contact.
     * @param string $email The email of the contact.
     * @param string $phone_number The phone number of the contact.
     */
    function create($name, $email, $phone_number) {
        $contactManager = new ContactManager();
        $contact = new Contact(0, $name, $email, $phone_number);
        $contactManager->create($contact);
        echo "Contact créé avec succès.\n";
    }

    /**
     * Deletes the contact with the given ID.
     *
     * @param int $id The ID of the contact.
     */
    function delete($id) {
        if (!is_numeric($id)) {
            echo "L'id doit être un nombre.\n";
            return;
        }
        try {
            $contactManager = new ContactManager();
            $contactManager->delete($id);
            echo "Contact supprimé avec succès.\n";
        } catch (Exception $e) {
            echo "Contact introuvable avec l'id : $id.\n";
        }
    }

    /**
     * Modifies the contact with the given ID, name, email, and phone number.
     *
     * @param int $id The ID of the contact.
     * @param string $name The new name of the contact.
     * @param string $email The new email of the contact.
     * @param string $phone_number The new phone number of the contact.
     */
    function modify($id, $name, $email, $phone_number) {

        // Validates the contact details
        if (!is_numeric($id)) {
            echo "L'id doit être un nombre.\n";
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "L'email n'est pas valide.\n";
            return;
        }
        if (!preg_match("/[0-9+]+/", $phone_number)) {
            echo "Le numéro de téléphone n'est pas valide.\n";
            return;
        }
        if (strlen($phone_number) < 10) {
            echo "Le numéro de téléphone doit contenir au moins 10 chiffres.\n";
            return;
        }

        // Modifies the contact
        try {
            $contactManager = new ContactManager();
            $contact = new Contact($id, $name, $email, $phone_number);
            $contactManager->modify($contact);
            echo "Contact modifié avec succès.\n";
        } catch (Exception $e) {
            echo "Contact introuvable avec l'id : $id.\n";
        }
    }

}