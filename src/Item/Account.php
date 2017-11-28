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
 * Description of Account
 *
 * @author Bert Maurau
 */
class Account
{

    private $accountKey;
    private $description;
    private $fiscProfessionalPercentage;
    private $fiscRecupPercentage;
    private $purchaseVatCode;
    private $salesVatCode;
    private $vatRecupPercentage;

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

    public function getAccountKey()
    {
        return $this -> accountKey;
    }

    public function getDescription()
    {
        return $this -> description;
    }

    public function getFiscProfessionalPercentage()
    {
        return $this -> fiscProfessionalPercentage;
    }

    public function getFiscRecupPercentage()
    {
        return $this -> fiscRecupPercentage;
    }

    public function getPurchaseVatCode()
    {
        return $this -> purchaseVatCode;
    }

    public function getSalesVatCode()
    {
        return $this -> salesVatCode;
    }

    public function getVatRecupPercentage()
    {
        return $this -> vatRecupPercentage;
    }

    public function setAccountKey($accountKey)
    {
        $this -> accountKey = $accountKey;
        return $this;
    }

    public function setDescription($description)
    {
        $this -> description = new Description($description);
        return $this;
    }

    public function setFiscProfessionalPercentage($fiscProfessionalPercentage)
    {
        $this -> fiscProfessionalPercentage = $fiscProfessionalPercentage;
        return $this;
    }

    public function setFiscRecupPercentage($fiscRecupPercentage)
    {
        $this -> fiscRecupPercentage = $fiscRecupPercentage;
        return $this;
    }

    public function setPurchaseVatCode($purchaseVatCode)
    {
        $this -> purchaseVatCode = $purchaseVatCode;
        return $this;
    }

    public function setSalesVatCode($salesVatCode)
    {
        $this -> salesVatCode = $salesVatCode;
        return $this;
    }

    public function setVatRecupPercentage($vatRecupPercentage)
    {
        $this -> vatRecupPercentage = $vatRecupPercentage;
        return $this;
    }

}
