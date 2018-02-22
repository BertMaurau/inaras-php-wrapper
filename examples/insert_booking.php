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

$dateToCompareWith = date('Y-m-d\TH:i:sP');

// Start procedure
// Check the bookyears to see which bookyear needs to be selected
$bookyearResult = $octopus -> getBookyearPeriodByDate($dateToCompareWith, true);

$octopus -> close();

if (!$bookyearResult -> bookyearKey) {
    echo "No matching bookyearPeriod found for $dateToCompareWith. Terminating.<br>";
    exit;
} else {
    echo "Document will be booked w/ bookyearKey {$bookyearResult -> bookyearKey -> getId()} and bookyearPeriod {$bookyearResult -> bookyearPeriod}. <br>";
    exit;
}

// Next get all the journals and compare with given journal to fetch last document
$journalKey = getenv("JOURNAL_KEY");

$journals = $octopus -> getJournals($bookyearKey);
foreach ($journals as $key => $journal) {
    if ($journal -> getJournalKey() === $journalKey) {
        // get the doc nr
        $newDocumentNumber = ($journal -> getLastBookedDocumentNr()) + 1;
    }
}

echo "Document for $dateToCompareWith will be booked in $bookyearPeriod (Key: {$bookyearKey -> getId()}) w/ documentNr $newDocumentNumber.";

/*

  // create the booking
  $booking = (new \Octopus\Item\FinancialDiversBooking())
  -> setBookyearKey($bookyearKey)
  -> setBookyearPeriodeNr('201801')
  -> setDocumentDate(date('Y-m-d\TH:i:sP'))
  -> setDocumentSequenceNr($newDocumentNumber)
  -> setJournalKey($journalKey);

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
 */
//\Octopus\dump($journals);
/*


  $booking = new \Octopus\Item\FinancialDiversBooking;
  $booking -> setBookyearKey($bookyearKey)
  -> setBookyearPeriodeNr('201712')
  -> setDocumentDate(date('Y-m-d\TH:i:sP'))
  -> setDocumentSequenceNr(6)
  -> setJournalKey('V2');



  \Octopus\dump($octopus -> insertFinancialDiversBooking($booking));

  //\Octopus\dump($octopus -> getLastError());
 */
$octopus -> close();
