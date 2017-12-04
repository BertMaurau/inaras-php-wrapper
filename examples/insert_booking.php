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
        -> setDossierDescription('SoftTouch')
        -> setDossierKey((object) ['id' => 3768]);
try {
    $octopus -> setDossier($dossier) -> connect();
} catch (\Exception $ex) {
    echo "Failed to connect. Reason: " . $ex -> getMessage();
    exit();
}

$booking = new \Octopus\Item\FinancialDiversBooking;
$booking -> setBookyearKey((new \Octopus\Item\BookyearKey) -> setId(2))
        -> setBookyearPeriodeNr('201712')
        -> setDocumentDate(date('Y-m-d\TH:i:sP'))
        -> setDocumentSequenceNr(5)
        -> setJournalKey('V2');

$bookingLine = new \Octopus\Item\FinancialDiversBookingLine;
$bookingLine -> setAmount(20)
        -> setType('C')
        -> setReference('Testingk');

$booking -> addBookingLine($bookingLine);

$bookingLine = new \Octopus\Item\FinancialDiversBookingLine;
$bookingLine -> setAmount(-20)
        -> setType('C')
        -> setReference('Afpuntingk Testingk');

$booking -> addBookingLine($bookingLine);

\Octopus\dump($octopus -> insertFinancialDiversBooking($booking));

//\Octopus\dump($octopus -> getLastError());

$octopus -> close();
