<?php
require 'ContactManager.php';
require 'Contact.php';
require 'Command.php';

echo "\nBienvenue dans le gestionnaire de contacts.\n";
echo "Tapez help pour afficher la liste des commandes.\n";
for ($i = 0; $i < 3; $i++) {
    echo ".";
    sleep(1);
}
echo "\n";

while (true) {
    


    $line = readline("\nEntrez votre commande : ");
    echo "Vous avez saisi : $line\n \n";

    if ($line == "help") {
        echo "Liste des commandes :\n";
        echo "list : liste des contacts\n";
        echo "detail [id] : détail d'un contact\n";
        echo "create [name] [email] [phone_number] : créer un contact\n";
        echo "modify [id] [name] [email] [phone_number] : modifier un contact\n";
        echo "delete [id] : supprimer un contact\n";
        echo "exit : quitter le programme\n";
    }

    if ($line == "list") {
        $command = new Command();
        echo $command->list();
    }

    //add a detail command that understand the $id of the contact
    if (preg_match("/detail ([0-9a-zA-Z]+)/", $line, $matches)) {
        $id = $matches[1];
        $command = new Command();
        echo $command->detail($id);
    }

    if (preg_match("/create ([0-9a-zA-Z]+) ([0-9a-zA-Z@.]+) ([0-9+]+)/", $line, $matches)) {
        echo "Création d'un contact\n";
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];
        $command = new Command();
        echo $command->create($name, $email, $phone_number);
    }

    if (preg_match("/modify ([0-9a-zA-Z]+) ([0-9a-zA-Z]+) ([0-9a-zA-Z@.]+) ([0-9+]+)/", $line, $matches)) {
        $line2 = readline("Etes-vous sûr de vouloir modifier ce contact ? (o/n) : ");
        if ($line2 == "n") {
            echo "Modification annulée.\n";
            continue;
        }
        if ($line2 == "o") {
            $id = $matches[1];
            $name = $matches[2];
            $email = $matches[3];
            $phone_number = $matches[4];
            $command = new Command();
            echo $command->modify($id, $name, $email, $phone_number);
        }
    }

    if (preg_match("/delete ([0-9a-zA-Z]+)/", $line, $matches)) {

        $line2 = readline("Etes-vous sûr de vouloir supprimer ce contact ? (o/n) : ");
        if ($line2 == "n") {
            echo "Suppression annulée.\n";
            continue;
        }
        if ($line2 == "o") {
            $id = $matches[1];
            $command = new Command();
            echo $command->delete($id);
        }
    }
    if (!preg_match("/list|detail|create|modify|delete|exit|help/", $line)) {
        echo "Commande non reconnue. Tapez \"help\" pour afficher les commandes. \n";
    }

    if ($line == "exit") {
        break;
    }

}