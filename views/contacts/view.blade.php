<div id="content">
    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">
                        <i class="fas fa-exclamation-triangle" style="font-size: 3em; color:#dd0000;" ng-if="contact.client_failure"></i>
                        <b>@{{contact.title_name + ' ' + contact.first_name + ' ' + contact.last_name}}</b>
                    </div>
                    <div>
                        <small><a href="/ng/com_zeapps_contact/companies/@{{contact.id_company}}">@{{contact.name_company}}</a></small>
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>{{ __t("Topology") }} : </strong>@{{contact.name_topology}} <br>
                    <strong>{{ __t("Family") }} : </strong>@{{contact.name_account_family}}
                </div>

                <div class="col-md-3">
                    <strong>{{ __t("Manager") }} : </strong>@{{contact.name_user_account_manager}}
                </div>

                <div class="col-md-3">
                    <div class="pull-right">
                        <ze-btn fa="arrow-left" color="primary" hint="Retour" direction="left" ng-click="back()"></ze-btn>
                        @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                            <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                                    ze-modalform="edit"
                                    data-edit="contact"
                                    data-template="templateEdit"
                                    data-title="{{ __t("Edit contact") }}"></ze-btn>
                        @endif


                        <div class="btn-group btn-group-xs" role="group" ng-if="nb_contacts > 0">
                            <button type="button" class="btn btn-default" ng-class="contact_first == 0 ? 'disabled' :''" ng-click="first_contact()"><span class="fa fa-fw fa-fast-backward"></span></button>
                            <button type="button" class="btn btn-default" ng-class="contact_previous == 0 ? 'disabled' :''" ng-click="previous_contact()"><span class="fa fa-fw fa-chevron-left"></span></button>
                            <button type="button" class="btn btn-default disabled">@{{contact_order}}/@{{nb_contacts}}</button>
                            <button type="button" class="btn btn-default" ng-class="contact_next == 0 ? 'disabled' :''" ng-click="next_contact()"><span class="fa fa-fw fa-chevron-right"></span></button>
                            <button type="button" class="btn btn-default" ng-class="contact_last == 0 ? 'disabled' :''" ng-click="last_contact()"><span class="fa fa-fw fa-fast-forward"></span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <ul role="tablist" class="nav nav-tabs">
            <li role="presentation" ng-class="isTabActive('summary') ? 'active' : ''"><a href="#" ng-click="setTab('summary')">{{ __t("Summary") }}</a></li>
            <li role="presentation" ng-class="isTabActive('addresses') ? 'active' : ''"><a href="#" ng-click="setTab('addresses')">{{ __t("Addresses") }}</a></li>

            <li role="presentation" ng-class="isTabActive(hook.label) ? 'active' : ''" ng-repeat="hook in hooksComZeappsContact_ContactHook">
                <a href="#" ng-click="setTab(hook.label)">@{{ hook.label }}</a>
            </li>

            <li role="presentation" ng-class="isTabActive('email') ? 'active' : ''"><a href="#" ng-click="setTab('email')">{{ __t("Email") }}</a></li>
        </ul>

        <div ng-show="isTabActive(hook.label)" ng-repeat="hook in hooksComZeappsContact_ContactHook">
            <div ng-include="hook.template">
            </div>
        </div>





        <div ng-show="isTabActive('summary')">
            <div class="row">
                <div class="col-md-4">
                    <strong>{{ __t("Date of Birth") }} : </strong>@{{contact.date_of_birth | dateConvert:'date' }}
                    <span ng-if="contact.date_of_birth">(@{{ contact.age_of_contact }})</span>
                </div>
                <div class="col-md-4">
                    <strong>{{ __t("Service") }} : </strong>@{{contact.name_activity_area}}
                </div>
                <div class="col-md-4">
                    <strong>{{ __t("Function") }} : </strong>@{{contact.company_number}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>{{ __t("Information") }} : </strong>
                    </div>
                    <div class="well">
                        <div class="row" ng-if="contact.mobile != '' || contact.phone != '' || contact.other_phone != ''">
                            <div class="col-md-4" ng-if="contact.mobile != ''">
                                <i class="fa fa-fw fa-mobile"></i> @{{contact.mobile}}
                            </div>
                            <div class="col-md-4" ng-if="contact.phone != ''">
                                <i class="fa fa-fw fa-phone"></i> @{{contact.phone}}
                            </div>
                            <div class="col-md-4" ng-if="contact.other_phone != ''">
                                <i class="fa fa-fw fa-phone"></i> @{{contact.other_phone}}
                            </div>
                        </div>
                        <div class="row" ng-if="contact.fax != '' || contact.skype_id != '' || contact.twitter != ''">
                            <div class="col-md-4" ng-if="contact.fax != ''">
                                <i class="fa fa-fw fa-fax"></i> @{{contact.fax}}
                            </div>
                            <div class="col-md-4" ng-if="contact.skype_id != ''">
                                <i class="fab fa-fw fa-skype"></i> @{{contact.skype_id}}
                            </div>
                            <div class="col-md-4" ng-if="contact.twitter != ''">
                                <i class="fab fa-fw fa-twitter"></i> @{{contact.twitter}}
                            </div>
                        </div>
                        <div class="row" ng-if="contact.website_url != ''">
                            <div class="col-md-12">
                                <i class="fa fa-fw fa-globe"></i> @{{contact.website_url}}
                            </div>
                        </div>
                        <div class="row" ng-if="contact.email != ''">
                            <div class="col-md-12">
                                <i class="fas fa-envelope"></i> <a href="mailto:@{{contact.email}}" target="_blank">@{{contact.email}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" ng-if="contact.assistant != '' || contact.assistant_phone != ''">
                <div class="col-md-12">
                    <div>
                        <strong>{{ __t("Assistant") }} : </strong>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-fw fa-user"></i> @{{contact.assistant}}
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-fw fa-phone"></i> @{{contact.assistant_phone}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-6">
                    <div>
                        <strong>{{ __t("Billing address") }} :</strong>
                    </div>
                    <div class="well">
                        <span ng-if="contact.address_1 != ''">@{{contact.address_1}}<br></span>
                        <span ng-if="contact.address_2 != ''">@{{contact.address_2}}<br></span>
                        <span ng-if="contact.address_3 != ''">@{{contact.address_3}}<br></span>
                        <span ng-if="contact.zipcode != '' || contact.city != ''">@{{contact.zipcode}} @{{contact.city}}<br></span>
                        <span ng-if="contact.state != ''">@{{contact.state}}<br></span>
                        <span ng-if="contact.country_name != ''">@{{contact.country_name}}<br></span>
                    </div>
                </div>
            </div>



            <div class="row" ng-show="contact.sub_adresses.length">
                <div class="col-md-12">
                    <div>
                        <strong>{{ __t("Secondary address (es)") }} :</strong>
                    </div>
                    <div class="well" ng-repeat="address in contact.sub_adresses">
                        <span ng-if="address.company_name != ''">@{{address.company_name}}<br></span>
                        <span ng-if="address.first_name != '' || address.last_name != ''">@{{address.first_name}} @{{address.last_name}}<br></span>
                        <span ng-if="address.address_1 != ''">@{{address.address_1}}<br></span>
                        <span ng-if="address.address_2 != ''">@{{address.address_2}}<br></span>
                        <span ng-if="address.address_3 != ''">@{{address.address_3}}<br></span>
                        <span ng-if="address.zipcode != '' || address.city != ''">@{{address.zipcode}} @{{address.city}}<br></span>
                        <span ng-if="address.state != ''">@{{address.state}}<br></span>
                        <span ng-if="address.country_name != ''">@{{address.country_name}}<br></span>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>{{ __t("Comment") }} :</strong>
                    </div>
                    <div class="well">
                        <span ng-bind-html=" contact.comment | nl2br:true "></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div ng-if="contact.average_order > 0">
                        <div>
                            <strong>{{ __t("Average time between 2 orders") }} :</strong>
                        </div>
                        <div class="well">
                            @{{contact.average_order | number:0}} jours
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div ng-if="contact.turnovers && contact.turnovers.length">
                        <div>
                            <strong>{{ __t("Turnover per year") }} :</strong>
                        </div>
                        <div class="well">
                            <table class="table table-responsive table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>{{ __t("Year") }}</th>
                                    <th class="text-right">{{ __t("Tax-free turnover") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="turnover in contact.turnovers">
                                    <td>@{{turnover.year}}</td>
                                    <td class="text-right">@{{turnover.total_ht | currencyConvert}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div ng-show="isTabActive('addresses')">

            <div class="row">
                <div class="col-md-12">
                    @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                        <ze-btn fa="plus" color="success" hint="Adresse" always-on="true"
                                ze-modalform="addAddresse"
                                data-template="templateFormAddresse"
                                data-title="Ajouter une nouvelle adresse"></ze-btn>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-condensed table-responsive" ng-show="contact.sub_adresses.length">
                        <thead>
                        <tr>
                            <th>{{ __t("Company") }}</th>
                            <th>{{ __t("Name") }}</th>
                            <th>{{ __t("Address") }}</th>
                            <th>{{ __t("Zip code") }}</th>
                            <th>{{ __t("City") }}</th>
                            <th>{{ __t("State") }}</th>
                            <th>{{ __t("Country") }}</th>
                            @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                                <th></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="address in contact.sub_adresses">
                            <td>@{{address.company_name}}</td>
                            <td>@{{address.first_name}} @{{address.last_name}}</td>
                            <td>@{{address.address_1}}
                                <br ng-if="address.address_2 != ''">@{{address.address_2}}
                                <br ng-if="address.address_3 != ''">@{{address.address_3}}</td>
                            <td>@{{address.zipcode}}</td>
                            <td>@{{address.city}}</td>
                            <td>@{{address.state}}</td>
                            <td>@{{address.country_name}}</td>
                            @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                                <td class="text-right">
                                        <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                                                ze-modalform="editAddresse"
                                                data-edit="address"
                                                data-template="templateFormAddresse"
                                                data-title="{{ __t("Edit address") }}"></ze-btn>
                                        <ze-btn fa="trash" color="danger" hint="{{ __t("Delete") }}" direction="left" ng-click="deleteAddresse(address)" ze-confirmation></ze-btn>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>




        <div ng-if="isTabActive('email')">
            <div ng-include="'/zeapps/email/list_partial'" ng-init="module = 'com_zeapps_contact'; id = 'contacts_' + contact.id"></div>
        </div>


    </form>
</div>