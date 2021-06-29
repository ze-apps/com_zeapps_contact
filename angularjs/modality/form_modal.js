app.controller("ComZeappsCrmModalityConfigFormModalCtrl", ["$scope",
    function ($scope) {
        if (!$scope.form.id) {
            $scope.form.type_modality = 0 ;
            $scope.form.id_cheque = "" ;
            $scope.form.situation = 0 ;
            $scope.form.accounting_account = "" ;
            $scope.form.journal = "" ;
            $scope.form.settlement_type = 0 ;
            $scope.form.settlement_date = 0 ;
            $scope.form.settlement_delay = 0 ;
            $scope.form.export = "" ;
            $scope.form.sort = 0 ;
            $scope.form.code_web = "" ;
            $scope.form.label = "" ;
            $scope.form.label_doc = "" ;
        }
    }]);