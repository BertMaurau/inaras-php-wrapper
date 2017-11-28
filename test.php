<?php

error_reporting(E_ALL);

require_once 'src/Octopus.php';

require __DIR__ . '/vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv -> load();

$octopus = new \Octopus\Octopus();

$octopus -> setSoftwareHouseUuid(getenv("SOFTWAREHOUSE_UUID"))
        -> setCredentials(getenv("ACCOUNT_USER"), getenv("ACCOUNT_PASSWORD"))
        -> authenticate();
//var_dump($octopus -> getDossier());

$dossier = (new \Octopus\Item\Dossier())
        -> setDossierDescription('SoftTouch')
        -> setDossierKey((object) ['id' => 3768]);
try {
    $octopus -> setDossier($dossier) -> connect();
} catch (\Exception $ex) {
    echo "Failed to connect. Reason: " . $ex -> getMessage();
    exit();
}
\Octopus\dump($octopus -> getProducts());

$octopus -> close();
