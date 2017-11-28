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
 * Description of ProductKey
 *
 * @author Bert Maurau
 */
class ProductKey
{

    private $id; // integer

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

    public function getId()
    {
        return $this -> id;
    }

    public function setId($id)
    {
        $this -> id = $id;
        return $this;
    }

}

/**
 * Description of Product
 *
 * @author Bert Maurau
 */
class Product
{

    private $code; // array
    private $currencyCode; // string
    private $defaultBookingAccountNr; // integer
    private $defaultCostCentre; // costCentreKey
    private $description; // object
    private $externProductNr; // string
    private $priceVatExclusive; // float
    private $priceVatInclusive; // float
    private $productKey; // productKey
    private $supplierInfo; // string
    private $unit; // string
    private $vatCode; // string

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

    public function getId()
    {
        return $this -> productKey -> getId();
    }

    public function getCode()
    {
        return $this -> code;
    }

    public function getCurrencyCode()
    {
        return $this -> currencyCode;
    }

    public function getDefaultBookingAccountNr()
    {
        return $this -> defaultBookingAccountNr;
    }

    public function getDefaultCostCentre()
    {
        return $this -> defaultCostCentre;
    }

    public function getDescription()
    {
        return $this -> description;
    }

    public function getExternProductNr()
    {
        return $this -> externProductNr;
    }

    public function getPriceVatExclusive()
    {
        return $this -> priceVatExclusive;
    }

    public function getPriceVatInclusive()
    {
        return $this -> priceVatInclusive;
    }

    public function getProductKey()
    {
        return $this -> productKey;
    }

    public function getSupplierInfo()
    {
        return $this -> supplierInfo;
    }

    public function getUnit()
    {
        return $this -> unit;
    }

    public function getVatCode()
    {
        return $this -> vatCode;
    }

    public function setCode($code)
    {
        $this -> code = $code;
        return $this;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this -> currencyCode = $currencyCode;
        return $this;
    }

    public function setDefaultBookingAccountNr($defaultBookingAccountNr)
    {
        $this -> defaultBookingAccountNr = $defaultBookingAccountNr;
        return $this;
    }

    public function setDefaultCostCentre($defaultCostCentre)
    {
        $this -> defaultCostCentre = $defaultCostCentre;
        return $this;
    }

    public function setDescription($description)
    {
        $this -> description = new Description($description);
        return $this;
    }

    public function setExternProductNr($externProductNr)
    {
        $this -> externProductNr = $externProductNr;
        return $this;
    }

    public function setPriceVatExclusive($priceVatExclusive)
    {
        $this -> priceVatExclusive = $priceVatExclusive;
        return $this;
    }

    public function setPriceVatInclusive($priceVatInclusive)
    {
        $this -> priceVatInclusive = $priceVatInclusive;
        return $this;
    }

    public function setProductKey($productKey)
    {
        $this -> productKey = new ProductKey($productKey);
        return $this;
    }

    public function setSupplierInfo($supplierInfo)
    {
        $this -> supplierInfo = $supplierInfo;
        return $this;
    }

    public function setUnit($unit)
    {
        $this -> unit = $unit;
        return $this;
    }

    public function setVatCode($vatCode)
    {
        $this -> vatCode = $vatCode;
        return $this;
    }

}
