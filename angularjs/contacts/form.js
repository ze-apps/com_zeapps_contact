app.controller("ComZeappsContactContactsFormCtrl", ["$scope", "$routeParams", "$rootScope", "zeHttp",
    function ($scope, $routeParams, $rootScope, zhttp) {

        var currentTab = 'general';

        $scope.companyTplNew = "/com_zeapps_contact/companies/form_modal" ;

        $scope.accountManagerHttp = zhttp.app.user;
        $scope.accountManagerFields = [
            {label: __t("First name"), key: 'firstname'},
            {label: __t("Last name"), key: 'lastname'}
        ];

        $scope.companyHttp = zhttp.contact.company;
        $scope.companyFields = [
            {label: __t("Name"), key: 'company_name'},
            {label: __t("Phone"), key: 'phone'},
            {label: __t("City"), key: 'billing_city'},
            {label: __t("Account manager"), key: 'name_user_account_manager'}
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

        $scope.isTabActive = isTabActive;
        $scope.setTab = setTab;
        $scope.displayTab = displayTab;

        $scope.updateAccountFamily = updateAccountFamily;
        $scope.updateModality = updateModality;

        $scope.loadAccountManager = loadAccountManager;
        $scope.loadCompany = loadCompany;
        $scope.loadCountry = loadCountry;
        $scope.loadState = loadState;
        $scope.loadAccountingNumber = loadAccountingNumber;

        $scope.updateAge = updateAge;


        $scope.listContactsDuplicate = [] ;
        $scope.updateContactName = function () {
            $scope.listContactsDuplicate = [] ;
            var formatted_filters = angular.toJson({first_name:$scope.form.first_name, last_name:$scope.form.last_name});
            zhttp.contact.contact.searchDuplicate(formatted_filters).then(function (response) {
                if (response.status == 200) {
                    $scope.listContactsDuplicate = response.data.contacts ;
                    $scope.listContactsDuplicateTotal = response.data.total;
                }
            });
        };
        $scope.changeToDuplicateContact = function (objContact) {
            $scope.form.executeSave(objContact);
        };




        zhttp.contact.contact.context().then(function (response) {
            if (response.status == 200) {
                $scope.account_families = response.data.account_families;

                if (!$scope.form.id) {
                    $scope.$parent.form.id_user_account_manager = $rootScope.user.id;
                    $scope.$parent.form.name_user_account_manager = $rootScope.user.firstname + " " + $rootScope.user.lastname;
                }
            }
        });
        if ($routeParams.id_company !== undefined && $routeParams.id_company !== 0) {
            zhttp.contact.company.get($routeParams.id_company).then(function (response) {
                if (response.data && response.data != "false") {
                    loadCompany(response.data.company);
                }
            });
        }

        function updateAge(date_of_birth) {
            $scope.form.age_of_contact = get_age_from_date_of_birth(date_of_birth);
        }

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
                if ($scope.form.id_account_family == account_family.id) {
                    $scope.form.name_account_family = account_family.label;
                }
            });
        }

        function updateModality() {
            angular.forEach($rootScope.modalities, function (modality) {
                if ($scope.form.id_modality == modality.id) {
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

        function loadCompany(company) {
            if (company) {
                $scope.$parent.form.id_company = company.id;
                $scope.$parent.form.name_company = company.company_name;
            } else {
                $scope.$parent.form.id_company = 0;
                $scope.$parent.form.name_company = "";
            }
        }

        function loadCountry(country) {
            if (country) {
                $scope.$parent.form.country_id = country.id;
                $scope.$parent.form.country_name = country.name;
            } else {
                $scope.$parent.form.country_id = 0;
                $scope.$parent.form.country_name = "";
            }
        }

        function loadState(state) {
            if (state) {
                $scope.$parent.form.state = state.iso_code;
            } else {
                $scope.$parent.form.state = "";
            }
        }

        function loadAccountingNumber(accounting_number) {
            if (accounting_number) {
                $scope.$parent.form.accounting_number = accounting_number.number;
            } else {
                $scope.$parent.form.accounting_number = "";
            }
        }

        function get_age_from_date_of_birth(date) {
            var today = new Date();
            var age = Math.floor((today-date) / (365.25 * 24 * 60 * 60 * 1000) );
            if (age == 1) {
                return '1 an';
            } else {
                return age + ' ans';
            }
        }
    }]);