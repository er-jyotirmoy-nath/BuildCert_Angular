/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var app = angular.module("homepage",["ngRoute"]);

app.config(function($routeProvider){
    $routeProvider
            .when('/tmv2',{
                templateUrl : "tmv2.php"
                
            })
            .when('/tmv3',{
                templateUrl : "tmv3.php"
                
            })
            .otherwise({
                redirectTo: "/\n\
"
            });
});