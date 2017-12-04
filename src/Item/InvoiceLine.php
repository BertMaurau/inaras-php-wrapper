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
 * Description of InvoiceLine
 *
 * @author Bert Maurau
 */
class InvoiceLine
{

    private $bookingAccountNr;
    private $costCentreKey;
    private $count;
    private $description;
    private $discountPercentage;
    private $externProductNr;
    private $unit;
    private $unitPrice;
    private $vatCodeKey;

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

    public function getBookingAccountNr()
    {
        return $this -> bookingAccountNr;
    }

    public function getCostCentreKey()
    {
        return $this -> costCentreKey;
    }

    public function getCount()
    {
        return $this -> count;
    }

    public function getDescription()
    {
        return $this -> description;
    }

    public function getDiscountPercentage()
    {
        return $this -> discountPercentage;
    }

    public function getExternProductNr()
    {
        return $this -> externProductNr;
    }

    public function getUnit()
    {
        return $this -> unit;
    }

    public function getUnitPrice()
    {
        return $this -> unitPrice;
    }

    public function getVatCodeKey()
    {
        return $this -> vatCodeKey;
    }

    public function setBookingAccountNr($bookingAccountNr)
    {
        $this -> bookingAccountNr = $bookingAccountNr;
        return $this;
    }

    public function setCostCentreKey($costCentreKey)
    {
        $this -> costCentreKey = new CostCentreKey($costCentreKey);
        return $this;
    }

    public function setCount($count)
    {
        $this -> count = $count;
        return $this;
    }

    public function setDescription($description)
    {
        $this -> description = $description;
        return $this;
    }

    public function setDiscountPercentage($discountPercentage)
    {
        $this -> discountPercentage = $discountPercentage;
        return $this;
    }

    public function setExternProductNr($externProductNr)
    {
        $this -> externProductNr = $externProductNr;
        return $this;
    }

    public function setUnit($unit)
    {
        $this -> unit = $unit;
        return $this;
    }

    public function setUnitPrice($unitPrice)
    {
        $this -> unitPrice = $unitPrice;
        return $this;
    }

    public function setVatCodeKey($vatCodeKey)
    {
        $this -> vatCodeKey = $vatCodeKey;
        return $this;
    }

}
