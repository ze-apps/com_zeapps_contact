<?php
use Zeapps\Core\Routeur ;

// Route pour angularJS
Routeur::get('/com_zeapps_contact/companies/search', 'App\\com_zeapps_contact\\Controllers\\View@companiesSearch');
Routeur::get('/com_zeapps_contact/companies/form_modal', 'App\\com_zeapps_contact\\Controllers\\View@companiesFormModal');
Routeur::get("/com_zeapps_contact/companies/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contact\\Controllers\\Companies@getAll');


Routeur::get('/com_zeapps_contact/test', 'App\\com_zeapps_contact\\Controllers\\Test@index');
