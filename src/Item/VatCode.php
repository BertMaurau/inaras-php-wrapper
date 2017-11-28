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
