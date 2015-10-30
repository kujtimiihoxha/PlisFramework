
// Create an plislication module for our demo.
var plis = angular.module( "plisApp", [] );
// -------------------------------------------------- //
// -------------------------------------------------- //
// After the AngularJS has been bootstrplised, you can no longer
// use the normal module methods (ex, plis.controller) to add
// components to the dependency-injection container. Instead,
// you have to use the relevant providers. Since those are only
// available during the config() method at initialization time,
// we have to keep a reference to them.
// --
// NOTE: This general idea is based on excellent article by
// Ifeanyi Isitor: http://ify.io/lazy-loading-in-angularjs/
plis.config(
    function( $controllerProvider, $provide, $compileProvider ) {
        // Since the "shorthand" methods for component
        // definitions are no longer valid, we can just
        // override them to use the providers for post-
        // bootstrap loading.
        console.log( "Config method executed." );
        // Let's keep the older references.
        plis._controller = plis.controller;
        plis._service = plis.service;
        plis._factory = plis.factory;
        plis._value = plis.value;
        plis._directive = plis.directive;
        // Provider-based controller.
        plis.controller = function( name, constructor ) {
            $controllerProvider.register( name, constructor );
            return( this );
        };
        // Provider-based service.
        plis.service = function( name, constructor ) {
            $provide.service( name, constructor );
            return( this );
        };
        // Provider-based factory.
        plis.factory = function( name, factory ) {
            $provide.factory( name, factory );
            return( this );
        };
        // Provider-based value.
        plis.value = function( name, value ) {
            $provide.value( name, value );
            return( this );
        };
        // Provider-based directive.
        plis.directive = function( name, factory ) {
            $compileProvider.directive( name, factory );
            return( this );
        };
        // NOTE: You can do the same thing with the "filter"
        // and the "$filterProvider"; but, I don't really use
        // custom filters.
    }
);
