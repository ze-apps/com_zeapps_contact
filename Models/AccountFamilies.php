<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;
use Zeapps\Core\ObjectHistory;

class AccountFamilies extends Model implements iModelExport{
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_account_families';
    protected $table ;

    protected $fieldModelInfo ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        // stock la liste des champs
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->string('label', 255);
        $this->fieldModelInfo->tinyInteger('sort', false, true)->default(0);

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
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
        $objModelExport->tableLabel = "Compte famille" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }
}