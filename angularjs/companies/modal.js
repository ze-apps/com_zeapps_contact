// declare the modal to the app service
listModuleModalFunction.push({
	module_name:"com_zeapps_contact",
	function_name:"search_company",
	templateUrl:"/com_zeapps_contact/companies/modal_company",
	controller:"ZeAppsContactsModalCompanyCtrl",
	size:"lg",
	resolve:{
		titre: function () {
			return __t("Search for a company");
		}
	}
});


app.controller("ZeAppsContactsModalCompanyCtrl", ["$scope", "$uibModalInstance", "zeHttp", "titre", "option", function($scope, $uibModalInstance, zhttp, titre, option) {

	$scope.titre = titre ;

	$scope.cancel = cancel;
	$scope.loadCompany = loadCompany;

	loadList() ;

	function loadList() {
		var options = {};
        zhttp.post("/com_zeapps_contact/companies/getAll", options).then(function (response) {
			if (response.status == 200) {
				$scope.companies = response.data.companies ;
                angular.forEach($scope.companies, function(company){
                    company.discount = parseFloat(company.discount);
                });
			}
		});
	}

	function cancel() {
		$uibModalInstance.dismiss("cancel");
	}

	function loadCompany(id_company) {

		// search the company
		var company = false ;
		for (var i = 0 ; i < $scope.companies.length ; i++) {
			if ($scope.companies[i].id == id_company) {
				company = $scope.companies[i] ;
				break;
			}
		}

		$uibModalInstance.close(company);
	}

}]) ;