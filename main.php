<?php

require "bdd.php";

echo "starting";

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";

    if ($line == "list") {
        echo var_dump($mysqlClient);
        foreach ($contacts as $contact) {
            //echo  $contact['id'] . $contact['name'] . $contact['email'] . $contact['phone_number'] ;
        }

    if ($line == "quit") {
        die();
    }

    }
}