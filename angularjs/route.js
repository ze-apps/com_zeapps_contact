app.config(["$routeProvider",
	function ($routeProvider) {
		$routeProvider
		// MODALITIES
			.when("/ng/com_zeapps/modalities", {
				templateUrl: "/com_zeapps_contact/modalities/config",
				controller: "ComZeappsCrmModalityConfigCtrl"
			})

			.when("/ng/com_zeapps/modalities/new", {
				templateUrl: "/com_zeapps_contact/modalities/form_modal",
				controller: "ComZeappsCrmModalityConfigFormCtrl"
			})

			.when("/ng/com_zeapps/modalities/edit/:id", {
				templateUrl: "/com_zeapps_contact/modalities/form_modal",
				controller: "ComZeappsCrmModalityConfigFormCtrl"
			})



		// COMPANIES
			.when("/ng/com_zeapps_contact/companies", {
				templateUrl: "/com_zeapps_contact/companies/search",
				controller: "ComZeappsContactCompaniesListCtrl"
			})
			.when("/ng/com_zeapps_contact/companies/:id_company", {
				templateUrl: "/com_zeapps_contact/companies/view",
				controller: "ComZeappsContactCompaniesViewCtrl"
			})


		// CONTACT
			.when("/ng/com_zeapps_contact/contacts", {
				templateUrl: "/com_zeapps_contact/contacts/search",
				controller: "ComZeappsContactContactsListCtrl"
			})
			.when("/ng/com_zeapps_contact/contacts/:id_contact", {
				templateUrl: "/com_zeapps_contact/contacts/view",
				controller: "ComZeappsContactContactsViewCtrl"
			})


		// CONFIG
			.when("/ng/com_zeapps/account_families", {
				templateUrl: "/com_zeapps_contact/account_families/config",
				controller: "ComZeappsContactAccountFamiliesConfigCtrl"
			})
			/*.when("/ng/com_zeapps/topologies", {
				templateUrl: "/com_zeapps_contact/topologies/config",
				controller: "ComZeappsContactTopologiesConfigCtrl"
			})*/
		;
	}]);

