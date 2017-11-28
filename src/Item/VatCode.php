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
 * Description of VatCode
 *
 * @author Bert Maurau
 */
class VatCode
{

    private $basePercentage; // integer
    private $code; // string
    private $defaultSellBookingAccountNr; // integer
    private $description; // string
    private $type; // integer

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

    public function getBasePercentage()
    {
        return $this -> basePercentage;
    }

    public function getCode()
    {
        return $this -> code;
    }

    public function getDefaultSellBookingAccountNr()
    {
        return $this -> defaultSellBookingAccountNr;
    }

    public function getDescription()
    {
        return $this -> description;
    }

    public function getType()
    {
        return $this -> type;
    }

    public function setBasePercentage($basePercentage)
    {
        $this -> basePercentage = $basePercentage;
        return $this;
    }

    public function setCode($code)
    {
        $this -> code = $code;
        return $this;
    }

    public function setDefaultSellBookingAccountNr($defaultSellBookingAccountNr)
    {
        $this -> defaultSellBookingAccountNr = $defaultSellBookingAccountNr;
        return $this;
    }

    public function setDescription($description)
    {
        $this -> description = $description;
        return $this;
    }

    public function setType($type)
    {
        $this -> type = $type;
        return $this;
    }

}
