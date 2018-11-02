<?php
use Zeapps\Core\Routeur ;

// Route pour angularJS
Routeur::get('/com_zeapps_contact/contacts/search', 'App\\com_zeapps_contact\\Controllers\\Contacts@search');
Routeur::get('/com_zeapps_contact/contacts/list_partial', 'App\\com_zeapps_contact\\Controllers\\Contacts@list_partial');
Routeur::get('/com_zeapps_contact/contacts/view', 'App\\com_zeapps_contact\\Controllers\\Contacts@view');
Routeur::get('/com_zeapps_contact/contacts/form_modal', 'App\\com_zeapps_contact\\Controllers\\Contacts@form_modal');
Routeur::get('/com_zeapps_contact/contacts/modal_contact', 'App\\com_zeapps_contact\\Controllers\\Contacts@modal_contact');
Routeur::get('/com_zeapps_contact/contacts/context/', 'App\\com_zeapps_contact\\Controllers\\Contacts@context');

Routeur::post("/com_zeapps_contact/contacts/getAll/{id_company}/{limit}/{offset}/{context}", 'App\\com_zeapps_contact\\Controllers\\Contacts@getAll');




Routeur::get("/com_zeapps_contact/contacts/get/{id}", 'App\\com_zeapps_contact\\Controllers\\Contacts@get');
Routeur::post("/com_zeapps_contact/contacts/modal/{id_company}/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Contacts@modal');
Routeur::post("/com_zeapps_contact/contacts/save/", 'App\\com_zeapps_contact\\Controllers\\Contacts@save');
Routeur::post("/com_zeapps_contact/contacts/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\Contacts@delete');
Routeur::post("/com_zeapps_contact/contacts/make_export/", 'App\\com_zeapps_contact\\Controllers\\Contacts@make_export');
Routeur::get("/com_zeapps_contact/contacts/get_export/", 'App\\com_zeapps_contact\\Controllers\\Contacts@get_export');



Routeur::get('/com_zeapps_contact/test', 'App\\com_zeapps_contact\\Controllers\\Contacts@test');