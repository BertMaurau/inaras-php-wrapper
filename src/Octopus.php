<?php

/*
 * The MIT License
 *
 * Copyright 2017 Bert Maurau.
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

namespace Octopus;

use Octopus\Exception as Exception;
use Octopus\Item as Item;

session_start();

function dump($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

/**
 * Description of the main Octopus Class
 *
 * @author Bert Maurau
 */
class Octopus
{

    const WS_URL = 'https://service.inaras.be/OctopusService01-14/OctopusWSService?wsdl';

    private $softwareHouseUuid; // string
    private $credentials; // Credentials
    private $dossier; // Dossier

    public function __construct()
    {
        $this -> soap = new \SoapClient(self::WS_URL, array(
            'exceptions' => true,
        ));
    }

    /**
     * Get the bookyearKey and bookyearPeriod for the given date
     * @param string $date The date to compare with
     * @param boolean $showOutput to show output on the screen
     * @return object key and period
     */
    public function getBookyearPeriodByDate($date, $showOutput = false)
    {

        $dateCompare = strtotime($date);

        $bookyearKey = null;
        $bookyearPeriod = null;

        // Get all bookyears
        $bookyears = $this -> getBookyears();

        foreach ($bookyears as $key => $bookyear) {

            if ($showOutput) {
                echo "Checking bookyear {$bookyear -> getBookyearDescription()}. <br>";
            }

            // Loop the periods for current bookyear
            foreach ($bookyear -> getPeriods() as $key => $period) {

                if ($showOutput) {
                    echo " - Comparing {$period -> getStartDate()}  <  $date  <  {$period -> getEndDate()}. <br>";
                }

                // Check if period matches the given date
                if (strtotime($period -> getStartDate()) <= $dateCompare && strtotime($period -> getEndDate()) >= $dateCompare) {

                    $bookyearKey = $bookyear -> getBookyearKey();
                    $bookyearPeriod = $period -> getBookyearPeriod();

                    if ($showOutput) {
                        echo " - - Match: $bookyearPeriod. <br>";
                    }
                    return (object) array('bookyearKey' => $bookyearKey, 'bookyearPeriod' => $bookyearPeriod);
                }
            }
        }
        return (object) array('bookyearKey' => $bookyearKey, 'bookyearPeriod' => $bookyearPeriod);
    }

