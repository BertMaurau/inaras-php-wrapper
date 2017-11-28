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
 * Description of Bookyear
 *
 * @author Bert Maurau
 */
class Bookyear
{

    private $bookyearDescription; // String
    private $bookyearKey; // DossierKey
    private $closed; // boolean
    private $endData; // Date
    private $periods; //array
    private $startDate; // Date

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
        return $this -> bookyearKey -> getId();
    }

    public function getBookyearDescription()
    {
        return $this -> bookyearDescription;
    }

    public function getBookyearKey()
    {
        return $this -> bookyearKey;
    }

    public function getClosed()
    {
        return $this -> closed;
    }

    public function getEndData()
    {
        return $this -> endData;
    }

    public function getPeriods()
    {
        return $this -> periods;
    }

    public function getStartDate()
    {
        return $this -> startDate;
    }

    public function setBookyearDescription($bookyearDescription)
    {
        $this -> bookyearDescription = $bookyearDescription;
        return $this;
    }

    public function setBookyearKey($bookyearKey)
    {
        $this -> bookyearKey = new BookyearKey($bookyearKey);
        return $this;
    }

    public function setClosed($closed)
    {
        $this -> closed = $closed;
        return $this;
    }

    public function setEndData($endData)
    {
        $this -> endData = $endData;
        return $this;
    }

    public function setPeriods($periods)
    {
        foreach ($periods as $key => $period) {
            $this -> periods[$period -> bookyearPeriod] = new BookyearPeriod($period);
        }
        return $this;
    }

    public function setStartDate($startDate)
    {
        $this -> startDate = $startDate;
        return $this;
    }

}

/**
 * Description of BookyearPeriod
 *
 * @author Bert Maurau
 */
class BookyearPeriod
{

    private $bookyearPeriod; // integer
    private $endDate; // Date
    private $startDate; // Date

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

    public function getBookyearPeriod()
    {
        return $this -> bookyearPeriod;
    }

    public function getEndDate()
    {
        return $this -> endDate;
    }

    public function getStartDate()
    {
        return $this -> startDate;
    }

    public function setBookyearPeriod($bookyearPeriod)
    {
        $this -> bookyearPeriod = $bookyearPeriod;
        return $this;
    }

    public function setEndDate($endDate)
    {
        $this -> endDate = $endDate;
        return $this;
    }

    public function setStartDate($startDate)
    {
        $this -> startDate = $startDate;
        return $this;
    }

}
