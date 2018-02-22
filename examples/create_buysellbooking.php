<?php

/*
 * The MIT License
 *
 * Copyright 2018 Bert Maurau.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

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


// ============================================================================
//      Start
// ============================================================================

define('RELATION_PAY1', 1);
define('RELATION_PAY2', 2);
define('RELATION_PAY3', 3);
define('RELATION_PAY4', 4);
define('RELATION_PAY5', 5);
define('RELATION_PAY6', 6);
define('RELATION_PAY7', 7);
define('RELATION_PAY8', 8);
define('RELATION_PAY9', 9);

//ex.
$kasticket = (object) array(
            'ticketnr'    => 2010000260,
            'datum'       => '2017-10-26',
            't_tebetalen' => 28.00,
            't_betm1'     => 28.00,
            't_betm2'     => 0,
            't_betm3'     => 0,
            't_betm4'     => 0,
            't_betm5'     => 0,
            't_betm6'     => 0,
            't_betm7'     => 0,
            't_betm8'     => 0,
            't_betm9'     => 0,
);

$bookyearResult = $octopus -> getBookyearPeriodByDate($kasticket -> datum);


if (!$bookyearResult -> bookyearKey) {
    echo "No matching bookyearPeriod found for $dateToCompareWith. Terminating.<br>";
    exit;
} else {
    echo "Document will be booked w/ bookyearKey {$bookyearResult -> bookyearKey -> getId()} and bookyearPeriod {$bookyearResult -> bookyearPeriod}. <br>";
    exit;
}

// Next get all the journals and compare with given journal to fetch last document
$journalKey = getenv("JOURNAL_KEY");

$journals = $octopus -> getJournals($bookyearResult -> bookyearKey);
foreach ($journals as $key => $journal) {
    if ($journal -> getJournalKey() === $journalKey) {
        // get the doc nr
        $newDocumentNumber = ($journal -> getLastBookedDocumentNr()) + 1;
    }
}
$octopus -> close();



$booking = new \Octopus\Item\BuySellBooking;
$booking -> setAmount($kasticket -> t_tebetalen)
        -> setBookingLines($bookingLines)
        -> setBookyearKey($bookyearKey)
        -> setBookyearPeriodNr($bookyearPeriodNr)
        -> setComment('Ticket 123')
        -> setCurrencyCode($currencyCode)
        -> setDocumentDate($documentDate)
        -> setDocumentSequenceNr($newDocumentNumber)
        -> setExchangeRate($exchangeRate)
        -> setExpiryDate($expiryDate)
        -> setExternalRelationId($externalRelationId)
        -> setJournalKey($journalKey)
        -> setReference($reference)
        -> setRelationKey($relationKey);

$amount = 55.90;