    /**
     * Authenticate with the service
     * @return response
     * @throws \Exception
     */
    public function authenticate()
    {

        // Check for sessionId first
        if (!$this -> getSoftwareHouseUuid()) {
            throw new Exception\MissingValueException('SoftwareHouseUuid', 'Authenticate');
        }
        // Check for sessionId first
        if (!$this -> getCredentials()) {
            throw new Exception\MissingValueException('Credentials', 'Authenticate');
        }

        $request = array(
            "softwareHouseUuid" => $this -> getSoftwareHouseUuid(),
            "credentials"       => $this -> getCredentials());

        try {
            $result = $this -> soap -> Authenticate($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($result -> return !== 0) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        } else {
            return $this;
        }
    }

    /**
     * Authenticate with the service and connect to given dossier
     * @return response
     * @throws \Exception
     */
    public function authenticateAndConnect()
    {

        // Check for SoftwareHouseUuid first
        if (!$this -> getSoftwareHouseUuid()) {
            throw new Exception\MissingValueException('SoftwareHouseUuid', 'Authenticate');
        }
        // Check for Credentials first
        if (!$this -> getCredentials()) {
            throw new Exception\MissingValueException('Credentials', 'Authenticate');
        }
        // Check for Credentials first
        if (!$this -> getDossier()) {
            throw new Exception\MissingValueException('Dossier', 'Authenticate');
        }

        $request = array(
            "softwareHouseUuid" => $this -> getSoftwareHouseUuid(),
            "credentials"       => $this -> getCredentials(),
            "dossierKey"        => $this -> getDossier() -> getDossierKey());

        try {
            $result = $this -> soap -> AuthenticateAndConnect($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($result -> return !== 0) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        } else {
            return $this;
        }
    }

    /**
     * Get the dossier
     * @todo Check how multiple dossiers gets return. Only access to one dossier atm and is returned as one object.
     * @return Dossier
     * @return response
     * @throws \Exception
     */
    public function getDossiers()
    {
        try {
            $result = $this -> soap -> GetDossiers();
        } catch (\Exception $ex) {
            throw $ex;
        }

        if (!isset($result -> return -> dossierKey)) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        }

        $dossier = (new Item\Dossier())
                -> setDossierDescription($result -> return -> dossierDescription)
                -> setDossierKey($result -> return -> dossierKey);

        return $dossier;
    }

    /**
     * Connect with the set Dossier
     * @return response
     * @throws \Exception
     */
    public function connect()
    {
        // Check for Credentials first
        if (!$this -> getDossier()) {
            throw new Exception\MissingValueException('Dossier', 'Authenticate');
        }

        $request = array(
            "dossierKey" => $this -> getDossier() -> getDossierKey());

        try {
            $result = $this -> soap -> ConnectToDossier($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($result -> return !== 0) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        } else {
            return $this;
        }
    }

    /**
     * Close to connected Dossier
     * @return response
     * @throws \Exception
     */
    public function close()
    {
        try {
            $result = $this -> soap -> CloseDossier();
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($result -> return !== 0) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        } else {
            return $this;
        }
    }

    //Get the accounts for a specific bookyear
    public function getAccounts(Item\BookyearKey $bookyearKey)
    {
        // Check for BOokyearkey first
        if (!$bookyearKey) {
            throw new Exception\MissingValueException('BookyearKey', 'Accounts');
        }

        $request = array(
            "bookyearKey" => $bookyearKey);

        try {
            $result = $this -> soap -> GetAccounts($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        // Check for array or 1 item
        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> accountKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $account) {
            $return[$key] = new Item\Account($account);
        }

        return $return;
    }

    /**
     * Get the bookyears in the current opened dossier
     * @return \Octopus\Item\Bookyear
     * @throws \Exception
     */
    public function getBookyears()
    {
        try {
            $result = $this -> soap -> GetBookyears();
        } catch (\Exception $ex) {
            throw $ex;
        }
        $return = array();
        // Check for array or 1 item
        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> bookyearKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $bookyear) {
            $return[$key] = new Item\Bookyear($bookyear);
        }

        return $return;
    }

    /**
     * Get the Jorunals in the current opened dossier
     * @param \Octopus\Item\BookyearKey $bookyearKey
     * @return \Octopus\Item\Journal
     * @throws Exception\MissingValueException
     * @throws \Exception
     */
    public function getJournals(Item\BookyearKey $bookyearKey)
    {
        // Check for BOokyearkey first
        if (!$bookyearKey) {
            throw new Exception\MissingValueException('BookyearKey', 'Journals');
        }

        $request = array(
            "bookyearKey" => $bookyearKey);

        try {
            $result = $this -> soap -> GetJournals($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();
        // Check for array or 1 item
        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> bookyearKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $journal) {
            $return[$key] = new Item\Journal($journal);
        }

        return $return;
    }

    /**
     * Set the locale of the user.
     * @param integer $locale
     * @return $this
     * @throws \Exception
     */
    public function setLocale($locale = 1)
    {
        if (!in_array($locale, [1, 2, 3])) {
            throw new \Exception("Locale must be a value of 1, 2, 3 (nl_BE = 1 , fr_BE = 2 , en_GB = 3)");
        }
        $request = array(
            "locale" => $locale);

        try {
            $result = $this -> soap -> SetLocale($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if ($result -> return != 0) {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        }

        return $this;
    }

    /**
     * Get a description of the supplied error. (Deprecated?)
     * ERROR: SOAP-ERROR: Encoding: object has no 'errorNr' property
     * @param type $errorNr
     * @return string
     * @throws \Exception
     */
    public function getErrorDescription($errorNr)
    {
        $request = array(
            "errorNr" => (int) $errorNr);

        try {
            $result = $this -> soap -> GetErrorDescription($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result -> return;
    }

    /**
     * Retrieves the last occured error.
     * @return type
     * @throws \Exception
     */
    public function getLastError()
    {
        try {
            $result = $this -> soap -> GetLastError();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result -> return;
    }

    /**
     * List the costcentres
     * @return \Octopus\Item\CostCentre
     * @throws \Exception
     */
    public function getCostCentres()
    {
        try {
            $result = $this -> soap -> GetCostCentres();
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();

        // Check for array or 1 item
        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> code)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $costcentre) {
            $return[$key] = new Item\CostCentre($costcentre);
        }

        return $return;
    }

    /**
     * List the Vatcodes
     * @return \Octopus\Item\VatCode
     * @throws \Exception
     */
    public function getVatCodes()
    {
        try {
            $result = $this -> soap -> GetVatCodes();
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();

        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> costCentreKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $vatcode) {
            $return[$key] = new Item\VatCode($vatcode);
        }

        return $return;
    }

    /**
     * List the Relations
     * @return \Octopus\Item\Relation
     * @throws \Exception
     */
    public function getRelations()
    {
        try {
            $result = $this -> soap -> GetRelations();
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();

        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> relationKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $relation) {
            $return[$key] = new Item\Relation($relation);
        }

        return $return;
    }

    /**
     * List the ProductGroups
     * @return \Octopus\Item\ProductGroup
     * @throws \Exception
     */
    public function getProductGroups()
    {
        try {
            $result = $this -> soap -> GetProductGroups();
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();

        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> productGroupKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $productgroup) {
            $return[$key] = new Item\ProductGroup($productgroup);
        }

        return $return;
    }

    /**
     * List the Products
     * @return \Octopus\Item\Product
     * @throws \Exception
     */
    public function getProducts()
    {
        try {
            $result = $this -> soap -> GetProducts();
        } catch (\Exception $ex) {
            throw $ex;
        }

        $return = array();

        if (count($result -> return) > 1) {
            // array
            $return = $result -> return;
        } else {
            if (!isset($result -> return -> productKey)) {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            } else {
                $return[0] = $result -> return;
            }
        }

        foreach ($return as $key => $product) {
            $return[$key] = new Item\Product($product);
        }

        return $return;
    }

    /**
     * Get specific invoice
     * @param integer $bookYearKey
     * @param string $journalKey
     * @param integer $documentNr
     * @return \Octopus\Item\Invoice
     * @throws Exception\MissingValueException
     * @throws \Exception
     */
    public function getInvoice(Item\BookyearKey $bookYearKey, $journalKey, $documentNr)
    {

        if (!$bookYearKey) {
            throw new Exception\MissingValueException('BookyearKey', 'Invoice');
        }
        if (!$journalKey) {
            throw new Exception\MissingValueException('JournalKey', 'Invoice');
        }
        if (!$documentNr) {
            throw new Exception\MissingValueException('DocumentNr', 'Invoice');
        }

        $request = array(
            "bookyearKey"        => $bookYearKey,
            "journalKey"         => $journalKey,
            "documentSequenceNr" => $documentNr,
        );

        try {
            $result = $this -> soap -> GetInvoice($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if (!isset($result -> return -> documentSequenceNr)) {
            if (!isset($result -> return)) {
                // Not found?
                $return = array();
            } else {
                throw new \Exception($this -> getResponse($result -> return) -> full);
            }
        } else {
            $return[0] = $result -> return;
        }

        foreach ($return as $key => $invoice) {
            $return[$key] = new Item\Invoice($invoice);
        }

        return $return;
    }

    /**
     * Insert a new Booking
     * @param \Octopus\Item\FinancialDiversBooking $financialDiversBooking
     * @return boolean
     * @throws Exception\MissingValueException
     * @throws \Exception
     */
    public function insertFinancialDiversBooking(Item\FinancialDiversBooking $financialDiversBooking)
    {
        if (!$financialDiversBooking) {
            throw new Exception\MissingValueException('Booking', 'InsertFinancialBooking');
        }

        $request = array(
            "booking" => $financialDiversBooking,
        );

        try {
            $result = $this -> soap -> InsertFinancialDiversBooking($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if (isset($result -> return) && $result -> return === 0) {
            return true;
        } else {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        }
    }

    /**
     * Insert a new BuySell Booking
     * @param \Octopus\Item\BuySellBooking $buySellBooking
     * @return boolean
     * @throws Exception\MissingValueException
     * @throws \Exception
     */
    public function insertBuySellBooking(Item\BuySellBooking $buySellBooking)
    {
        if (!$buySellBooking) {
            throw new Exception\MissingValueException('Booking', 'BuySellBooking');
        }

        $request = array(
            "booking" => $buySellBooking,
        );

        print_r($request);

        try {
            $result = $this -> soap -> InsertBuySellBooking($request);
        } catch (\Exception $ex) {
            throw $ex;
        }

        if (isset($result -> return) && $result -> return === 0) {
            return true;
        } else {
            throw new \Exception($this -> getResponse($result -> return) -> full);
        }
    }

    /**
     * On class destruct
     */
    public function __destruct()
    {
        try {
            $this -> close();
        } catch (Exception $ex) {
            // do nothingk
        }
    }

    /**
     * Create object with code and message for return codes
     * @param integer $code
     * @return object
     */
    private function getResponse($code)
    {
        return (object) ['code' => $code, 'message' => \Octopus\ReturnCodes::$codes[$code], 'full' => $this -> getLastError()];
    }

    //------------------------------------------------------------------------
    // Getters and Setters
    //------------------------------------------------------------------------
    /**
     * setSoftwareHouseUuid
     * @param string $softwareHouseUuid
     * @return $this
     */
    public function setSoftwareHouseUuid($softwareHouseUuid)
    {
        $this -> softwareHouseUuid = $softwareHouseUuid;
        return $this;
    }

    /**
     * getSoftwareHouseUuid
     * @return string
     */
    public function getSoftwareHouseUuid()
    {
        return $this -> softwareHouseUuid;
    }

    /**
     * setCredentials
     * @param string $user
     * @param string $password
     * @return $this
     */
    public function setCredentials($user, $password)
    {
        $this -> credentials = (new Item\Credentials()) -> setUser($user) -> setPassword($password);
        return $this;
    }

    /**
     * getCredentials
     * @return \Octopus\Item\Credentials
     */
    public function getCredentials()
    {
        return $this -> credentials;
    }

    /**
     * getDossier
     * @return \Octopus\Item\Dossier
     */
    public function getDossier()
    {
        return $this -> dossier;
    }

    /**
     * setDossier
     * @param \Octopus\Item\Dossier $dossier
     * @return $this
     */
    public function setDossier(Item\Dossier $dossier)
    {
        $this -> dossier = $dossier;
        return $this;
    }

}
