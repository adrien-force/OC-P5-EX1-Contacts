<?php

require "bdd.php";

class contactManager
{

    function findAll()
    {

        $sqlQuery = 'SELECT * FROM contact';
        $contactstatement = $mysqlClient->prepare($sqlQuery);
        $contactstatement->execute();
        $contacts = $contactstatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
