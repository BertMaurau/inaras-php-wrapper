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

namespace Octopus;

/**
 * Description of ErrorCodes
 *
 * @author Bert Maurau
 */
class ReturnCodes
{

    public static $codes = array(
        '0'   => 'CODE_OK',
        '-28' => 'ERR_ACCOUNT_ALREADY_EXIST',
        '-50' => 'ERR_ACCOUNT_NOT_BOOKING_TYPE',
        '-23' => 'ERR_BOOKING_LINE_BASE_VAT_OTHER_SIGN',
        '-34' => 'ERR_BOOKING_NOT_EXISTS',
        '-15' => 'ERR_BOOKYEAR_PERIOD_NR_PROTECTED',
        '-52' => 'ERR_CLOSE_DOSSIER',
        '-1'  => 'ERR_CODE_INVALID_LOGIN',
        '-41' => 'ERR_COST_CENTRE_CLOSED',
        '-59' => 'ERR_DELIVERY_NOTE_NOT_EXISTS',
        '-5'  => 'ERR_DOSSIER_DISABLED',
        '-72' => 'ERR_EXPORT_DELIVERY_NOTE',
        '-71' => 'ERR_EXPORT_INVOICE',
        '-74' => 'ERR_EXPORT_RAPPEL',
        '-44' => 'ERR_GET_ACCOUNTS',
        '-33' => 'ERR_GET_BOOKING',
        '-8'  => 'ERR_GET_BOOKYEARS',
        '-45' => 'ERR_GET_COSTCENTRES',
        '-60' => 'ERR_GET_DELIVERY_NOTE',
        '-67' => 'ERR_GET_FINANCIAL_JOURNAL_BALANCE',
        '-62' => 'ERR_GET_INVOICE',
        '-36' => 'ERR_GET_JOURNALS',
        '-77' => 'ERR_GET_MODIFIED_ACCOUNT_AMOUNTS',
        '-65' => 'ERR_GET_MODIFIED_BALANCING_RELATIONS',
        '-48' => 'ERR_GET_PRODUCTGROUPS',
        '-46' => 'ERR_GET_PRODUCTS',
        '-47' => 'ERR_GET_RELATIONS',
        '-42' => 'ERR_GET_VATCODES',
        '-13' => 'ERR_ILLEGAL_DOCUMENT_SEQUENCE_NR',
        '-20' => 'ERR_ILLEGAL_EXCHANGE_RATE',
        '-27' => 'ERR_INSERT_ACCOUNT',
        '-26' => 'ERR_INSERT_BALANCING',
        '-24' => 'ERR_INSERT_BOOKING',
        '-43' => 'ERR_INSERT_DELIVERY_NOTE',
        '-37' => 'ERR_INSERT_INVOICE',
        '-49' => 'ERR_INSERT_PRODUCT',
        '-76' => 'ERR_INSERT_UPDATE_COSTCENTRE',
        '-7'  => 'ERR_INSERT_UPDATE_RELATION',
        '-38' => 'ERR_INVALID_JOURNAL',
        '-79' => 'ERR_INVALID_PARAMETER',
        '-31' => 'ERR_INVALID_PERCENTAGE_FISC_PROF',
        '-32' => 'ERR_INVALID_PERCENTAGE_FISC_RECUP',
        '-30' => 'ERR_INVALID_PERCENTAGE_VAT_RECUP',
        '-68' => 'ERR_INVALID_SOFTWARE_HOUSE_IDENTIFICATION',
        '-61' => 'ERR_INVOICE_NOT_EXISTS',
        '-11' => 'ERR_JOURNAL_CLOSED',
        '-12' => 'ERR_JOURNAL_OPEN',
        '-29' => 'ERR_JOURNAL_WRONG_MODE',
        '-78' => 'ERR_MISSING_CODA_VERSION_INFO',
        '-3'  => 'ERR_NO_ACCESS_TO_DOSSIER',
        '-17' => 'ERR_NO_DOCUMENT_DATE',
        '-6'  => 'ERR_NO_DOSSIER_OPEN',
        '-18' => 'ERR_NO_EXPIRY_DATE',
        '-2'  => 'ERR_NOT_AUTHENTICATED',
        '-4'  => 'ERR_OPEN_DOSSIER',
        '-73' => 'ERR_RAPPEL_NOT_EXISTS',
        '-55' => 'ERR_REPORT_HISTORY_ACCOUNT',
        '-54' => 'ERR_REPORT_HISTORY_CLIENT',
        '-66' => 'ERR_REPORT_HISTORY_COSTCENTRE',
        '-53' => 'ERR_REPORT_HISTORY_SUPPLIER',
        '-58' => 'ERR_REPORT_OPEN_ACCOUNT',
        '-57' => 'ERR_REPORT_OPEN_CLIENT',
        '-56' => 'ERR_REPORT_OPEN_SUPPLIER',
        '-69' => 'ERR_SET_CONFIG_FINANCIAL_DISCOUNT',
        '-70' => 'ERR_SET_RAPPEL_PERCENTAGE',
        '-51' => 'ERR_TO_MANY_CONNECTIONS',
        '-25' => 'ERR_UKNOWN_FINANCIAL_TYPE',
        '-21' => 'ERR_UNKNOWN_ACCOUNT',
        '-9'  => 'ERR_UNKNOWN_BOOKYEAR',
        '-14' => 'ERR_UNKNOWN_BOOKYEAR_PERIOD_NR',
        '-40' => 'ERR_UNKNOWN_COST_CENTRE',
        '-19' => 'ERR_UNKNOWN_CURRENCY',
        '-10' => 'ERR_UNKNOWN_JOURNAL',
        '-39' => 'ERR_UNKNOWN_PRODUCT',
        '-16' => 'ERR_UNKNOWN_RELATION',
        '-22' => 'ERR_UNKNOWN_VATCODE',
        '-35' => 'ERR_UPDATE_BOOKING',
        '-63' => 'ERR_UPDATE_DELIVERY_NOTE',
        '-64' => 'ERR_UPDATE_INVOICE',
        '-75' => 'ERR_VATCODE_WRONG_TYPE'
    );

}
