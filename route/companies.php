<?php
use Zeapps\Core\Routeur ;


// Route pour angularJS
Routeur::get('/com_zeapps_contact/companies/search', 'App\\com_zeapps_contact\\Controllers\\View@companiesSearch');
Routeur::get('/com_zeapps_contact/companies/view', 'App\\com_zeapps_contact\\Controllers\\View@view');
Routeur::get('/com_zeapps_contact/companies/form_modal', 'App\\com_zeapps_contact\\Controllers\\View@companiesFormModal');
Routeur::get('/com_zeapps_contact/companies/modal_company', 'App\\com_zeapps_contact\\Controllers\\View@companiesModal');
Routeur::get('/com_zeapps_contact/companies/summary_partial', 'App\\com_zeapps_contact\\Controllers\\View@summary_partial');

Routeur::post("/com_zeapps_contact/companies/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_contact\\Controllers\\Companies@getAll');

Routeur::post("/com_zeapps_contact/companies/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Companies@modal');
Routeur::post("/com_zeapps_contact/companies/context/", 'App\\com_zeapps_contact\\Controllers\\Companies@context');
Routeur::get("/com_zeapps_contact/companies/get/{id}", 'App\\com_zeapps_contact\\Controllers\\Companies@get');
Routeur::post("/com_zeapps_contact/companies/save", 'App\\com_zeapps_contact\\Controllers\\Companies@save');
Routeur::post("/com_zeapps_contact/companies/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\Companies@delete');
Routeur::post("/com_zeapps_contact/companies/make_export/", 'App\\com_zeapps_contact\\Controllers\\Companies@make_export');
Routeur::get("/com_zeapps_contact/companies/get_export/", 'App\\com_zeapps_contact\\Controllers\\Companies@get_export');





Routeur::get("/com_zeapps_contact/code_naf/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal');
Routeur::get("/com_zeapps_contact/code_naf/modal_code_naf", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal_code_naf');
Routeur::get("/com_zeapps_contact/code_naf/get/{id}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@get');
Routeur::post("/com_zeapps_contact/code_naf/getAll", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@getAll');


Routeur::get("/com_zeapps_contact/country/get_all/", 'App\\com_zeapps_contact\\Controllers\\Country@get_all');
Routeur::post("/com_zeapps_contact/country/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Country@modal');
Routeur::post("/com_zeapps_contact/state/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\State@modal');





Routeur::get("/com_zeapps_contact/modalities/config", 'App\\com_zeapps_contact\\Controllers\\Modalities@config');
Routeur::get("/com_zeapps_contact/modalities/form_modal", 'App\\com_zeapps_contact\\Controllers\\Modalities@form_modal');
Routeur::get("/com_zeapps_contact/modalities/get/{id}", 'App\\com_zeapps_contact\\Controllers\\Modalities@get');
Routeur::get("/com_zeapps_contact/modalities/getAll/", 'App\\com_zeapps_contact\\Controllers\\Modalities@getAll');
Routeur::post("/com_zeapps_contact/modalities/save", 'App\\com_zeapps_contact\\Controllers\\Modalities@save');
Routeur::post("/com_zeapps_contact/modalities/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\Modalities@delete');









Routeur::get('/com_zeapps_contact/test', 'App\\com_zeapps_contact\\Controllers\\Test@index');