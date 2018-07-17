app.run(["zeHttp", "$rootScope", function(zhttp, $rootScope){
    $rootScope.modalities =[];

    $modalities = zhttp.contact.modality.get_all() ;
    $modalities.success(function (response) {
        angular.forEach(response, function(modality){
            $rootScope.modalities.push(modality);
        });
    });
}]);