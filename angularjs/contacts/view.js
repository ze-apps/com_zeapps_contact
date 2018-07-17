app.controller("ComZeappsContactContactsViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu",
	function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu) {

        menu("com_ze_apps_sales", "com_zeapps_sales_contact");

		$scope.$on("comZeappsContact_triggerContactHook", function(){
			$rootScope.$broadcast("comZeappsContact_dataContactHook",
				{
					id_contact: $routeParams.id_contact,
					id_company: $scope.contact.id_company
				}
			);
		});

        $scope.templateEdit = "/com_zeapps_contact/contacts/form_modal";
        $scope.hooks = zeHooks.get("comZeappsContact_ContactHook");
        $scope.contact = [];

        $scope.currentTab = $rootScope.comZeappsContactLastShowTabContact || "summary";

		$scope.setTab = setTab;
        $scope.isTabActive = isTabActive;

        $scope.first_contact = first_contact;
        $scope.previous_contact = previous_contact;
        $scope.next_contact = next_contact;
        $scope.last_contact = last_contact;

        $scope.edit = edit;
        $scope.back = back;

        if ($routeParams.id_contact && $routeParams.id_contact != 0) {
            zhttp.contact.contact.get($routeParams.id_contact).then(function (response) {
                if (response.status == 200) {
                    $scope.contact = response.data.contact;
                    $scope.contact.date_of_birth = new Date($scope.contact.date_of_birth);
                }
            });
        }

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
        }
        else{
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

		function back() {
			$location.path("/ng/com_zeapps_contact/contacts");
		}

        function initNavigation() {

            // calcul le nombre de résultat
            $scope.nb_contacts = $rootScope.contacts_ids.length;


            // calcul la position du résultat actuel
            $scope.contact_order = 0;
            $scope.contact_first = 0;
            $scope.contact_previous = 0;
            $scope.contact_next = 0;
            $scope.contact_last = 0;

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
	}]);