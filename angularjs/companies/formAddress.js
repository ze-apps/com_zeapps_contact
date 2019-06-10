app.controller("ComZeappsContactCompaniesAddressFormCtrl", ["$scope", "$routeParams", "$rootScope", "zeHttp",
    function ($scope, $routeParams, $rootScope, zhttp) {

        var currentTab = 'general';

        $scope.countriesHttp = zhttp.contact.countries;
        $scope.countriesFields = [
            {label: 'Code ISO', key: 'iso_code'},
            {label: 'Pays', key: 'name'}
        ];

        $scope.statesHttp = zhttp.contact.states;
        $scope.statesFields = [
            {label: 'Code ISO', key: 'iso_code'},
            {label: 'Etat', key: 'name'}
        ];

        $scope.loadState = loadState;
        $scope.loadCountry = loadCountry;

        $scope.updateAge = updateAge;

        function updateAge(date_of_birth) {
            $scope.form.age_of_contact = get_age_from_date_of_birth(date_of_birth);
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
                $scope.$parent.form.state_id = state.id;
                $scope.$parent.form.state = state.iso_code;
            } else {
                $scope.$parent.form.state_id = 0;
                $scope.$parent.form.state = "";
            }
        }
    }]);