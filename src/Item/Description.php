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
 * Description of Description
 *
 * @author Bert Maurau
 */
class Description
{

    private $description_NL;
    private $description_FR;
    private $description_EN;

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

    public function get($locale = 'NL')
    {
        return $this -> {'description_' . $locale};
    }

    public function getDescription_NL()
    {
        return $this -> description_NL;
    }

    public function getDescription_FR()
    {
        return $this -> description_FR;
    }

    public function getDescription_EN()
    {
        return $this -> description_EN;
    }

    public function setDescription_NL($description_NL)
    {
        $this -> description_NL = $description_NL;
        return $this;
    }

    public function setDescription_FR($description_FR)
    {
        $this -> description_FR = $description_FR;
        return $this;
    }

    public function setDescription_EN($description_EN)
    {
        $this -> description_EN = $description_EN;
        return $this;
    }

}
