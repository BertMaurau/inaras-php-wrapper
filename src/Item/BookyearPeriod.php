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
