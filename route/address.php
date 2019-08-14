<?php
use Zeapps\Core\Routeur ;

Routeur::post("/com_zeapps_contact/address/getText", 'App\\com_zeapps_contact\\Controllers\\Address@getText');
Routeur::post("/com_zeapps_contact/address/get", 'App\\com_zeapps_contact\\Controllers\\Address@get');




