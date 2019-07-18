<div class="row">
    <div class="col-md-4">
        <strong>Code naf : </strong>@{{company.code_naf_libelle}}
    </div>
    <div class="col-md-4">
        <strong>SIRET : </strong>@{{company.company_number}}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <strong>Chiffre d'affaires : </strong>@{{company.turnover | currency:'€'}}
    </div>
    <div class="col-md-4">
        <strong>Compte comptable : </strong>@{{company.accounting_number}}
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
                    <i class="fa fa-fw fa-phone"></i> @{{company.phone}}
                </div>
                <div class="col-md-4">
                    <i class="fa fa-fw fa-fax"></i> @{{company.fax}}
                </div>
                <div class="col-md-4">
                    <i class="fa fa-fw fa-globe"></i> @{{company.website_url}}
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
            <strong>Adresse de livraison :</strong>
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
            <strong>Adresse(s) secondaire(s) :</strong>
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
            <strong>Commentaire :</strong>
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
                <strong>Temps moyen entre 2 commandes :</strong>
            </div>
            <div class="well">
                @{{company.average_order | number:0}} jours
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div ng-if="company.turnovers && company.turnovers.length">
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
                    <tr ng-repeat="turnover in company.turnovers">
                        <td>@{{turnover.year}}</td>
                        <td class="text-right">@{{turnover.total_ht | currency:'€':2}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>