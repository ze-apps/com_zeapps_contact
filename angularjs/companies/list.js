app.controller("ComZeappsContactCompaniesListCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",
	function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_ze_apps_sales", "com_zeapps_sales_company");

		$scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'company_name LIKE',
                    type: 'text',
                    label: 'Nom'
                },
                {
                    format: 'select',
                    field: 'id_account_family',
                    type: 'text',
                    label: 'Type de compte',
                    options: []
                }
            ],
            secondaries: [
                {
                    format: 'input',
                    field: 'billing_city LIKE',
                    type: 'text',
                    label: 'Ville',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'billing_zipcode LIKE',
                    type: 'text',
                    label: 'Code Postal',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'billing_country_name LIKE',
                    type: 'text',
                    label: 'Pays',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'accounting_number LIKE',
                    type: 'text',
                    label: 'Compte comptable',
                    size: 6
                }
            ]
        };
		$scope.filter_model = {};
		$scope.companies = [];
		$scope.page = 1;
		$scope.pageSize = 15;
		$scope.total = 0;
		$scope.templateForm = '/com_zeapps_contact/companies/form_modal';

		$scope.loadList = loadList;
        $scope.goTo = goTo;
		$scope.loadCodeNaf = loadCodeNaf;
		$scope.removeCodeNaf = removeCodeNaf;
		$scope.loadCountryLang = loadCountryLang;
		$scope.removeCountryLang = removeCountryLang;
		$scope.getExcel = getExcel;
		$scope.add = add;
		$scope.edit = edit;
		$scope.delete = del;

		loadList(true) ;

		function loadList(context) {
			context = context || "";
			var offset = ($scope.page - 1) * $scope.pageSize;
			var formatted_filters = angular.toJson($scope.filter_model);

			zhttp.contact.company.all($scope.pageSize, offset, context, formatted_filters).then(function (response) {
				if (response.status == 200) {
					if(context) {
                        $scope.filters.main[1].options = response.data.account_families;
                    }
                    $scope.companies = response.data.companies ;
                    angular.forEach($scope.companies, function(company){
                        company.discount = parseFloat(company.discount);
                    });
					// stock la liste des compagnies pour la navigation par fleche
					$rootScope.companies_ids = response.data.ids ;
					$scope.total = response.data.total;
				}
			});
		}

        function goTo(id){
            $location.url('/ng/com_zeapps_contact/companies/'+id);
        }

		function loadCodeNaf() {
			zeapps_modal.loadModule("com_zeapps_contact", "search_code_naf", {}, function(objReturn) {
				if (objReturn) {
					$scope.filters.code_naf = objReturn.code_naf;
					$scope.filters.code_naf_libelle = objReturn.code_naf + " - " + objReturn.libelle;
				} else {
					$scope.filters.code_naf = "";
					$scope.filters.code_naf_libelle = "";
				}
			});
		}

		function removeCodeNaf() {
			delete $scope.filters.code_naf;
			$scope.filters.code_naf_libelle = "";
		}

		function loadCountryLang() {
			zeapps_modal.loadModule("com_zeapps_contact", "search_country_lang", {}, function (objReturn) {
				$scope.filters.country_lang_name = objReturn.name;
				$scope.filters.country_id = objReturn.id_country;
			});
		}

		function removeCountryLang() {
			$scope.filters.country_lang_name = "";
			$scope.filters.country_id = 0;

		}

		function getExcel() {
            var formatted_filters = angular.toJson($scope.filter_model);
            zhttp.contact.company.excel.make(formatted_filters).then(function (response) {
                if (response.status == 200 && response.data) {
                    window.document.location.href = zhttp.contact.company.excel.get(response.data.link);
                } else {
                    toasts('info', "Aucune compagnie correspondant à vos critères n'a pu etre trouvée");
                }
            });
        }

        function add(company) {
			var formatted_data = angular.toJson(company);
            zhttp.contact.company.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    $location.path("/ng/com_zeapps_contact/companies/" + response.data);
                    //loadList();
                }
            });
        }

        function edit(company) {
			var formatted_data = angular.toJson(company);
            zhttp.contact.company.save(formatted_data);
        }

		function del(company) {
            zhttp.contact.company.del(company.id).then(function (response) {
                if (response.status == 200) {
                    loadList();
                }
            });
		}


	}]);