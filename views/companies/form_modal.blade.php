<div ng-controller="ComZeappsContactCompaniesFormCtrl">

    <ul role="tablist" class="nav nav-tabs">
        <li ng-class="isTabActive('general')"><a href="#" ng-click="setTab('general')">{{ __t("General informations") }}</a></li>
        <li ng-class="isTabActive('activity')"><a href="#" ng-click="setTab('activity')">{{ __t("Activity") }}</a></li>
        <li ng-class="isTabActive('contact')"><a href="#" ng-click="setTab('contact')">{{ __t("Contact information") }}</a></li>
        <li ng-class="isTabActive('comments')"><a href="#" ng-click="setTab('comments')">{{ __t("Comments") }}</a></li>
    </ul>

    <div ng-if="displayTab('general')">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Name") }}</label>
                    <input type="text" ng-model="form.company_name" class="form-control" ng-change="updateCompanyName()" ng-model-options="{debounce: 500}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Parent company") }}</label>

                    <span   ze-modalsearch="loadParentCompany"
                            data-http="parentCompanyHttp"
                            data-model="form.name_parent_company"
                            data-fields="parentCompanyFields"
                            data-title="{{ __t("Choose a company") }}"
                            data-template-new="companyTplNew"
                    ></span>
                </div>
            </div>
        </div>


        <div class="row bg-danger" ng-show="listCompaniesDuplicate.length">
            <div class="col-md-12">
                <b>{{ __t("Isn't your new entry a duplicate?") }}</b>
            </div>
        </div>
        <div class="row bg-danger" ng-show="listCompaniesDuplicate.length" style="max-height: 150px; overflow: scroll;">
            <div class="col-md-12">
                <ul>
                    <li ng-repeat="listCompanyDuplicate in listCompaniesDuplicate"><a href="#" ng-click="changeToDuplicateCompany(listCompanyDuplicate)">@{{ listCompanyDuplicate.company_name }}</a></li>
                </ul>
            </div>
        </div>




        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __t("Price list") }}</label>
                    <select ng-model="form.id_price_list" class="form-control">
                        <option ng-repeat="price_list in price_lists" ng-value="@{{price_list.id}}">
                            @{{ price_list.label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __t("VAT number") }}</label>
                    <input type="text" ng-model="form.tva_intracom" class="form-control">
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Type of account") }}</label>
                    <select ng-model="form.id_account_family" class="form-control" ng-change="updateAccountFamily()">
                        <option ng-repeat="account_family in account_families" ng-value="@{{account_family.id}}">
                            @{{ account_family.label }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Method of payment") }}</label>
                    <select ng-model="form.id_modality" class="form-control" ng-change="updateModality()">
                        <optgroup label="{{ __t("Payment receivable") }}">
                            <option ng-repeat="modality in modalities" ng-value="@{{modality.id}}" ng-if="modality.situation == 0">
                                @{{ modality.label }}
                            </option>
                        </optgroup>
                        <optgroup label="{{ __t("Payment received") }}">
                            <option ng-repeat="modality in modalities" ng-value="@{{modality.id}}" ng-if="modality.situation != 0">
                                @{{ modality.label }}
                            </option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{ __t("Default discount") }}</label>
                    <input type="number" ng-model="form.discount" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>{{ __t("Authorized outstanding") }}</label>
                    <input type="text" ng-model="form.outstanding_amount" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>{{ __t("Accounting Account") }}</label>
                    <span   ze-modalsearch="loadAccountingNumber"
                            data-http="accountingNumberHttp"
                            data-model="form.accounting_number"
                            data-fields="accountingNumberFields"
                            data-template-new="accountingNumberTplNew"
                            data-title="Choisir un compte comptable"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{ __t("Account Manager") }}</label>

                    <span   ze-modalsearch="loadAccountManager"
                            data-http="accountManagerHttp"
                            data-model="form.name_user_account_manager"
                            data-fields="accountManagerFields"
                            data-title="Choisir un utilisateur"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="checkbox" ng-model="form.client_failure"
                               ng-true-value="1" ng-false-value="0" ng-checked="form.client_failure == 1">
                        {{ __t("Defaulting customer") }}
                    </label>
                </div>
            </div>
        </div>

    </div>

    <div ng-if="displayTab('activity')">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("SIRET") }}</label>
                    <input type="text" ng-model="form.company_number" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("NAF Code") }}</label>
                    <span   ze-modalsearch="loadCodeNaf"
                            data-http="codeNafHttp"
                            data-model="form.code_naf_libelle"
                            data-fields="codeNafFields"
                            data-title="Choisir un code NAF"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Turnover") }}</label>
                    <input type="text" ng-model="form.turnover" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div ng-if="displayTab('contact')">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label>{{ __t("Payment received") }}Email</label>
                    <input type="text" ng-model="form.email" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="checkbox" ng-model="form.opt_out"
                               ng-true-value="'1'" ng-false-value="'0'" ng-checked="form.opt_out === '1'">
                        {{ __t("Marketing opposition") }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __t("Phone") }}</label>
                    <input type="text" ng-model="form.phone" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __t("Fax") }}</label>
                    <input type="text" ng-model="form.fax" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ __t("Website") }}</label>
                    <input type="text" ng-model="form.website_url" class="form-control">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Billing address") }}</label>
                    <input type="text" ng-model="form.billing_address_1" class="form-control">
                    <input type="text" ng-model="form.billing_address_2" class="form-control">
                    <input type="text" ng-model="form.billing_address_3" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("Zip code") }}</label>
                    <input type="text" ng-model="form.billing_zipcode" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("City") }}</label>
                    <input type="text" ng-model="form.billing_city" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("State") }}</label>

                    <span   ze-modalsearch="loadStateBilling"
                            data-http="statesHttp"
                            data-model="form.billing_state"
                            data-filters="{id_country: form.billing_country_id}"
                            data-fields="statesFields"
                            data-title="Choisir un état"></span>
                </div>

                <div class="form-group">
                    <label>{{ __t("Country") }}</label>

                    <span   ze-modalsearch="loadCountryBilling"
                            data-http="countriesHttp"
                            data-model="form.billing_country_name"
                            data-fields="countriesFields"
                            data-title="Choisir un pays"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __t("Delivery address") }}</label>
                    <input type="text" ng-model="form.delivery_address_1" class="form-control">
                    <input type="text" ng-model="form.delivery_address_2" class="form-control">
                    <input type="text" ng-model="form.delivery_address_3" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("Zip code") }}</label>
                    <input type="text" ng-model="form.delivery_zipcode" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("City") }}</label>
                    <input type="text" ng-model="form.delivery_city" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ __t("State") }}</label>

                    <span   ze-modalsearch="loadStateDelivery"
                            data-http="statesHttp"
                            data-model="form.delivery_state"
                            data-filters="{id_country: form.delivery_country_id}"
                            data-fields="statesFields"
                            data-title="Choisir un état"></span>
                </div>

                <div class="form-group">
                    <label>{{ __t("Country") }}</label>

                    <span   ze-modalsearch="loadCountryDelivery"
                            data-http="countriesHttp"
                            data-model="form.delivery_country_name"
                            data-fields="countriesFields"
                            data-title="Choisir un pays"></span>
                </div>
            </div>
        </div>
    </div>

    <div ng-if="displayTab('comments')">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ __t("Comments") }}</label>
                    <textarea class="form-control" rows="10" ng-model="form.comment"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>