<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;

class ModalitiesLang extends Model implements iModelExport {
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_modalities_lang';
    protected $table ;


    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->integer('id_modality', false, true)->default(0);
        $this->fieldModelInfo->integer('id_lang', false, true)->default(0);
        $this->fieldModelInfo->string('label', 255)->default('');
        $this->fieldModelInfo->string('label_doc', 255)->default('');

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        /**** to delete unwanted field ****/
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        return parent::save($options);
    }

    public function getModelExport() : ModelExportType {
        $objModelExport = new ModelExportType() ;
        $objModelExport->table = $this->table ;
        $objModelExport->tableLabel = "Modalités - langue" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }
}