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
