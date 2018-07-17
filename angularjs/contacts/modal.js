// declare the modal to the app service
listModuleModalFunction.push({
	module_name:"com_zeapps_contact",
	function_name:"search_contact",
	templateUrl:"/com_zeapps_contact/contacts/modal_contact",
	controller:"ZeAppsContactsModalContactCtrl",
	size:"lg",
	resolve:{
		titre: function () {
			return "Recherche d'un contact";
		}
	}
});


app.controller("ZeAppsContactsModalContactCtrl", ["$scope", "$uibModalInstance", "zeHttp", "titre", "option", function($scope, $uibModalInstance, zhttp, titre, option) {

	$scope.titre = titre ;

	$scope.cancel = cancel;
	$scope.loadContact = loadContact;

	loadList() ;

	function loadList() {
        zhttp.contact.contact.all(option.id_company).then(function (response) {
			if (response.status == 200) {
				$scope.contacts = response.data.contacts ;
                angular.forEach($scope.contacts, function(contact){
                    contact.discount = parseFloat(contact.discount);
                });
			}
		});
	}

	function cancel() {
		$uibModalInstance.dismiss("cancel");
	}

	function loadContact(contact) {
		$uibModalInstance.close(contact);
	}

}]) ;