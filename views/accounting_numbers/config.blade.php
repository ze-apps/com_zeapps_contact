<div id="breadcrumb">
    {{ __t("Accounting account") }}
</div>

<div id="content">
    <div class="row">
        <div class="col-md-12">
            <ze-filters class="pull-right" data-model="filter_model" data-filters="filters"
                        data-update="loadList"></ze-filters>

            @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
            <ze-btn fa="plus" color="success" hint="{{ __t("Accounting Account") }}" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="{{ __t("Add new accounting account") }}"></ze-btn>
            @endif

        </div>
    </div>



    <div class="text-center" ng-show="total > pageSize">
        <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
            class="pagination-sm" boundary-links="true" max-size="15"
            previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-responsive" ng-show="accounts.length">
                <thead>
                <tr>
                    <th>{{ __t("Label") }}</th>
                    <th>{{ __t("Number") }}</th>
                    <th>{{ __t("Type") }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="account in accounts">
                    <td ng-click="goTo(account.id)">@{{account.label}}</td>
                    <td ng-click="goTo(account.id)">@{{account.number}}</td>
                    <td ng-click="goTo(account.id)">@{{account.type_label}}</td>
                    <td class="text-right">
                        @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                            <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                                    ze-modalform="edit"
                                    data-edit="account"
                                    data-template="templateForm"
                                    data-title="{{ __t("Edit") }} {{ __t("Accounting Account") }}"></ze-btn>
                            <ze-btn fa="trash" color="danger" hint="{{ __t("Delete") }}" direction="left" ng-click="delete(account)"
                                    ze-confirmation></ze-btn>
                        @endif
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