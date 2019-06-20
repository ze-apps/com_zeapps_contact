<div id="breadcrumb">
    Entreprises
</div>
<div id="content">

    <div class="row">
        <div class="col-md-12">
            <ze-filters class="pull-right" data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>

            <ze-btn fa="plus" color="success" hint="Entreprise" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="Ajouter une nouvelle entreprise"></ze-btn>

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
            <table class="table table-hover table-condensed table-responsive" ng-show="companies.length">
                <thead>
                <tr>
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
                <tr ng-repeat="company in companies" ng-class="company.client_failure?'text-danger':''">
                    <td ng-click="goTo(company.id)"><i class="fas fa-ban text-danger" ng-if="company.client_failure"></i> @{{company.company_name}}</td>
                    <td ng-click="goTo(company.id)">@{{company.phone}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_zipcode}}</td>
                    <td ng-click="goTo(company.id)">@{{company.billing_city}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_state}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_country_name}}</td>
                    <td ng-click="goTo(company.id)">@{{company.name_user_account_manager}}</td>
                    <td class="text-right">
                        <ze-btn fa="edit" color="info" hint="Editer" direction="left"
                                ze-modalform="edit"
                                data-edit="company"
                                data-template="templateForm"
                                data-title="Modifier l'entreprise"></ze-btn>
                        <ze-btn fa="trash" color="danger" hint="Supprimer" direction="left" ng-click="delete(company)" ze-confirmation></ze-btn>
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