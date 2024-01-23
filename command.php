<?php

class Command {

    function list() {
        echo "Liste des contacts :\n";
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        
        foreach ($contacts as $contact) {
            $contact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            echo $contact->__toString() . "\n";
        }
    }

    function detail($id) {

        if (!is_numeric($id)) {
            echo "L'id doit être un nombre.\n";
            return;
        }

        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);

        if ($contact) {
            $detailledContact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
            echo "Détail du contact :\n";
            echo $detailledContact->__toString() . "\n";
        } else {
            echo "Contact introuvable avec l'id : $id.\n";
        }
    }

    function create($name, $email, $phone_number) {
        $contactManager = new ContactManager();
        $contact = new Contact(null, $name, $email, $phone_number);
        $contactManager->create($contact);
        echo "Contact créé avec succès.\n";
    
}
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

    function modify($id, $name, $email, $phone_number) {
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