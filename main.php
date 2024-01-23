<?php
require 'contactManager.php';
require 'contactAdmin.php';
require 'command.php';

while (true) {
    $line = readline("\nEntrez votre commande : ");
    echo "Vous avez saisi : $line\n";

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

    if ($line == "exit") {
        break;
    }

}