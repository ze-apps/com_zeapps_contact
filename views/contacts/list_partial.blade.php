<div ng-controller="ComZeappsContactContactsListPartialCtrl">
    <div class="row">
        <div class="col-md-12">
            <ze-filters class="pull-right" data-model="filter_model" data-filters="filters"
                        data-update="loadList"></ze-filters>

            <ze-btn fa="plus" color="success" hint="Contact" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="Ajouter un nouveau contact"></ze-btn>

            <span ng-show="btn_adding_existing_contact">

                <span ze-modalsearch-btn="loadContact"
                      fa="plus"
                      color="success"
                      hint="Contact existant"
                      always-on="true"
                      data-http="contactHttp"
                      data-fields="contactFields"
                      data-template-new="templateForm"
                      data-title="Choisir un contact"></span>
            </span>

            <ze-btn fa="download" color="primary" hint="Excel" always-on="true"
                    ng-click="getExcel()"></ze-btn>
        </div>
    </div>

    <div class="text-center" ng-show="total > pageSize">
        <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
            class="pagination-sm" boundary-links="true" max-size="15"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-responsive" ng-show="contacts.length">
                <thead>
                <tr>
                    <th>Société</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Etat</th>
                    <th>Pays</th>
                    <th>Gestionnaire du compte</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="contact in contacts" ng-class="contact.client_failure?'bg-danger text-danger':''">
                    <td ng-click="goTo(contact.id)">@{{contact.name_company}}</td>
                    <td ng-click="goTo(contact.id)"><i class="fas fa-ban text-danger"
                                                       ng-if="contact.client_failure"></i> @{{contact.last_name}}
                        @{{contact.first_name}}
                    </td>
                    <td ng-click="goTo(contact.id)">@{{contact.phone}}</td>
                    <td ng-click="goTo(contact.id)">@{{contact.zipcode}}</td>
                    <td ng-click="goTo(contact.id)">@{{contact.city}}</td>
                    <td ng-click="goTo(contact.id)">@{{contact.state}}</td>
                    <td ng-click="goTo(contact.id)">@{{contact.country_name}}</td>
                    <td ng-click="goTo(contact.id)">@{{contact.name_user_account_manager}}</td>
                    <td class="text-right">
                        <ze-btn fa="edit" color="info" hint="Editer" direction="left"
                                ze-modalform="edit"
                                data-edit="contact"
                                data-template="templateForm"
                                data-title="Modifier le contact"></ze-btn>
                        <ze-btn fa="trash" color="danger" hint="Supprimer" direction="left" ng-click="delete(contact)"
                                ze-confirmation></ze-btn>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center" ng-show="total > pageSize">
        <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
            class="pagination-sm" boundary-links="true" max-size="15"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>
</div>