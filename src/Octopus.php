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

require_once __DIR__ . '\Exception\MissingValueException.php';

require_once __DIR__ . '\ReturnCodes.php';

require_once __DIR__ . '\Item\Credentials.php';

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
        $this -> soap = new \SoapClient(self::WS_URL);
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

        if (!property_exists($result -> return, 'dossierKey')) {
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
            "dossierKey" => $dossier -> $this -> getDossier() -> getDossierKey());

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

    /**
     * Create object with code and message for return codes
     * @param integer $code
     * @return object
     */
    private function getResponse($code)
    {
        return (object) ['code' => $code, 'message' => \Octopus\ReturnCodes::$codes[$code]];
    }

    public function setSoftwareHouseUuid($softwareHouseUuid)
    {
        $this -> softwareHouseUuid = $softwareHouseUuid;
        return $this;
    }

    public function getSoftwareHouseUuid()
    {
        return $this -> softwareHouseUuid;
    }

    public function setCredentials($user, $password)
    {
        $this -> credentials = (new Item\Credentials()) -> setUser($user) -> setPassword($password);
        return $this;
    }

    public function getCredentials()
    {
        return $this -> credentials;
    }

    public function getDossier()
    {
        return $this -> dossier;
    }

    public function setDossier(Item\Dossier $dossier)
    {
        $this -> dossier = $dossier;
        return $this;
    }

}
