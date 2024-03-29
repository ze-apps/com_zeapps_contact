app.controller("ComZeappsContactCompaniesViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu", "$uibModal",
    function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu, $uibModal) {

        menu("com_ze_apps_sales", "com_zeapps_sales_company");


        $scope.$on("comZeappsContact_triggerEntrepriseHook", function (event, data) {
            $rootScope.$broadcast("comZeappsContact_dataEntrepriseHook",
                {
                    id_company: $routeParams.id_company
                }
            );
        });

        // to activate hook function
        $scope.hooksComZeappsContact_EntrepriseHook = zeHooks.get("comZeappsContact_EntrepriseHook");



        $scope.templateEdit = "/com_zeapps_contact/companies/form_modal";
        $scope.templateFormAddresse = "/com_zeapps_contact/companies/form_addresse_modal";
        $scope.companies = [];

        $scope.currentTab = $rootScope.comZeappsContactLastShowTabEntreprise || "summary";

        $scope.setTab = setTab;
        $scope.isTabActive = isTabActive;

        $scope.first_company = first_company;
        $scope.previous_company = previous_company;
        $scope.next_company = next_company;
        $scope.last_company = last_company;

        $scope.editAddresse = editAddresse;
        $scope.addAddresse = addAddresse;
        $scope.deleteAddresse = deleteAddresse;

        $scope.edit = edit;
        $scope.back = back;

        // charge la fiche
        var loadDataCompany = function () {
            if ($routeParams.id_company && $routeParams.id_company != 0) {
                zhttp.contact.company.get($routeParams.id_company).then(function (response) {
                    if (response.status == 200) {
                        $scope.company = response.data.company;
                        $scope.company.discount = parseFloat($scope.company.discount);
                        $scope.contacts = response.data.contacts;

                        if (parseFloat(response.data.currentDue) > parseFloat(response.data.authozied_outstanding_amount)) {
                            var message = __t("The customer has exceeded the authorized outstanding amount") ;
                            message += "<br>" ;
                            message += __t("Amount") + " : " + response.data.currentDue ;
                            message += "<br>" ;
                            message += __t("Authorized outstanding") + " : " + response.data.authozied_outstanding_amount;

                            var modalInstance = $uibModal.open({
                                animation: true,
                                templateUrl: "/assets/angular/popupModalDeBase.html",
                                controller: "ZeAppsPopupModalDeBaseCtrl",
                                size: "lg",
                                resolve: {
                                    titre: function () {
                                        return __t("Warning");
                                    },
                                    msg: function () {
                                        return message;
                                    },
                                    action_danger: function () {
                                        return "OK";
                                    },
                                    action_primary: function () {
                                        return false;
                                    },
                                    action_success: function () {
                                        return false;
                                    }
                                }
                            });
                            modalInstance.result.then(function (selectedItem) {
                                if (selectedItem.action == "danger") {

                                }
                            }, function () {
                            });
                        }
                    }
                });
            }
        };
        loadDataCompany() ;

        if ($rootScope.companies_ids == undefined) {
            zhttp.contact.company.all(0, 0, "").then(function (response) {
                if (response.status == 200) {
                    $scope.companies = response.data.companies;

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.companies_ids = response.data.ids;

                    initNavigation();
                }
            });
        }
        else {
            initNavigation();
        }

        function setTab(tab) {
            $rootScope.comZeappsContactLastShowTabEntreprise = tab;
            $scope.currentTab = tab;
        }

        function isTabActive(tab) {
            return $scope.currentTab === tab;
        }

        function edit() {
            var formatted_data = angular.toJson($scope.company);
            zhttp.contact.company.save(formatted_data);
        }

        function back() {
            $location.path("/ng/com_zeapps_contact/companies");
        }

        function initNavigation() {

            // calcul le nombre de résultat
            if ($rootScope.companies_ids) {
                $scope.nb_companies = $rootScope.companies_ids.length;
            } else {
                $scope.nb_companies = 0 ;
            }


            // calcul la position du résultat actuel
            $scope.companie_order = 0;
            $scope.company_first = 0;
            $scope.company_previous = 0;
            $scope.company_next = 0;
            $scope.company_last = 0;

            if ($rootScope.companies_ids) {
                for (var i = 0; i < $rootScope.companies_ids.length; i++) {
                    if ($rootScope.companies_ids[i] == $routeParams.id_company) {
                        $scope.companie_order = i + 1;
                        if (i > 0) {
                            $scope.company_previous = $rootScope.companies_ids[i - 1];
                        }

                        if ((i + 1) < $rootScope.companies_ids.length) {
                            $scope.company_next = $rootScope.companies_ids[i + 1];
                        }
                    }
                }

                // recherche la première companie de la liste
                if ($rootScope.companies_ids[0] != $routeParams.id_company) {
                    $scope.company_first = $rootScope.companies_ids[0];
                }

                // recherche la dernière companie de la liste
                if ($rootScope.companies_ids[$rootScope.companies_ids.length - 1] != $routeParams.id_company) {
                    $scope.company_last = $rootScope.companies_ids[$rootScope.companies_ids.length - 1];
                }
            }
        }

        function first_company() {
            if ($scope.company_first !== 0) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_first);
            }
        }

        function previous_company() {
            if ($scope.company_previous !== 0) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_previous);
            }
        }

        function next_company() {
            if ($scope.company_next) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_next);
            }
        }

        function last_company() {
            if ($scope.company_last) {
                $location.path("/ng/com_zeapps_contact/companies/" + $scope.company_last);
            }
        }


        function addAddresse(dataReturn) {
            dataReturn.id_company = $routeParams.id_company ;
            var formatted_data = angular.toJson(dataReturn);
            zhttp.contact.company.save_address(formatted_data).then(function () {
                loadDataCompany() ;
            });
        }

        function editAddresse(dataReturn) {
            var formatted_data = angular.toJson(dataReturn);
            zhttp.contact.company.save_address(formatted_data).then(function () {
                //loadDataCompany() ;
            });
        }

        function deleteAddresse(address) {
            zhttp.contact.company.del_address(address.id).then(function () {
                loadDataCompany() ;
            });
        }
    }]);