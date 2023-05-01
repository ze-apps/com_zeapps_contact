<div class="row">
    <div class="col-md-4">
        <strong>{{ __t("NAF Code") }} : </strong>@{{company.code_naf_libelle}}
    </div>
    <div class="col-md-4">
        <strong>{{ __t("SIRET") }} : </strong>@{{company.company_number}}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <strong>{{ __t("Turnover") }} : </strong>@{{company.turnover | currencyConvert}}
    </div>
    <div class="col-md-4">
        <strong>{{ __t("Accounting Account") }} : </strong>@{{company.accounting_number}}
    </div>
    <div class="col-md-4">
        <strong>{{ __t("VAT number") }} : </strong>@{{company.tva_intracom}}
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div>
            <strong>{{ __t("Information") }} : </strong>
        </div>
        <div class="well">
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-fw fa-phone"></i> @{{company.phone}} <span ng-if="company.phone != '' && company.mobile != ''">/</span> @{{company.mobile}}
                </div>
                <div class="col-md-4">
                    <i class="fa fa-fw fa-fax"></i> @{{company.fax}}
                </div>
                <div class="col-md-4">
                    <i class="fa fa-fw fa-globe"></i> @{{company.website_url}}
                </div>
                <div class="col-md-12" ng-if="company.email != ''">
                    <i class="fas fa-envelope"></i> <a href="mailto:@{{company.email}}" target="_blank">@{{company.email}}</a>
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
            <span ng-if="company.billing_address_1 != ''">@{{company.billing_address_1}}<br></span>
            <span ng-if="company.billing_address_2 != ''">@{{company.billing_address_2}}<br></span>
            <span ng-if="company.billing_address_3 != ''">@{{company.billing_address_3}}<br></span>
            <span ng-if="company.billing_zipcode != '' || company.billing_city != ''">@{{company.billing_zipcode}} @{{company.billing_city}}<br></span>
            <span ng-if="company.billing_state != ''">@{{company.billing_state}}<br></span>
            <span ng-if="company.billing_country_name != ''">@{{company.billing_country_name}}<br></span>
        </div>
    </div>

    <div class="col-md-6">
        <div>
            <strong>{{ __t("Delivery address") }} :</strong>
        </div>
        <div class="well">
            <span ng-if="company.delivery_address_1 != ''">@{{company.delivery_address_1}}<br></span>
            <span ng-if="company.delivery_address_2 != ''">@{{company.delivery_address_2}}<br></span>
            <span ng-if="company.delivery_address_3 != ''">@{{company.delivery_address_3}}<br></span>
            <span ng-if="company.delivery_zipcode != '' || company.delivery_city != ''">@{{company.delivery_zipcode}} @{{company.delivery_city}}<br></span>
            <span ng-if="company.delivery_state != ''">@{{company.delivery_state}}<br></span>
            <span ng-if="company.delivery_country_name != ''">@{{company.delivery_country_name}}<br></span>
        </div>
    </div>
</div>


<div class="row" ng-show="company.sub_adresses.length">
    <div class="col-md-12">
        <div>
            <strong>{{ __t("Secondary address (es)") }} :</strong>
        </div>
        <div class="well" ng-repeat="address in company.sub_adresses">
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
            <span ng-bind-html=" company.comment | nl2br:true "></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div ng-show="company.average_order > 0">
            <div>
                <strong>{{ __t("Average time between 2 orders") }} :</strong>
            </div>
            <div class="well">
                @{{company.average_order | number:0}} jours
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div ng-if="company.turnovers && company.turnovers.length">
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
                    <tr ng-repeat="turnover in company.turnovers">
                        <td>@{{turnover.year}}</td>
                        <td class="text-right">@{{turnover.total_ht | currencyConvert}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>