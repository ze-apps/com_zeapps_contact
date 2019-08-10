app.controller("ComZeappsContactAccountFamiliesConfigCtrl", ["$scope", "$route", "$routeParams", "$location", "$rootScope", "zeHttp", "menu",
    function ($scope, $route, $routeParams, $location, $rootScope, zhttp, menu) {

        menu("com_ze_apps_config", "com_ze_apps_contact_account_families");

        $scope.templateForm = "/com_zeapps_contact/account_families/form_modal";

        $scope.add = add;
        $scope.edit = edit;
        $scope.delete = del;

        var loadList = function () {
            zhttp.contact.account_families.get_all().then(function (response) {
                if (response.status == 200) {
                    $scope.account_families = response.data;
                }
            });
        };
        loadList();


        function add(account_family) {
            var formatted_data = angular.toJson(account_family);
            zhttp.contact.account_families.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
        }

        function edit(account_family) {
            var formatted_data = angular.toJson(account_family);
            zhttp.contact.account_families.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
            ;
        }

        function del(account_family) {
            zhttp.contact.account_families.del(account_family.id).then(function (response) {
                if (response.data && response.data != "false") {
                    loadList();
                }
            });
        }
    }]);