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
 * Description of Invoice
 *
 * @author Bert Maurau
 */
class Invoice
{

    private $bookyearKey;
    private $bookyearPeriodeNr;
    private $comment;
    private $currencyCode;
    private $documentDate;
    private $documentSequenceNr;
    private $exchangeRate;
    private $expiryDate;
    private $externalRelationId;
    private $financialDiscount;
    private $invoiceLines;
    private $journalKey;
    private $reference;

    public function __construct($properties = null)
    {
        $this -> invoiceLines = array();
        if ($properties) {
            foreach ($properties as $key => $value) {
                if (property_exists($this, $key)) {
                    $this -> {'set' . ucfirst($key)}($value);
                }
            }
        }
    }

    public function addInvoiceLine(InvoiceLine $invoiceLine)
    {
        array_push($this -> invoiceLines, $invoiceLine);
    }

    public function getBookyearKey()
    {
        return $this -> bookyearKey;
    }

    public function getBookyearPeriodeNr()
    {
        return $this -> bookyearPeriodeNr;
    }

    public function getComment()
    {
        return $this -> comment;
    }

    public function getCurrencyCode()
    {
        return $this -> currencyCode;
    }

    public function getDocumentDate()
    {
        return $this -> documentDate;
    }

    public function getDocumentSequenceNr()
    {
        return $this -> documentSequenceNr;
    }

    public function getExchangeRate()
    {
        return $this -> exchangeRate;
    }

    public function getExpiryDate()
    {
        return $this -> expiryDate;
    }

    public function getExternalRelationId()
    {
        return $this -> externalRelationId;
    }

    public function getFinancialDiscount()
    {
        return $this -> financialDiscount;
    }

    public function getInvoiceLines()
    {
        return $this -> invoiceLines;
    }

    public function getJournalKey()
    {
        return $this -> journalKey;
    }

    public function getReference()
    {
        return $this -> reference;
    }

    public function setBookyearKey($bookyearKey)
    {
        $this -> bookyearKey = new BookyearKey($bookyearKey);
        return $this;
    }

    public function setBookyearPeriodeNr($bookyearPeriodeNr)
    {
        $this -> bookyearPeriodeNr = $bookyearPeriodeNr;
        return $this;
    }

    public function setComment($comment)
    {
        $this -> comment = $comment;
        return $this;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this -> currencyCode = $currencyCode;
        return $this;
    }

    public function setDocumentDate($documentDate)
    {
        $this -> documentDate = $documentDate;
        return $this;
    }

    public function setDocumentSequenceNr($documentSequenceNr)
    {
        $this -> documentSequenceNr = $documentSequenceNr;
        return $this;
    }

    public function setExchangeRate($exchangeRate)
    {
        $this -> exchangeRate = $exchangeRate;
        return $this;
    }

    public function setExpiryDate($expiryDate)
    {
        $this -> expiryDate = $expiryDate;
        return $this;
    }

    public function setExternalRelationId($externalRelationId)
    {
        $this -> externalRelationId = $externalRelationId;
        return $this;
    }

    public function setFinancialDiscount($financialDiscount)
    {
        $this -> financialDiscount = $financialDiscount;
        return $this;
    }

    public function setInvoiceLines($invoiceLines)
    {
        if (count($invoiceLines) > 1) {
            foreach ($invoiceLines as $key => $invoiceLine) {
                $this -> addInvoiceLine(new InvoiceLine($invoiceLine));
            }
        } else {
            $this -> addInvoiceLine(new InvoiceLine($invoiceLines));
        }

        return $this;
    }

    public function setJournalKey($journalKey)
    {
        $this -> journalKey = $journalKey;
        return $this;
    }

    public function setReference($reference)
    {
        $this -> reference = $reference;
        return $this;
    }

}
