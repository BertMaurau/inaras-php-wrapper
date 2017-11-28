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
 * Description of ProductGroupKey
 *
 * @author Bert Maurau
 */
class ProductGroupKey
{

    private $id; // integer

    public function __construct($id = null)
    {
        if ($id) {
            $this -> setId($id);
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
 * Description of ProductGroup
 *
 * @author Bert Maurau
 */
class ProductGroup
{

    private $description; // string
    private $productGroupKey; // productGroupKey

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

    public function getDescription()
    {
        return $this -> description;
    }

    public function getProductGroupKey()
    {
        return $this -> productGroupKey;
    }

    public function setDescription($description)
    {
        $this -> description = $description;
        return $this;
    }

    public function setProductGroupKey($productGroupKey)
    {
        $this -> productGroupKey = $productGroupKey;
        return $this;
    }

}
