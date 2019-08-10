<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;
use Zeapps\Core\ObjectHistory;

class Companies extends Model implements iModelExport{
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_companies';
    protected $table ;

    protected $fieldModelInfo ;


    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;


        // stock la liste des champs
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');
        $this->fieldModelInfo->integer('id_user_account_manager', false, true)->default(0);
        $this->fieldModelInfo->string('name_user_account_manager', 100)->default("");
        $this->fieldModelInfo->integer('id_price_list')->default(0);
        $this->fieldModelInfo->string('company_name', 255)->default("");
        $this->fieldModelInfo->integer('id_parent_company', false, true)->default(0);
        $this->fieldModelInfo->string('name_parent_company', 255)->default("");
        $this->fieldModelInfo->integer('id_account_family', false, true)->default(0);
        $this->fieldModelInfo->string('name_account_family', 100)->default("");
        $this->fieldModelInfo->integer('id_topology', false, true)->default(0);
        $this->fieldModelInfo->string('name_topology', 100)->default("");
        $this->fieldModelInfo->integer('id_activity_area', false, true)->default(0);
        $this->fieldModelInfo->string('name_activity_area', 100)->default("");
        $this->fieldModelInfo->bigInteger('turnover')->default(0);
        $this->fieldModelInfo->string('billing_address_1', 100)->default("");
        $this->fieldModelInfo->string('billing_address_2', 100)->default("");
        $this->fieldModelInfo->string('billing_address_3', 100)->default("");
        $this->fieldModelInfo->string('billing_city', 100)->default("");
        $this->fieldModelInfo->string('billing_zipcode', 50)->default("");
        $this->fieldModelInfo->integer('billing_state_id')->default(0);
        $this->fieldModelInfo->string('billing_state', 100)->default("");
        $this->fieldModelInfo->integer('billing_country_id', false, true)->default(0);
        $this->fieldModelInfo->string('billing_country_name', 100)->default("");
        $this->fieldModelInfo->string('delivery_address_1', 100)->default("");
        $this->fieldModelInfo->string('delivery_address_2', 100)->default("");
        $this->fieldModelInfo->string('delivery_address_3', 100)->default("");
        $this->fieldModelInfo->string('delivery_city', 100)->default("");
        $this->fieldModelInfo->string('delivery_zipcode', 50)->default("");
        $this->fieldModelInfo->integer('delivery_state_id', false, true)->default(0);
        $this->fieldModelInfo->string('delivery_state', 100)->default("");
        $this->fieldModelInfo->integer('delivery_country_id', false, true)->default(0);
        $this->fieldModelInfo->string('delivery_country_name', 100)->default("");
        $this->fieldModelInfo->text('comment');
        $this->fieldModelInfo->string('email', 255)->default("");
        $this->fieldModelInfo->tinyInteger('opt_out', false, true)->default(0);
        $this->fieldModelInfo->string('phone', 25)->default("");
        $this->fieldModelInfo->string('fax', 25)->default("");
        $this->fieldModelInfo->string('website_url', 255)->default("");
        $this->fieldModelInfo->string('code_naf', 15)->default("");
        $this->fieldModelInfo->string('code_naf_libelle', 255)->default("");
        $this->fieldModelInfo->string('company_number', 30)->default("");
        $this->fieldModelInfo->string('accounting_number', 15)->default("");
        $this->fieldModelInfo->timestamp('last_order')->nullable();
        $this->fieldModelInfo->float('discount', 5,2)->default(0);
        $this->fieldModelInfo->integer('id_modality', false, true)->default(0);
        $this->fieldModelInfo->string('label_modality', 255)->default("");
        $this->fieldModelInfo->string('tva_intracom', 255)->default("");
        $this->fieldModelInfo->tinyInteger('client_failure', false, true)->default(0);;
        $this->fieldModelInfo->timestamps();
        $this->fieldModelInfo->softDeletes();

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        /******** clean data **********/
        $this->fieldModelInfo->cleanData($this) ;

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
        $this->fieldModelInfo->removeFieldUnwanted($this) ;
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        $reponse = parent::save($options) ;

        // save to ObjectHistory
        ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), $this, $valueOriginal);

        return $reponse;
    }

    public function delete() {

        // for history
        $valueOriginal = $this->original;

        $deleted = parent::delete();

        // save to ObjectHistory
        if ($deleted) {
            ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), null, $valueOriginal);
            return true;
        }

        return false;
    }

    public function getModelExport() : ModelExportType {
        $objModelExport = new ModelExportType() ;
        $objModelExport->table = $this->table ;
        $objModelExport->tableLabel = "Entreprise" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }
}