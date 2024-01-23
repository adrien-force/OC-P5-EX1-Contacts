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

        echo "finito\n";
    }
}