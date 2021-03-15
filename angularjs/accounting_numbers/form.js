app.controller("ComZeappsCrmAccountingNumberFormCtrl", ["$scope",
	function ($scope) {

		$scope.types = [
            {
                id: '1',
                label: __t("Customer")
            },
            {
                id: '2',
                label: __t("supplier")
            },
            {
                id: '3',
                label: __t("VAT")
            },
            {
                id: '4',
                label: __t("Product")
            },
            {
                id: '5',
                label: __t("Purchase")
            }
        ];

		$scope.updateType = updateType;

		function updateType() {
		    angular.forEach($scope.types, function(type){
		        if(type.id == $scope.form.type){
		            $scope.form.type_label = type.label;
                }
            })
		}
	}]);