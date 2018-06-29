<?php
use Zeapps\Core\Routeur ;

// Route pour angularJS
Routeur::get('/com_zeapps_contact/companies/search', 'App\\com_zeapps_contact\\Controllers\\View@companiesSearch');


Routeur::get('/com_zeapps_contact/test', 'App\\com_zeapps_contact\\Controllers\\Test@index');
