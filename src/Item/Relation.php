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

namespace Octopus\Item;

/**
 * Description of Relation
 *
 * @author Bert Maurau
 */
class Relation
{

    private $active; // boolean
    private $bankAccountNr; // string
    private $bicCode; // string
    private $city; // string
    private $client; // integer
    private $contactPerson; // string
    private $corporationType; // integer
    private $country; // string
    private $defaultBookingAccountClient; // integer
    private $defaultBookingAccountSupplier; // integer
    private $email; // string
    private $expirationDays; // integer
    private $expirationType; // integer
    private $externalRelationNr; // integer
    private $factLanguage; // integer
    private $fax; // string
    private $firstName; // string
    private $ibanAccountNr; // string
    private $mobile; // string
    private $name; // string
    private $postalCode; // string
    private $relationKey; // RelationKey
    private $remarks; // string
    private $searchField1; // string
    private $searchField2; // string
    private $streetAndNr; // string
    private $supplier; // integer
    private $telephone; // string
    private $url; // string
    private $vatNr; // string
    private $vatType; // integer

    public function __construct($properties = null)
    {
        if ($properties) {
            foreach ($properties as $key => $value) {
                if (property_exists($this, $key)) {
                    $this -> {'set' . ucfirst($key)}($value);
                }
            }
        }
    }

    public function getActive()
    {
        return $this -> active;
    }

    public function getBankAccountNr()
    {
        return $this -> bankAccountNr;
    }

    public function getBicCode()
    {
        return $this -> bicCode;
    }

    public function getCity()
    {
        return $this -> city;
    }

    public function getClient()
    {
        return $this -> client;
    }

    public function getContactPerson()
    {
        return $this -> contactPerson;
    }

    public function getCorporationType()
    {
        return $this -> corporationType;
    }

    public function getCountry()
    {
        return $this -> country;
    }

    public function getDefaultBookingAccountClient()
    {
        return $this -> defaultBookingAccountClient;
    }

    public function getDefaultBookingAccountSupplier()
    {
        return $this -> defaultBookingAccountSupplier;
    }

    public function getEmail()
    {
        return $this -> email;
    }

    public function getExpirationDays()
    {
        return $this -> expirationDays;
    }

    public function getExpirationType()
    {
        return $this -> expirationType;
    }

    public function getExternalRelationNr()
    {
        return $this -> externalRelationNr;
    }

    public function getFactLanguage()
    {
        return $this -> factLanguage;
    }

    public function getFax()
    {
        return $this -> fax;
    }

    public function getFirstName()
    {
        return $this -> firstName;
    }

    public function getIbanAccountNr()
    {
        return $this -> ibanAccountNr;
    }

    public function getMobile()
    {
        return $this -> mobile;
    }

    public function getName()
    {
        return $this -> name;
    }

    public function getPostalCode()
    {
        return $this -> postalCode;
    }

    public function getRelationKey()
    {
        return $this -> relationKey;
    }

    public function getRemarks()
    {
        return $this -> remarks;
    }

    public function getSearchField1()
    {
        return $this -> searchField1;
    }

    public function getSearchField2()
    {
        return $this -> searchField2;
    }

    public function getStreetAndNr()
    {
        return $this -> streetAndNr;
    }

    public function getSupplier()
    {
        return $this -> supplier;
    }

    public function getTelephone()
    {
        return $this -> telephone;
    }

    public function getUrl()
    {
        return $this -> url;
    }

    public function getVatNr()
    {
        return $this -> vatNr;
    }

    public function getVatType()
    {
        return $this -> vatType;
    }

    public function setActive($active)
    {
        $this -> active = $active;
        return $this;
    }

    public function setBankAccountNr($bankAccountNr)
    {
        $this -> bankAccountNr = $bankAccountNr;
        return $this;
    }

    public function setBicCode($bicCode)
    {
        $this -> bicCode = $bicCode;
        return $this;
    }

    public function setCity($city)
    {
        $this -> city = $city;
        return $this;
    }

    public function setClient($client)
    {
        $this -> client = $client;
        return $this;
    }

    public function setContactPerson($contactPerson)
    {
        $this -> contactPerson = $contactPerson;
        return $this;
    }

    public function setCorporationType($corporationType)
    {
        $this -> corporationType = $corporationType;
        return $this;
    }

    public function setCountry($country)
    {
        $this -> country = $country;
        return $this;
    }

    public function setDefaultBookingAccountClient($defaultBookingAccountClient)
    {
        $this -> defaultBookingAccountClient = $defaultBookingAccountClient;
        return $this;
    }

    public function setDefaultBookingAccountSupplier($defaultBookingAccountSupplier)
    {
        $this -> defaultBookingAccountSupplier = $defaultBookingAccountSupplier;
        return $this;
    }

    public function setEmail($email)
    {
        $this -> email = $email;
        return $this;
    }

    public function setExpirationDays($expirationDays)
    {
        $this -> expirationDays = $expirationDays;
        return $this;
    }

    public function setExpirationType($expirationType)
    {
        $this -> expirationType = $expirationType;
        return $this;
    }

    public function setExternalRelationNr($externalRelationNr)
    {
        $this -> externalRelationNr = $externalRelationNr;
        return $this;
    }

    public function setFactLanguage($factLanguage)
    {
        $this -> factLanguage = $factLanguage;
        return $this;
    }

    public function setFax($fax)
    {
        $this -> fax = $fax;
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this -> firstName = $firstName;
        return $this;
    }

    public function setIbanAccountNr($ibanAccountNr)
    {
        $this -> ibanAccountNr = $ibanAccountNr;
        return $this;
    }

    public function setMobile($mobile)
    {
        $this -> mobile = $mobile;
        return $this;
    }

    public function setName($name)
    {
        $this -> name = $name;
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this -> postalCode = $postalCode;
        return $this;
    }

    public function setRelationKey($relationKey)
    {
        $this -> relationKey = $relationKey;
        return $this;
    }

    public function setRemarks($remarks)
    {
        $this -> remarks = $remarks;
        return $this;
    }

    public function setSearchField1($searchField1)
    {
        $this -> searchField1 = $searchField1;
        return $this;
    }

    public function setSearchField2($searchField2)
    {
        $this -> searchField2 = $searchField2;
        return $this;
    }

    public function setStreetAndNr($streetAndNr)
    {
        $this -> streetAndNr = $streetAndNr;
        return $this;
    }

    public function setSupplier($supplier)
    {
        $this -> supplier = $supplier;
        return $this;
    }

    public function setTelephone($telephone)
    {
        $this -> telephone = $telephone;
        return $this;
    }

    public function setUrl($url)
    {
        $this -> url = $url;
        return $this;
    }

    public function setVatNr($vatNr)
    {
        $this -> vatNr = $vatNr;
        return $this;
    }

    public function setVatType($vatType)
    {
        $this -> vatType = $vatType;
        return $this;
    }

}
