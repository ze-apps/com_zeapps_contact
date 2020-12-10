<!----------- modal d'ajout d'un acounting number -------------->
<div ng-controller="ComZeappsCrmAccountingNumberFormCtrl">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ __t("Label") }}</label>
                <input type="text" class="form-control" ng-model="form.label">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Number") }}</label>
                <input type="text" class="form-control" ng-model="form.number">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Accounting account type") }}</label>
                <select class="form-control" ng-model="form.type" ng-change="updateType()">
                    <option ng-repeat="type in types" ng-value="@{{type.id}}">@{{ type.label }}</option>
                </select>
            </div>
        </div>
    </div>
</div>