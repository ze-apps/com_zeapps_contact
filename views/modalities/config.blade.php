<div id="breadcrumb">
    {{ __t("Lists of payment terms") }}
</div>
<div id="content">
    <div class="row">
        <div class="col-md-12">
            <ze-btn fa="plus" color="success" hint="{{ __t("Method of payment") }}" always-on="true"
                    ze-modalform="add"
                    data-template="templateForm"
                    data-title="{{ __t("Add a new payment method") }}"></ze-btn>
        </div>
    </div>

    <table class="table table-stripped table-condensed">
        <thead>
        <tr>
            <th>
                {{ __t("Label") }}
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="modality in list_modalities | orderBy:'sort'">
            <td>
                @{{ modality.label }}
            </td>
            <td class="text-right">
                <ze-btn fa="edit" color="info" hint="{{ __t("Edit") }}" direction="left"
                        ze-modalform="edit"
                        data-edit="modality"
                        data-template="templateForm"
                        data-title="{{ __t("Modify the payment method") }}"></ze-btn>
                <ze-btn fa="trash" color="danger" hint="{{ __t("Delete") }}" direction="left" ng-click="delete(modality)" ze-confirmation></ze-btn>
            </td>
        </tr>
        </tbody>
    </table>
</div>