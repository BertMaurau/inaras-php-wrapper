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
 * Description of JournalKey
 *
 * @author Bert Maurau
 */
class JournalKey
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
 * Description of Journal
 *
 * @author Bert Maurau
 */
class Journal
{

    private $bookyearKey; // bookyearKey
    private $closed; // boolean
    private $closedPeriod; // integer
    private $journalKey; // string
    private $lastBookedDocumentNr; // integer
    private $name; // string
    private $protectedPeriod; // integer

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
        return $this -> journalKey -> getId();
    }

    public function getBookyearKey()
    {
        return $this -> bookyearKey;
    }

    public function getClosed()
    {
        return $this -> closed;
    }

    public function getClosedPeriod()
    {
        return $this -> closedPeriod;
    }

    public function getJournalKey()
    {
        return $this -> journalKey;
    }

    public function getLastBookedDocumentNr()
    {
        return $this -> lastBookedDocumentNr;
    }

    public function getName()
    {
        return $this -> name;
    }

    public function getProtectedPeriod()
    {
        return $this -> protectedPeriod;
    }

    public function setBookyearKey($bookyearKey)
    {
        $this -> bookyearKey = new Item\BookyearKey($bookyearKey);
        return $this;
    }

    public function setClosed($closed)
    {
        $this -> closed = $closed;
        return $this;
    }

    public function setClosedPeriod($closedPeriod)
    {
        $this -> closedPeriod = $closedPeriod;
        return $this;
    }

    public function setJournalKey($journalKey)
    {
        $this -> journalKey = new Item\JournalKey($journalKey);
        return $this;
    }

    public function setLastBookedDocumentNr($lastBookedDocumentNr)
    {
        $this -> lastBookedDocumentNr = $lastBookedDocumentNr;
        return $this;
    }

    public function setName($name)
    {
        $this -> name = $name;
        return $this;
    }

    public function setProtectedPeriod($protectedPeriod)
    {
        $this -> protectedPeriod = $protectedPeriod;
        return $this;
    }

}
