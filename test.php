<?php

/*
 * Copyright 2017 Bert Maurau | SoftTouch bvba.
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

require_once 'src/Octopus.php';

require __DIR__ . '/vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv -> load();

$octopus = new \Octopus\Octopus();

$octopus -> setSoftwareHouseUuid(getenv("SOFTWAREHOUSE_UUID"))
        -> setCredentials(getenv("ACCOUNT_USER"), getenv("ACCOUNT_PASSWORD"))
        -> authenticate();
//var_dump($octopus -> getDossier());

$dossier = (new \Octopus\Item\Dossier())
        -> setDossierDescription('SoftTouch')
        -> setDossierKey((object) ['id' => 3768]);

$octopus -> setDossier($dossier) -> connect();

\Octopus\dump($octopus -> getAccounts(new \Octopus\Item\BookyearKey(1)));

$octopus -> close();
