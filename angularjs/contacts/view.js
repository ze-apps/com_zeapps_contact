app.controller("ComZeappsContactContactsViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu", "$uibModal",
	function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu, $uibModal) {

        menu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.$on("comZeappsContact_triggerContactHook", function(){
			$rootScope.$broadcast("comZeappsContact_dataContactHook",
				{
					id_contact: $routeParams.id_contact,
					id_company: $scope.contact.id_company
				}
			);
		});


		// to activate hook function
        $scope.hooksComZeappsContact_ContactHook = zeHooks.get("comZeappsContact_ContactHook");




        $scope.templateEdit = "/com_zeapps_contact/contacts/form_modal";
        $scope.templateFormAddresse = "/com_zeapps_contact/contacts/form_addresse_modal";
        $scope.contact = [];
        $scope.currentTab = $rootScope.comZeappsContactLastShowTabContact || "summary";

		$scope.setTab = setTab;
        $scope.isTabActive = isTabActive;

        $scope.first_contact = first_contact;
        $scope.previous_contact = previous_contact;
        $scope.next_contact = next_contact;
        $scope.last_contact = last_contact;

        $scope.edit = edit;

        $scope.editAddresse = editAddresse;
        $scope.addAddresse = addAddresse;
        $scope.deleteAddresse = deleteAddresse;

        $scope.back = back;

        var loadDataContact = function () {
            if ($routeParams.id_contact && $routeParams.id_contact != 0) {
                zhttp.contact.contact.get($routeParams.id_contact).then(function (response) {
                    if (response.status == 200) {
                        $scope.contact = response.data.contact;
                        if ($scope.contact.date_of_birth && $scope.contact.date_of_birth != '0000-00-00') {
                            $scope.contact.date_of_birth = new Date($scope.contact.date_of_birth);
                        }
                        $scope.contact.age_of_contact = get_age_from_date_of_birth($scope.contact.date_of_birth);

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
        loadDataContact() ;

        if($rootScope.contacts_ids == undefined) {
            zhttp.contact.contact.all(0, 0, "").then(function (response) {
                if (response.status == 200) {
                    $scope.contacts = response.data.contacts;
                    $scope.contact.discount = parseFloat($scope.contact.discount);

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.contacts_ids = response.data.ids;

                    initNavigation();
                }
            });
        } else {
            initNavigation();
        }

		function setTab(tab){
			$rootScope.comZeappsContactLastShowTabContact = tab;
			$scope.currentTab = tab;
		}

		function isTabActive(tab){
			return $scope.currentTab === tab;
		}

		function edit() {
            var formatted_data = angular.toJson($scope.contact);
            zhttp.contact.contact.save(formatted_data);
		}

        function addAddresse(dataReturn) {
            dataReturn.id_contact = $routeParams.id_contact ;
            var formatted_data = angular.toJson(dataReturn);
            zhttp.contact.contact.save_address(formatted_data).then(function () {
                loadDataContact() ;
            });
        }

        function editAddresse(dataReturn) {
            var formatted_data = angular.toJson(dataReturn);
            zhttp.contact.contact.save_address(formatted_data).then(function () {
                //loadDataContact() ;
            });
        }

        function deleteAddresse(address) {
            zhttp.contact.contact.del_address(address.id).then(function () {
                loadDataContact() ;
            });
        }


		function back() {
			$location.path("/ng/com_zeapps_contact/contacts");
		}

        function initNavigation() {

            // calcul le nombre de résultat
            if ($rootScope.contacts_ids) {
                $scope.nb_contacts = $rootScope.contacts_ids.length;
            } else {
                $scope.nb_contacts = 0 ;
            }


            // calcul la position du résultat actuel
            $scope.contact_order = 0;
            $scope.contact_first = 0;
            $scope.contact_previous = 0;
            $scope.contact_next = 0;
            $scope.contact_last = 0;

            if ($rootScope.contacts_ids) {
                for (var i = 0; i < $rootScope.contacts_ids.length; i++) {
                    if ($rootScope.contacts_ids[i] == $routeParams.id_contact) {
                        $scope.contact_order = i + 1;
                        if (i > 0) {
                            $scope.contact_previous = $rootScope.contacts_ids[i - 1];
                        }

                        if ((i + 1) < $rootScope.contacts_ids.length) {
                            $scope.contact_next = $rootScope.contacts_ids[i + 1];
                        }
                    }
                }

                // recherche la première companie de la liste
                if ($rootScope.contacts_ids[0] != $routeParams.id_contact) {
                    $scope.contact_first = $rootScope.contacts_ids[0];
                }

                // recherche la dernière companie de la liste
                if ($rootScope.contacts_ids[$rootScope.contacts_ids.length - 1] != $routeParams.id_contact) {
                    $scope.contact_last = $rootScope.contacts_ids[$rootScope.contacts_ids.length - 1];
                }
            }
        }

        function first_contact() {
            if ($scope.contact_first !== 0) {
                $location.path("/ng/com_zeapps_contact/contacts/" + $scope.contact_first);
            }
        }
        function previous_contact() {
            if ($scope.contact_previous !== 0) {
                $location.path("/ng/com_zeapps_contact/contacts/" + $scope.contact_previous);
            }
        }
        function next_contact() {
            if ($scope.contact_next) {
                $location.path("/ng/com_zeapps_contact/contacts/" + $scope.contact_next);
            }
        }
        function last_contact() {
            if ($scope.contact_last) {
                $location.path("/ng/com_zeapps_contact/contacts/" + $scope.contact_last);
            }
        }

        function get_age_from_date_of_birth(date) {
            var today = new Date();
            var age = Math.floor((today-date) / (365.25 * 24 * 60 * 60 * 1000) );
            if (age == 1) {
                return __t("1 year");
            } else {
                return age + ' ' + __t("years");
            }
        }
	}]);