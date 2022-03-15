<?php

class Router {

    private $routes;

    function __construct()
    {
        $this->routes = include(ROOT . '/components/routes.php');
    }

    private function getURI() {
        $uri = explode( '?', $_SERVER['REQUEST_URI'] );
        return trim( $uri[0], '/' );
    }

    public function run() {
        $uri = $this->getURI();
        foreach( $this->routes as $route => $action ) {
            if( $uri == $route ) {
                include( ROOT . '/controllers/ContactsController.php');
                $controller = new ContactsController();
                $controller->$action();
                break;
            }
        }
    }

}