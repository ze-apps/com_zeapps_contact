<div class="modal-header">
    <h3 class="modal-title">@{{titre}}</h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="contacts.length">
                <thead>
                <tr>
                    <th>{{ __t("Name") }}</th>
                    <th>{{ __t("Company") }}</th>
                    <th>{{ __t("Phone") }}</th>
                    <th>{{ __t("City") }}</th>
                    <th>{{ __t("Account manager") }}</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="contact in contacts">
                    <td><a href="#" ng-click="loadContact(contact)">@{{contact.last_name + ' ' + contact.first_name}}</a></td>
                    <td><a href="#" ng-click="loadContact(contact)">@{{contact.name_company}}</a></td>
                    <td><a href="#" ng-click="loadContact(contact)">@{{contact.phone}}</a></td>
                    <td><a href="#" ng-click="loadContact(contact)">@{{contact.city}}</a></td>
                    <td><a href="#" ng-click="loadContact(contact)">@{{contact.name_user_account_manager}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-danger" type="button" ng-click="cancel()">{{ __t("Cancel") }}</button>
</div>