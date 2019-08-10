<?php
use Zeapps\Core\Routeur ;

Routeur::get("/com_zeapps_contact/account_families/config", 'App\\com_zeapps_contact\\Controllers\\AccountFamilies@config');
Routeur::get("/com_zeapps_contact/account_families/form_modal", 'App\\com_zeapps_contact\\Controllers\\AccountFamilies@form_modal');


Routeur::get("/com_zeapps_contact/account_families/get_all", 'App\\com_zeapps_contact\\Controllers\\AccountFamilies@get_all');
Routeur::post("/com_zeapps_contact/account_families/save", 'App\\com_zeapps_contact\\Controllers\\AccountFamilies@save');
Routeur::post("/com_zeapps_contact/account_families/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\AccountFamilies@delete');

//Routeur::post("/com_zeapps_contact/accounting_numbers/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@modal');
//Routeur::post("/com_zeapps_contact/accounting_numbers/save", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@save');
