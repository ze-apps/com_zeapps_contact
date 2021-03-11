<div ng-controller="ComZeappsContactContactsAddressFormCtrl">



    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __t("Company") }}</label>
                <input type="text" ng-model="form.company_name" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("First name") }}</label>
                <input type="text" ng-model="form.first_name" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Last name") }}</label>
                <input type="text" ng-model="form.last_name" class="form-control">
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Address") }}</label>
                <input type="text" ng-model="form.address_1" class="form-control">
                <input type="text" ng-model="form.address_2" class="form-control">
                <input type="text" ng-model="form.address_3" class="form-control">
            </div>

            <div class="form-group">
                <label>{{ __t("State") }}</label>

                <span   ze-modalsearch="loadState"
                        data-http="statesHttp"
                        data-model="form.state"
                        data-filters="{id_country: form.country_id}"
                        data-fields="statesFields"
                        data-title="{{ __t("Choose a state") }}"></span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Zip code") }}</label>
                <input type="text" ng-model="form.zipcode" class="form-control">
            </div>

            <div class="form-group">
                <label>{{ __t("City") }}</label>
                <input type="text" ng-model="form.city" class="form-control">
            </div>



            <div class="form-group">
                <label>{{ __t("Country") }}</label>

                <span   ze-modalsearch="loadCountry"
                        data-http="countriesHttp"
                        data-model="form.country_name"
                        data-fields="countriesFields"
                        data-title="{{ __t("Choose a country") }}"></span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __t("Email") }}</label>
                <input type="text" ng-model="form.email" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Phone") }}</label>
                <input type="text" ng-model="form.phone" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Fax") }}</label>
                <input type="text" ng-model="form.fax" class="form-control">
            </div>
        </div>
    </div>



</div>