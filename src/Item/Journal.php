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
        $this -> bookyearKey = new BookyearKey($bookyearKey);
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
        $this -> journalKey = new JournalKey($journalKey);
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
