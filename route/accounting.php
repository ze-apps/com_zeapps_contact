<?php
use Zeapps\Core\Routeur ;

Routeur::get("/com_zeapps_contact/accounting_numbers/config", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@config');
Routeur::get("/com_zeapps_contact/accounting_numbers/form_modal", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@form_modal');

Routeur::post("/com_zeapps_contact/accounting_numbers/getAll/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@getAll');
Routeur::post("/com_zeapps_contact/accounting_numbers/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@modal');
Routeur::post("/com_zeapps_contact/accounting_numbers/save", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@save');
Routeur::post("/com_zeapps_contact/accounting_numbers/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@delete');

