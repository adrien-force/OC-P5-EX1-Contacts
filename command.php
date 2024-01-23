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
        
        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);
        
        $detailledContact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone_number']);
        echo "Détail du contact :\n";
        echo $detailledContact->__toString() . "\n";
    }
}