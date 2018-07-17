<?php
use Zeapps\Core\Routeur ;

// Route pour angularJS
Routeur::get('/com_zeapps_contact/companies/search', 'App\\com_zeapps_contact\\Controllers\\View@companiesSearch');
Routeur::get('/com_zeapps_contact/companies/form_modal', 'App\\com_zeapps_contact\\Controllers\\View@companiesFormModal');
Routeur::get('/com_zeapps_contact/companies/modal_company', 'App\\com_zeapps_contact\\Controllers\\View@companiesModal');

Routeur::post("/com_zeapps_contact/companies/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contact\\Controllers\\Companies@getAll');

Routeur::post("/com_zeapps_contact/companies/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Companies@modal');
Routeur::post("/com_zeapps_contact/companies/context/", 'App\\com_zeapps_contact\\Controllers\\Companies@context');
Routeur::get("/com_zeapps_contact/companies/get/{id}", 'App\\com_zeapps_contact\\Controllers\\Companies@context');
Routeur::post("/com_zeapps_contact/companies/save", 'App\\com_zeapps_contact\\Controllers\\Companies@save');
Routeur::post("/com_zeapps_contact/companies/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\Companies@delete');
Routeur::post("/com_zeapps_contact/companies/make_export/", 'App\\com_zeapps_contact\\Controllers\\Companies@make_export');
Routeur::get("/com_zeapps_contact/companies/get_export/", 'App\\com_zeapps_contact\\Controllers\\Companies@get_export');





Routeur::get("/com_zeapps_contact/code_naf/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal');
Routeur::get("/com_zeapps_contact/code_naf/modal_code_naf", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal_code_naf');
Routeur::get("/com_zeapps_contact/code_naf/get/{id}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@get');
Routeur::post("/com_zeapps_contact/code_naf/getAll", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@getAll');






Routeur::post("/com_zeapps_contact/accounting_numbers/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@modal');
Routeur::post("/com_zeapps_contact/accounting_numbers/save", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@save');
Routeur::get("/com_zeapps_contact/accounting_numbers/form_modal", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@form_modal');



Routeur::get('/com_zeapps_contact/test', 'App\\com_zeapps_contact\\Controllers\\Test@index');
