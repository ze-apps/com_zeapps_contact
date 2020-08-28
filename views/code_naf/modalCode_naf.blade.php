<div class="modal-header">
    <h3 class="modal-title">@{{titre}}</h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="code_naf.length">
                <thead>
                <tr>
                    <th>{{ __t("NAF Code") }}</th>
                    <th>{{ __t("Label") }}</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="item in code_naf">
                    <td><a href="#" ng-click="loadCodeNaf(item.code_naf)">@{{item.code_naf}}</a></td>
                    <td><a href="#" ng-click="loadCodeNaf(item.code_naf)">@{{item.libelle}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-danger" type="button" ng-click="cancel()">{{ __t("Cancel") }}</button>
</div>