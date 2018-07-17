<div class="modal-header">
    <h3 class="modal-title">@{{titre}}</h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="companies.length">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Gestionnaire du compte</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="company in companies">
                    <td><a href="#" ng-click="loadCompany(company.id)">@{{company.company_name}}</a></td>
                    <td><a href="#" ng-click="loadCompany(company.id)">@{{company.phone}}</a></td>
                    <td><a href="#" ng-click="loadCompany(company.id)">@{{company.billing_city}}</a></td>
                    <td><a href="#" ng-click="loadCompany(company.id)">@{{company.name_user_account_manager}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-danger" type="button" ng-click="cancel()">Annuler</button>
</div>