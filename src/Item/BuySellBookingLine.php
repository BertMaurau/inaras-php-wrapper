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

namespace Octopus\Item;

/**
 * Description of BuySellBookingLine
 *
 * @author Bert Maurau
 */
class BuySellBookingLine
{

    private $accountKey; // int
    private $baseAmount; // double
    private $comment; // string
    private $costCentreKey; // costCentreKey
    private $vatAmount; // double
    private $vatCodeKey; // string

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

    public function getBaseAmount()
    {
        return $this -> baseAmount;
    }

    public function getComment()
    {
        return $this -> comment;
    }

    public function getCostCentreKey()
    {
        return $this -> costCentreKey;
    }

    public function getVatAmount()
    {
        return $this -> vatAmount;
    }

    public function getVatCodeKey()
    {
        return $this -> vatCodeKey;
    }

    public function setAccountKey($accountKey)
    {
        $this -> accountKey = $accountKey;
        return $this;
    }

    public function setBaseAmount($baseAmount)
    {
        $this -> baseAmount = $baseAmount;
        return $this;
    }

    public function setComment($comment)
    {
        $this -> comment = $comment;
        return $this;
    }

    public function setCostCentreKey($costCentreKey)
    {
        $this -> costCentreKey = new CostCentreKey($costCentreKey);
        return $this;
    }

    public function setVatAmount($vatAmount)
    {
        $this -> vatAmount = $vatAmount;
        return $this;
    }

    public function setVatCodeKey($vatCodeKey)
    {
        $this -> vatCodeKey = $vatCodeKey;
        return $this;
    }

}
