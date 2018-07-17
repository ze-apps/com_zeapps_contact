<div id="content">
    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <div class="titleWell">
                        @{{contact.title_name + ' ' + contact.first_name + ' ' + contact.last_name}}
                    </div>
                    <div>
                        <small>@{{contact.name_company}}</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <strong>Topologie : </strong>@{{contact.name_topology}} <br>
                    <strong>Famille : </strong>@{{contact.name_account_family}}
                </div>

                <div class="col-md-3">
                    <strong>Manager : </strong>@{{contact.name_user_account_manager}}
                </div>

                <div class="col-md-3">
                    <div class="pull-right">
                        <ze-btn fa="arrow-left" color="primary" hint="Retour" direction="left" ng-click="back()"></ze-btn>
                        <ze-btn fa="pencil" color="info" hint="Editer" direction="left"
                                ze-modalform="edit"
                                data-edit="contact"
                                data-template="templateEdit"
                                data-title="Modifier le contact"></ze-btn>


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
            <li role="presentation" ng-class="isTabActive('summary') ? 'active' : ''"><a href="#" ng-click="setTab('summary')">Résumé</a></li>

            <li role="presentation" ng-class="isTabActive(hook.label) ? 'active' : ''" ng-repeat="hook in hooks">
                <a href="#" ng-click="setTab(hook.label)">@{{ hook.label }}</a>
            </li>
        </ul>

        <div ng-show="isTabActive(hook.label)" ng-repeat="hook in hooks">
            <div ng-include="hook.template">
            </div>
        </div>

        <div ng-show="isTabActive('summary')">
            <div class="row">
                <div class="col-md-4">
                    <strong>Date de naissance : </strong>@{{contact.date_of_birth | date:'dd/MM/yyyy'}}
                </div>
                <div class="col-md-4">
                    <strong>Service : </strong>@{{contact.name_activity_area}}
                </div>
                <div class="col-md-4">
                    <strong>Fonction : </strong>@{{contact.company_number}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Information de contact : </strong>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-mobile"></i> @{{contact.mobile}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-phone"></i> @{{contact.phone}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-phone"></i> @{{contact.other_phone}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-fax"></i> @{{contact.fax}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-skype"></i> @{{contact.skype_id}}
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-fw fa-twitter"></i> @{{contact.twitter}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <i class="fa fa-fw fa-globe"></i> @{{contact.website_url}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Assistant(e) : </strong>
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
                        <strong>Adresse de facturation :</strong>
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
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <strong>Commentaire :</strong>
                    </div>
                    <div class="well">
                        <span ng-bind-html=" contact.comment | nl2br:true "></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <strong>Temps moyen entre 2 commandes :</strong>
                    </div>
                    <div class="well">
                        @{{contact.average_order | number:0}} jours
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <strong>Chiffre d'affaires par année :</strong>
                    </div>
                    <div class="well">
                        <table class="table table-responsive table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>Année</th>
                                <th class="text-right">Chiffre d'affaires HT</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="turnover in contact.turnovers">
                                <td>@{{turnover.year}}</td>
                                <td class="text-right">@{{turnover.total_ht | currency:'€':2}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>