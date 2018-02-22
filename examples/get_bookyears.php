<?php

error_reporting(E_ALL);

require_once '../src/Octopus.php';

require __DIR__ . '/../vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv -> load();

$octopus = new \Octopus\Octopus();

$octopus -> setSoftwareHouseUuid(getenv("SOFTWAREHOUSE_UUID"))
        -> setCredentials(getenv("ACCOUNT_USER"), getenv("ACCOUNT_PASSWORD"))
        -> authenticate();

$dossier = (new \Octopus\Item\Dossier())
        -> setDossierDescription(getenv("DOSSIER_NAME"))
        -> setDossierKey((object) ['id' => getenv("DOSSIER_ID")]);
try {
    $octopus -> setDossier($dossier) -> connect();
} catch (\Exception $ex) {
    echo "Failed to connect. Reason: " . $ex -> getMessage();
    exit();
}

//\Octopus\dump($octopus -> getAccounts((new \Octopus\Item\BookyearKey) -> setId(2)));
\Octopus\dump($octopus -> getVatCodes());

$octopus -> close();
