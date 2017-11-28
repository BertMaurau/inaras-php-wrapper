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
