<div id="breadcrumb">
    {{ __t("Type of account") }}
</div>

<div id="content">
    <div class="row">
        <div class="col-md-12">
            <ze-btn fa="plus" color="success" hint="Famille de compte" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="{{ __t("Add a new account family") }}"></ze-btn>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form>
                <table class="table table-responsive table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>{{ __t("Label") }}</th>
                        <th>{{ __t("Sequence") }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="account_family in account_families">
                        <td>@{{account_family.label}}</td>
                        <td>@{{account_family.sort}}</td>
                        <td class="text-right">
                            <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                                    ze-modalform="edit"
                                    data-edit="account_family"
                                    data-template="templateForm"
                                    data-title="Modifier la famille de compte"></ze-btn>
                            <ze-btn fa="trash" color="danger" hint="{{ __t("Delete") }}" direction="left" ng-click="delete(account_family)" ze-confirmation></ze-btn>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>