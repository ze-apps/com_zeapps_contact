app.controller("ComZeappsContactCompaniesFormCtrl", ["$scope", "$rootScope", "zeHttp",
    function ($scope, $rootScope, zhttp) {
        var currentTab = 'general';

        $scope.companyTplNew = "/com_zeapps_contact/companies/form_modal";

        $scope.accountManagerHttp = zhttp.app.user;
        $scope.accountManagerFields = [
            {label: __t("First name"), key: 'firstname'},
            {label: __t("Last name"), key: 'lastname'}
        ];

        $scope.parentCompanyHttp = zhttp.contact.company;
        $scope.parentCompanyFields = [
            {label: __t("Name"), key: 'company_name'},
            {label: __t("Phone"), key: 'phone'},
            {label: __t("City"), key: 'billing_city'},
            {label: __t("Account manager"), key: 'name_user_account_manager'}
        ];

        $scope.codeNafHttp = zhttp.contact.code_naf;
        $scope.codeNafFields = [
            {label: __t("NAF Code"), key: 'code_naf'},
            {label: __t("Label"), key: 'libelle'}
        ];

        $scope.countriesHttp = zhttp.contact.countries;
        $scope.countriesFields = [
            {label: __t("ISO code"), key: 'iso_code'},
            {label: __t("Country"), key: 'name'}
        ];

        $scope.statesHttp = zhttp.contact.states;
        $scope.statesFields = [
            {label: __t("ISO code"), key: 'iso_code'},
            {label: __t("State"), key: 'name'}
        ];

        $scope.accountingNumberHttp = zhttp.contact.accounting_number;
        $scope.accountingNumberTplNew = '/com_zeapps_contact/accounting_numbers/form_modal';
        $scope.accountingNumberFields = [
            {label: __t("Number"), key: 'number'},
            {label: __t("Label"), key: 'label'},
            {label: __t("Type"), key: 'type_label'}
        ];


        // charge la liste des grilles de prix
        $scope.price_lists = false;
        zhttp.crm.price_list.get_all().then(function (response) {
            if (response.status == 200) {
                $scope.price_lists = response.data;
            }
        });

        $scope.listCompaniesDuplicate = [] ;


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



        $scope.updateCompanyName = function () {
            $scope.listCompaniesDuplicate = [] ;
            var formatted_filters = angular.toJson({company_name:$scope.form.company_name});
            zhttp.contact.company.searchDuplicate(formatted_filters).then(function (response) {
                if (response.status == 200) {
                    $scope.listCompaniesDuplicate = response.data.companies ;
                    $scope.listCompaniesDuplicateTotal = response.data.total;
                }
            });
        };
        $scope.changeToDuplicateCompany = function (objCompany) {
            $scope.form.executeSave(objCompany);
        };


        zhttp.contact.company.context().then(function (response) {
            if (response.status == 200) {
                $scope.account_families = response.data.account_families;
                $scope.topologies = response.data.topologies;

                if (!$scope.form.id) {
                    $scope.$parent.form.id_user_account_manager = $rootScope.user.id;
                    $scope.$parent.form.name_user_account_manager = $rootScope.user.firstname + " " + $rootScope.user.lastname;

                    if (typeof JS_CRM_DEFAULT_DISCOUNT_COMPANY !== 'undefined') {
                        $scope.$parent.form.discount = JS_CRM_DEFAULT_DISCOUNT_COMPANY;
                    }
                    if (typeof JS_CRM_DEFAULT_MODALITY_COMPANY !== 'undefined') {
                        $scope.$parent.form.id_modality = JS_CRM_DEFAULT_MODALITY_COMPANY;
                    }
                    if (typeof JS_CRM_DEFAULT_ACCOUNT_NUMBER_COMPANY !== 'undefined') {
                        $scope.$parent.form.accounting_number=JS_CRM_DEFAULT_ACCOUNT_NUMBER_COMPANY;
                    }
                }
            }
        });

        function isTabActive(tab) {
            return currentTab === tab ? 'active' : '';
        }

        function setTab(tab) {
            return currentTab = tab;
        }

        function displayTab(tab) {
            return currentTab === tab;
        }

        function updateAccountFamily() {
            angular.forEach($scope.account_families, function (account_family) {
                if ($scope.form.id_account_family === account_family.id) {
                    $scope.form.name_account_family = account_family.label;
                }
            });
        }

        function updateTopology() {
            angular.forEach($scope.topologies, function (topology) {
                if ($scope.form.id_topology === topology.id) {
                    $scope.form.name_topology = topology.label;
                }
            });
        }

        function updateModality() {
            angular.forEach($rootScope.modalities, function (modality) {
                if ($scope.form.id_modality === modality.id) {
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