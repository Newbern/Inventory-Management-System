<?php
class Router {
    // Defying Routes & Controllers
    private array $routes = [];
    private string $current_route = "";
    private string $controller = "";

    // Getting route and storing it
    public function get(string $path, string $method) {
        // Setting route from the current_route with the route being set
        $full_path = $this->current_route . $path;
        // Storing the function as a string to be ran later if you go to the controller you will see the callable functions
        $this->routes[$full_path] = $this->controller . "@". $method;
    }

    // Grouping up routes
    // This will help keep all together and from getting messy
    public function group(string $new_route, string $controller, callable $callback){
        // Setting the group controller to this object to be ran for all the routes that are stored
        $this->controller = $controller;

        // Setting the current_route with a new location & also saving it for later
        $previous_route = $this->current_route;
        $this->current_route = $previous_route . $new_route;

        // Calling the function so we can get all the routes and store them in this object
        $callback($this);

        // Once we collet all the routes we will reset this route to the original current route so when we get the routes function
        // it will start from the beginning and not for example (admin/signin)
        $this->current_route = $previous_route;
    }

    // Executing the router
    public function dispatch(string $request) {
        // Checking to see if the route is even stored in the router array
        if (isset($this->routes[$request])) {

            // Separating the Controller from the method or 'callable function'
            [$controller_name, $method] = explode("@", $this->routes[$request]);

            // Loading in the Controller to be used
            require ROOT. "app/controllers/$controller_name.php";

            // Creating a obj with the controller and calling the function with it
            $controller = new $controller_name();
            $controller->$method();
        }
        // if it is not stored in the router array it will go to the error page specifically
        else {
            require ROOT . "app/controllers/public_controller.php";
            $Error = new Public_Controller;
            $Error->Error();
        }
    }
}