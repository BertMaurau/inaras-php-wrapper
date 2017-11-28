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

namespace Octopus\Item;

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
