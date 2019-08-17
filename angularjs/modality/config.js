app.controller("ComZeappsCrmModalityConfigCtrl", ["$scope", "$rootScope", "zeHttp", "menu",
	function ($scope, $rootScope, zhttp, menu) {

        menu("com_ze_apps_config", "com_ze_apps_modalities");

        $scope.templateForm = "/com_zeapps_contact/modalities/form_modal";

        $scope.add = add;
        $scope.edit = edit;
		$scope.delete = del;

		$scope.list_modalities = [];

		var loadModalities = function () {
            $scope.list_modalities = [];
            zhttp.contact.modality.get_all().then(function (response) {
                $scope.list_modalities = response.data ;
            }) ;
        };
        loadModalities();

        function add(modality){
            var formatted_data = angular.toJson(modality);
            zhttp.contact.modality.save(formatted_data).then(function(response){
                if(response.data && response.data != "false"){
                    modality.id = response.data;
                    loadModalities();
                }
            });
        }

        function edit(modality){
            var formatted_data = angular.toJson(modality);
            zhttp.contact.modality.save(formatted_data).then(function () {
                loadModalities();
            });
        }

		function del(modality){
            zhttp.contact.modality.del(modality.id).then(function (response) {
                if (response.status == 200) {
                    loadModalities();
                }
            });
		}
	}]);