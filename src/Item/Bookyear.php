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
 * Description of BookyearKey
 *
 * @author Bert Maurau
 */
class BookyearKey
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
