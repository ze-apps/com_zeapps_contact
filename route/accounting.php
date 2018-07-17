<?php
use Zeapps\Core\Routeur ;



Routeur::post("/com_zeapps_contact/accounting_numbers/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@modal');
Routeur::post("/com_zeapps_contact/accounting_numbers/save", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@save');
Routeur::get("/com_zeapps_contact/accounting_numbers/form_modal", 'App\\com_zeapps_contact\\Controllers\\AccountingNumbers@form_modal');