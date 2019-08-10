<div ng-controller="ComZeappsContactContactsFormCtrl">

    <ul role="tablist" class="nav nav-tabs">
        <li ng-class="isTabActive('general')"><a href="#" ng-click="setTab('general')">Informations générales</a></li>
        <li ng-class="isTabActive('contact')"><a href="#" ng-click="setTab('contact')">Coordonnées</a></li>
        <li ng-class="isTabActive('comments')"><a href="#" ng-click="setTab('comments')">Commentaires</a></li>
    </ul>

    <div ng-if="displayTab('general')">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Grille de tarif</label>
                    <select ng-model="form.id_price_list" class="form-control">
                        <option ng-repeat="price_list in price_lists" ng-value="@{{price_list.id}}">
                            @{{ price_list.label }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Type de compte</label>
                    <select ng-model="form.id_account_family" class="form-control" ng-change="updateAccountFamily()">
                        <option ng-repeat="account_family in account_families" ng-value="@{{account_family.id}}">
                            @{{ account_family.label }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Compte comptable</label>
                    <span   ze-modalsearch="loadAccountingNumber"
                            data-http="accountingNumberHttp"
                            data-model="form.accounting_number"
                            data-fields="accountingNumberFields"
                            data-template-new="accountingNumberTplNew"
                            data-title="Choisir un compte comptable"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Gestionnaire du Compte</label>

                    <span   ze-modalsearch="loadAccountManager"
                            data-http="accountManagerHttp"
                            data-model="form.name_user_account_manager"
                            data-fields="accountManagerFields"
                            data-title="Choisir un utilisateur"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Salutation</label>
                    <select ng-model="form.title_name" class="form-control">
                        <option value="M.">M.</option>
                        <option value="Mme">Mme</option>
                        <option value="Mlle">Mlle</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" ng-model="form.last_name" class="form-control" ng-change="updateContactName()" ng-model-options="{debounce: 500}">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" ng-model="form.first_name" class="form-control" ng-change="updateContactName()" ng-model-options="{debounce: 500}">
                </div>
            </div>
        </div>




        <div class="row bg-danger" ng-show="listContactsDuplicate.length">
            <div class="col-md-12">
                <b>Votre création ne serait-elle pas un doublon ?</b>
            </div>
        </div>
        <div class="row bg-danger" ng-show="listContactsDuplicate.length" style="max-height: 150px; overflow: scroll;">
            <div class="col-md-12">
                <ul>
                    <li ng-repeat="listContactDuplicate in listContactsDuplicate"><a href="#" ng-click="changeToDuplicateContact(listContactDuplicate)">@{{ listContactDuplicate.first_name }} @{{ listContactDuplicate.last_name }}</a></li>
                </ul>
            </div>
        </div>





        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Société</label>

                    <span   ze-modalsearch="loadCompany"
                            data-http="companyHttp"
                            data-model="form.name_company"
                            data-fields="companyFields"
                            data-title="Choisir une entreprise"
                            data-template-new="companyTplNew"
                    ></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Date de naissance</label>
                    <input type="date" ng-blur="updateAge(form.date_of_birth)" ng-model="form.date_of_birth" class="form-control">
                    <span class="pull-right" ng-model="form.age_of_contact" ng-if="form.date_of_birth">@{{form.age_of_contact}}</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Service</label>
                    <input type="text" ng-model="form.department" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fonction</label>
                    <input type="text" ng-model="form.job" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Remise par défault</label>
                    <input type="number" ng-model="form.discount" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Modalité de paiement</label>
                    <select ng-model="form.id_modality" class="form-control" ng-change="updateModality()">
                        <optgroup label="Paiement à recevoir">
                            <option ng-repeat="modality in modalities" value="@{{modality.id}}" ng-if="modality.situation == 0">
                                @{{ modality.label }}
                            </option>
                        </optgroup>
                        <optgroup label="Paiement reçu">
                            <option ng-repeat="modality in modalities" value="@{{modality.id}}" ng-if="modality.situation != 0">
                                @{{ modality.label }}
                            </option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="checkbox" ng-model="form.client_failure"
                               ng-true-value="1" ng-false-value="0" ng-checked="form.client_failure == 1">
                        Client défaillant
                    </label>
                </div>
            </div>
        </div>
    </div>





    <div ng-if="displayTab('contact')">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" ng-model="form.email" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="checkbox" ng-model="form.opt_out"
                               ng-true-value="'1'" ng-false-value="'0'" ng-checked="form.opt_out === '1'">
                        Opposition marketing
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" ng-model="form.mobile" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="text" ng-model="form.phone" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Autre téléphone</label>
                    <input type="text" ng-model="form.other_phone" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Assistant(e)</label>
                    <input type="text" ng-model="form.assistant" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Assistant(e) téléphone</label>
                    <input type="text" ng-model="form.assistant_phone" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Télécopie</label>
                    <input type="text" ng-model="form.fax" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Skype ID</label>
                    <input type="text" ng-model="form.skype_id" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" ng-model="form.twitter" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>URL du site web</label>
                    <input type="text" ng-model="form.website_url" class="form-control">
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
    </div>

    <div ng-if="displayTab('comments')">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Commentaire</label>
                    <textarea class="form-control" rows="3" ng-model="form.comment"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>