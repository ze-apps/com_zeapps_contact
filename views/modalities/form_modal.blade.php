<div ng-controller="ComZeappsCrmModalityConfigFormModalCtrl">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Label") }}</label>
                <input type="text" class="form-control" ng-model="form.label" ng-required="true">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Document caption") }}</label>
                <input type="text" class="form-control" ng-model="form.label_doc" ng-required="true">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("Settlement type") }}</label>
                <select class="form-control" ng-model="form.type_modality">
                    <option ng-value="0">{{ __t("Other mode") }}</option>
                    <option ng-value="1">{{ __t("Check") }}</option>
                    <option ng-value="2">{{ __t("Debit") }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("Check remittance ID") }}</label>
                <input type="text" ng-model="form.id_cheque" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("Accounting situation") }}</label>
                <select class="form-control" ng-model="form.situation">
                    <option ng-value="0">{{ __t("Waiting for payment") }}</option>
                    <option ng-value="1">{{ __t("Payment received") }}</option>
                    <option ng-value="2">{{ __t("Species") }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Accounting Account") }}</label>
                <input type="text" class="form-control" ng-model="form.accounting_account">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Diary") }}</label>
                <input type="text" ng-model="form.journal" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("Maturity type") }}</label>
                <select class="form-control" ng-model="form.settlement_type">
                    <option ng-value="0">{{ __t("According to the invoice date") }}</option>
                    <option ng-value="1">{{ __t("Fixed maturity") }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("The <small>(day of the month)</small>") }}</label>
                <input type="number" class="form-control" ng-model="form.settlement_date">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ __t("Number of days") }}</label>
                <input type="number" class="form-control" ng-model="form.settlement_delay">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Export code") }}</label>
                <input type="text" class="form-control" ng-model="form.export">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __t("Sequence") }}</label>
                <input type="number" class="form-control" ng-model="form.sort">
            </div>
        </div>
    </div>
</div>