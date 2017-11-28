<?php

/*
 * Copyright 2017 Bert Maurau.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
            throw new \Exception($this -> getResponse($result -> return) -> message);
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
            "errorNr " => (int) $errorNr);

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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
                throw new \Exception($this -> getResponse($result -> return) -> message);
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
     * Create object with code and message for return codes
     * @param integer $code
     * @return object
     */
    private function getResponse($code)
    {
        return (object) ['code' => $code, 'message' => \Octopus\ReturnCodes::$codes[$code] /* , 'message' => $this -> getErrorDescription($code) */];
    }

    // Getters and Setters

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
