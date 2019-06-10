<div ng-controller="ComZeappsContactContactsAddressFormCtrl">



    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Entreprise</label>
                <input type="text" ng-model="form.company_name" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" ng-model="form.first_name" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" ng-model="form.last_name" class="form-control">
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" ng-model="form.address_1" class="form-control">
                <input type="text" ng-model="form.address_2" class="form-control">
                <input type="text" ng-model="form.address_3" class="form-control">
            </div>

            <div class="form-group">
                <label>État</label>

                <span   ze-modalsearch="loadState"
                        data-http="statesHttp"
                        data-model="form.state"
                        data-filters="{id_country: form.country_id}"
                        data-fields="statesFields"
                        data-title="Choisir un état"></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Code postal</label>
                <input type="text" ng-model="form.zipcode" class="form-control">
            </div>

            <div class="form-group">
                <label>Ville</label>
                <input type="text" ng-model="form.city" class="form-control">
            </div>



            <div class="form-group">
                <label>Pays</label>

                <span   ze-modalsearch="loadCountry"
                        data-http="countriesHttp"
                        data-model="form.country_name"
                        data-fields="countriesFields"
                        data-title="Choisir un pays"></span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                <input type="text" ng-model="form.email" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" ng-model="form.phone" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Fax</label>
                <input type="text" ng-model="form.fax" class="form-control">
            </div>
        </div>
    </div>



</div>