<div id="breadcrumb">
    {{ __t("Companies") }}
</div>
<div id="content">

    <div class="row">
        <div class="col-md-12">
            <ze-filters class="pull-right" data-model="filter_model" data-filters="filters"
                        data-update="loadList"></ze-filters>

            @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                <ze-btn fa="plus" color="success" hint="{{ __t("Company") }}" always-on="true"
                        ze-modalform="add"
                        data-template="templateForm"
                        data-title="{{ __t("Add a new company") }}"></ze-btn>
            @endif

            @if (in_array("com_ze_apps_contact_com_export", $zeapps_right_current_user))
                <ze-btn fa="download" color="primary" hint="Excel" always-on="true"
                        ng-click="getExcel()"></ze-btn>
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
            <table class="table table-hover table-condensed table-responsive" ng-show="companies.length">
                <thead>
                <tr>
                    <th>{{ __t("Name") }}</th>
                    <th>{{ __t("Phone") }}</th>
                    <th>{{ __t("Zip code") }}</th>
                    <th>{{ __t("City") }}</th>
                    <th>{{ __t("State") }}</th>
                    <th>{{ __t("Country") }}</th>
                    <th>{{ __t("Account manager") }}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="company in companies" ng-class="company.client_failure?'bg-danger text-danger':''">
                    <td ng-click="goTo(company.id)"><i class="fas fa-ban text-danger"
                                                       ng-if="company.client_failure"></i> @{{company.company_name}}
                    </td>
                    <td ng-click="goTo(company.id)">@{{company.phone}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_zipcode}}</td>
                    <td ng-click="goTo(company.id)">@{{company.billing_city}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_state}}</td>
                    <td ng-click="goTo(contact.id)">@{{company.billing_country_name}}</td>
                    <td ng-click="goTo(company.id)">@{{company.name_user_account_manager}}</td>
                    <td class="text-right">
                        @if (in_array("com_ze_apps_contact_com_write", $zeapps_right_current_user))
                            <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                                    ze-modalform="edit"
                                    data-edit="company"
                                    data-template="templateForm"
                                    data-title="{{ __t("Change company") }}"></ze-btn>
                            <ze-btn fa="trash" color="danger" hint="{{ __t("Delete") }}" direction="left"
                                    ng-click="delete(company)" ze-confirmation></ze-btn>
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