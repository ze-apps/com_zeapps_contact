<?php

namespace App\com_zeapps_contact\Models;

class Address {
    public $company = "" ;
    public $civility = "" ;
    public $first_name = "" ;
    public $last_name = "" ;
    public $address_1 = "" ;
    public $address_2 = "" ;
    public $address_3 = "" ;
    public $city = "" ;
    public $zipcode = "" ;
    public $state_id = "" ;
    public $state = "" ;
    public $country_id = "" ;
    public $country_name = "" ;
    public $email = "" ;
    public $phone = "" ;
    public $fax = "" ;

    public static function getAddresseObject($id_company, $id_address_company = 0, $id_contact = 0, , $id_address_contact = 0, $typeAdresse = "billing") {
        $adresse = new Address() ;
        $objCompany = null;
        $objCompaniesAddress = null;
        $objContact = null;
        $objContactAddress = null;

        // load company
        if ($id_company) {
            $objCompany = Companies::find($id_company);
        }

        // load company
        if ($id_address_company) {
            $objCompaniesAddress = CompaniesAddresses::find($id_address_company);
        }



        // load contact
        if ($id_contact) {
            $objContact = Contacts::find($id_contact);
        }


        // load company
        if ($id_address_contact) {
            $objContactAddress = ContactAddresses::find($id_address_contact);
        }


        if ($objCompaniesAddress) {
            $adresse->company = $objCompaniesAddress->company_name ;
            $adresse->civility = $objCompaniesAddress->title_name ;
            $adresse->first_name = $objCompaniesAddress->first_name ;
            $adresse->last_name = $objCompaniesAddress->last_name ;
            $adresse->address_1 = $objCompaniesAddress->address_1 ;
            $adresse->address_2 = $objCompaniesAddress->address_2 ;
            $adresse->address_3 = $objCompaniesAddress->address_3 ;
            $adresse->city = $objCompaniesAddress->city ;
            $adresse->zipcode = $objCompaniesAddress->zipcode ;
            $adresse->state_id = $objCompaniesAddress->state_id ;
            $adresse->state = $objCompaniesAddress->state ;
            $adresse->country_id = $objCompaniesAddress->country_id ;
            $adresse->country_name = $objCompaniesAddress->country_name ;
            $adresse->email = $objCompaniesAddress->email ;
            $adresse->phone = $objCompaniesAddress->phone ;
            $adresse->fax = $objCompaniesAddress->fax ;

            if (trim($adresse->company) == "" && trim($adresse->first_name) == "" && trim($adresse->last_name) == "") {
                if ($objCompany) {
                    $adresse->company = $objCompany->company_name ;
                }

                if ($objContact) {
                    $adresse->first_name = $objContact->first_name ;
                    $adresse->last_name = $objContact->last_name ;
                }
            }

        } else if ($objCompany) {
            $address_1 = $typeAdresse . "_address_1" ;
            $address_2 = $typeAdresse . "_address_2" ;
            $address_3 = $typeAdresse . "_address_3" ;
            $city = $typeAdresse . "_city" ;
            $zipcode = $typeAdresse . "_zipcode" ;
            $state_id = $typeAdresse . "_state_id" ;
            $state = $typeAdresse . "_state" ;
            $country_id = $typeAdresse . "_country_id" ;
            $country_name = $typeAdresse . "_country_name" ;

            $adresse->company = $objCompany->company_name ;
            $adresse->civility = "" ;
            $adresse->first_name = "" ;
            $adresse->last_name = "" ;
            $adresse->address_1 = $objCompany->$address_1 ;
            $adresse->address_2 = $objCompany->$address_2 ;
            $adresse->address_3 = $objCompany->$address_3 ;
            $adresse->city = $objCompany->$city ;
            $adresse->zipcode = $objCompany->$zipcode ;
            $adresse->state_id = $objCompany->$state_id ;
            $adresse->state = $objCompany->$state ;
            $adresse->country_id = $objCompany->$country_id ;
            $adresse->country_name = $objCompany->$country_name ;
            $adresse->email = $objCompany->email ;
            $adresse->phone = $objCompany->phone ;
            $adresse->fax = $objCompany->fax ;

        } else if ($objContactAddress) {
            $adresse->company = $objContactAddress->company_name ;
            $adresse->civility = $objContactAddress->title_name ;
            $adresse->first_name = $objContactAddress->first_name ;
            $adresse->last_name = $objContactAddress->last_name ;
            $adresse->address_1 = $objContactAddress->address_1 ;
            $adresse->address_2 = $objContactAddress->address_2 ;
            $adresse->address_3 = $objContactAddress->address_3 ;
            $adresse->city = $objContactAddress->city ;
            $adresse->zipcode = $objContactAddress->zipcode ;
            $adresse->state_id = $objContactAddress->state_id ;
            $adresse->state = $objContactAddress->state ;
            $adresse->country_id = $objContactAddress->country_id ;
            $adresse->country_name = $objContactAddress->country_name ;
            $adresse->email = $objContactAddress->email ;
            $adresse->phone = $objContactAddress->phone ;
            $adresse->fax = $objContactAddress->fax ;

            if (trim($adresse->company) == "" && trim($adresse->first_name) == "" && trim($adresse->last_name) == "") {
                if ($objContact) {
                    $adresse->first_name = $objContact->first_name ;
                    $adresse->last_name = $objContact->last_name ;
                }
            }

        } else if ($objContact) {
            $adresse->company = "" ;
            $adresse->civility = $objContact->company_name ;
            $adresse->first_name = $objContact->company_name ;
            $adresse->last_name = $objContact->company_name ;
            $adresse->address_1 = $objContact->address_1 ;
            $adresse->address_2 = $objContact->address_2 ;
            $adresse->address_3 = $objContact->address_3 ;
            $adresse->city = $objContact->city ;
            $adresse->zipcode = $objContact->zipcode ;
            $adresse->state_id = $objContact->state_id ;
            $adresse->state = $objContact->state ;
            $adresse->country_id = $objContact->country_id ;
            $adresse->country_name = $objContact->country_name ;
            $adresse->email = $objContact->email ;
            $adresse->phone = $objContact->phone ;
            $adresse->fax = $objContact->fax ;
        }



        return $adresse;
    }
}