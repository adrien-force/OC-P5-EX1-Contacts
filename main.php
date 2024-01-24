<?php

/**
 * This script is the main entry point for the contact management application.
 * It provides a command-line interface for interacting with the ContactManager class.
 * The user can perform various operations such as listing contacts, creating a new contact,
 * modifying an existing contact, deleting a contact, and viewing contact details.
 * The script uses the Command class to parse user commands and execute the corresponding actions.
 * The ContactManager class is responsible for managing the contacts and performing the requested operations.
 * The Contact class represents an individual contact with properties such as name, email, and phone number.
 * The script runs in an infinite loop until the user enters the "exit" command to quit the program.
 * During each iteration of the loop, the user is prompted to enter a command, and the script processes it accordingly.
 * If the user enters an invalid command, an error message is displayed.
 */

require 'src/ContactManager.php';
require 'src/Contact.php';
require 'src/Command.php';

echo "\nBienvenue dans le gestionnaire de contacts.\n";
echo "Tapez help pour afficher la liste des commandes.\n";
for ($i = 0; $i < 3; $i++) {
    echo ".";
    sleep(1);
}
echo "\n";

while (true) {
    // Prompt the user to enter a command
    $line = readline("\nEntrez votre commande : ");
    echo "Vous avez saisi : $line\n \n";

    // Process the user command
    if ($line == "help") {
        // Display the list of available commands
        echo "Liste des commandes :\n";
        echo "list : liste des contacts\n";
        echo "detail [id] : détail d'un contact\n";
        echo "create [name] [email] [phone_number] : créer un contact\n";
        echo "modify [id] [name] [email] [phone_number] : modifier un contact\n";
        echo "delete [id] : supprimer un contact\n";
        echo "exit : quitter le programme\n";
    }
    // Process the user command and display the list of contacts
    if ($line == "list") {
        // Create a new Command object and call the list() method
        $command = new Command();
        echo $command->list();
    }
    // Process the user command and display the details of the contact with the given ID
    if (preg_match("/detail ([0-9a-zA-Z]+)/", $line, $matches)) {
        // Extract the contact ID from the command and call the detail() method
        $id = $matches[1];
        $command = new Command();
        echo $command->detail($id);
    }
    // Process the user command and create a new contact
    if (preg_match("/create ([0-9a-zA-Z]+) ([0-9a-zA-Z@.]+) ([0-9+]+)/", $line, $matches)) {
        // Extract the contact details from the command and call the create() method
        echo "Création d'un contact\n";
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];
        $command = new Command();
        echo $command->create($name, $email, $phone_number);
    }
    // Process the user command and modify an existing contact
    if (preg_match("/modify ([0-9a-zA-Z]+) ([0-9a-zA-Z]+) ([0-9a-zA-Z@.]+) ([0-9+]+)/", $line, $matches)) {
        // Prompt the user for confirmation before modifying the contact
        $line2 = readline("Etes-vous sûr de vouloir modifier ce contact ? (o/n) : ");
        if ($line2 == "n") {
            echo "Modification annulée.\n";
            continue;
        }
        if ($line2 == "o") {
            // Extract the contact details from the command and call the modify() method
            $id = $matches[1];
            $name = $matches[2];
            $email = $matches[3];
            $phone_number = $matches[4];
            $command = new Command();
            echo $command->modify($id, $name, $email, $phone_number);
        }
    }

    // Process the user command and delete an existing contact
    if (preg_match("/delete ([0-9a-zA-Z]+)/", $line, $matches)) {
        // Prompt the user for confirmation before deleting the contact
        $line2 = readline("Etes-vous sûr de vouloir supprimer ce contact ? (o/n) : ");
        if ($line2 == "n") {
            echo "Suppression annulée.\n";
            continue;
        }
        if ($line2 == "o") {
            // Extract the contact ID from the command and call the delete() method
            $id = $matches[1];
            $command = new Command();
            echo $command->delete($id);
        }
    }

    // Display an error message for unrecognized commands
    if (!preg_match("/list|detail|create|modify|delete|exit|help/", $line)) {
        echo "Commande non reconnue. Tapez \"help\" pour afficher les commandes. \n";
    }

    // Exit the loop and terminate the program
    if ($line == "exit") {
        break;
    }
}