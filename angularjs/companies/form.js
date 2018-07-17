app.controller("ComZeappsContactCompaniesFormCtrl", ["$scope", "$rootScope", "zeHttp",
	function ($scope, $rootScope, zhttp) {

        var currentTab = 'general';


		$scope.accountManagerHttp = zhttp.app.user;
		$scope.accountManagerFields = [
			{label:'Prénom',key:'firstname'},
			{label:'Nom',key:'lastname'}
		];

		$scope.parentCompanyHttp = zhttp.contact.company;
		$scope.parentCompanyFields = [
			{label:'Nom',key:'company_name'},
			{label:'Téléphone',key:'phone'},
			{label:'Ville',key:'billing_city'},
			{label:'Gestionnaire du compte',key:'name_user_account_manager'}
		];

		$scope.codeNafHttp = zhttp.contact.code_naf;
		$scope.codeNafFields = [
			{label:'Code NAF',key:'code_naf'},
			{label:'Libellé',key:'libelle'}
		];

		$scope.countriesHttp = zhttp.contact.countries;
		$scope.countriesFields = [
			{label:'Code ISO',key:'iso_code'},
			{label:'Pays',key:'name'}
		];

        $scope.statesHttp = zhttp.contact.states;
        $scope.statesFields = [
            {label:'Code ISO',key:'iso_code'},
            {label:'Etat',key:'name'}
        ];

        $scope.accountingNumberHttp = zhttp.contact.accounting_number;
        $scope.accountingNumberTplNew = '/com_zeapps_contact/accounting_numbers/form_modal';
        $scope.accountingNumberFields = [
            {label:'Numero',key:'number'},
            {label:'Libelle',key:'label'},
            {label:'Type',key:'type_label'}
        ];

        $scope.isTabActive = isTabActive;
        $scope.setTab = setTab;
        $scope.displayTab = displayTab;

        $scope.updateAccountFamily = updateAccountFamily;
        $scope.updateTopology = updateTopology;
        $scope.updateModality = updateModality;

		$scope.loadAccountManager = loadAccountManager;
		$scope.loadParentCompany = loadParentCompany;
		$scope.loadCodeNaf = loadCodeNaf;
		$scope.loadCountryDelivery = loadCountryDelivery;
		$scope.loadCountryBilling = loadCountryBilling;
		$scope.loadStateDelivery = loadStateDelivery;
		$scope.loadStateBilling = loadStateBilling;
		$scope.loadAccountingNumber = loadAccountingNumber;

        zhttp.contact.company.context().then(function (response) {
            if (response.status == 200) {
                $scope.account_families = response.data.account_families;
                $scope.topologies = response.data.topologies;

                $scope.$parent.form.id_user_account_manager = $rootScope.user.id;
                $scope.$parent.form.name_user_account_manager =  $rootScope.user.firstname + " " +  $rootScope.user.lastname;
            }
        });

        function isTabActive(tab){
            return currentTab === tab ? 'active' : '';
        }

        function setTab(tab){
            return currentTab = tab;
        }

        function displayTab(tab){
            return currentTab === tab;
        }

        function updateAccountFamily(){
            angular.forEach($scope.account_families, function(account_family){
                if($scope.form.id_account_family === account_family.id){
                    $scope.form.name_account_family = account_family.label;
                }
            });
        }

        function updateTopology(){
            angular.forEach($scope.topologies, function(topology){
                if($scope.form.id_topology === topology.id){
                    $scope.form.name_topology = topology.label;
                }
            });
        }

        function updateModality(){
            angular.forEach($rootScope.modalities, function(modality){
                if($scope.form.id_modality === modality.id){
                    $scope.form.label_modality = modality.label;
                }
            });
        }

		function loadAccountManager(user) {
            if (user) {
                $scope.$parent.form.id_user_account_manager = user.id;
                $scope.$parent.form.name_user_account_manager = user.firstname + " " + user.lastname;
            } else {
                $scope.$parent.form.id_user_account_manager = 0;
                $scope.$parent.form.name_user_account_manager = "";
            }
		}

		function loadParentCompany(company) {
            if (company) {
                $scope.$parent.form.id_parent_company = company.id;
                $scope.$parent.form.name_parent_company = company.company_name;
            } else {
                $scope.$parent.form.id_parent_company = 0;
                $scope.$parent.form.name_parent_company = "";
            }
		}

		function loadCodeNaf(code_naf) {
            if (code_naf) {
                $scope.$parent.form.code_naf = code_naf.code_naf;
                $scope.$parent.form.code_naf_libelle = code_naf.libelle;
            } else {
                $scope.$parent.form.code_naf = 0;
                $scope.$parent.form.code_naf_libelle = "";
            }
		}

		function loadCountryDelivery(country) {
            if (country) {
                $scope.$parent.form.delivery_country_id = country.id;
                $scope.$parent.form.delivery_country_name = country.name;
            } else {
                $scope.$parent.form.delivery_country_id = 0;
                $scope.$parent.form.delivery_country_name = "";
            }
		}

		function loadCountryBilling(country) {
            if (country) {
                $scope.$parent.form.billing_country_id = country.id;
                $scope.$parent.form.billing_country_name = country.name;
            } else {
                $scope.$parent.form.billing_country_id = 0;
                $scope.$parent.form.billing_country_name = "";
            }
		}

		function loadStateDelivery(state) {
            if (state) {
                $scope.$parent.form.delivery_state = state.iso_code;
            } else {
                $scope.$parent.form.delivery_state = "";
            }
		}

		function loadStateBilling(state) {
            if (state) {
                $scope.$parent.form.billing_state = state.iso_code;
            } else {
                $scope.$parent.form.billing_state = "";
            }
		}

		function loadAccountingNumber(accounting_number) {
            if (accounting_number) {
                $scope.$parent.form.accounting_number = accounting_number.number;
            } else {
                $scope.$parent.form.accounting_number = "";
            }
		}
	}]);