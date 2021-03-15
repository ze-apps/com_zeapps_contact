app.controller("ComZeappsContactAccountingNumberConfigCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "menu",
    function ($scope, $route, $routeParams, $location, $rootScope, zhttp, menu) {

        menu("com_ze_apps_config", "com_ze_apps_contact_accounting_account");

        $scope.templateForm = "/com_zeapps_contact/accounting_numbers/form_modal";

        $scope.add = add;
        $scope.edit = edit;
        $scope.delete = del;

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'label LIKE',
                    type: 'text',
                    label: __t("Label")
                },
                {
                    format: 'input',
                    field: 'number LIKE',
                    type: 'text',
                    label: __t("Number")
                },
                {
                    format: 'input',
                    field: 'type_label LIKE',
                    type: 'text',
                    label: __t("Type")
                }
            ],
            secondaries: [
            ]
        };
        $scope.filter_model = {};
		$scope.page = 1;
		$scope.pageSize = 15;
        $scope.total = 0;


        

        var loadList = function () {
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);

			zhttp.contact.accounting_number.all($scope.pageSize, offset, formatted_filters).then(function (response) {
				if (response.status == 200) {
                    $scope.accounts = response.data.accounts;
                    $scope.total = response.data.total;
				}
            });
        };
        loadList();
        $scope.loadList = loadList;


        function add(accounting_account) {
            var formatted_data = angular.toJson(accounting_account);
            zhttp.contact.accounting_number.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
        }

        function edit(accounting_account) {
            var formatted_data = angular.toJson(accounting_account);
            zhttp.contact.accounting_number.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
            ;
        }

        function del(accounting_account) {
            zhttp.contact.accounting_number.del(accounting_account.id).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
        }
    }]);