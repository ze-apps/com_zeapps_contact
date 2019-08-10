<div id="breadcrumb">
    Familles de compte
</div>

<div id="content">
    <div class="row">
        <div class="col-md-12">
            <ze-btn fa="plus" color="success" hint="Famille de compte" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="Ajouter une nouvelle famille de compte"></ze-btn>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form>
                <table class="table table-responsive table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Ordre</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="account_family in account_families">
                        <td>@{{account_family.label}}</td>
                        <td>@{{account_family.sort}}</td>
                        <td class="text-right">
                            <ze-btn fa="edit" color="info" hint="Editer" direction="left"
                                    ze-modalform="edit"
                                    data-edit="account_family"
                                    data-template="templateForm"
                                    data-title="Modifier la famille de compte"></ze-btn>
                            <ze-btn fa="trash" color="danger" hint="Supprimer" direction="left" ng-click="delete(account_family)" ze-confirmation></ze-btn>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>