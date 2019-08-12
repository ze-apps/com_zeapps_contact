app.controller("ComZeappsContactContactsListPartialCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "toasts", "$uibModal",
	function ($scope, $routeParams, $location, $rootScope, zhttp, toasts, $uibModal) {

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'first_name LIKE',
                    type: 'text',
                    label: 'Prénom'
                },
                {
                    format: 'input',
                    field: 'last_name LIKE',
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
                    field: 'city LIKE',
                    type: 'text',
                    label: 'Ville',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'zipcode LIKE',
                    type: 'text',
                    label: 'Code Postal',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'country_name LIKE',
                    type: 'text',
                    label: 'Pays',
                    size: 6
                }
            ]
        };
        $scope.filter_model = {};
		$scope.page = 1;
		$scope.pageSize = 15;
        $scope.total = 0;
        $scope.templateForm = '/com_zeapps_contact/contacts/form_modal';

        $scope.btn_adding_existing_contact = false ;

        $scope.loadList = loadList;
        $scope.goTo = goTo;
        $scope.getExcel = getExcel;
        $scope.add = add;
        $scope.edit = edit;
		$scope.delete = del;



        $scope.contactHttp = zhttp.contact.contact;
        $scope.contactFields = [
            {label:'Nom',key:'last_name'},
            {label:'Prénom',key:'first_name'},
            {label:'Entreprise',key:'name_company'},
            {label:'Téléphone',key:'phone'},
            {label:'Ville',key:'city'},
            {label:'Gestionnaire du compte',key:'name_user_account_manager'}
        ];
        $scope.loadContact = loadContact;
        function loadContact(contact) {
            // tester si le contact est déjà affecté a une entreprise
            if (contact.id_company != 0 && contact.id_company != id_company) {
                var modalInstance = $uibModal.open({
                    animation: true,
                    templateUrl: "/assets/angular/popupModalDeBase.html",
                    controller: "ZeAppsPopupModalDeBaseCtrl",
                    size: "lg",
                    resolve: {
                        titre: function () {
                            return "Attention";
                        },
                        msg: function () {
                            return "Ce contact est déjà associé à une autre entreprise, souhaitez-vous relier ce contact avec cette société ?<br>(il ne sera plus associé à l'autre société)";
                        },
                        action_danger: function () {
                            return "Annuler";
                        },
                        action_primary: function () {
                            return false;
                        },
                        action_success: function () {
                            return "Confirmer";
                        }
                    }
                });

                modalInstance.result.then(
                    function (selectedItem) {
                        if (selectedItem.action === "success") {
                            saveContact(contact);
                        }
                    }
                );
            } else if (contact.id_company != id_company) {
                saveContact(contact);
            }
        }

        var saveContact = function(contact) {
            contact.id_company = id_company ;
            var formatted_data = angular.toJson(contact);
            zhttp.contact.contact.save(formatted_data).then(function (response) {
                loadList(false);
            });
        };





        var id_company = 0 ;
		loadList(true) ;
		function loadList(context) {
            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);
            id_company = $routeParams.id_company || '';
            if (id_company) {
                $scope.btn_adding_existing_contact = true;
            } else {
                $scope.btn_adding_existing_contact = false;
            }

			zhttp.contact.contact.all(id_company, $scope.pageSize, offset, context, formatted_filters).then(function (response) {
				if (response.status == 200) {
                    if(context) {
                        $scope.filters.main[2].options = response.data.account_families;
                    }

                    $scope.contacts = response.data.contacts;
                    angular.forEach($scope.contacts, function(contact){
                        if (contact.date_of_birth) {
                            contact.date_of_birth = new Date(contact.date_of_birth);
                            contact.age_of_contact = get_age_from_date_of_birth(contact.date_of_birth);
                        }
                        contact.discount = parseFloat(contact.discount);
                    });

                    $scope.total = response.data.total;
                    // stock la liste des contacts pour la navigation par fleche
                    $rootScope.contacts_ids = response.data.ids ;
				}
			});
		}

        function goTo(id){
            $location.url('/ng/com_zeapps_contact/contacts/'+id);
        }

        function getExcel() {
            var formatted_filters = angular.toJson($scope.filter_model);
            zhttp.contact.contact.excel.make(formatted_filters).then(function (response) {
                if (response.status == 200 && response.data) {
                    window.document.location.href = zhttp.contact.contact.excel.get(response.data.link);
                } else {
                    toasts('danger', "Une erreur (2) est survenue lors de la génération du fichier Excel");
                }
            });
        }

        function add(contact) {
            var formatted_data = angular.toJson(contact);
            zhttp.contact.contact.save(formatted_data).then(function (response) {
                if (response.data && response.data != "false") {
                    $location.path("/ng/com_zeapps_contact/contacts/" + response.data);
                }
            });
        }

        function edit(contact) {
            var formatted_data = angular.toJson(contact);
            zhttp.contact.contact.save(formatted_data);
            loadList();
        }

		function del(contact) {
            zhttp.contact.contact.del(contact.id).then(function (response) {
                if (response.status == 200) {
                    loadList();
                }
            });
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